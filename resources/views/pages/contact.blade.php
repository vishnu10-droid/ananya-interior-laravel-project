@extends('layouts.app')
@section('title', "Let's Create Your Space | Ananya Interior")
@section('description', 'Call, WhatsApp or send the form — we respond within a few hours.')

@section('content')
@php
    $types = ['Home Interior','Modular Kitchen','Bedroom','Living Room','Office Interior','Commercial Interior','Office','School','Hospital','Factory','Hotel/Resturant','Government Contractor','OME','Builder','Gem','Other'];
    $roles = ['Homeowner','Interior Designer','Architect','Builder','Contractor','Other'];
    $phone = \App\Models\Setting::get('phone', '+91 7351400063 / +91 9837027055');
    $address = \App\Models\Setting::get('address', '21/18, Mangal Sen Bhawan, Freeganj, Agra (U.P) 282004');
@endphp

{{-- HERO --}}
<section class="relative isolate flex min-h-[340px] items-center overflow-hidden bg-espressodeep md:min-h-[380px]">
    <img src="/images/company-profile/page-01-image-01.png" alt="A warm wooden chair in a sunlit interior" class="hero-zoom absolute inset-0 h-full w-full object-cover object-[68%_center] opacity-70 brightness-[0.72] saturate-[0.85]">
    <div class="absolute inset-0 bg-gradient-to-r from-[#160f0a]/95 via-[#160f0a]/65 to-[#160f0a]/20"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-espressodeep/70 via-transparent to-transparent"></div>
    <div class="relative mx-auto w-full max-w-7xl px-5 py-14 md:px-8 md:py-16" data-reveal="up">
        <span class="inline-flex items-center gap-2 rounded-full border border-champagne/50 bg-espressodeep/30 px-4 py-2 text-[10px] font-medium uppercase tracking-[0.3em] text-champagne backdrop-blur-md">✦ Contact</span>
        <h1 class="mt-6 max-w-2xl font-serif text-[2.5rem] leading-[1.06] text-cream sm:text-[3.4rem] md:text-[4.1rem]">Let&rsquo;s Create<br><em class="italic text-[#F3E3C8]">Your Space</em></h1>
        <p class="mt-5 max-w-xl text-sm leading-relaxed text-cream/75 md:text-[15px]">Call, WhatsApp or send the form — we respond within a few hours.</p>
        <a href="#contact" class="mt-7 inline-flex items-center gap-2 rounded-full bg-champagne px-6 py-3 text-xs font-medium tracking-wide text-espressodeep shadow-[0_14px_34px_-16px_rgba(196,154,90,0.95)] transition-all duration-300 hover:scale-[1.04] hover:bg-[#d9b274]">Get In Touch <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
    </div>
</section>

