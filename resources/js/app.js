import '../css/app.css';

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const finePointer = window.matchMedia('(pointer: fine)').matches;

/* Body scroll locking shared by the mobile drawer and every modal. */
const scrollLocks = new Set();
function setBodyLock(key, on) {
    on ? scrollLocks.add(key) : scrollLocks.delete(key);
    document.body.style.overflow = scrollLocks.size ? 'hidden' : '';
}

function rafThrottle(fn) {
    let queued = false;
    return (...args) => {
        if (queued) return;
        queued = true;
        requestAnimationFrame(() => {
            queued = false;
            fn(...args);
        });
    };
}

/* ---------------- scroll reveal (Framer Motion `whileInView` replacement) --------------- */
function setupReveal(root = document) {
    const items = root.querySelectorAll('[data-reveal]:not([data-reveal-bound])');
    if (!items.length) return;

    items.forEach((el) => el.dataset.revealBound = '1');

    if (reduceMotion || !('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            const delay = Number(el.dataset.delay || 0);
            window.setTimeout(() => el.classList.add('is-visible'), delay);
            observer.unobserve(el);
        });
    }, { threshold: 0.12 });

    items.forEach((el) => observer.observe(el));
}
setupReveal();

/* Livewire / dynamically injected content gets the same reveal treatment. */
if ('MutationObserver' in window) {
    new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            mutation.addedNodes.forEach((node) => {
                if (node.nodeType !== 1) return;
                if (node.matches?.('[data-reveal]')) setupReveal(node.parentElement || document);
                else if (node.querySelector?.('[data-reveal]')) setupReveal(node);
            });
        });
    }).observe(document.body, { childList: true, subtree: true });
}

/* ---------------- hero: scroll zoom/parallax + subtle pointer tilt --------------- */
(function heroMotion() {
    const hero = document.querySelector('[data-hero-parallax]');
    if (!hero || reduceMotion || window.innerWidth < 768) return;

    const bg = hero.querySelector('[data-hero-bg-wrap]');
    const content = hero.querySelector('[data-hero-content]');
    const target = { x: 0, y: 0 };
    const current = { x: 0, y: 0 };
    let queued = false;

    const request = () => {
        if (queued) return;
        queued = true;
        requestAnimationFrame(render);
    };

    function render() {
        queued = false;
        const rect = hero.getBoundingClientRect();
        const progress = Math.min(1, Math.max(0, -rect.top / Math.max(rect.height, 1)));

        current.x += (target.x - current.x) * 0.09;
        current.y += (target.y - current.y) * 0.09;

        if (bg) {
            bg.style.setProperty('--hero-x', `${current.x.toFixed(3)}%`);
            bg.style.setProperty('--hero-y', `calc(${(progress * 30).toFixed(2)}% + ${current.y.toFixed(3)}%)`);
            bg.style.setProperty('--hero-scale', (1 + progress * 0.3).toFixed(3));
            bg.style.setProperty('--hero-opacity', (1 - progress * 0.55).toFixed(3));
        }
        if (content) {
            content.style.setProperty('--hero-content-y', `${(progress * 42).toFixed(2)}%`);
            content.style.setProperty('--hero-content-opacity', Math.max(0, 1 - progress / 0.6).toFixed(3));
        }

        if (Math.abs(target.x - current.x) > 0.001 || Math.abs(target.y - current.y) > 0.001) request();
    }

    if (finePointer) {
        hero.addEventListener('pointermove', (event) => {
            const rect = hero.getBoundingClientRect();
            target.x = ((event.clientX - rect.left) / rect.width - 0.5) * 2.4;
            target.y = ((event.clientY - rect.top) / rect.height - 0.5) * 2.4;
            request();
        });
        hero.addEventListener('pointerleave', () => {
            target.x = 0;
            target.y = 0;
            request();
        });
    }

    window.addEventListener('scroll', request, { passive: true });
    window.addEventListener('resize', request);
    request();
})();

/* ---------------- generic scroll parallax for [data-parallax] images --------------- */
(function scrollParallax() {
    const nodes = document.querySelectorAll('[data-parallax]');
    if (!nodes.length || reduceMotion || window.innerWidth < 768) return;

    const update = rafThrottle(() => {
        nodes.forEach((node) => {
            const rect = node.getBoundingClientRect();
            if (rect.bottom < 0 || rect.top > window.innerHeight) return;
            const progress = (window.innerHeight - rect.top) / (window.innerHeight + rect.height);
            const strength = Number(node.dataset.parallax || 8);
            node.style.setProperty('--parallax-y', `${((progress - 0.5) * 2 * strength).toFixed(2)}%`);
            if (node.hasAttribute('data-parallax-scale')) {
                node.style.setProperty('--parallax-scale', (1 + Math.abs(progress - 0.5) * 2 * 0.12).toFixed(3));
            }
        });
    });

    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
})();

