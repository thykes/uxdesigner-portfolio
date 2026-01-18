<section class="mb-32">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">
        <div class="relative">
            <?php if ($image = $block->image()->toFile()): ?>
            <div class="aspect-[4/5] overflow-hidden bg-[var(--charcoal)]">
                <img alt="<?= $image->alt() ?>" class="w-full h-full object-cover grayscale" src="<?= $image->url() ?>"/>
            </div>
            <p class="mt-6 text-[10px] uppercase tracking-widest text-[var(--text-muted)]"><?= $block->caption() ?></p>
            <?php endif ?>
        </div>
        <div class="pt-10">
            <h3 class="serif-display text-5xl md:text-6xl mb-10"><?= $block->title()->kti() ?></h3>
            <p class="text-[var(--text-muted)] text-xl leading-relaxed mb-12">
                <?= $block->text()->kti() ?>
            </p>
            
            <?php if ($block->points()->isNotEmpty()): ?>
            <div class="space-y-10">
                <?php foreach ($block->points()->toStructure() as $point): ?>
                <div class="flex items-start gap-6">
                    <span class="material-symbols-outlined text-[var(--accent)] text-3xl"><?= $point->icon() ?></span>
                    <div>
                        <h4 class="font-bold uppercase tracking-widest text-xs mb-2 text-white"><?= $point->title() ?></h4>
                        <p class="text-sm text-[var(--text-muted)] leading-relaxed"><?= $point->description() ?></p>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <?php endif ?>
        </div>
    </div>
</section>
