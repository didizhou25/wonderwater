<footer class="border-t border-mist/60 bg-paper px-6 py-16 text-ink lg:px-10">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-12 md:grid-cols-[2fr_1fr_1fr_1fr]">
            <div>
                <div class="flex items-center gap-3">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-full bg-paper ring-1 ring-ink/10">
                        <img src="{{ asset('images/wonderwater-icon.jpg') }}" alt="" class="h-full w-full object-cover" />
                    </span>
                    <p class="font-display text-xl tracking-[0.15em]">WONDERWATER</p>
                </div>
                <p class="mt-4 max-w-xs text-sm text-ink/60">The Future of Water. Drink Better.</p>
            </div>

            <div>
                <p class="text-xs font-medium tracking-[0.15em] text-ink/40 uppercase">{{ __('Merk') }}</p>
                <ul class="mt-4 space-y-3 text-sm">
                    <li><a href="#technologie" class="text-ink/70 transition-colors hover:text-ink">{{ __('Technologie') }}</a></li>
                    <li><a href="#producten" class="text-ink/70 transition-colors hover:text-ink">{{ __('Producten') }}</a></li>
                    <li><a href="#science" class="text-ink/70 transition-colors hover:text-ink">Science &amp; Transparency</a></li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-medium tracking-[0.15em] text-ink/40 uppercase">{{ __('Abonnement') }}</p>
                <ul class="mt-4 space-y-3 text-sm">
                    <li><a href="#abonnement" class="text-ink/70 transition-colors hover:text-ink">{{ __('Hoe het werkt') }}</a></li>
                    <li><a href="#movement" class="text-ink/70 transition-colors hover:text-ink">{{ __('Word lid') }}</a></li>
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
                {!! __('WonderWater bevat meetbare eigenschappen zoals opgelost moleculair waterstof, een negatieve ORP en &ndash; afhankelijk van de productiemethode &ndash; deuteriumarm water. Deze eigenschappen worden wereldwijd onderzocht. De wetenschap ontwikkelt zich snel, maar voor veel mogelijke toepassingen is aanvullend klinisch onderzoek nodig. WonderWater is geen geneesmiddel en is niet bedoeld om ziekten te diagnosticeren, behandelen of voorkomen.') !!}
            </p>

            <div class="mt-6 flex flex-col gap-4 text-xs text-ink/40 sm:flex-row sm:items-center sm:justify-between">
                <p>&copy; {{ date('Y') }} WonderWater. {{ __('Alle rechten voorbehouden.') }}</p>
                <div class="flex gap-6">
                    <a href="#" class="transition-colors hover:text-ink">{{ __('Privacybeleid') }}</a>
                    <a href="#" class="transition-colors hover:text-ink">{{ __('Algemene Voorwaarden') }}</a>
                </div>
            </div>
        </div>
    </div>
</footer>
