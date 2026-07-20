@props([
    'count' => 24,
    'variant' => 'dark',
])

<div {{ $attributes->merge(['class' => 'pointer-events-none absolute inset-0 overflow-hidden']) }} aria-hidden="true">
    @for ($i = 0; $i < $count; $i++)
        @php
            $size = random_int(3, 14);
            $left = random_int(2, 98);
            $duration = random_int(12, 28);
            $delay = random_int(0, 24) * -1;
            $opacity = random_int(15, 50) / 100;
            $blur = random_int(0, 7) / 10;
        @endphp
        <span
            class="bubble {{ $variant === 'light' ? 'bubble--light' : 'bubble--dark' }}"
            style="--bubble-size: {{ $size }}px; --bubble-left: {{ $left }}%; --bubble-duration: {{ $duration }}s; --bubble-delay: {{ $delay }}s; --bubble-opacity: {{ $opacity }}; --bubble-blur: {{ $blur }}px;"
        ></span>
    @endfor
</div>
