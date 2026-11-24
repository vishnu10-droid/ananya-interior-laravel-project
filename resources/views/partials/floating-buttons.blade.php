@php
    $whatsapp = \App\Models\Setting::get('whatsapp', 'https://wa.me/917351400063');
@endphp

{{-- Quick enquiry trigger --}}
<button type="button" data-modal-open="quick-enquiry-modal" data-float-in style="--d:.9s" data-shine aria-label="Open quick enquiry" class="fixed bottom-10 md:bottom-14 left-5 z-40 hidden items-center gap-2.5 rounded-full bg-red-600 px-5 py-3 text-white shadow-xl backdrop-blur-md transition-colors hover:bg-red-700 sm:px-7 md:flex">
    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>
    <span class="whitespace-nowrap font-serif text-sm tracking-wide sm:text-base">Are you ?</span>
</button>

{{-- Quick enquiry modal --}}
<div data-modal id="quick-enquiry-modal" hidden>
    <div class="modal-backdrop" data-modal-close></div>
    <div class="modal-panel relative mx-auto w-full max-w-lg overflow-hidden rounded-3xl bg-cream shadow-lift">
        <button type="button" data-modal-close aria-label="Close quick enquiry" class="absolute right-4 top-4 z-10 grid h-9 w-9 place-items-center rounded-full bg-white/85 text-charcoal shadow-sm transition-colors hover:bg-gold hover:text-charcoal">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>

        <div data-qe-form class="px-6 py-8 pr-14 md:px-9 md:py-10">
            <p class="text-[11px] uppercase tracking-[0.3em] text-golddark">Quick Enquiry</p>
            <h3 class="mt-2 font-serif text-2xl leading-tight text-charcoal md:text-3xl">Are you looking for <em class="italic text-golddark">interior trade?</em></h3>
            <p class="mt-2 text-sm leading-relaxed text-coffee">Tell us who you are — we'll get in touch with the right trade guidance.</p>

            <form data-qe-form-element novalidate class="mt-7 space-y-4">
                <div>
                    <label for="quick-name" class="text-xs uppercase tracking-wider text-coffee">Name *</label>
                    <input id="quick-name" name="name" type="text" required autocomplete="name" placeholder="Your full name" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-white px-4 py-3 text-sm text-charcoal placeholder:text-stonewarm">
                </div>
                <div>
                    <label for="quick-contact" class="text-xs uppercase tracking-wider text-coffee">Contact *</label>
                    <input id="quick-contact" name="contact" type="tel" inputmode="tel" required pattern="[0-9+\s-]{8,15}" autocomplete="tel" placeholder="Phone / WhatsApp number" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-white px-4 py-3 text-sm text-charcoal placeholder:text-stonewarm">
                </div>
                <div>
                    <label for="quick-role" class="text-xs uppercase tracking-wider text-coffee">I am a *</label>
                    <select id="quick-role" name="role" required class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-white px-4 py-3 text-sm text-charcoal">
                        <option value="HomeOwner">HomeOwner</option>
                        <option value="Interior Designer">Interior Designer</option>
                        <option value="Interior Trader" selected>Interior Trader</option>
                        <option value="Architect">Architect</option>
                        <option value="Builder">Builder</option>
                        <option value="Contractor">Contractor</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <p data-qe-error hidden class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"></p>

                <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-charcoal px-8 py-3.5 text-sm tracking-wide text-cream transition-colors hover:bg-espresso">
                    Submit Enquiry
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4 20-7z"/></svg>
                </button>
            </form>
        </div>

        <div data-qe-success hidden class="px-7 py-12 text-center md:px-10">
            <span class="mx-auto grid h-16 w-16 place-items-center rounded-full bg-green-100 text-green-700">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
            </span>
            <h3 class="mt-5 font-serif text-2xl text-charcoal">Thank you, <span data-qe-success-name>friend</span>!</h3>
            <p class="mx-auto mt-3 max-w-sm text-sm leading-relaxed text-coffee">You're enquiring as an <strong data-qe-success-role>Interior Trader</strong>. Our Agra studio will reach you on <strong data-qe-success-contact></strong> shortly.</p>
            <div class="mt-7 flex flex-wrap justify-center gap-2.5">
                <a href="{{ $whatsapp }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-2 rounded-full bg-charcoal px-6 py-3 text-sm text-cream transition-colors hover:bg-espresso">Chat on WhatsApp <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
                <button type="button" data-modal-close class="rounded-full border border-charcoal/20 px-6 py-3 text-sm text-charcoal transition-colors hover:bg-beige">Done</button>
            </div>
        </div>
    </div>
