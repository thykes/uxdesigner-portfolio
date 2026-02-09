<?php
/** @var \Kirby\Cms\Block $block */
$before = $block->before_image()->toFile();
$after = $block->after_image()->toFile();

if ($before && $after):
    $align = $block->alignment()->or('center')->value();
    $width = $block->width()->or('full')->value();

    // Outer Wrapper Classes (Layout: Width, Float, Margin)
    $wrapperClasses = ['slider-wrapper', 'w-full']; // Base

    // Width logic
    $wrapperClasses[] = match ($width) {
        '1/2' => 'md:w-1/2',
        '1/3' => 'md:w-1/3',
        default => '' // Full width by default
    };

    // Alignment/Float logic
    if ($width !== 'full') {
        $wrapperClasses[] = match ($align) {
            'left' => 'md:float-left md:mr-8 md:mb-8 my-8',
            'right' => 'md:float-right md:ml-8 md:mb-8 my-8',
            default => 'mx-auto my-12' // Center alignment for partial width
        };
    } else {
        $wrapperClasses[] = 'my-24'; // Vertical rhythm for full width
    }

    // Inner Slider Classes (Component: Border, Radius, Overflow, Shrink-Wrap)
    $sliderClasses = [
        'relative',
        'w-fit',
        'mx-auto', // Always center inside wrapper
        'max-w-full',
        'h-auto',
        'rounded-3xl',
        'overflow-hidden',
        'bg-charcoal',
        'group',
        'cursor-pointer',
        'border',
        'border-white/5',
        'select-none',
        'slider-container'
    ];
    ?>
    <div class="<?= implode(' ', $wrapperClasses) ?>">
        <div class="<?= implode(' ', $sliderClasses) ?>" id="slider-<?= $block->id() ?>">

            <!-- Base Image (Sets Height & Width) -->
            <img src="<?= $before->url() ?>" alt="Before"
                class="block max-h-[80vh] w-auto h-auto slider-before pointer-events-none select-none">

            <!-- Overlay Image (After) -->
            <div class="absolute inset-0 select-none slider-after" style="clip-path: inset(0 50% 0 0);">
                <img src="<?= $after->url() ?>" alt="After"
                    class="absolute inset-0 w-full h-full object-cover pointer-events-none select-none">
            </div>

            <div class="absolute inset-y-0 left-1/2 w-[2px] bg-primary z-20 slider-line pointer-events-none"></div>
            <div class="slider-handle z-30"></div>

            <?php if ($block->before_label()->isNotEmpty()): ?>
                <div
                    class="absolute bottom-4 left-4 bg-background-dark/80 backdrop-blur px-3 py-1 rounded-full text-[8px] font-bold tracking-widest uppercase text-white/60 z-30">
                    <?= $block->before_label() ?>
                </div>
            <?php endif ?>

            <?php if ($block->after_label()->isNotEmpty()): ?>
                <div
                    class="absolute bottom-4 right-4 bg-primary/80 backdrop-blur px-3 py-1 rounded-full text-[8px] font-bold tracking-widest uppercase text-background-dark z-30">
                    <?= $block->after_label() ?>
                </div>
            <?php endif ?>
        </div>

        <?php if ($block->caption()->isNotEmpty()): ?>
            <figcaption class="mt-4 text-center text-sm font-medium text-[var(--text-muted)] tracking-wide italic opacity-80 max-w-2xl mx-auto">
                <?= $block->caption() ?>
            </figcaption>
        <?php endif ?>
    </div>

    <script>
        (function () {
            const slider = document.getElementById('slider-<?= $block->id() ?>');
            if (!slider) return;

            const afterImage = slider.querySelector('.slider-after');
            const handle = slider.querySelector('.slider-handle');
            const line = slider.querySelector('.slider-line');
            let isDragging = false;

            const updateSlider = (clientX) => {
                const rect = slider.getBoundingClientRect();
                let x = clientX - rect.left;
                if (x < 0) x = 0;
                if (x > rect.width) x = rect.width;

                const percentage = (x / rect.width) * 100;
                afterImage.style.clipPath = `inset(0 ${100 - percentage}% 0 0)`;
                handle.style.left = `${percentage}%`;
                line.style.left = `${percentage}%`;
            };

            const onStart = (e) => {
                isDragging = true;
                updateSlider(e.clientX || (e.touches && e.touches[0].clientX));
                e.preventDefault();
            };

            const onEnd = () => {
                isDragging = false;
            };

            const onMove = (e) => {
                if (!isDragging) return;
                updateSlider(e.clientX || (e.touches && e.touches[0].clientX));
            };

            slider.addEventListener('mousedown', onStart);
            slider.addEventListener('touchstart', onStart, { passive: false });
            window.addEventListener('mouseup', onEnd);
            window.addEventListener('touchend', onEnd);
            window.addEventListener('mousemove', onMove);
            window.addEventListener('touchmove', onMove, { passive: false });
        })();
    </script>
<?php endif ?>