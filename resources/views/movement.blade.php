<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Join the Movement — WonderWater</title>
        <meta name="description" content="Word lid van de WonderWater movement. Vanaf €5 per liter, altijd vers geleverd, geen apparaten.">

        <script>document.documentElement.classList.add('js-ready')</script>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-ink font-sans text-paper antialiased">
        <div data-cursor-dot class="cursor-dot" style="opacity: 0"></div>

        @include('partials.site-nav')

        <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-6 py-32">
            <x-bubble-field :count="32" variant="dark" />

            <div class="pointer-events-none absolute inset-0">
                <div class="absolute inset-0 bg-gradient-to-b from-ink via-ink-soft to-ink"></div>
                <div data-hero-glow class="absolute top-1/3 left-1/2 h-[55vmin] w-[55vmin] -translate-x-1/2 -translate-y-1/2 rounded-full bg-wonder/10 blur-[150px] transition-transform duration-700 ease-out"></div>
            </div>

            <div class="relative z-10 mx-auto w-full max-w-md">
                <div class="text-center" data-reveal>
                    <a href="{{ route('home') }}" class="ease-premium text-xs tracking-[0.3em] text-paper/40 uppercase transition-colors duration-400 hover:text-paper/70">
                        &larr; Terug naar WonderWater
                    </a>

                    <p class="mt-10 text-xs font-medium tracking-[0.4em] text-wonder uppercase">The New Standard.</p>
                    <h1 class="font-display mt-4 text-4xl font-light md:text-5xl">Join the Movement</h1>
                    <p class="mx-auto mt-4 max-w-sm text-sm leading-relaxed text-paper/70">
                        @if ($signupCount > 0)
                            Sluit je aan bij {{ $signupCount }} {{ Str::plural('pionier', $signupCount) }} die kiezen voor de toekomst van water.
                        @else
                            Word een van de eerste leden en kies voor de toekomst van water.
                        @endif
                    </p>
                </div>

                <div class="mt-14" data-reveal style="transition-delay: 150ms">
                    @if (session('wonderwater_status') === 'joined')
                        <div class="rounded-2xl border border-wonder/30 bg-wonder/10 px-8 py-10 text-center">
                            <p class="font-display text-2xl text-wonder">Welkom bij de movement.</p>
                            <p class="mt-3 text-sm text-paper/70">We nemen zo snel mogelijk contact met je op.</p>
                            <a href="{{ route('home') }}" class="ease-premium mt-8 inline-flex items-center rounded-full border border-paper/30 px-6 py-2.5 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-all duration-400 hover:border-paper hover:shadow-[0_0_20px_rgba(184,243,228,0.2)]">
                                Terug naar de homepage
                            </a>
                        </div>
                    @else
                        <form method="POST" action="{{ route('waitlist.join') }}" class="rounded-2xl border border-paper/10 bg-paper/[0.03] p-8 sm:p-10">
                            @csrf

                            {{-- Honeypot — hidden from real visitors, left blank by them --}}
                            <input type="text" name="company_website" tabindex="-1" autocomplete="off" class="absolute -left-[9999px]" aria-hidden="true">

                            <div>
                                <label for="name" class="text-xs tracking-[0.15em] text-paper/50 uppercase">Naam (optioneel)</label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name') }}"
                                    placeholder="Je naam"
                                    class="ease-premium mt-2 w-full border-0 border-b border-paper/20 bg-transparent px-0 py-3 text-paper placeholder:text-paper/25 transition-colors duration-400 focus:border-wonder focus:ring-0 focus:outline-none"
                                >
                            </div>

                            <div class="mt-6">
                                <label for="email" class="text-xs tracking-[0.15em] text-paper/50 uppercase">E-mailadres</label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    required
                                    value="{{ old('email') }}"
                                    placeholder="jouw@email.nl"
                                    class="ease-premium mt-2 w-full border-0 border-b border-paper/20 bg-transparent px-0 py-3 text-paper placeholder:text-paper/25 transition-colors duration-400 focus:border-wonder focus:ring-0 focus:outline-none"
                                >
                                @error('email')
                                    <p class="mt-2 text-xs text-rose-300">{{ $message }}</p>
                                @enderror
                            </div>

                            <fieldset class="mt-8">
                                <legend class="text-xs tracking-[0.15em] text-paper/50 uppercase">Interesse</legend>
                                <div class="mt-3 grid grid-cols-3 gap-2">
                                    @foreach (['drink' => 'Drink', 'skin' => 'Skin', 'both' => 'Beide'] as $value => $label)
                                        <label class="cursor-pointer">
                                            <input
                                                type="radio"
                                                name="interest"
                                                value="{{ $value }}"
                                                {{ old('interest', 'drink') === $value ? 'checked' : '' }}
                                                class="peer sr-only"
                                            >
                                            <span class="ease-premium block rounded-full border border-paper/20 py-2.5 text-center text-xs tracking-[0.1em] text-paper/60 uppercase transition-all duration-400 peer-checked:border-wonder peer-checked:bg-wonder/10 peer-checked:text-wonder peer-checked:shadow-[0_0_16px_rgba(184,243,228,0.15)]">
                                                {{ $label }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </fieldset>

                            <button
                                type="submit"
                                class="ease-premium mt-10 w-full rounded-full bg-paper px-8 py-4 text-xs font-medium tracking-[0.15em] text-ink uppercase transition-all duration-500 hover:scale-[1.02] hover:shadow-[0_0_35px_rgba(184,243,228,0.35)]"
                            >
                                Word lid
                            </button>
                        </form>

                        <p class="mt-6 text-center text-xs text-paper/40">
                            Door je aan te melden ga je akkoord met ons <a href="#" class="underline underline-offset-2 hover:text-paper/70">privacybeleid</a>.
                        </p>
                    @endif
                </div>
            </div>
        </main>

        @include('partials.site-footer')
    </body>
</html>
