import '../css/app.css';

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

/* ---------------- scroll reveal (Framer Motion `whileInView` replacement) --------------- */
const revealItems = document.querySelectorAll('[data-reveal]');
if (reduceMotion || !('IntersectionObserver' in window)) {
    revealItems.forEach((el) => el.classList.add('is-visible'));
} else {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const delay = Number(el.dataset.delay || 0);
                window.setTimeout(() => el.classList.add('is-visible'), delay);
                observer.unobserve(el);
            }
        });
    }, { threshold: 0.12 });

    revealItems.forEach((el) => observer.observe(el));
}

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

/* ---------------- mobile menu --------------- */
const menu = document.getElementById('mobile-menu');
const openBtn = document.getElementById('mobile-menu-open');
const setMenu = (open) => {
    if (!menu) return;
    menu.classList.toggle('hidden', !open);
    document.body.style.overflow = open ? 'hidden' : '';
    openBtn?.setAttribute('aria-expanded', String(open));
};
openBtn?.addEventListener('click', () => setMenu(true));
document.querySelectorAll('[data-close-menu]').forEach((btn) => btn.addEventListener('click', () => setMenu(false)));
document.addEventListener('keydown', (event) => { if (event.key === 'Escape') setMenu(false); });

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