{{-- CONTACT SECTION --}}
<section id="contact" class="relative overflow-hidden bg-ivory py-20 md:py-24">
    <div class="soft-leaf-shadow pointer-events-none absolute -right-32 -top-24 h-[440px] w-[440px] rotate-[20deg]"></div>
    <div class="soft-leaf-shadow pointer-events-none absolute -bottom-40 -left-40 h-[420px] w-[420px] -rotate-[35deg] opacity-60"></div>

    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <div class="flex items-center justify-center gap-3" data-reveal="left"><span class="h-px w-8 bg-champagne/70 sm:w-14"></span><span class="eyebrow-label whitespace-nowrap">Get In Touch</span><span class="h-px w-8 bg-champagne/70 sm:w-14"></span></div>
            <h2 class="mt-4 font-serif text-[32px] leading-[1.12] text-espressodeep sm:text-[40px] md:text-[46px]" data-reveal="up">Let&rsquo;s Create <em class="italic text-champagne">Your Space</em></h2>
            <p class="mt-4 text-[15px] leading-relaxed text-coffee" data-reveal="up" data-delay="80">Tell us about your project — we usually respond within a few hours.</p>
        </div>

        <div class="mt-10 grid grid-cols-2 overflow-hidden rounded-2xl border border-brownrich/10 bg-white/50 md:grid-cols-4 md:divide-x md:divide-brownrich/10">
            @foreach (['Home Interior','Modular Kitchen','Bedroom','Office Interior'] as $i => $label)
                <div class="flex items-center justify-center gap-3 border-b border-brownrich/10 px-4 py-5 last:border-b-0 md:border-b-0" data-reveal="up" data-delay="{{ $i * 90 }}">
                    <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full border border-champagne/30 bg-champagne/10 text-champagne">
                        @if ($i === 0)<svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 12V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M3 12h18v6H3zM5 18v2M19 18v2"/></svg>
                        @elseif ($i === 1)<svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 8h16v10H4zM8 8V5h8v3M9 12h6"/></svg>
                        @elseif ($i === 2)<svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 18v-6a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v6M5 10V7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v3M5 18v2M19 18v2"/></svg>
                        @else<svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 21h18M5 21V8l7-5 7 5v13M10 21v-6h4v6"/></svg>@endif
                    </span>
                    <span class="font-serif text-[15px] text-brownrich">{{ $label }}</span>
                </div>
            @endforeach
        </div>

        <div class="mt-10 grid items-stretch gap-6 lg:grid-cols-5">
            {{-- INFO CARD --}}
            <div class="lg:col-span-2" data-reveal="left">
                <div class="relative flex h-full flex-col overflow-hidden rounded-[28px] bg-gradient-to-br from-[#2c211a] via-espressodeep to-brownrich p-8 text-cream shadow-[0_30px_70px_-32px_rgba(33,25,20,0.85)] ring-1 ring-champagne/15 md:p-9 transition-transform duration-500 hover:-translate-y-1.5">
                    <div class="wood-slats pointer-events-none absolute inset-0 opacity-70"></div>
                    <img src="/images/company-profile/page-25-image-01.png" alt="" class="pointer-events-none absolute bottom-0 right-0 h-3/4 w-3/4 object-cover opacity-[0.22] mix-blend-luminosity [mask-image:linear-gradient(to_left,#000,transparent)]">
                    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-espressodeep/90 to-transparent"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3"><span class="h-px w-8 bg-champagne"></span><span class="text-[11px] font-medium uppercase tracking-[0.38em] text-champagne">Ananya</span></div>
                        <a href="tel:+917351400063" class="mt-5 block font-serif text-[21px] leading-snug text-cream transition-colors hover:text-champagne sm:text-[23px]">{{ $phone }}</a>
                        <div class="mt-6 flex items-start gap-3"><span class="mt-0.5 grid h-9 w-9 shrink-0 place-items-center rounded-full border border-champagne/30 bg-champagne/10 text-champagne"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg></span><p class="text-sm leading-relaxed text-cream/75">{{ $address }}</p></div>
                        <div class="mt-4 flex items-center gap-3"><span class="grid h-9 w-9 shrink-0 place-items-center rounded-full border border-champagne/30 bg-champagne/10 text-champagne"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></span><p class="text-sm text-cream/75">Open 24 Hours, all days</p></div>
                    </div>
                    <div class="relative z-10 mt-auto grid grid-cols-3 gap-2.5 pt-9">
                        <a href="tel:+917351400063" class="flex flex-col items-center gap-1.5 rounded-xl bg-champagne py-4 text-xs font-medium text-espressodeep shadow-[0_12px_28px_-14px_rgba(196,154,90,0.9)] transition-colors hover:bg-[#d9b274]"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2a19.79 19.79 0 0 1-8.63-3.07a19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>Call Now</a>
                        <a href="{{ \App\Models\Setting::get('whatsapp', '#') }}" target="_blank" rel="noreferrer" class="flex flex-col items-center gap-1.5 rounded-xl border border-white/15 bg-white/10 py-4 text-xs text-cream transition-colors hover:border-champagne/50 hover:bg-white/15"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>WhatsApp</a>
                        <a href="{{ \App\Models\Setting::get('maps_url', '#') }}" target="_blank" rel="noreferrer" class="flex flex-col items-center gap-1.5 rounded-xl border border-white/15 bg-white/10 py-4 text-xs text-cream transition-colors hover:border-champagne/50 hover:bg-white/15"><svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 11 19-9-9 19-2-8-8-2z"/></svg>Directions</a>
                    </div>
                </div>
            </div>

            {{-- FORM --}}
            <div class="lg:col-span-3" data-reveal="right">
                <div class="relative h-full overflow-hidden rounded-[28px] bg-white p-7 shadow-[0_24px_70px_-30px_rgba(73,48,32,0.45)] ring-1 ring-brownrich/5 md:p-9 transition-transform duration-500 hover:-translate-y-1">
                    <div class="pointer-events-none absolute -bottom-20 -right-20 h-56 w-56 rounded-full bg-gradient-to-tl from-champagne/20 via-champagne/5 to-transparent blur-xl"></div>
                    <div class="pointer-events-none absolute bottom-0 right-0 h-24 w-36 rounded-tl-[100%] border-l border-t border-champagne/25 bg-champagne/10"></div>

                    @if (session('enquiry_sent'))
                        <div class="relative z-10 mb-6 rounded-2xl border border-green-200 bg-green-50 p-6 text-center" role="alert">
                            <p class="font-serif text-2xl text-green-800">Thank you, {{ session('enquiry_name') }}!</p>
                            <p class="mt-2 text-sm text-green-700">Your enquiry has been saved. Our Agra studio will call you shortly.</p>
                            <a href="{{ \App\Models\Setting::get('whatsapp', '#') }}" target="_blank" rel="noreferrer" class="mt-4 inline-flex rounded-full bg-espressodeep px-6 py-3 text-sm text-cream">Chat on WhatsApp</a>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="relative z-10 mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <ul class="list-disc pl-5">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.enquiry') }}" method="POST" class="relative z-10">
                        @csrf
                        <div class="grid gap-x-4 gap-y-5 sm:grid-cols-2">
                            @php
                                $fields = [
                                    ['name','Name *','text','Your full name','enquiry-name',true],
                                    ['phone','Phone *','tel','98XXX XXXXX','enquiry-phone',true],
                                    ['email','Email','email','you@email.com','enquiry-email',false],
                                    ['city','City *','text','Your city','enquiry-city',true],
                                    ['area','Area *','text','Area / locality','enquiry-area',true],
                                    ['pincode','Pincode *','text','6-digit pincode','enquiry-pincode',true],
                                ];
                            @endphp
                            @foreach ($fields as [$field,$label,$type,$placeholder,$id,$required])
                                <div data-reveal="up" data-delay="{{ $loop->index * 60 }}">
                                    <label for="{{ $id }}" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">{{ $label }}</label>
                                    <input id="{{ $id }}" name="{{ $field }}" type="{{ $type }}" placeholder="{{ $placeholder }}" value="{{ old($field) }}" {{ $required ? 'required' : '' }} class="mt-1.5 w-full rounded-xl border border-champagne/35 bg-white py-3 pl-4 pr-4 text-sm text-charcoal placeholder:text-stonewarm transition-all duration-300 hover:border-champagne/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error($field) border-red-400 @enderror">
                                    @error($field)<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                            @endforeach

                            <div data-reveal="up" data-delay="360">
                                <label for="enquiry-type" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">Project Type</label>
                                <select id="enquiry-type" name="type" class="mt-1.5 w-full appearance-none rounded-xl border border-champagne/35 bg-white py-3 pl-4 pr-10 text-sm text-charcoal focus:border-champagne focus:ring-2 focus:ring-champagne/15">
                                    @foreach ($types as $type)<option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>{{ $type }}</option>@endforeach
                                </select>
                            </div>

                            <div data-reveal="up" data-delay="420">
                                <label for="enquiry-role" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">You Are *</label>
                                <select id="enquiry-role" name="role" required class="mt-1.5 w-full appearance-none rounded-xl border border-champagne/35 bg-white py-3 pl-4 pr-10 text-sm text-charcoal focus:border-champagne focus:ring-2 focus:ring-champagne/15">
                                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select your profession</option>
                                    @foreach ($roles as $role)<option value="{{ $role }}" {{ old('role') === $role ? 'selected' : '' }}>{{ $role }}</option>@endforeach
                                </select>
                            </div>

                            <div class="sm:col-span-2" data-reveal="up" data-delay="480">
                                <label for="enquiry-requirements" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">Project Requirements</label>
                                <select id="enquiry-requirements" name="requirements" class="mt-1.5 w-full appearance-none rounded-xl border border-champagne/35 bg-white py-3 pl-4 pr-10 text-sm text-charcoal focus:border-champagne focus:ring-2 focus:ring-champagne/15">
                                    <option value="">Select timeline</option>
                                    @foreach (['Immediate','Within 15 Days','3 Months','6 Months'] as $req)<option value="{{ $req }}" {{ old('requirements') === $req ? 'selected' : '' }}>{{ $req }}</option>@endforeach
                                </select>
                            </div>

                            <div class="sm:col-span-2" data-reveal="up" data-delay="540">
                                <label for="enquiry-message" class="block text-[11px] font-medium uppercase tracking-[0.16em] text-coffee">Message *</label>
                                <textarea id="enquiry-message" name="message" rows="4" required placeholder="Tell us about your space, size and what you dream of…" class="mt-1.5 min-h-[112px] w-full resize-none rounded-xl border border-champagne/35 bg-white py-3.5 pl-4 pr-4 text-sm text-charcoal placeholder:text-stonewarm focus:border-champagne focus:ring-2 focus:ring-champagne/15 @error('message') border-red-400 @enderror">{{ old('message') }}</textarea>
                                @error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <button type="submit" class="mt-6 inline-flex items-center gap-2 rounded-full bg-espressodeep px-8 py-3.5 text-sm tracking-wide text-cream shadow-[0_14px_32px_-16px_rgba(33,25,20,0.9)] transition-all duration-300 hover:scale-[1.02] hover:bg-brownrich active:scale-[0.98]">Send Enquiry <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m22 2-7 20-4-9-9-4 20-7z"/></svg></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
