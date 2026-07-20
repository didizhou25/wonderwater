// Generates a static, backend-free copy of the two marketing pages for the
// Cloudflare Workers preview deploy (wonderwater.didi-0aa.workers.dev).
// Cloudflare Workers can't run PHP, so this reimplements the Blade views as
// plain HTML and points them at the same Vite-built CSS/JS/fonts. The real
// Laravel app (routes/web.php, waitlist DB, etc.) is unaffected and keeps
// deploying to TransIP per DEPLOY.md.

import { cpSync, existsSync, mkdirSync, readFileSync, writeFileSync } from 'node:fs';

const manifest = JSON.parse(readFileSync('public/build/manifest.json', 'utf8'));
const fontsManifest = JSON.parse(readFileSync('public/build/fonts-manifest.json', 'utf8'));

const cssFile = manifest['resources/css/app.css'].file;
const jsFile = manifest['resources/js/app.js'].file;
const fontsCssFile = fontsManifest.style.file;

const fontPreloads = fontsManifest.preloads
    .map(
        (p) =>
            `<link rel="preload" as="${p.as}" type="${p.type}" href="/build/${p.file}" crossorigin="${p.crossorigin}">`,
    )
    .join('\n        ');

const head = (title, description) => `
        <title>${title}</title>
        <meta name="description" content="${description}">

        <script>document.documentElement.classList.add('js-ready')</script>

        ${fontPreloads}
        <link rel="stylesheet" href="/build/${fontsCssFile}">

        <link rel="stylesheet" href="/build/${cssFile}">
        <script type="module" src="/build/${jsFile}"></script>`;

const bubbleField = (count, variant, extraClass = '') =>
    `<div class="pointer-events-none absolute inset-0 overflow-hidden${extraClass ? ` ${extraClass}` : ''}" data-bubble-field data-bubble-count="${count}" data-bubble-variant="${variant}" aria-hidden="true"></div>`;

const siteNav = () => `
        <header
            data-site-nav
            class="group fixed inset-x-0 top-0 z-50 border-b border-transparent transition-colors duration-500 data-scrolled:border-mist/60 data-scrolled:bg-paper/90 data-scrolled:backdrop-blur-md"
        >
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-10">
                <a href="/" class="font-display text-lg font-medium tracking-[0.2em] text-paper transition-colors duration-500 group-data-scrolled:text-ink" aria-label="WonderWater — home">
                    WONDERWATER
                </a>

                <nav class="hidden items-center gap-10 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-colors duration-500 group-data-scrolled:text-ink md:flex" aria-label="Hoofdmenu">
                    <a href="/#technologie" class="ease-premium relative py-1 opacity-80 transition-opacity duration-300 after:absolute after:bottom-0 after:left-0 after:h-px after:w-full after:origin-left after:scale-x-0 after:bg-current after:transition-transform after:duration-400 hover:opacity-100 hover:after:scale-x-100">Technologie</a>
                    <a href="/#producten" class="ease-premium relative py-1 opacity-80 transition-opacity duration-300 after:absolute after:bottom-0 after:left-0 after:h-px after:w-full after:origin-left after:scale-x-0 after:bg-current after:transition-transform after:duration-400 hover:opacity-100 hover:after:scale-x-100">Producten</a>
                    <a href="/#abonnement" class="ease-premium relative py-1 opacity-80 transition-opacity duration-300 after:absolute after:bottom-0 after:left-0 after:h-px after:w-full after:origin-left after:scale-x-0 after:bg-current after:transition-transform after:duration-400 hover:opacity-100 hover:after:scale-x-100">Abonnement</a>
                    <a href="/#science" class="ease-premium relative py-1 opacity-80 transition-opacity duration-300 after:absolute after:bottom-0 after:left-0 after:h-px after:w-full after:origin-left after:scale-x-0 after:bg-current after:transition-transform after:duration-400 hover:opacity-100 hover:after:scale-x-100">Science</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a
                        href="/movement"
                        class="ease-premium hidden items-center rounded-full border border-paper/40 px-5 py-2 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-all duration-400 sm:inline-flex hover:border-paper hover:bg-paper hover:text-ink hover:shadow-[0_0_20px_rgba(184,243,228,0.25)] group-data-scrolled:border-ink/20 group-data-scrolled:text-ink group-data-scrolled:hover:bg-ink group-data-scrolled:hover:text-paper"
                    >
                        Word lid
                    </a>

                    <button
                        type="button"
                        data-mobile-toggle
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        aria-label="Menu"
                        class="group/menu relative z-50 inline-flex h-10 w-10 items-center justify-center text-paper transition-colors duration-500 group-data-scrolled:text-ink md:hidden"
                    >
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="group-aria-expanded/menu:hidden">
                            <line x1="2" y1="6" x2="20" y2="6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <line x1="2" y1="11" x2="20" y2="11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <line x1="2" y1="16" x2="20" y2="16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute hidden group-aria-expanded/menu:block">
                            <line x1="1" y1="1" x2="17" y2="17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            <line x1="17" y1="1" x2="1" y2="17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" data-mobile-panel class="fixed inset-0 z-40 hidden flex-col items-center justify-center gap-10 bg-ink text-paper md:hidden">
                <nav class="flex flex-col items-center gap-8 text-lg" aria-label="Mobiel menu">
                    <a href="/#technologie" data-mobile-link class="font-display">Technologie</a>
                    <a href="/#producten" data-mobile-link class="font-display">Producten</a>
                    <a href="/#abonnement" data-mobile-link class="font-display">Abonnement</a>
                    <a href="/#science" data-mobile-link class="font-display">Science</a>
                </nav>
                <a
                    href="/movement"
                    data-mobile-link
                    class="inline-flex items-center rounded-full bg-paper px-8 py-3 text-xs font-medium tracking-[0.15em] text-ink uppercase"
                >
                    Word lid
                </a>
            </div>
        </header>`;

