<?php
/** @var \Kirby\Cms\Block $block */
$before = $block->before_image()->toFile();
$after = $block->after_image()->toFile();

if ($before && $after):
?>
<div class="my-24 relative w-full aspect-[16/9] rounded-3xl overflow-hidden bg-charcoal group cursor-pointer border border-white/5 select-none slider-container" id="slider-<?= $block->id() ?>">
    <div class="absolute inset-0 bg-cover bg-center grayscale opacity-80" style="background-image: url('<?= $before->url() ?>');"></div>
    <div class="absolute inset-0 bg-cover bg-center slider-after" style="background-image: url('<?= $after->url() ?>'); clip-path: inset(0 50% 0 0);"></div>
    <div class="absolute inset-y-0 left-1/2 w-[2px] bg-primary z-20 slider-line"></div>
    <div class="slider-handle"></div>
    
    <?php if ($block->before_label()->isNotEmpty()): ?>
    <div class="absolute bottom-4 left-4 bg-background-dark/80 backdrop-blur px-3 py-1 rounded-full text-[8px] font-bold tracking-widest uppercase text-white/60 z-30">
        <?= $block->before_label() ?>
    </div>
    <?php endif ?>

    <?php if ($block->after_label()->isNotEmpty()): ?>
    <div class="absolute bottom-4 right-4 bg-primary/80 backdrop-blur px-3 py-1 rounded-full text-[8px] font-bold tracking-widest uppercase text-background-dark z-30">
        <?= $block->after_label() ?>
    </div>
    <?php endif ?>
</div>

<script>
(function() {
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