<section class="mx-auto max-w-7xl px-5 pb-14 md:px-8">
    <div class="grid grid-cols-2 overflow-hidden rounded-[26px] border border-champagne/40 bg-white/70 shadow-[0_22px_60px_-38px_rgba(73,48,32,0.6)] backdrop-blur-sm md:grid-cols-4" data-reveal="up">
        @foreach ([['24+','Projects Delivered'],['8','Trade Services'],['1995','Established'],['100%','Client Satisfaction']] as $stat)
            <div class="flex items-center gap-3 px-4 py-6 md:gap-4 md:px-7 {{ $loop->index % 2 === 1 ? 'border-l border-champagne/25' : '' }} {{ $loop->index >= 2 ? 'border-t border-champagne/25 md:border-t-0' : '' }} {{ $loop->index > 0 ? 'md:border-l md:border-champagne/25' : '' }}">
                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full border border-champagne/35 bg-champagne/10 text-champagne md:h-11 md:w-11"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 21h18M6 21V7l6-4 6 4v14M10 21v-6h4v6"/></svg></span>
                <div><p class="font-serif text-[24px] leading-none text-espressodeep md:text-[30px]">{{ $stat[0] }}</p><p class="mt-1.5 text-[10px] uppercase tracking-[0.12em] text-coffee">{{ $stat[1] }}</p></div>
            </div>
        @endforeach
    </div>
