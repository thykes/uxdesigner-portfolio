<div class="my-20">
    <div class="relative w-full aspect-video rounded-3xl overflow-hidden bg-[var(--charcoal)] shadow-xl border border-white/5 group">
        <?php if ($block->source()->value() == 'file' && ($file = $block->file()->toFile())): ?>
        <video class="w-full h-full object-cover" controls playsinline>
            <source src="<?= $file->url() ?>" type="<?= $file->mime() ?>">
        </video>
        <?php elseif ($block->url()->isNotEmpty()): ?>
        <div class="absolute inset-0 w-full h-full [&_iframe]:w-full [&_iframe]:h-full">
            <?= video($block->url()) ?>
        </div>
        <?php endif ?>
    </div>
    <?php if ($block->caption()->isNotEmpty()): ?>
    <p class="mt-4 text-center text-sm text-[var(--text-muted)] uppercase tracking-widest font-sans">
        <?= $block->caption() ?>
    </p>
    <?php endif ?>
</div>