/* ---------------- pointer tilt on cards --------------- */
if (finePointer && !reduceMotion) {
    document.addEventListener('pointermove', (event) => {
        const card = event.target.closest?.('[data-tilt]');
        if (!card) return;
        const rect = card.getBoundingClientRect();
        const x = (event.clientX - rect.left) / rect.width - 0.5;
        const y = (event.clientY - rect.top) / rect.height - 0.5;
        card.style.setProperty('--ry', `${(x * 7).toFixed(2)}deg`);
        card.style.setProperty('--rx', `${(-y * 7).toFixed(2)}deg`);
    });

    document.addEventListener('pointerout', (event) => {
        const card = event.target.closest?.('[data-tilt]');
        if (!card || card.contains(event.relatedTarget)) return;
        card.style.setProperty('--rx', '0deg');
        card.style.setProperty('--ry', '0deg');
    });
}

/* ---------------- 3D flip cards (FlipProductCard parity) --------------- */
(function flipCards() {
    document.querySelectorAll('[data-flip]').forEach((card) => {
        const inner = card.querySelector('.flip-inner');
        if (!inner) return;
        const set = (on) => inner.classList.toggle('is-flipped', on);

        if (finePointer && !reduceMotion) {
            card.addEventListener('mouseenter', () => {
                if (card.dataset.flipLock !== '1') set(true);
            });
            card.addEventListener('mouseleave', () => {
                if (card.dataset.flipLock !== '1') set(false);
            });
        } else {
            card.addEventListener('click', (event) => {
                if (event.target.closest('a, button:not([data-flip-toggle])')) return;
                set(!inner.classList.contains('is-flipped'));
            });
        }

        card.querySelectorAll('[data-flip-toggle]').forEach((btn) => {
            btn.addEventListener('click', (event) => {
                event.preventDefault();
                event.stopPropagation();
                card.dataset.flipLock = '1';
                set(!inner.classList.contains('is-flipped'));
            });
        });

        card.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                card.dataset.flipLock = '';
                set(false);
            }
        });
    });
})();

/* ---------------- count-up stats (About `CountUp` parity) --------------- */
(function counters() {
    const nodes = document.querySelectorAll('[data-count]:not([data-count-bound])');
    if (!nodes.length) return;
    nodes.forEach((el) => el.dataset.countBound = '1');

    const render = (el, value) => {
        const decimals = Number(el.dataset.decimals || 0);
        el.textContent = (el.dataset.prefix || '')
            + (decimals ? value.toFixed(decimals) : Math.round(value))
            + (el.dataset.suffix || '');
    };

    if (reduceMotion || !('IntersectionObserver' in window)) {
        nodes.forEach((el) => render(el, Number(el.dataset.count || 0)));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            const el = entry.target;
            observer.unobserve(el);
            const to = Number(el.dataset.count || 0);
            const duration = Number(el.dataset.duration || 1700);
            const start = performance.now();
            const step = (now) => {
                const progress = Math.min(1, (now - start) / duration);
                render(el, to * (1 - Math.pow(1 - progress, 3)));
                if (progress < 1) requestAnimationFrame(step);
                else render(el, to);
            };
            requestAnimationFrame(step);
        });
    }, { threshold: 0.4 });

    nodes.forEach((el) => observer.observe(el));
})();

/* ---------------- AnimatePresence-style modals / lightboxes --------------- */
(function modals() {
    const open = (modal) => {
        if (!modal || modal.classList.contains('is-open')) return;
        modal.hidden = false;
        /* Reveal hooks inside a hidden modal never intersect the viewport —
           mark them visible as soon as the overlay opens. */
        modal.querySelectorAll('[data-reveal]').forEach((el) => el.classList.add('is-visible'));
        requestAnimationFrame(() => requestAnimationFrame(() => modal.classList.add('is-open')));
        setBodyLock(modal.id || 'modal', true);
        modal.querySelectorAll('video[data-lightbox-video]').forEach((v) => v.play().catch(() => {}));
    };

    const close = (modal) => {
        if (!modal || !modal.classList.contains('is-open')) return;
        modal.classList.remove('is-open');
        setBodyLock(modal.id || 'modal', false);
        window.setTimeout(() => {
            if (modal.classList.contains('is-open')) return;
            modal.hidden = true;
            modal.querySelectorAll('video').forEach((v) => v.pause());
        }, 380);
    };

    document.querySelectorAll('[data-modal-open]').forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.preventDefault();
            open(document.getElementById(btn.dataset.modalOpen));
        });
    });

    document.querySelectorAll('[data-modal]').forEach((modal) => {
        modal.querySelectorAll('[data-modal-close]').forEach((el) => {
            el.addEventListener('click', () => close(modal));
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') close(document.querySelector('[data-modal].is-open'));
    });
})();