const siteFooter = () => `
        <footer class="border-t border-mist/60 bg-paper px-6 py-16 text-ink lg:px-10">
            <div class="mx-auto max-w-7xl">
                <div class="grid grid-cols-1 gap-12 md:grid-cols-[2fr_1fr_1fr_1fr]">
                    <div>
                        <p class="font-display text-xl tracking-[0.15em]">WONDERWATER</p>
                        <p class="mt-4 max-w-xs text-sm text-ink/60">The Future of Water. Drink Better.</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium tracking-[0.15em] text-ink/40 uppercase">Merk</p>
                        <ul class="mt-4 space-y-3 text-sm">
                            <li><a href="/#technologie" class="text-ink/70 transition-colors hover:text-ink">Technologie</a></li>
                            <li><a href="/#producten" class="text-ink/70 transition-colors hover:text-ink">Producten</a></li>
                            <li><a href="/#science" class="text-ink/70 transition-colors hover:text-ink">Science &amp; Transparency</a></li>
                        </ul>
                    </div>

                    <div>
                        <p class="text-xs font-medium tracking-[0.15em] text-ink/40 uppercase">Abonnement</p>
                        <ul class="mt-4 space-y-3 text-sm">
                            <li><a href="/#abonnement" class="text-ink/70 transition-colors hover:text-ink">Hoe het werkt</a></li>
                            <li><a href="/movement" class="text-ink/70 transition-colors hover:text-ink">Word lid</a></li>
                        </ul>
                    </div>

                    <div>
                        <p class="text-xs font-medium tracking-[0.15em] text-ink/40 uppercase">Contact</p>
                        <ul class="mt-4 space-y-3 text-sm">
                            <li><a href="mailto:hello@wonderwater.nl" class="text-ink/70 transition-colors hover:text-ink">hello@wonderwater.nl</a></li>
                            <li><a href="#" class="text-ink/70 transition-colors hover:text-ink">Instagram</a></li>
                            <li><a href="#" class="text-ink/70 transition-colors hover:text-ink">LinkedIn</a></li>
                        </ul>
                    </div>
                </div>

                <div class="mt-16 border-t border-mist/60 pt-8">
                    <p class="max-w-4xl text-xs leading-relaxed text-ink/50">
                        WonderWater bevat meetbare eigenschappen zoals opgelost moleculair waterstof, een negatieve ORP en
                        &ndash; afhankelijk van de productiemethode &ndash; een verlaagd deuteriumgehalte. Deze eigenschappen
                        worden wereldwijd onderzocht. De wetenschap ontwikkelt zich snel, maar voor veel mogelijke
                        toepassingen is aanvullend klinisch onderzoek nodig. WonderWater is geen geneesmiddel en is niet
                        bedoeld om ziekten te diagnosticeren, behandelen of voorkomen.
                    </p>

                    <div class="mt-6 flex flex-col gap-4 text-xs text-ink/40 sm:flex-row sm:items-center sm:justify-between">
                        <p>&copy; ${new Date().getFullYear()} WonderWater. Alle rechten voorbehouden.</p>
                        <div class="flex gap-6">
                            <a href="#" class="transition-colors hover:text-ink">Privacybeleid</a>
                            <a href="#" class="transition-colors hover:text-ink">Algemene Voorwaarden</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>`;

