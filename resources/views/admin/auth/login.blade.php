<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Ananya Interior</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream text-charcoal font-sans antialiased">
    <div class="min-h-screen grid lg:grid-cols-2">
        <div class="relative hidden overflow-hidden bg-walnut lg:block">
            <img src="/images/company-profile/page-04-image-01.png" alt="Ananya Interior" class="absolute inset-0 h-full w-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-walnut via-walnut/60 to-transparent"></div>
            <div class="relative flex h-full flex-col justify-end p-16 text-cream">
                <p class="eyebrow-label">Ananya Interior</p>
                <h1 class="mt-4 font-serif text-5xl leading-tight">Crafting spaces,<br><em class="italic text-champagne">managing details.</em></h1>
                <p class="mt-5 max-w-md text-sm text-cream/70">Agra's trusted interior design studio — one place for your products, enquiries and projects.</p>
            </div>
        </div>

        <div class="flex items-center justify-center px-5 py-12 sm:px-12">
            <div class="w-full max-w-md">
                <a href="/" class="flex items-center gap-2 text-sm text-coffee hover:text-golddark">← Back to website</a>
                <div class="mt-10 rounded-3xl border border-charcoal/5 bg-white p-8 shadow-lift md:p-10">
                    <p class="eyebrow-label">Admin Panel</p>
                    <h2 class="mt-3 font-serif text-3xl text-charcoal">Welcome back</h2>
                    <p class="mt-2 text-sm text-coffee">Sign in to manage Ananya Interior.</p>

                    @if ($errors->any())
                        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.post') }}" class="mt-7 space-y-5">
                        @csrf
                        <div>
                            <label for="email" class="text-xs uppercase tracking-wider text-coffee">Email</label>
                            <input id="email" name="email" type="email" required autofocus value="{{ old('email') }}" placeholder="admin@ananyaagra.com" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-3 text-sm focus:border-gold focus:ring-2 focus:ring-gold/15">
                        </div>
                        <div>
                            <label for="password" class="text-xs uppercase tracking-wider text-coffee">Password</label>
                            <input id="password" name="password" type="password" required placeholder="••••••••" class="mt-1.5 w-full rounded-xl border border-charcoal/10 bg-cream px-4 py-3 text-sm focus:border-gold focus:ring-2 focus:ring-gold/15">
                        </div>
                        <label class="flex items-center gap-2 text-sm text-coffee"><input type="checkbox" name="remember" class="rounded accent-gold"> Remember me</label>
                        <button type="submit" class="w-full rounded-full bg-charcoal px-8 py-3.5 text-sm text-cream transition-colors hover:bg-espresso">Sign in</button>
                    </form>
                    <p class="mt-6 text-center text-[11px] text-stonewarm">Demo: admin@ananyaagra.com / password</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
