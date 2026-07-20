<header
    data-site-nav
    class="group fixed inset-x-0 top-0 z-50 border-b border-transparent transition-colors duration-500 data-scrolled:border-mist/60 data-scrolled:bg-paper/90 data-scrolled:backdrop-blur-md"
>
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-10">
        <a href="{{ route('home') }}" class="font-display text-lg font-medium tracking-[0.2em] text-paper transition-colors duration-500 group-data-scrolled:text-ink" aria-label="WonderWater — home">
            WONDERWATER
        </a>

        <nav class="hidden items-center gap-10 text-xs font-medium tracking-[0.15em] text-paper uppercase transition-colors duration-500 group-data-scrolled:text-ink md:flex" aria-label="Hoofdmenu">
            <a href="{{ route('home') }}#technologie" class="ease-premium relative py-1 opacity-80 transition-opacity duration-300 after:absolute after:bottom-0 after:left-0 after:h-px after:w-full after:origin-left after:scale-x-0 after:bg-current after:transition-transform after:duration-400 hover:opacity-100 hover:after:scale-x-100">Technologie</a>
            <a href="{{ route('home') }}#producten" class="ease-premium relative py-1 opacity-80 transition-opacity duration-300 after:absolute after:bottom-0 after:left-0 after:h-px after:w-full after:origin-left after:scale-x-0 after:bg-current after:transition-transform after:duration-400 hover:opacity-100 hover:after:scale-x-100">Producten</a>
            <a href="{{ route('home') }}#abonnement" class="ease-premium relative py-1 opacity-80 transition-opacity duration-300 after:absolute after:bottom-0 after:left-0 after:h-px after:w-full after:origin-left after:scale-x-0 after:bg-current after:transition-transform after:duration-400 hover:opacity-100 hover:after:scale-x-100">Abonnement</a>
            <a href="{{ route('home') }}#science" class="ease-premium relative py-1 opacity-80 transition-opacity duration-300 after:absolute after:bottom-0 after:left-0 after:h-px after:w-full after:origin-left after:scale-x-0 after:bg-current after:transition-transform after:duration-400 hover:opacity-100 hover:after:scale-x-100">Science</a>
        </nav>

        <div class="flex items-center gap-3">
            <a
                href="{{ route('movement') }}"
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
            <a href="{{ route('home') }}#technologie" data-mobile-link class="font-display">Technologie</a>
            <a href="{{ route('home') }}#producten" data-mobile-link class="font-display">Producten</a>
            <a href="{{ route('home') }}#abonnement" data-mobile-link class="font-display">Abonnement</a>
            <a href="{{ route('home') }}#science" data-mobile-link class="font-display">Science</a>
        </nav>
        <a
            href="{{ route('movement') }}"
            data-mobile-link
            class="inline-flex items-center rounded-full bg-paper px-8 py-3 text-xs font-medium tracking-[0.15em] text-ink uppercase"
        >
            Word lid
        </a>
    </div>
</header>