const homePage = () => `<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        ${head('WonderWater — The Future of Water.', 'WonderWater is waterstofrijk water met een negatieve ORP en verlaagd deuteriumgehalte. Geen apparaten, geen abonnement-gedoe — vanaf €5 per liter, altijd vers geleverd.')}
    </head>
    <body class="bg-paper font-sans text-ink antialiased">
        <div data-cursor-dot class="cursor-dot" style="opacity: 0"></div>

        ${siteNav()}

        <main>
            <section class="relative flex min-h-screen items-center justify-center overflow-hidden bg-ink px-6 text-paper">
                <div class="pointer-events-none absolute inset-0">
                    <div class="absolute inset-0 bg-gradient-to-b from-ink via-ink-soft to-ink"></div>
                    <div data-hero-glow class="absolute top-1/2 left-1/2 h-[70vmin] w-[70vmin] -translate-x-1/2 -translate-y-1/2 rounded-full bg-wonder/10 blur-[140px] transition-transform duration-700 ease-out"></div>
                    <div class="absolute inset-0 opacity-[0.035] [background-image:radial-gradient(circle,white_1px,transparent_1px)] [background-size:28px_28px]"></div>
                </div>

                ${bubbleField(30, 'dark')}

                <div class="relative z-10 mx-auto max-w-3xl pt-24 pb-12 text-center">
                    <p class="text-xs font-medium tracking-[0.4em] text-wonder uppercase" data-reveal style="transition-delay: 0ms">WonderWater</p>

                    <h1 class="mt-8 font-display text-6xl leading-[0.95] font-light tracking-tight sm:text-7xl md:text-8xl">
                        <span data-split class="block">The Future</span>
                        <span data-split class="block">of Water.</span>
                    </h1>

                    <p class="mx-auto mt-10 max-w-xl text-balance text-lg leading-relaxed text-paper/70" data-reveal style="transition-delay: 200ms">
                        Water is het meest essentiële element van het leven &mdash; toch drinken we vandaag
                        vrijwel hetzelfde water als tientallen jaren geleden.
                        <span class="text-wonder">Wat als het slimmer kon zijn?</span>
                    </p>

                    <div class="mt-12 flex flex-col items-center justify-center gap-4 sm:flex-row" data-reveal style="transition-delay: 380ms">
                        <a
                            href="#technologie"
                            class="ease-premium inline-flex items-center rounded-full bg-paper px-8 py-3 text-xs font-medium tracking-[0.15em] text-ink uppercase transition-all duration-500 hover:scale-[1.03] hover:shadow-[0_0_30px_rgba(184,243,228,0.35)]"
                        >
                            Ontdek de technologie
                        </a>
                        <a
                            href="/movement"
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

            <section id="technologie" class="bg-paper px-6 py-32 lg:px-10">
                <div class="mx-auto max-w-3xl text-center" data-reveal>
                    <p class="text-xs font-medium tracking-[0.4em] text-wonder-deep uppercase">Three Technologies. One Wonder.</p>
                    <h2 class="font-display mt-4 text-4xl font-light md:text-5xl" data-split>Designed for Human Performance.</h2>

                    <p class="mx-auto mt-8 max-w-2xl leading-relaxed text-ink/70">
                        Iedere dag maakt je lichaam miljarden nieuwe cellen aan. Iedere dag produceert het
                        energie. Iedere dag herstelt het. Water speelt daarin een fundamentele rol.
                    </p>
                    <p class="mx-auto mt-4 max-w-2xl leading-relaxed text-ink/70">
                        WonderWater is ontwikkeld voor mensen die bewust kiezen voor kwaliteit &mdash; mensen die
                        begrijpen dat uitzonderlijke prestaties beginnen bij uitzonderlijke gewoonten. Niet meer.
                        Maar beter.
                    </p>
                </div>

                <div class="mx-auto mt-24 grid max-w-6xl gap-16 md:grid-cols-2 md:gap-20">
                    <div class="md:sticky md:top-32 md:self-start">
                        <div class="relative mx-auto h-64 w-64 sm:h-80 sm:w-80" data-reveal aria-hidden="true">
                            <div class="absolute inset-0 rounded-full bg-wonder/25 blur-[70px]"></div>
                            ${bubbleField(8, 'light', 'opacity-70')}

                            <svg viewBox="0 0 200 200" class="relative h-full w-full overflow-visible">
                                <g style="transform: rotate(0deg); transform-origin: center;">
                                    <g class="orbit-ring" style="--orbit-duration: 26s;">
                                        <ellipse cx="100" cy="100" rx="92" ry="34" fill="none" stroke="#0f6a5a" stroke-opacity="0.25" stroke-width="1"/>
                                        <circle cx="192" cy="100" r="3.5" fill="#b8f3e4"/>
                                    </g>
                                </g>
                                <g style="transform: rotate(60deg); transform-origin: center;">
                                    <g class="orbit-ring" style="--orbit-duration: 19s; --orbit-direction: reverse;">
                                        <ellipse cx="100" cy="100" rx="92" ry="34" fill="none" stroke="#0f6a5a" stroke-opacity="0.25" stroke-width="1"/>
                                        <circle cx="192" cy="100" r="3.5" fill="#b8f3e4"/>
                                    </g>
                                </g>
                                <g style="transform: rotate(120deg); transform-origin: center;">
                                    <g class="orbit-ring" style="--orbit-duration: 32s;">
                                        <ellipse cx="100" cy="100" rx="92" ry="34" fill="none" stroke="#0f6a5a" stroke-opacity="0.25" stroke-width="1"/>
                                        <circle cx="192" cy="100" r="3.5" fill="#b8f3e4"/>
                                    </g>
                                </g>
                                <circle class="breathe" cx="100" cy="100" r="20" fill="#0f6a5a" fill-opacity="0.14"/>
                                <circle cx="100" cy="100" r="9" fill="#0f6a5a"/>
                            </svg>

                            <div class="line-draw absolute top-full left-1/2 h-16 w-px -translate-x-1/2 bg-gradient-to-b from-wonder-deep/25 to-transparent"></div>
                        </div>

                        <div class="mt-14 text-center">
                            <div data-tech-visual="0">
                                <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50">01 &mdash; Hydrogen Rich</p>
                                <p class="font-display mt-2 text-lg text-wonder-deep italic">H&#8322; opgelost in elke druppel.</p>
                            </div>
                            <div data-tech-visual="1" class="hidden">
                                <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50">02 &mdash; Negative ORP</p>
                                <p class="font-display mt-2 text-lg text-wonder-deep italic">&minus;400 mV reducerend vermogen.</p>
                            </div>
                            <div data-tech-visual="2" class="hidden">
                                <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50">03 &mdash; Low Deuterium</p>
                                <p class="font-display mt-2 text-lg text-wonder-deep italic">Verlaagd voor cellulaire energie.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-[22vh] py-8 md:gap-[32vh]">
                        <div
                            data-tech-panel="0"
                            data-active="true"
                            class="ease-premium flex min-h-[40vh] flex-col justify-center transition-opacity duration-700 md:opacity-40 md:data-active:opacity-100"
                        >
                            <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50">01</p>
                            <div class="breathe mt-4 flex h-16 w-16 items-center justify-center rounded-full border border-wonder-deep/20 bg-wonder/20" style="animation-delay: 0s">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="10.5" y1="14" x2="17.5" y2="14" stroke="#0f6a5a" stroke-width="2"/>
                                    <circle cx="9" cy="14" r="4.25" fill="#0f6a5a"/>
                                    <circle cx="19" cy="14" r="4.25" fill="#0f6a5a"/>
                                </svg>
                            </div>
                            <h3 class="font-display mt-6 text-2xl">Hydrogen Rich</h3>
                            <p class="mt-3 max-w-sm leading-relaxed text-ink/60">
                                WonderWater bevat een hoge concentratie opgelost moleculair waterstof (H&#8322;),
                                één van de meest veelbelovende onderzoeksgebieden binnen de moderne
                                waterwetenschap.
                            </p>
                        </div>

                        <div
                            data-tech-panel="1"
                            class="ease-premium flex min-h-[40vh] flex-col justify-center transition-opacity duration-700 md:opacity-40 md:data-active:opacity-100"
                        >
                            <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50">02</p>
                            <div class="breathe mt-4 flex h-16 w-16 items-center justify-center rounded-full border border-wonder-deep/20 bg-wonder/20" style="animation-delay: 1.1s">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="14" cy="14" r="9" stroke="#0f6a5a" stroke-width="1.5"/>
                                    <line x1="9.5" y1="14" x2="18.5" y2="14" stroke="#0f6a5a" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <h3 class="font-display mt-6 text-2xl">Negative ORP</h3>
                            <p class="mt-3 max-w-sm leading-relaxed text-ink/60">
                                Met een ORP van ongeveer &minus;400 mV bezit WonderWater een sterk reducerend
                                karakter &ndash; een meetbare eigenschap die kenmerkend is voor hoogwaardig
                                waterstofrijk water.
                            </p>
                        </div>

                        <div
                            data-tech-panel="2"
                            class="ease-premium flex min-h-[40vh] flex-col justify-center transition-opacity duration-700 md:opacity-40 md:data-active:opacity-100"
                        >
                            <p class="text-xs font-medium tracking-[0.2em] text-wonder-deep/50">03</p>
                            <div class="breathe mt-4 flex h-16 w-16 items-center justify-center rounded-full border border-wonder-deep/20 bg-wonder/20" style="animation-delay: 2.2s">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="14" cy="14" r="1.8" fill="#0f6a5a"/>
                                    <ellipse cx="14" cy="14" rx="10" ry="4" stroke="#0f6a5a" stroke-width="1.4" transform="rotate(0 14 14)"/>
                                    <ellipse cx="14" cy="14" rx="10" ry="4" stroke="#0f6a5a" stroke-width="1.4" transform="rotate(60 14 14)"/>
                                    <ellipse cx="14" cy="14" rx="10" ry="4" stroke="#0f6a5a" stroke-width="1.4" transform="rotate(120 14 14)"/>
                                </svg>
                            </div>
                            <h3 class="font-display mt-6 text-2xl">Low Deuterium</h3>
                            <p class="mt-3 max-w-sm leading-relaxed text-ink/60">
                                WonderWater wordt geproduceerd met een verlaagd deuteriumgehalte. De mogelijke
                                invloed hiervan op cellulaire energieprocessen wordt internationaal intensief
                                onderzocht.
                            </p>
                        </div>
                    </div>
                </div>

                <p class="font-display mt-20 text-center text-xl text-wonder-deep italic" data-reveal>
                    Innovatie begint met wetenschap.
                </p>
            </section>

            <section id="producten" class="bg-ink text-paper">
                <div class="mx-auto max-w-2xl px-6 py-24 text-center lg:px-10" data-reveal>
                    <p class="text-xs font-medium tracking-[0.4em] text-wonder uppercase">Two Rituals. One Philosophy.</p>
                    <h2 class="font-display mt-4 text-4xl font-light md:text-5xl" data-split>Drink. Skin.</h2>
                </div>

                <div class="group relative grid min-h-[80vh] items-center gap-12 overflow-hidden bg-ink px-6 py-16 md:grid-cols-2 md:gap-8 lg:px-16">
                    <div class="relative flex aspect-square items-center justify-center overflow-hidden md:order-1" data-reveal>
                        <span class="font-display pointer-events-none absolute text-[16rem] leading-none font-light text-paper/[0.04] select-none">01</span>
                        ${bubbleField(16, 'dark')}
                        <svg viewBox="0 0 200 260" class="ease-premium relative h-4/5 w-4/5 transition-transform duration-700 group-hover:scale-105" aria-hidden="true">
                            <path
                                class="draw-path"
                                d="M85 20 H115 V72 L162 216 Q168 234 148 234 H52 Q32 234 38 216 L85 72 Z"
                                fill="none"
                                stroke="#b8f3e4"
                                stroke-opacity="0.55"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                                stroke-linecap="round"
                            />
                            <line class="rise-in" x1="48" y1="188" x2="152" y2="188" stroke="#b8f3e4" stroke-opacity="0.3" stroke-width="1"/>
                        </svg>
                    </div>
                    <div class="relative md:order-2" data-reveal>
                        <p class="text-xs font-medium tracking-[0.2em] text-wonder uppercase">01 &mdash; WonderWater Drink</p>
                        <h3 class="font-display mt-4 text-4xl font-light md:text-5xl" data-split>Premium water voor iedere dag.</h3>
                        <p class="mt-6 max-w-md leading-relaxed text-paper/70">
                            Zuiver geproduceerd. Vers geleverd. Ontwikkeld voor mensen die bewust kiezen voor de
                            hoogste kwaliteit.
                        </p>
                        <a
                            href="#abonnement"
                            class="ease-premium mt-8 inline-flex items-center gap-2 rounded-full border border-paper/30 px-7 py-3 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-all duration-500 hover:border-paper hover:bg-paper/5"
                        >
                            Bekijk abonnement
                            <span aria-hidden="true" class="ease-premium transition-transform duration-400 group-hover:translate-x-1">&rarr;</span>
                        </a>
                    </div>
                </div>

                <div class="group relative grid min-h-[80vh] items-center gap-12 overflow-hidden bg-ink-soft px-6 py-16 md:grid-cols-2 md:gap-8 lg:px-16">
                    <div class="relative order-2 flex aspect-square items-center justify-center overflow-hidden md:order-2" data-reveal>
                        <span class="font-display pointer-events-none absolute text-[16rem] leading-none font-light text-paper/[0.04] select-none">02</span>
                        ${bubbleField(16, 'dark')}
                        <svg viewBox="0 0 160 200" class="ease-premium relative h-4/5 w-4/5 transition-transform duration-700 group-hover:scale-105" aria-hidden="true">
                            <path
                                class="draw-path breathe"
                                d="M80 14 C112 72 142 112 142 146 C142 176 114 196 80 196 C46 196 18 176 18 146 C18 112 48 72 80 14 Z"
                                fill="none"
                                stroke="#b8f3e4"
                                stroke-opacity="0.55"
                                stroke-width="1.5"
                                stroke-linejoin="round"
                                stroke-linecap="round"
                                style="animation-delay: 2s"
                            />
                        </svg>
                    </div>
                    <div class="relative order-1 md:order-1" data-reveal>
                        <p class="text-xs font-medium tracking-[0.2em] text-wonder uppercase">02 &mdash; WonderWater Skin</p>
                        <h3 class="font-display mt-4 text-4xl font-light md:text-5xl" data-split>Water zonder onnodige toevoegingen.</h3>
                        <p class="mt-6 max-w-md leading-relaxed text-paper/70">
                            Speciaal ontwikkeld voor dagelijkse huidverzorging. Minimalistisch. Zuiver. Elegant.
                        </p>
                        <a
                            href="/movement"
                            class="ease-premium mt-8 inline-flex items-center gap-2 rounded-full border border-paper/30 px-7 py-3 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-all duration-500 hover:border-paper hover:bg-paper/5"
                        >
                            Vroege toegang
                            <span aria-hidden="true" class="ease-premium transition-transform duration-400 group-hover:translate-x-1">&rarr;</span>
                        </a>
                    </div>
                </div>
            </section>

            <section id="abonnement" class="bg-paper px-6 py-32 lg:px-10">
                <div class="mx-auto max-w-3xl text-center" data-reveal>
                    <p class="text-xs font-medium tracking-[0.4em] text-wonder-deep uppercase">A Subscription. Nothing Else.</p>
                    <p class="font-display mt-6 text-5xl font-light md:text-6xl">Vanaf &euro;5 per liter.</p>

                    <div class="mx-auto mt-14 grid max-w-lg grid-cols-2 gap-x-8 gap-y-6 text-left">
                        ${['Geen filters', 'Geen cartridges', 'Geen apparaten', 'Geen onderhoud']
                            .map(
                                (item, i) => `<div class="flex items-center gap-3" data-reveal style="transition-delay: ${i * 100}ms">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" class="shrink-0 text-wonder-deep" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="9" cy="9" r="8.25" stroke="currentColor" stroke-width="1.2"/>
                                    <path class="draw-path" d="M5.5 9.3 7.8 11.5 12.5 6.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span class="text-sm text-ink/70">${item}</span>
                            </div>`,
                            )
                            .join('\n                        ')}
                    </div>

                    <p class="mt-14 leading-relaxed text-ink/70">
                        Alleen vers geproduceerd WonderWater, geleverd via een flexibel abonnement.
                    </p>
                    <p class="font-display mt-2 text-lg text-wonder-deep italic">
                        Altijd vers. Altijd beschikbaar. Altijd WonderWater.
                    </p>

                    <a
                        href="/movement"
                        class="ease-premium mt-10 inline-flex items-center rounded-full bg-ink px-8 py-3 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-all duration-500 hover:scale-[1.03] hover:shadow-[0_0_30px_rgba(15,106,90,0.3)]"
                    >
                        Start je abonnement
                    </a>
                </div>
            </section>

            <section id="science" class="bg-ink-soft px-6 py-32 text-paper lg:px-10">
                <div class="mx-auto max-w-4xl">
                    <div class="text-center" data-reveal>
                        <p class="text-xs font-medium tracking-[0.4em] text-wonder uppercase">Radical Transparency.</p>
                        <h2 class="font-display mt-4 text-4xl font-light md:text-5xl">Innovatie vraagt om vertrouwen.</h2>
                        <p class="mx-auto mt-6 max-w-2xl leading-relaxed text-paper/70">
                            Daarom testen wij iedere productieserie onafhankelijk op onder andere:
                        </p>
                    </div>

                    <div class="mt-14 grid grid-cols-2 gap-x-6 gap-y-4 sm:grid-cols-3">
                        ${[
                            'Opgelost moleculair waterstof',
                            'ORP',
                            'pH',
                            'Mineralensamenstelling',
                            'Microbiologische veiligheid',
                            'Zware metalen',
                            'Pesticiden',
                            'Overige verontreinigingen',
                            'Deuteriumgehalte (waar van toepassing)',
                        ]
                            .map(
                                (parameter, i) => `<div data-reveal style="transition-delay: ${i * 60}ms">
                                <div class="ease-premium rounded-lg border border-paper/10 px-4 py-3 text-center text-sm text-paper/80 transition-all duration-400 hover:-translate-y-0.5 hover:border-wonder/30 hover:bg-paper/[0.03]">
                                    ${parameter}
                                </div>
                            </div>`,
                            )
                            .join('\n                        ')}
                    </div>

                    <p class="font-display mt-14 text-center text-xl text-wonder italic" data-reveal>
                        Geen geheimen. Alleen meetbare kwaliteit.
                    </p>

                    <div class="mx-auto mt-16 max-w-2xl border-t border-paper/10 pt-8" data-reveal>
                        <p class="text-xs font-medium tracking-[0.15em] text-paper/40 uppercase">Wetenschappelijke transparantie</p>
                        <p class="mt-4 text-sm leading-relaxed text-paper/60">
                            WonderWater bevat meetbare eigenschappen zoals opgelost moleculair waterstof, een
                            negatieve ORP en &ndash; afhankelijk van de productiemethode &ndash; een verlaagd
                            deuteriumgehalte. Deze eigenschappen worden wereldwijd onderzocht. De wetenschap
                            ontwikkelt zich snel, maar voor veel mogelijke toepassingen is aanvullend klinisch
                            onderzoek nodig. WonderWater is geen geneesmiddel en is niet bedoeld om ziekten te
                            diagnosticeren, behandelen of voorkomen.
                        </p>
                    </div>
                </div>
            </section>

            <section class="relative overflow-hidden bg-ink px-6 py-32 text-paper lg:px-10">
                ${bubbleField(20, 'dark')}

                <div class="pointer-events-none absolute inset-0">
                    <div data-hero-glow class="absolute top-1/2 left-1/2 h-[60vmin] w-[60vmin] -translate-x-1/2 -translate-y-1/2 rounded-full bg-wonder/10 blur-[140px] transition-transform duration-700 ease-out"></div>
                </div>

                <div class="relative z-10 mx-auto max-w-2xl text-center" data-reveal>
                    <p class="text-xs font-medium tracking-[0.4em] text-wonder uppercase">The New Standard.</p>
                    <p class="mx-auto mt-6 max-w-xl leading-relaxed text-paper/70">
                        De wereld verandert. Voeding verandert. Gezondheid verandert. Technologie verandert.
                        Waarom zou water hetzelfde blijven?
                    </p>
                    <h2 class="font-display mt-8 text-4xl font-light md:text-5xl">Join the WonderWater Movement</h2>
                    <p class="mx-auto mt-4 max-w-md text-sm text-paper/60">
                        Word een van de eerste leden en kies voor de toekomst van water.
                    </p>

                    <a
                        href="/movement"
                        class="ease-premium mt-10 inline-flex items-center rounded-full bg-paper px-10 py-4 text-xs font-medium tracking-[0.15em] text-ink uppercase transition-all duration-500 hover:scale-[1.03] hover:shadow-[0_0_40px_rgba(184,243,228,0.3)]"
                    >
                        Word lid
                    </a>

                    <p class="font-display mt-20 text-sm tracking-[0.3em] text-paper/30 uppercase">
                        WonderWater &mdash; The Future of Water. Drink Better.
                    </p>
                </div>
            </section>
        </main>

        ${siteFooter()}
    </body>
</html>
`;

