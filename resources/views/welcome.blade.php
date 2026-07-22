<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WonderWater: {{ __('De toekomst van water.') }}</title>
        <meta name="description" content="{{ __('WonderWater is waterstofrijk water met een negatieve ORP en deuteriumarm water. Geen apparaten, geen abonnement-gedoe, vanaf €5 per liter, altijd vers geleverd.') }}">

        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

        <script>document.documentElement.classList.add('js-ready')</script>

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-paper font-sans text-ink antialiased">
        <div data-cursor-dot class="cursor-dot" style="opacity: 0">
            <span class="cursor-dot__core"></span>
        </div>

        @include('partials.site-nav')

        <main>
            {{-- 1. HERO --}}
            <section class="relative flex min-h-screen items-center justify-center overflow-hidden bg-ink px-6 text-paper">
                <div class="pointer-events-none absolute inset-0">
                    <div class="absolute inset-0 bg-gradient-to-b from-ink via-ink-soft to-ink"></div>
                    <div data-hero-glow class="absolute top-1/2 left-1/2 h-[70vmin] w-[70vmin] -translate-x-1/2 -translate-y-1/2 rounded-full bg-wonder/10 blur-[140px] transition-transform duration-700 ease-out"></div>
                    <div class="absolute inset-0 opacity-[0.035] [background-image:radial-gradient(circle,white_1px,transparent_1px)] [background-size:28px_28px]"></div>
                </div>

                {{-- Generative visual 1: hydrogen bubbles rising through water --}}
                <x-bubble-field :count="26" variant="dark" :min-size="8" :max-size="26" />

                <div class="relative z-10 mx-auto max-w-3xl pt-24 pb-12 text-center">
                    <p class="text-xs font-medium tracking-[0.4em] text-wonder uppercase" data-reveal style="transition-delay: 0ms">WonderWater</p>

                    <h1 class="mt-8 font-display text-7xl leading-[0.95] font-light tracking-tight sm:text-8xl md:text-9xl">
                        <span data-split class="block">The Future</span>
                        <span data-split class="block">of Water.</span>
                    </h1>

                    <p class="mx-auto mt-10 max-w-xl text-balance text-lg leading-relaxed text-paper/70" data-reveal style="transition-delay: 200ms">
                        {{ __('Water is het meest essentiële element van het leven, toch drinken we vandaag vrijwel hetzelfde water als tientallen jaren geleden.') }}
                        <span class="text-wonder">{{ __('Wat als het slimmer kon zijn?') }}</span>
                    </p>

                    <div class="mt-12 flex flex-col items-center justify-center gap-4 sm:flex-row" data-reveal style="transition-delay: 380ms">
                        <a
                            href="#technologie"
                            class="ease-premium inline-flex items-center rounded-full bg-paper px-8 py-3 text-xs font-medium tracking-[0.15em] text-ink uppercase transition-all duration-500 hover:scale-[1.03] hover:shadow-[0_0_30px_rgba(184,243,228,0.35)]"
                        >
                            {{ __('Ontdek de technologie') }}
                        </a>
                        <a
                            href="{{ route('movement') }}"
                            class="ease-premium inline-flex items-center rounded-full border border-paper/30 px-8 py-3 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-all duration-500 hover:border-paper hover:bg-paper/5"
                        >
                            Join the Movement
                        </a>
                    </div>
                </div>

                <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce text-paper/30">
                    <svg width="18" height="28" viewBox="0 0 18 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="1" y="1" width="16" height="26" rx="8" stroke="currentColor" stroke-width="1.5"/>
                        <circle cx="9" cy="8" r="2" fill="currentColor"/>
                    </svg>
                </div>
            </section>

            {{-- 2. WHY WONDERWATER: THREE TECHNOLOGIES (pinned visual + scroll-spy) --}}
            <section id="technologie" class="relative bg-paper px-6 py-32 lg:px-10">
                <div class="pointer-events-none absolute inset-0 overflow-hidden">
                    <div class="absolute inset-0 opacity-[0.5] [background-image:radial-gradient(circle,rgba(15,106,90,0.08)_1px,transparent_1px)] [background-size:30px_30px]"></div>
                    <div class="absolute top-1/3 left-1/2 h-[50vmin] w-[50vmin] -translate-x-1/2 rounded-full bg-wonder/15 blur-[160px]"></div>
                </div>

                <div class="relative mx-auto max-w-3xl text-center" data-reveal>
                    <p class="text-xs font-medium tracking-[0.4em] text-wonder-deep uppercase">Three Technologies. One Wonder.</p>
                    <h2 class="font-display mt-4 text-4xl font-light md:text-5xl" data-split>Designed for Human Performance.</h2>

                    <p class="mx-auto mt-8 max-w-2xl leading-relaxed text-ink/70">
                        {{ __('Iedere dag maakt je lichaam miljarden nieuwe cellen aan. Iedere dag produceert het energie. Iedere dag herstelt het. Water speelt daarin een fundamentele rol.') }}
                    </p>
                    <p class="mx-auto mt-4 max-w-2xl leading-relaxed text-ink/70">
                        {{ __('WonderWater is ontwikkeld voor mensen die bewust kiezen voor kwaliteit. Mensen die begrijpen dat uitzonderlijke prestaties beginnen bij uitzonderlijke gewoonten. Niet meer. Maar beter.') }}
                    </p>
                </div>

                <div class="relative mx-auto mt-16 grid max-w-6xl gap-12 md:grid-cols-[minmax(0,1fr)_minmax(0,1.15fr)] md:gap-16">
                    {{-- Pinned visual --}}
                    <div class="md:sticky md:top-32 md:self-start">
                        <div class="relative mx-auto h-72 w-72 sm:h-96 sm:w-96" data-reveal aria-hidden="true">
                            <div class="breathe absolute inset-0 rounded-full bg-wonder/30 blur-[80px]" style="animation-duration: 7s"></div>
                            <div class="absolute inset-6 rounded-full border border-wonder-deep/10"></div>
                            <div class="absolute inset-0 rounded-full border border-dashed border-wonder-deep/15 [animation:wonderwater-orbit_50s_linear_infinite]"></div>
                            <x-bubble-field :count="12" variant="light" class="opacity-80" />

                            <svg viewBox="0 0 200 200" class="relative h-full w-full overflow-visible">
                                <g style="transform: rotate(0deg); transform-origin: center;">
                                    <g class="orbit-ring" style="--orbit-duration: 24s;">
                                        <ellipse cx="100" cy="100" rx="92" ry="34" fill="none" stroke="#0f6a5a" stroke-opacity="0.25" stroke-width="1"/>
                                        <circle cx="192" cy="100" r="3.5" fill="#b8f3e4"/>
                                    </g>
                                </g>
                                <g style="transform: rotate(60deg); transform-origin: center;">
                                    <g class="orbit-ring" style="--orbit-duration: 24s;">
                                        <ellipse cx="100" cy="100" rx="92" ry="34" fill="none" stroke="#0f6a5a" stroke-opacity="0.25" stroke-width="1"/>
                                        <circle cx="192" cy="100" r="3.5" fill="#b8f3e4"/>
                                    </g>
                                </g>
                                <g style="transform: rotate(120deg); transform-origin: center;">
                                    <g class="orbit-ring" style="--orbit-duration: 24s;">
                                        <ellipse cx="100" cy="100" rx="92" ry="34" fill="none" stroke="#0f6a5a" stroke-opacity="0.25" stroke-width="1"/>
                                        <circle cx="192" cy="100" r="3.5" fill="#b8f3e4"/>
                                    </g>
                                </g>
                                <circle class="breathe" cx="100" cy="100" r="24" fill="#0f6a5a" fill-opacity="0.14"/>
                                <circle class="breathe" cx="100" cy="100" r="10" fill="#0f6a5a" style="animation-delay: 0.3s; transform-box: fill-box; transform-origin: center;"/>
                            </svg>

                            <div class="line-draw absolute top-full left-1/2 h-16 w-px -translate-x-1/2 bg-gradient-to-b from-wonder-deep/25 to-transparent"></div>
                        </div>

                        <div class="mt-14 text-center">
                            <div data-tech-visual="0">
                                <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50">01. Hydrogen Rich</p>
                                <p class="font-display mt-2 text-lg text-wonder-deep italic">{!! __('H&#8322; opgelost in elke druppel.') !!}</p>
                            </div>
                            <div data-tech-visual="1" class="hidden">
                                <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50">02. Negative ORP</p>
                                <p class="font-display mt-2 text-lg text-wonder-deep italic">{{ __('Negatieve mV reducerend vermogen.') }}</p>
                            </div>
                            <div data-tech-visual="2" class="hidden">
                                <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50">03. Low Deuterium</p>
                                <p class="font-display mt-2 text-lg text-wonder-deep italic">{{ __('Verlaagd voor cellulaire energie.') }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Scroll-spy panels --}}
                    <div class="relative flex flex-col gap-[10vh] py-8 md:gap-[16vh]">
                        <div class="pointer-events-none absolute top-2 bottom-2 left-8 hidden w-px bg-gradient-to-b from-wonder-deep/20 via-wonder-deep/10 to-transparent md:block"></div>

                        <div
                            data-tech-panel="0"
                            data-active="true"
                            class="group ease-premium relative flex min-h-[30vh] flex-col justify-center pl-0 transition-opacity duration-700 md:pl-20 md:opacity-40 md:data-active:opacity-100"
                        >
                            <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50 group-data-active:text-wonder-deep">01</p>
                            <div class="ease-premium breathe mt-4 flex h-20 w-20 items-center justify-center rounded-full border border-wonder-deep/20 bg-wonder/20 transition-all duration-500 group-data-active:scale-110 group-data-active:border-wonder-deep/50 group-data-active:shadow-[0_0_30px_rgba(184,243,228,0.4)]" style="animation-delay: 0s">
                                <svg width="32" height="32" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="10.5" y1="14" x2="17.5" y2="14" stroke="#0f6a5a" stroke-width="2"/>
                                    <circle cx="9" cy="14" r="4.25" fill="#0f6a5a"/>
                                    <circle cx="19" cy="14" r="4.25" fill="#0f6a5a"/>
                                </svg>
                            </div>
                            <h3 class="font-display ease-premium mt-6 text-2xl transition-colors duration-500 group-data-active:text-wonder-deep">Hydrogen Rich</h3>
                            <p class="mt-3 max-w-sm leading-relaxed text-ink/60">
                                {!! __('WonderWater bevat een hoge concentratie opgelost moleculair waterstof (H&#8322;), één van de meest veelbelovende onderzoeksgebieden binnen de moderne waterwetenschap.') !!}
                            </p>
                        </div>

                        <div
                            data-tech-panel="1"
                            class="group ease-premium relative flex min-h-[30vh] flex-col justify-center pl-0 transition-opacity duration-700 md:pl-20 md:opacity-40 md:data-active:opacity-100"
                        >
                            <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50 group-data-active:text-wonder-deep">02</p>
                            <div class="ease-premium breathe mt-4 flex h-20 w-20 items-center justify-center rounded-full border border-wonder-deep/20 bg-wonder/20 transition-all duration-500 group-data-active:scale-110 group-data-active:border-wonder-deep/50 group-data-active:shadow-[0_0_30px_rgba(184,243,228,0.4)]" style="animation-delay: 1.1s">
                                <svg width="32" height="32" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="14" cy="14" r="9" stroke="#0f6a5a" stroke-width="1.5"/>
                                    <line x1="9.5" y1="14" x2="18.5" y2="14" stroke="#0f6a5a" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <h3 class="font-display ease-premium mt-6 text-2xl transition-colors duration-500 group-data-active:text-wonder-deep">Negative ORP</h3>
                            <p class="mt-3 max-w-sm leading-relaxed text-ink/60">
                                {!! __('Met een negatieve ORP bezit WonderWater een sterk reducerend karakter &ndash; een meetbare eigenschap die kenmerkend is voor hoogwaardig waterstofrijk water.') !!}
                            </p>
                        </div>

                        <div
                            data-tech-panel="2"
                            class="group ease-premium relative flex min-h-[30vh] flex-col justify-center pl-0 transition-opacity duration-700 md:pl-20 md:opacity-40 md:data-active:opacity-100"
                        >
                            <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50 group-data-active:text-wonder-deep">03</p>
                            <div class="ease-premium breathe mt-4 flex h-20 w-20 items-center justify-center rounded-full border border-wonder-deep/20 bg-wonder/20 transition-all duration-500 group-data-active:scale-110 group-data-active:border-wonder-deep/50 group-data-active:shadow-[0_0_30px_rgba(184,243,228,0.4)]" style="animation-delay: 2.2s">
                                <svg width="32" height="32" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="14" cy="14" r="1.8" fill="#0f6a5a"/>
                                    <ellipse cx="14" cy="14" rx="10" ry="4" stroke="#0f6a5a" stroke-width="1.4" transform="rotate(0 14 14)"/>
                                    <ellipse cx="14" cy="14" rx="10" ry="4" stroke="#0f6a5a" stroke-width="1.4" transform="rotate(60 14 14)"/>
                                    <ellipse cx="14" cy="14" rx="10" ry="4" stroke="#0f6a5a" stroke-width="1.4" transform="rotate(120 14 14)"/>
                                </svg>
                            </div>
                            <h3 class="font-display ease-premium mt-6 text-2xl transition-colors duration-500 group-data-active:text-wonder-deep">Low Deuterium</h3>
                            <p class="mt-3 max-w-sm leading-relaxed text-ink/60">
                                {{ __('WonderWater wordt geproduceerd als deuteriumarm water. De mogelijke invloed hiervan op cellulaire energieprocessen wordt internationaal intensief onderzocht.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <p class="font-display relative mt-20 text-center text-xl text-wonder-deep italic" data-reveal>
                    {{ __('Innovatie begint met wetenschap.') }}
                </p>
            </section>

            {{-- 3. TWO PRODUCTS — full-bleed alternating panels --}}
            <section id="producten" class="bg-ink text-paper">
                <div class="mx-auto max-w-2xl px-6 py-24 text-center lg:px-10" data-reveal>
                    <p class="text-xs font-medium tracking-[0.4em] text-wonder uppercase">Two Rituals. One Philosophy.</p>
                    <h2 class="font-display mt-4 text-4xl font-light md:text-5xl" data-split>Drink. Skin.</h2>
                </div>

                {{-- Panel 01 — Drink --}}
                <div class="group relative grid min-h-[80vh] items-center gap-12 overflow-hidden bg-ink px-6 py-16 md:grid-cols-2 md:gap-8 lg:px-16">
                    <div class="relative flex aspect-square items-center justify-center overflow-hidden md:order-1" data-reveal>
                        <span class="font-display pointer-events-none absolute text-[16rem] leading-none font-light text-paper/[0.04] select-none">01</span>
                        <x-bubble-field :count="16" variant="dark" />
                        <svg viewBox="0 0 200 240" class="ease-premium relative h-4/5 w-4/5 transition-transform duration-700 group-hover:scale-105" aria-hidden="true">
                            <defs>
                                <clipPath id="dropletClip">
                                    <path d="M100 18 C138 78 168 124 168 162 C168 202 138 228 100 228 C62 228 32 202 32 162 C32 124 62 78 100 18 Z" />
                                </clipPath>
                            </defs>

                            <g clip-path="url(#dropletClip)">
                                <g class="glass-fill">
                                    <path
                                        class="glass-wave glass-wave-1"
                                        d="M-60 100 C -35 90 -10 110 15 100 C40 90 65 110 90 100 C115 90 140 110 165 100 C190 90 215 110 240 100 C265 90 290 110 315 100 V240 H-60 Z"
                                        fill="#0f6a5a"
                                        fill-opacity="0.32"
                                    />
                                    <path
                                        class="glass-wave glass-wave-2"
                                        d="M-60 104 C -35 116 -10 92 15 104 C40 116 65 92 90 104 C115 116 140 92 165 104 C190 116 215 92 240 104 C265 116 290 92 315 104 V240 H-60 Z"
                                        fill="#b8f3e4"
                                        fill-opacity="0.28"
                                    />
                                </g>
                                <circle class="glass-bubble" cx="72" cy="212" r="2.4" fill="#b8f3e4" style="--bubble-delay: 0s" />
                                <circle class="glass-bubble" cx="118" cy="210" r="1.8" fill="#b8f3e4" style="--bubble-delay: 1.5s" />
                                <circle class="glass-bubble" cx="94" cy="216" r="1.4" fill="#b8f3e4" style="--bubble-delay: 2.8s" />
                            </g>

                            <path
                                class="draw-path"
                                d="M100 18 C138 78 168 124 168 162 C168 202 138 228 100 228 C62 228 32 202 32 162 C32 124 62 78 100 18 Z"
                                fill="none"
                                stroke="#b8f3e4"
                                stroke-opacity="0.55"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                                stroke-linecap="round"
                            />
                        </svg>
                    </div>
                    <div class="relative md:order-2" data-reveal>
                        <p class="text-xs font-medium tracking-[0.2em] text-wonder uppercase">01. WonderWater Drink</p>
                        <h3 class="font-display mt-4 text-4xl font-light md:text-5xl" data-split>{{ __('Premium water voor iedere dag.') }}</h3>
                        <p class="mt-6 max-w-md leading-relaxed text-paper/70">
                            {{ __('Zuiver geproduceerd. Vers geleverd. Ontwikkeld voor mensen die bewust kiezen voor de hoogste kwaliteit.') }}
                        </p>
                        <a
                            href="#abonnement"
                            class="ease-premium mt-8 inline-flex items-center gap-2 rounded-full border border-paper/30 px-7 py-3 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-all duration-500 hover:border-paper hover:bg-paper/5"
                        >
                            {{ __('Bekijk abonnement') }}
                            <span aria-hidden="true" class="ease-premium transition-transform duration-400 group-hover:translate-x-1">&rarr;</span>
                        </a>
                    </div>
                </div>

                {{-- Panel 02 — Skin (alternated) --}}
                <div class="group relative grid min-h-[80vh] items-center gap-12 overflow-hidden bg-ink-soft px-6 py-16 md:grid-cols-2 md:gap-8 lg:px-16">
                    <div class="relative order-2 flex aspect-square items-center justify-center overflow-hidden md:order-2" data-reveal>
                        <span class="font-display pointer-events-none absolute text-[16rem] leading-none font-light text-paper/[0.04] select-none">02</span>
                        <x-bubble-field :count="16" variant="dark" />
                        <svg viewBox="0 0 160 200" class="ease-premium relative h-4/5 w-4/5 transition-transform duration-700 group-hover:scale-105" aria-hidden="true">
                            <defs>
                                <clipPath id="jarClip">
                                    <rect x="32" y="88" width="96" height="86" rx="16" />
                                </clipPath>
                            </defs>

                            {{-- Jar body, open, filling with cream --}}
                            <g clip-path="url(#jarClip)">
                                <g class="glass-fill">
                                    <path
                                        class="glass-wave glass-wave-1"
                                        d="M-60 108 C -35 98 -10 118 15 108 C40 98 65 118 90 108 C115 98 140 118 165 108 C190 98 215 118 240 108 C265 98 290 118 315 108 V240 H-60 Z"
                                        fill="#0f6a5a"
                                        fill-opacity="0.32"
                                    />
                                    <path
                                        class="glass-wave glass-wave-2"
                                        d="M-60 112 C -35 124 -10 100 15 112 C40 124 65 100 90 112 C115 124 140 100 165 112 C190 124 215 100 240 112 C265 124 290 100 315 112 V240 H-60 Z"
                                        fill="#b8f3e4"
                                        fill-opacity="0.28"
                                    />
                                </g>
                                <circle class="glass-bubble" cx="60" cy="150" r="2" fill="#b8f3e4" style="--bubble-delay: 0.4s" />
                                <circle class="glass-bubble" cx="100" cy="152" r="1.6" fill="#b8f3e4" style="--bubble-delay: 1.9s" />
                                <circle class="glass-bubble" cx="80" cy="156" r="1.3" fill="#b8f3e4" style="--bubble-delay: 3.1s" />
                            </g>

                            <rect
                                class="draw-path"
                                x="32" y="88" width="96" height="86" rx="16"
                                fill="none"
                                stroke="#b8f3e4"
                                stroke-opacity="0.55"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                            />
                            <ellipse
                                class="draw-path"
                                cx="80" cy="88" rx="48" ry="9"
                                fill="none"
                                stroke="#b8f3e4"
                                stroke-opacity="0.55"
                                stroke-width="1.5"
                                style="transition-delay: 0.2s"
                            />

                            {{-- Lid, set aside --}}
                            <g class="breathe" style="animation-delay: 1.2s; transform-box: fill-box; transform-origin: center;">
                                <rect
                                    class="draw-path"
                                    x="88" y="26" width="58" height="30" rx="12"
                                    fill="none"
                                    stroke="#b8f3e4"
                                    stroke-opacity="0.55"
                                    stroke-width="1.5"
                                    transform="rotate(-10 117 41)"
                                    style="transition-delay: 0.5s"
                                />
                                <ellipse
                                    class="draw-path"
                                    cx="117" cy="41" rx="26" ry="6"
                                    fill="none"
                                    stroke="#b8f3e4"
                                    stroke-opacity="0.4"
                                    stroke-width="1.2"
                                    transform="rotate(-10 117 41)"
                                    style="transition-delay: 0.7s"
                                />
                            </g>
                        </svg>
                    </div>
                    <div class="relative order-1 md:order-1" data-reveal>
                        <p class="text-xs font-medium tracking-[0.2em] text-wonder uppercase">02. WonderWater Skin</p>
                        <h3 class="font-display mt-4 text-4xl font-light md:text-5xl" data-split>{{ __('Water zonder onnodige toevoegingen.') }}</h3>
                        <p class="mt-6 max-w-md leading-relaxed text-paper/70">
                            {{ __('Speciaal ontwikkeld voor dagelijkse huidverzorging. Minimalistisch. Zuiver. Elegant.') }}
                        </p>
                        <a
                            href="{{ route('movement') }}"
                            class="ease-premium mt-8 inline-flex items-center gap-2 rounded-full border border-paper/30 px-7 py-3 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-all duration-500 hover:border-paper hover:bg-paper/5"
                        >
                            {{ __('Vroege toegang') }}
                            <span aria-hidden="true" class="ease-premium transition-transform duration-400 group-hover:translate-x-1">&rarr;</span>
                        </a>
                    </div>
                </div>
            </section>

            {{-- 4. SUBSCRIPTION --}}
            <section id="abonnement" class="bg-paper px-6 py-32 lg:px-10">
                <div class="mx-auto max-w-3xl text-center" data-reveal>
                    <p class="text-xs font-medium tracking-[0.4em] text-wonder-deep uppercase">A Subscription. Nothing Else.</p>
                    <p class="font-display mt-6 text-5xl font-light md:text-6xl">{{ __('Vanaf €5 per liter.') }}</p>

                    <div class="mx-auto mt-14 grid max-w-lg grid-cols-2 gap-x-8 gap-y-6 text-left">
                        @foreach (['Geen filters', 'Geen cartridges', 'Geen apparaten', 'Geen onderhoud'] as $item)
                            <div class="flex items-center gap-3" data-reveal style="transition-delay: {{ $loop->index * 100 }}ms">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" class="shrink-0 text-wonder-deep" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="9" cy="9" r="8.25" stroke="currentColor" stroke-width="1.2"/>
                                    <path class="draw-path" d="M5.5 9.3 7.8 11.5 12.5 6.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-sm text-ink/70">{{ __($item) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <p class="mt-14 leading-relaxed text-ink/70">
                        {{ __('Alleen vers geproduceerd WonderWater, geleverd via een flexibel abonnement.') }}
                    </p>
                    <p class="font-display mt-2 text-lg text-wonder-deep italic">
                        {{ __('Altijd vers. Altijd beschikbaar. Altijd WonderWater.') }}
                    </p>

                    <a
                        href="{{ route('movement') }}"
                        class="ease-premium mt-10 inline-flex items-center rounded-full bg-ink px-8 py-3 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-all duration-500 hover:scale-[1.03] hover:shadow-[0_0_30px_rgba(15,106,90,0.3)]"
                    >
                        {{ __('Start je abonnement') }}
                    </a>
                </div>
            </section>

            {{-- 5. SCIENCE & TRANSPARENCY --}}
            <section id="science" class="bg-ink-soft px-6 py-32 text-paper lg:px-10">
                <div class="mx-auto max-w-4xl">
                    <div class="text-center" data-reveal>
                        <p class="text-xs font-medium tracking-[0.4em] text-wonder uppercase">Radical Transparency.</p>
                        <h2 class="font-display mt-4 text-4xl font-light md:text-5xl">{{ __('Innovatie vraagt om vertrouwen.') }}</h2>
                        <p class="mx-auto mt-6 max-w-2xl leading-relaxed text-paper/70">
                            {{ __('Daarom testen wij iedere productieserie onafhankelijk op onder andere:') }}
                        </p>
                    </div>

                    <div class="mt-10 grid grid-cols-2 gap-x-4 gap-y-3 sm:grid-cols-3">
                        @foreach ([
                            'Opgelost moleculair waterstof' => 'hydrogen',
                            'ORP' => 'orp',
                            'pH' => 'ph',
                            'Mineralensamenstelling' => 'minerals',
                            'Microbiologische veiligheid' => 'shield',
                            'Zware metalen' => 'metals',
                            'Pesticiden' => 'leaf',
                            'Overige verontreinigingen' => 'filter',
                            'Deuteriumgehalte (waar van toepassing)' => 'atom',
                        ] as $parameter => $icon)
                            <div data-reveal style="transition-delay: {{ $loop->index * 60 }}ms">
                                <div class="param-box ease-premium group relative flex h-14 flex-col items-center justify-center gap-1 overflow-hidden rounded-lg border border-paper/10 px-3 py-2 text-center transition-all duration-400 hover:-translate-y-0.5 hover:border-wonder/30 hover:bg-paper/[0.03]">
                                    <span class="param-ripple pointer-events-none absolute inset-0 rounded-full bg-wonder/20"></span>

                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="ease-premium relative -mt-1 h-4 w-4 -translate-y-1 scale-75 text-wonder opacity-0 transition-all duration-400 group-hover:mt-0 group-hover:translate-y-0 group-hover:scale-100 group-hover:opacity-100">
                                        @switch($icon)
                                            @case('hydrogen')
                                                <line x1="7.5" y1="10" x2="12.5" y2="10" stroke="currentColor" stroke-width="1.4"/>
                                                <circle cx="6.5" cy="10" r="3" stroke="currentColor" stroke-width="1.4"/>
                                                <circle cx="13.5" cy="10" r="3" stroke="currentColor" stroke-width="1.4"/>
                                                @break
                                            @case('orp')
                                                <circle cx="10" cy="10" r="7.5" stroke="currentColor" stroke-width="1.3"/>
                                                <line x1="6.5" y1="10" x2="13.5" y2="10" stroke="currentColor" stroke-width="1.3"/>
                                                <line x1="6.5" y1="6.3" x2="9.3" y2="6.3" stroke="currentColor" stroke-width="1.1"/>
                                                @break
                                            @case('ph')
                                                <path d="M5 16 V6 C5 4 7 3 9 4.3 C11 5.6 11 8.4 9 9.7 C7.5 10.7 5 10.3 5 12" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                                <line x1="12" y1="4" x2="12" y2="16" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                                <line x1="12" y1="4" x2="15.5" y2="4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                                <path d="M12 10 C13.5 10 15.5 10.5 15.5 12.5 C15.5 14.5 13.5 15 12 15" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                                @break
                                            @case('minerals')
                                                <path d="M10 2.5 15.5 7 13 17.5 7 17.5 4.5 7 Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                                                <path d="M4.5 7 H15.5 M7 17.5 10 7 13 17.5 M10 2.5 10 7" stroke="currentColor" stroke-width="1" stroke-opacity="0.6"/>
                                                @break
                                            @case('shield')
                                                <path d="M10 2.5 16 5 V10 C16 14 13.5 16.5 10 17.5 C6.5 16.5 4 14 4 10 V5 Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                                                <path d="M7 9.6 9.2 11.8 13.2 7.4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                                @break
                                            @case('metals')
                                                <path d="M10 2.5 16.5 6.25 V13.75 L10 17.5 3.5 13.75 V6.25 Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                                                <circle cx="10" cy="10" r="2.6" stroke="currentColor" stroke-width="1.2"/>
                                                @break
                                            @case('leaf')
                                                <path d="M5 15 C5 8 10 4 16 4 C16 10 12 15 5 15 Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                                                <line x1="5" y1="15" x2="14" y2="6" stroke="currentColor" stroke-width="1" stroke-opacity="0.6"/>
                                                <line x1="3" y1="17" x2="17" y2="3" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                                @break
                                            @case('filter')
                                                <path d="M3.5 4 H16.5 L11.5 10.5 V16 L8.5 14.5 V10.5 Z" stroke="currentColor" stroke-width="1.3" stroke-linejoin="round"/>
                                                @break
                                            @case('atom')
                                                <circle cx="10" cy="10" r="1.4" fill="currentColor"/>
                                                <ellipse cx="10" cy="10" rx="8" ry="3.2" stroke="currentColor" stroke-width="1.1" transform="rotate(0 10 10)"/>
                                                <ellipse cx="10" cy="10" rx="8" ry="3.2" stroke="currentColor" stroke-width="1.1" transform="rotate(60 10 10)"/>
                                                <ellipse cx="10" cy="10" rx="8" ry="3.2" stroke="currentColor" stroke-width="1.1" transform="rotate(120 10 10)"/>
                                                @break
                                        @endswitch
                                    </svg>

                                    <span class="ease-premium relative text-xs leading-tight text-paper/80 transition-transform duration-400 group-hover:-translate-y-0.5">{{ __($parameter) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <p class="font-display mt-14 text-center text-xl text-wonder italic" data-reveal>
                        {{ __('Geen geheimen. Alleen meetbare kwaliteit.') }}
                    </p>

                    <div class="mx-auto mt-16 max-w-2xl border-t border-paper/10 pt-8" data-reveal>
                        <p class="text-xs font-medium tracking-[0.15em] text-paper/40 uppercase">{{ __('Wetenschappelijke transparantie') }}</p>
                        <p class="mt-4 text-sm leading-relaxed text-paper/60">
                            {!! __('WonderWater bevat meetbare eigenschappen zoals opgelost moleculair waterstof, een negatieve ORP en &ndash; afhankelijk van de productiemethode &ndash; deuteriumarm water. Deze eigenschappen worden wereldwijd onderzocht. De wetenschap ontwikkelt zich snel, maar voor veel mogelijke toepassingen is aanvullend klinisch onderzoek nodig. WonderWater is geen geneesmiddel en is niet bedoeld om ziekten te diagnosticeren, behandelen of voorkomen.') !!}
                        </p>
                    </div>
                </div>
            </section>

            {{-- 6. CALL TO ACTION / MOVEMENT --}}
            <section class="relative overflow-hidden bg-ink px-6 py-32 text-paper lg:px-10">
                <x-bubble-field :count="20" variant="dark" />

                <div class="pointer-events-none absolute inset-0">
                    <div data-hero-glow class="absolute top-1/2 left-1/2 h-[60vmin] w-[60vmin] -translate-x-1/2 -translate-y-1/2 rounded-full bg-wonder/10 blur-[140px] transition-transform duration-700 ease-out"></div>
                </div>

                <div class="relative z-10 mx-auto max-w-2xl text-center" data-reveal>
                    <p class="text-xs font-medium tracking-[0.4em] text-wonder uppercase">The New Standard.</p>
                    <h2 class="font-display mt-4 text-4xl font-light md:text-5xl">Join the WonderWater Movement</h2>
                    <p class="mx-auto mt-6 max-w-xl leading-relaxed text-paper/70">
                        {{ __('De wereld verandert. Voeding verandert. Gezondheid verandert. Technologie verandert. Waarom zou water hetzelfde blijven?') }}
                    </p>
                    <p class="mx-auto mt-4 max-w-md text-sm text-paper/60">
                        @if ($signupCount > 0)
                            {{ trans_choice('Sluit je aan bij :count pionier die kiezen voor de toekomst van water.|Sluit je aan bij :count pioniers die kiezen voor de toekomst van water.', $signupCount, ['count' => $signupCount]) }}
                        @else
                            {{ __('Word een van de eerste leden en kies voor de toekomst van water.') }}
                        @endif
                    </p>

                    <a
                        href="{{ route('movement') }}"
                        class="ease-premium mt-10 inline-flex items-center rounded-full bg-paper px-10 py-4 text-xs font-medium tracking-[0.15em] text-ink uppercase transition-all duration-500 hover:scale-[1.03] hover:shadow-[0_0_40px_rgba(184,243,228,0.3)]"
                    >
                        {{ __('Word lid') }}
                    </a>
                </div>
            </section>
        </main>

        @include('partials.site-footer')
    </body>
</html>