</div>

{{-- Right side floating actions --}}
<div class="fixed bottom-20 md:bottom-24 right-5 z-40 flex flex-col gap-3 items-end">
    <button type="button" data-scroll-top aria-label="Back to top" class="scroll-top-btn w-11 h-11 rounded-full bg-creamwarm shadow-lift border border-champagne/50 grid place-items-center text-espressodeep transition-all duration-300 opacity-0 pointer-events-none hover:bg-champagne">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m18 15-6-6-6 6"/></svg>
    </button>

    <a href="tel:+917351400063" data-float-in style="--d:.7s" data-shine aria-label="Call us" title="Call us" class="w-14 h-14 rounded-full bg-champagne text-espressodeep grid place-items-center shadow-lift border border-[#e3c48f]/60 transition-colors hover:bg-[#d9b274]">
        <svg width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
    </a>

    <a href="{{ $whatsapp }}" target="_blank" rel="noreferrer" data-float-in style="--d:.8s" aria-label="Chat on WhatsApp" title="Chat on WhatsApp" class="w-14 h-14 rounded-full bg-[#25D366] text-white grid place-items-center shadow-lift relative">
        <span class="absolute inset-0 rounded-full bg-[#25D366] animate-ping opacity-20" aria-hidden="true"></span>
        <svg viewBox="0 0 24 24" width="26" height="26" fill="currentColor" aria-hidden="true" class="relative"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347M12.05 21.786h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>
</div>

@push('scripts')
<script>
    (function () {
        var modal = document.getElementById('quick-enquiry-modal');
        if (!modal) return;

        var formWrap = modal.querySelector('[data-qe-form]');
        var form = modal.querySelector('[data-qe-form-element]');
        var success = modal.querySelector('[data-qe-success]');
        var nameInput = modal.querySelector('#quick-name');
        var contactInput = modal.querySelector('#quick-contact');
        var roleInput = modal.querySelector('#quick-role');
        var errorBox = modal.querySelector('[data-qe-error]');
        var successName = modal.querySelector('[data-qe-success-name]');
        var successContact = modal.querySelector('[data-qe-success-contact]');
        var successRole = modal.querySelector('[data-qe-success-role]');

        function showError(message) {
            errorBox.textContent = message;
            errorBox.hidden = false;
        }

        function reset() {
            form.reset();
            errorBox.hidden = true;
            success.hidden = true;
            formWrap.hidden = false;
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            var name = (nameInput.value || '').trim();
            var contact = (contactInput.value || '').trim();
            var role = (roleInput.value || '').trim();

            if (!name || !contact || !role) {
                showError('Please enter your name, contact number and role.');
                return;
            }
            if (!/^[0-9+\s-]{8,15}$/.test(contact)) {
                showError('Please enter a valid contact number.');
                return;
            }

            errorBox.hidden = true;
            successName.textContent = name.split(' ')[0] || 'friend';
            successContact.textContent = contact;
            successRole.textContent = role;
            formWrap.hidden = true;
            success.hidden = false;
        });

        modal.querySelectorAll('[data-modal-close]').forEach(function (button) {
            button.addEventListener('click', reset);
        });
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') reset();
        });
    })();
</script>
@endpush