const movementPage = () => `<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        ${head('Join the Movement — WonderWater', 'Word lid van de WonderWater movement. Vanaf €5 per liter, altijd vers geleverd, geen apparaten.')}
    </head>
    <body class="bg-ink font-sans text-paper antialiased">
        <div data-cursor-dot class="cursor-dot" style="opacity: 0"></div>

        ${siteNav()}

        <main class="relative flex min-h-screen items-center justify-center overflow-hidden px-6 py-32">
            ${bubbleField(32, 'dark')}

            <div class="pointer-events-none absolute inset-0">
                <div class="absolute inset-0 bg-gradient-to-b from-ink via-ink-soft to-ink"></div>
                <div data-hero-glow class="absolute top-1/3 left-1/2 h-[55vmin] w-[55vmin] -translate-x-1/2 -translate-y-1/2 rounded-full bg-wonder/10 blur-[150px] transition-transform duration-700 ease-out"></div>
            </div>

            <div class="relative z-10 mx-auto w-full max-w-md">
                <div class="text-center" data-reveal>
                    <a href="/" class="ease-premium text-xs tracking-[0.3em] text-paper/40 uppercase transition-colors duration-400 hover:text-paper/70">
                        &larr; Terug naar WonderWater
                    </a>

                    <p class="mt-10 text-xs font-medium tracking-[0.4em] text-wonder uppercase">The New Standard.</p>
                    <h1 class="font-display mt-4 text-4xl font-light md:text-5xl">Join the Movement</h1>
                    <p class="mx-auto mt-4 max-w-sm text-sm leading-relaxed text-paper/70">
                        Word een van de eerste leden en kies voor de toekomst van water.
                    </p>
                </div>

                <div class="mt-14" data-reveal style="transition-delay: 150ms">
                    <div data-static-waitlist-wrap>
                        <form data-static-waitlist-form class="rounded-2xl border border-paper/10 bg-paper/[0.03] p-8 sm:p-10">
                            <div>
                                <label for="name" class="text-xs tracking-[0.15em] text-paper/50 uppercase">Naam (optioneel)</label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
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
                                    placeholder="jouw@email.nl"
                                    class="ease-premium mt-2 w-full border-0 border-b border-paper/20 bg-transparent px-0 py-3 text-paper placeholder:text-paper/25 transition-colors duration-400 focus:border-wonder focus:ring-0 focus:outline-none"
                                >
                            </div>

                            <fieldset class="mt-8">
                                <legend class="text-xs tracking-[0.15em] text-paper/50 uppercase">Interesse</legend>
                                <div class="mt-3 grid grid-cols-3 gap-2">
                                    ${Object.entries({ drink: 'Drink', skin: 'Skin', both: 'Beide' })
                                        .map(
                                            ([value, label]) => `<label class="cursor-pointer">
                                            <input
                                                type="radio"
                                                name="interest"
                                                value="${value}"
                                                ${value === 'drink' ? 'checked' : ''}
                                                class="peer sr-only"
                                            >
                                            <span class="ease-premium block rounded-full border border-paper/20 py-2.5 text-center text-xs tracking-[0.1em] text-paper/60 uppercase transition-all duration-400 peer-checked:border-wonder peer-checked:bg-wonder/10 peer-checked:text-wonder peer-checked:shadow-[0_0_16px_rgba(184,243,228,0.15)]">
                                                ${label}
                                            </span>
                                        </label>`,
                                        )
                                        .join('\n                                    ')}
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
                    </div>

                    <div data-static-waitlist-success class="hidden rounded-2xl border border-wonder/30 bg-wonder/10 px-8 py-10 text-center">
                        <p class="font-display text-2xl text-wonder">Welkom bij de movement.</p>
                        <p class="mt-3 text-sm text-paper/70">We nemen zo snel mogelijk contact met je op.</p>
                        <a href="/" class="ease-premium mt-8 inline-flex items-center rounded-full border border-paper/30 px-6 py-2.5 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-all duration-400 hover:border-paper hover:shadow-[0_0_20px_rgba(184,243,228,0.2)]">
                            Terug naar de homepage
                        </a>
                    </div>
                </div>
            </div>
        </main>

        ${siteFooter()}
    </body>
</html>
`;

const notFoundPage = () => `<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pagina niet gevonden — WonderWater</title>
        <style>
            body { margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: #0a0d0c; color: #f6f4ee; font-family: ui-sans-serif, system-ui, sans-serif; text-align: center; }
            a { color: #b8f3e4; }
        </style>
    </head>
    <body>
        <div>
            <p style="font-size: 0.75rem; letter-spacing: 0.4em; text-transform: uppercase; color: #b8f3e4;">404</p>
            <h1 style="font-weight: 300; margin: 1rem 0;">Deze pagina bestaat niet.</h1>
            <a href="/">&larr; Terug naar WonderWater</a>
        </div>
    </body>
</html>
`;

mkdirSync('dist', { recursive: true });
cpSync('public/build', 'dist/build', { recursive: true });
if (existsSync('public/favicon.ico')) cpSync('public/favicon.ico', 'dist/favicon.ico');
if (existsSync('public/robots.txt')) cpSync('public/robots.txt', 'dist/robots.txt');

writeFileSync('dist/index.html', homePage());
writeFileSync('dist/movement.html', movementPage());
writeFileSync('dist/404.html', notFoundPage());

console.log('Static Cloudflare preview built into dist/');