</section>

{{-- MAP --}}
<section class="mx-auto max-w-7xl px-5 pb-14 md:px-8">
    <div class="rounded-[28px] border border-champagne/50 bg-white p-1.5 shadow-[0_30px_70px_-36px_rgba(33,25,20,0.6)]" data-reveal="up">
        <div class="overflow-hidden rounded-[20px]">
            <iframe title="Ananya Interior location map" src="https://www.google.com/maps?q=Sanjay+Place+Civil+Lines+Agra+282002&output=embed" class="block h-[320px] w-full border-0 md:h-[420px]" loading="lazy"></iframe>
        </div>
    </div>
    <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:flex-row">
        <a href="{{ \App\Models\Setting::get('maps_url', '#') }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-2 rounded-full bg-espressodeep px-7 py-3 text-xs uppercase tracking-[0.16em] text-cream transition-colors hover:bg-brownrich">Get Directions <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a>
        <a href="tel:+917351400063" class="inline-flex items-center gap-2 rounded-full border border-champagne/50 px-7 py-3 text-xs uppercase tracking-[0.16em] text-brownrich transition-colors hover:bg-champagne/10">Call the studio</a>
    </div>
    <div class="mt-10 text-center"><a href="/" class="inline-flex items-center gap-2 rounded-full border border-champagne/40 bg-creamwarm px-6 py-2.5 text-sm text-coffee transition-colors hover:border-champagne hover:text-espressodeep">Back to home <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></a></div>
</section>
@endsection