/* ---------------- trending reels: play only when visible --------------- */
(function reels() {
    const videos = document.querySelectorAll('video[data-reel]');
    if (!videos.length || !('IntersectionObserver' in window)) return;
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            const video = entry.target;
            if (entry.isIntersecting) video.play().catch(() => {});
            else video.pause();
        });
    }, { threshold: 0.25 });
    videos.forEach((video) => observer.observe(video));
})();

/* ---------------- sticky navbar --------------- */
const header = document.getElementById('site-header');
const isHome = document.body.dataset.home === '1';
const updateHeader = () => {
    if (!header) return;
    const solid = window.scrollY > 40 || !isHome;
    header.classList.toggle('nav-solid', solid);
    header.classList.toggle('bg-transparent', !solid);
};
updateHeader();
window.addEventListener('scroll', updateHeader, { passive: true });

/* ---------------- mobile menu: backdrop fade + spring drawer --------------- */
(function mobileMenu() {
    const menu = document.getElementById('mobile-menu');
    const openBtn = document.getElementById('mobile-menu-open');
    if (!menu) return;

    const panel = menu.querySelector('[data-drawer-panel]');
    const setMenu = (open) => {
        if (open) {
            menu.hidden = false;
            menu.classList.remove('hidden');
            requestAnimationFrame(() => requestAnimationFrame(() => menu.classList.add('is-open')));
            setBodyLock('menu', true);
            panel?.querySelectorAll('[data-drawer-link]').forEach((el, i) => {
                el.style.setProperty('--d', `${0.06 * i}s`);
            });
        } else {
            menu.classList.remove('is-open');
            setBodyLock('menu', false);
            window.setTimeout(() => {
                if (!menu.classList.contains('is-open')) {
                    menu.classList.add('hidden');
                    menu.hidden = true;
                }
            }, 480);
        }
        openBtn?.setAttribute('aria-expanded', String(open));
    };

    openBtn?.addEventListener('click', () => setMenu(true));
    document.querySelectorAll('[data-close-menu]').forEach((btn) => btn.addEventListener('click', () => setMenu(false)));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && menu.classList.contains('is-open')) setMenu(false);
    });
})();

/* ---------------- back to top --------------- */
const topButtons = document.querySelectorAll('[data-scroll-top], .scroll-top-btn');
const updateTop = () => {
    topButtons.forEach((btn) => {
        if (btn.dataset.scrollTop !== undefined) return;
        btn.classList.toggle('opacity-100', window.scrollY > 600);
        btn.classList.toggle('pointer-events-auto', window.scrollY > 600);
        btn.classList.toggle('opacity-0', window.scrollY <= 600);
        btn.classList.toggle('pointer-events-none', window.scrollY <= 600);
    });
};
window.addEventListener('scroll', updateTop, { passive: true });
updateTop();
topButtons.forEach((btn) => btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' })));

/* ---------------- smooth in-page anchors --------------- */
document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener('click', (event) => {
        const id = link.getAttribute('href').slice(1);
        const target = id ? document.getElementById(id) : null;
        if (!target) return;
        event.preventDefault();
        target.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
    });
});

