// A blocking inline script in <head> already added `.js-ready` to <html> before
// this module runs, so CSS gated behind `.js-ready` (kinetic text, custom cursor)
// never flashes for a moment before JS takes over — and degrades gracefully to
// plain, fully-visible text/native cursor if JS never loads at all.

// Lightweight scroll-reveal: elements marked [data-reveal] fade/slide in
// once they cross into the viewport. No dependency needed for this.
const revealables = document.querySelectorAll('[data-reveal]');

if ('IntersectionObserver' in window && revealables.length) {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.setAttribute('data-revealed', 'true');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15, rootMargin: '0px 0px -80px 0px' },
    );

    revealables.forEach((el) => observer.observe(el));
} else {
    revealables.forEach((el) => el.setAttribute('data-revealed', 'true'));
}

// Kinetic word-by-word text reveal: split [data-split] elements into words,
// each wrapped for a mask/slide-up effect, staggered via a --split-i custom property.
const splitTargets = document.querySelectorAll('[data-split]');

splitTargets.forEach((el) => {
    const words = el.textContent.trim().split(/\s+/);
    el.textContent = '';
    words.forEach((word, i) => {
        const mask = document.createElement('span');
        mask.className = 'split-mask';
        const inner = document.createElement('span');
        inner.className = 'split-inner';
        inner.style.setProperty('--split-i', i);
        inner.textContent = word;
        mask.appendChild(inner);
        el.appendChild(mask);
        if (i < words.length - 1) el.appendChild(document.createTextNode(' '));
    });
});

if ('IntersectionObserver' in window && splitTargets.length) {
    const splitObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.setAttribute('data-split-revealed', 'true');
                    splitObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.4, rootMargin: '0px 0px -60px 0px' },
    );

    splitTargets.forEach((el) => splitObserver.observe(el));
} else {
    splitTargets.forEach((el) => el.setAttribute('data-split-revealed', 'true'));
}

// Sticky nav: adds a background once the hero has been scrolled past.
const siteNav = document.querySelector('[data-site-nav]');

if (siteNav) {
    const onScroll = () => {
        siteNav.toggleAttribute('data-scrolled', window.scrollY > 40);
    };

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

// Mobile menu: full-screen overlay toggled from the hamburger/close buttons.
const mobileToggles = document.querySelectorAll('[data-mobile-toggle]');
const mobilePanel = document.querySelector('[data-mobile-panel]');

if (mobileToggles.length && mobilePanel) {
    const setOpen = (open) => {
        mobilePanel.classList.toggle('hidden', !open);
        mobilePanel.classList.toggle('flex', open);
        mobileToggles.forEach((toggle) => toggle.setAttribute('aria-expanded', String(open)));
        document.body.classList.toggle('overflow-hidden', open);
    };

    mobileToggles.forEach((toggle) => {
        toggle.addEventListener('click', () => setOpen(mobilePanel.classList.contains('hidden')));
    });

    mobilePanel.querySelectorAll('[data-mobile-link]').forEach((link) => {
        link.addEventListener('click', () => setOpen(false));
    });
}

// Hero glow: drifts gently toward the pointer for a subtle premium parallax feel.
const heroGlows = document.querySelectorAll('[data-hero-glow]');
const prefersMotion = window.matchMedia('(prefers-reduced-motion: no-preference)').matches;

if (heroGlows.length && prefersMotion) {
    let glowTicking = false;
    let lastGlowEvent = null;

    const applyGlow = () => {
        glowTicking = false;
        if (!lastGlowEvent) return;

        const xOffset = (lastGlowEvent.clientX / window.innerWidth - 0.5) * 60;
        const yOffset = (lastGlowEvent.clientY / window.innerHeight - 0.5) * 60;

        heroGlows.forEach((glow) => {
            glow.style.transform = `translate(calc(-50% + ${xOffset}px), calc(-50% + ${yOffset}px))`;
        });
    };

    window.addEventListener(
        'pointermove',
        (event) => {
            lastGlowEvent = event;
            if (!glowTicking) {
                glowTicking = true;
                requestAnimationFrame(applyGlow);
            }
        },
        { passive: true },
    );
}

// Custom cursor: a small dot that follows the pointer and grows over hoverable elements.
const cursorDot = document.querySelector('[data-cursor-dot]');

if (cursorDot && window.matchMedia('(pointer: fine)').matches) {
    let cursorTicking = false;
    let lastCursorEvent = null;

    const moveCursor = () => {
        cursorTicking = false;
        if (!lastCursorEvent) return;
        cursorDot.style.transform = `translate(${lastCursorEvent.clientX}px, ${lastCursorEvent.clientY}px)`;
    };

    window.addEventListener(
        'pointermove',
        (event) => {
            lastCursorEvent = event;
            cursorDot.style.opacity = '1';
            if (!cursorTicking) {
                cursorTicking = true;
                requestAnimationFrame(moveCursor);
            }
        },
        { passive: true },
    );

    window.addEventListener('pointerleave', () => {
        cursorDot.style.opacity = '0';
    });

    const hoverables = 'a, button, input, label, [data-cursor-hover]';
    document.addEventListener('pointerover', (event) => {
        if (event.target.closest(hoverables)) {
            cursorDot.setAttribute('data-cursor-hover', 'true');
        }
    });
    document.addEventListener('pointerout', (event) => {
        if (event.target.closest(hoverables)) {
            cursorDot.removeAttribute('data-cursor-hover');
        }
    });
}

// Technologies section: pinned visual + scroll-spy over the three tall panels.
const techPanels = document.querySelectorAll('[data-tech-panel]');

if ('IntersectionObserver' in window && techPanels.length) {
    const techObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    techPanels.forEach((panel) => panel.removeAttribute('data-active'));
                    entry.target.setAttribute('data-active', 'true');

                    const index = entry.target.getAttribute('data-tech-panel');
                    document.querySelectorAll('[data-tech-visual]').forEach((visual) => {
                        visual.classList.toggle('hidden', visual.getAttribute('data-tech-visual') !== index);
                    });
                }
            });
        },
        { threshold: 0.5, rootMargin: '-20% 0px -20% 0px' },
    );

    techPanels.forEach((panel) => techObserver.observe(panel));
}

// Science section: horizontal drag-to-scroll + wheel-to-horizontal on the snap-strip.
const snapStrip = document.querySelector('[data-snap-strip]');

if (snapStrip) {
    let isDragging = false;
    let dragStartX = 0;
    let scrollStartLeft = 0;

    snapStrip.addEventListener('pointerdown', (event) => {
        isDragging = true;
        dragStartX = event.clientX;
        scrollStartLeft = snapStrip.scrollLeft;
        snapStrip.setPointerCapture(event.pointerId);
    });

    snapStrip.addEventListener('pointermove', (event) => {
        if (!isDragging) return;
        snapStrip.scrollLeft = scrollStartLeft - (event.clientX - dragStartX);
    });

    ['pointerup', 'pointercancel'].forEach((type) => {
        snapStrip.addEventListener(type, () => {
            isDragging = false;
        });
    });

    snapStrip.addEventListener(
        'wheel',
        (event) => {
            if (Math.abs(event.deltaY) <= Math.abs(event.deltaX)) return;
            snapStrip.scrollLeft += event.deltaY;
            event.preventDefault();
        },
        { passive: false },
    );
}
