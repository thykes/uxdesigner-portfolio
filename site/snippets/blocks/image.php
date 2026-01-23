<?php
/** @var \Kirby\Cms\Block $block */
$src = null;
if ($block->location() == 'web') {
    $src = $block->src();
} elseif ($image = $block->image()->toFile()) {
    $src = $image->url();
}
?>
<?php if ($src): ?>
<figure class="my-20">
    <div class="relative w-full rounded-3xl overflow-hidden bg-[var(--charcoal)] shadow-xl border border-white/5 group">
        <?php if ($block->ratio()->isNotEmpty()): ?>
        <div style="aspect-ratio: <?= $block->ratio() ?>">
            <img src="<?= $src ?>" alt="<?= $block->alt() ?>" class="w-full h-full object-cover" loading="lazy">
        </div>
        <?php else: ?>
        <img src="<?= $src ?>" alt="<?= $block->alt() ?>" class="w-full h-auto object-cover" loading="lazy">
        <?php endif ?>
    </div>
    <?php if ($block->caption()->isNotEmpty()): ?>
    <figcaption class="mt-4 text-center text-sm text-[var(--text-muted)] uppercase tracking-widest font-sans">
        <?= $block->caption() ?>
    </figcaption>
    <?php endif ?>
</figure>
<?php endif ?>