/* ---------------- testimonials cover-flow carousel --------------- */
(function coverflow() {
    document.querySelectorAll('[data-coverflow]').forEach((root) => {
        const cards = [...root.querySelectorAll('[data-coverflow-card]')];
        if (!cards.length) return;
        const count = cards.length;
        let active = 0;
        let timer;

        const dotsWrap = root.querySelector('[data-coverflow-dots]');
        if (dotsWrap && count > 1) {
            dotsWrap.innerHTML = '';
            cards.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.setAttribute('aria-label', `Go to testimonial ${i + 1}`);
                dot.className = 'h-[7px] w-[7px] rounded-full bg-charcoal/25';
                dot.addEventListener('click', () => { show(i); restart(); });
                dotsWrap.appendChild(dot);
            });
        }

        function show(index) {
            active = (index + count) % count;
            cards.forEach((card, i) => {
                let offset = i - active;
                if (offset > count / 2) offset -= count;
                if (offset < -count / 2) offset += count;
                const distance = Math.abs(offset);
                const visible = distance <= 2;
                const scale = distance === 0 ? 1 : distance === 1 ? 0.86 : 0.72;
                const opacity = !visible ? 0 : distance === 0 ? 1 : distance === 1 ? 0.88 : 0.58;
                const y = distance === 0 ? 0 : 10;
                card.style.transform = `translate3d(calc(-50% + ${offset * 290}px), calc(-50% + ${y}px), 0) scale(${scale}) rotate(${offset * 2}deg)`;
                card.style.opacity = String(opacity);
                card.style.zIndex = String(30 - distance);
                card.style.pointerEvents = visible ? 'auto' : 'none';
                card.setAttribute('aria-hidden', String(!visible));
            });
            if (dotsWrap) {
                [...dotsWrap.children].forEach((dot, i) => {
                    const on = i === active;
                    dot.className = `h-[7px] rounded-full transition-all duration-500 ${on ? 'w-7 bg-[#c89542]' : 'w-[7px] bg-[#d8c9b5]'}`;
                });
            }
        }

        const restart = () => {
            window.clearInterval(timer);
            if (!reduceMotion && count > 1) timer = window.setInterval(() => show(active + 1), 4500);
        };

        root.querySelector('[data-coverflow-prev]')?.addEventListener('click', () => { show(active - 1); restart(); });
        root.querySelector('[data-coverflow-next]')?.addEventListener('click', () => { show(active + 1); restart(); });
        cards.forEach((card, i) => card.addEventListener('click', () => {
            if (i !== active) { show(i); restart(); }
        }));

        show(0);
        restart();
    });
})();

/* ---------------- GSAP-style pinned horizontal scroll --------------- */
(function horizontalScroll() {
    const sections = [...document.querySelectorAll('[data-hscroll]')];
    if (!sections.length) return;

    sections.forEach((section) => {
        const sticky = section.querySelector('[data-hscroll-sticky]');
        const viewport = section.querySelector('[data-hscroll-viewport]');
        const track = section.querySelector('[data-hscroll-track]');
        if (!sticky || !viewport || !track) return;

        let travel = 0;

        const measure = () => {
            if (reduceMotion || window.innerWidth < 768) {
                section.classList.add('hscroll-static');
                section.style.height = '';
                track.style.transform = '';
                return;
            }
            section.classList.remove('hscroll-static');
            travel = Math.max(0, track.scrollWidth - viewport.clientWidth);
            if (travel < 10) {
                section.classList.add('hscroll-static');
                section.style.height = '';
                track.style.transform = '';
                return;
            }
            section.style.height = `${travel + window.innerHeight}px`;
            update();
        };

        const update = () => {
            if (section.classList.contains('hscroll-static')) return;
            const rect = section.getBoundingClientRect();
            const span = Math.max(rect.height - window.innerHeight, 1);
            const progress = Math.min(1, Math.max(0, -rect.top / span));
            track.style.transform = `translate3d(${(-progress * travel).toFixed(1)}px, 0, 0)`;
        };

        window.addEventListener('scroll', rafThrottle(update), { passive: true });
        window.addEventListener('resize', rafThrottle(measure));
        window.addEventListener('load', measure);
        measure();
    });
})();

/* ---------------- auto-playing hero slider --------------- */
(function heroSlider() {
    document.querySelectorAll('[data-hero-slider]').forEach((slider) => {
        const slides = [...slider.querySelectorAll('[data-slide]')];
        if (slides.length < 2) return;
        const dots = [...slider.querySelectorAll('[data-slide-go]')];
        const interval = Number(slider.dataset.interval || 5500);
        let active = 0;
        let timer;

        const show = (index) => {
            active = (index + slides.length) % slides.length;
            slides.forEach((slide, i) => {
                slide.classList.toggle('is-active', i === active);
                if (i === active) {
                    slide.querySelectorAll('[data-slide-caption]').forEach((el, k) => el.style.setProperty('--d', `${0.08 + k * 0.06}s`));
                }
            });
            dots.forEach((dot, i) => {
                const on = i === active;
                dot.classList.toggle('w-7', on);
                dot.classList.toggle('bg-gold', on);
                dot.classList.toggle('w-1.5', !on);
                dot.classList.toggle('bg-white/60', !on);
            });
        };

        const start = () => {
            window.clearInterval(timer);
            if (!reduceMotion) timer = window.setInterval(() => show(active + 1), interval);
        };

        dots.forEach((dot, i) => dot.addEventListener('click', () => { show(i); start(); }));
        slider.querySelector('[data-slide-prev]')?.addEventListener('click', () => { show(active - 1); start(); });
        slider.querySelector('[data-slide-next]')?.addEventListener('click', () => { show(active + 1); start(); });
        slider.addEventListener('mouseenter', () => window.clearInterval(timer));
        slider.addEventListener('mouseleave', start);
        show(0);
        start();
    });
})();

