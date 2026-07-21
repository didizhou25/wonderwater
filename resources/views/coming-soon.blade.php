<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WonderWater: Coming Soon</title>
        <meta name="description" content="{{ __('WonderWater is waterstofrijk water met een negatieve ORP en deuteriumarm water. Geen apparaten, geen abonnement-gedoe, vanaf €5 per liter, altijd vers geleverd.') }}">
        <meta name="robots" content="noindex, nofollow">

        <script>document.documentElement.classList.add('js-ready')</script>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-screen overflow-hidden bg-ink font-sans text-paper antialiased">
        <div data-cursor-dot class="cursor-dot" style="opacity: 0">
            <span class="cursor-dot__core"></span>
        </div>

        <div class="absolute top-5 right-5 z-20 flex items-center gap-1 text-xs font-medium tracking-[0.1em] text-paper/40 uppercase sm:top-7 sm:right-8">
            <a href="{{ route('lang.switch', 'nl') }}" class="ease-premium rounded-full px-2 py-1 transition-colors duration-300 hover:text-paper {{ app()->getLocale() === 'nl' ? 'text-paper' : '' }}">NL</a>
            <span class="opacity-30">/</span>
            <a href="{{ route('lang.switch', 'en') }}" class="ease-premium rounded-full px-2 py-1 transition-colors duration-300 hover:text-paper {{ app()->getLocale() === 'en' ? 'text-paper' : '' }}">EN</a>
        </div>

        <main class="relative flex h-screen flex-col items-center justify-center overflow-hidden px-6 py-6">
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute inset-0 bg-gradient-to-b from-ink via-ink-soft to-ink"></div>
                <div data-hero-glow class="absolute top-1/2 left-1/2 h-[70vmin] w-[70vmin] -translate-x-1/2 -translate-y-1/2 rounded-full bg-wonder/10 blur-[160px] transition-transform duration-700 ease-out"></div>
                <div class="absolute inset-0 opacity-[0.04] [background-image:radial-gradient(circle,white_1px,transparent_1px)] [background-size:26px_26px]"></div>
                {{-- Vignette for a more mysterious, focused feel --}}
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_35%,rgba(10,13,12,0.75)_100%)]"></div>
            </div>

            <p class="font-display pointer-events-none absolute top-1/2 left-1/2 w-screen -translate-x-1/2 -translate-y-1/2 overflow-hidden text-center text-[19vw] leading-[0.85] font-light whitespace-nowrap text-paper/[0.03] select-none">
                WONDER<br>WATER
            </p>

            <x-bubble-field :count="24" variant="dark" :min-size="5" :max-size="18" />

            <div class="relative z-10 flex min-h-0 w-full max-w-xl flex-1 flex-col items-center justify-center text-center">
                {{-- Hand-drawn artwork: a droplet filling with liquid, orbited by a single wandering particle --}}
                <div class="relative h-32 w-32 sm:h-36 sm:w-36" data-reveal aria-hidden="true">
                    <div class="breathe absolute inset-0 rounded-full bg-wonder/20 blur-2xl" style="animation-duration: 6s"></div>

                    <div class="absolute inset-[-25%]">
                        <div class="orbit-ring absolute inset-0" style="--orbit-duration: 14s;">
                            <span class="absolute top-0 left-1/2 h-1.5 w-1.5 -translate-x-1/2 rounded-full bg-wonder shadow-[0_0_8px_rgba(184,243,228,0.8)]"></span>
                        </div>
                    </div>

                    <svg viewBox="0 0 200 240" class="relative h-full w-full overflow-visible">
                        <defs>
                            <clipPath id="teaserDropletClip">
                                <path d="M100 18 C138 78 168 124 168 162 C168 202 138 228 100 228 C62 228 32 202 32 162 C32 124 62 78 100 18 Z" />
                            </clipPath>
                        </defs>

                        <g clip-path="url(#teaserDropletClip)">
                            <g class="glass-fill" style="transition-duration: 7s; transition-delay: 0.4s;">
                                <path class="glass-wave glass-wave-1" d="M-60 100 C -35 90 -10 110 15 100 C40 90 65 110 90 100 C115 90 140 110 165 100 C190 90 215 110 240 100 C265 90 290 110 315 100 V240 H-60 Z" fill="#0f6a5a" fill-opacity="0.4" style="animation: none;" />
                                <path class="glass-wave glass-wave-2" d="M-60 104 C -35 116 -10 92 15 104 C40 116 65 92 90 104 C115 116 140 92 165 104 C190 116 215 92 240 104 C265 116 290 92 315 104 V240 H-60 Z" fill="#b8f3e4" fill-opacity="0.3" style="animation: none;" />
                            </g>
                        </g>

                        <path
                            class="draw-path"
                            d="M100 18 C138 78 168 124 168 162 C168 202 138 228 100 228 C62 228 32 202 32 162 C32 124 62 78 100 18 Z"
                            fill="none"
                            stroke="#b8f3e4"
                            stroke-opacity="0.6"
                            stroke-width="1.5"
                            stroke-linejoin="round"
                            stroke-linecap="round"
                        />
                    </svg>
                </div>

                <div class="mt-5 flex items-center justify-center gap-2.5" data-reveal style="transition-delay: 100ms">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center overflow-hidden rounded-full bg-paper ring-1 ring-paper/30">
                        <img src="{{ asset('images/wonderwater-icon.jpg') }}" alt="" class="h-full w-full object-cover" />
                    </span>
                    <p class="font-display text-sm font-medium tracking-[0.35em] text-paper/80">
                        WONDERWATER
                    </p>
                </div>

                <h1 class="mt-3 font-display text-6xl leading-[0.95] font-light tracking-tight sm:text-7xl md:text-8xl">
                    <span data-split class="block">The Future</span>
                    <span data-split class="block">of Water.</span>
                </h1>

                {{-- Cycling, cryptic status line for a "something is being prepared" feel --}}
                <div class="mt-7 h-5" data-reveal style="transition-delay: 220ms">
                    <p data-teaser-status class="font-display text-sm text-wonder/80 italic transition-opacity duration-500">
                        {{ __('Formule wordt gekalibreerd') }}&hellip;
                    </p>
                </div>
            </div>

            <p class="relative z-10 text-[0.65rem] tracking-[0.35em] text-paper/25 uppercase">
                &copy; {{ date('Y') }} WonderWater
            </p>
        </main>

        <script>
            (function () {
                var el = document.querySelector('[data-teaser-status]');
                if (!el) return;
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

                var phrases = [
                    @foreach ([
                        'Formule wordt gekalibreerd',
                        'Waterstof wordt opgelost',
                        'ORP wordt gemeten',
                        'Iets moois wordt voorbereid',
                    ] as $phrase)
                        {!! json_encode(__($phrase)) !!},
                    @endforeach
                ];
                var i = 0;

                setInterval(function () {
                    i = (i + 1) % phrases.length;
                    el.style.opacity = '0';
                    setTimeout(function () {
                        el.textContent = phrases[i] + '…';
                        el.style.opacity = '1';
                    }, 500);
                }, 3200);
            })();
        </script>
    </body>
</html>