/* ---------------- accordions --------------- */
(function accordions() {
    document.querySelectorAll('[data-accordion-trigger]').forEach((trigger) => {
        const panel = trigger.parentElement.querySelector('[data-accordion-panel]');
        if (!panel) return;
        /* Respect a server-rendered open state (e.g. the Brand filter). */
        if (trigger.getAttribute('aria-expanded') === 'true') {
            panel.style.maxHeight = panel.style.maxHeight || `${panel.scrollHeight}px`;
            panel.style.opacity = '1';
        } else {
            panel.style.maxHeight = '0px';
            panel.style.opacity = '0';
        }
        trigger.addEventListener('click', () => {
            const open = trigger.getAttribute('aria-expanded') === 'true';
            trigger.setAttribute('aria-expanded', String(!open));
            panel.style.maxHeight = open ? '0px' : `${panel.scrollHeight}px`;
            panel.style.opacity = open ? '0' : '1';
        });
    });
})();

/* ---------------- filter pills --------------- */
(function filters() {
    document.querySelectorAll('[data-filter]').forEach((button) => {
        button.addEventListener('click', () => {
            const group = button.closest('[data-filter-group]') || document;
            group.querySelectorAll('[data-filter]').forEach((b) => b.classList.remove('is-active', 'bg-charcoal', 'text-cream'));
            button.classList.add('is-active', 'bg-charcoal', 'text-cream');

            const target = button.dataset.filterTarget
                ? document.getElementById(button.dataset.filterTarget)
                : group;
            if (!target) return;
            const value = button.dataset.filter;
            target.querySelectorAll('[data-filter-item]').forEach((item) => {
                const categories = (item.dataset.category || '').split(/[\s,|]+/);
                const show = value === 'all' || categories.includes(value);
                item.classList.toggle('is-filtered-out', !show);
                if (show && !reduceMotion) {
                    item.classList.remove('is-entering');
                    void item.offsetWidth;
                    item.classList.add('is-entering');
                }
            });
        });
    });
})();

/* ---------------- draggable rails with arrow controls --------------- */
(function dragRails() {
    document.querySelectorAll('[data-drag-rail]').forEach((rail) => {
        const scope = rail.closest('[data-drag-scope]') || rail.parentElement;
        const nudge = (dir) => rail.scrollBy({ left: dir * 320, behavior: reduceMotion ? 'auto' : 'smooth' });
        scope.querySelector('[data-drag-prev]')?.addEventListener('click', () => nudge(-1));
        scope.querySelector('[data-drag-next]')?.addEventListener('click', () => nudge(1));

        let down = false;
        let moved = false;
        let startX = 0;
        let startScroll = 0;

        rail.addEventListener('pointerdown', (event) => {
            if (event.pointerType === 'touch') return;
            down = true;
            moved = false;
            startX = event.clientX;
            startScroll = rail.scrollLeft;
        });
        window.addEventListener('pointermove', (event) => {
            if (!down) return;
            const delta = event.clientX - startX;
            if (Math.abs(delta) > 4) {
                moved = true;
                rail.classList.add('is-dragging');
                rail.scrollLeft = startScroll - delta;
            }
        });
        window.addEventListener('pointerup', () => {
            down = false;
            rail.classList.remove('is-dragging');
        });
        rail.addEventListener('click', (event) => {
            if (moved) {
                event.preventDefault();
                event.stopPropagation();
                moved = false;
            }
        }, true);
    });
})();

/* ---------------- scroll progress bar --------------- */
(function scrollProgress() {
    const bar = document.querySelector('[data-scroll-progress]');
    if (!bar) return;
    const update = rafThrottle(() => {
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        bar.style.width = `${scrollable > 0 ? (window.scrollY / scrollable) * 100 : 0}%`;
    });
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
})();
