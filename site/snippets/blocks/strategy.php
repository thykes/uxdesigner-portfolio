<section class="mb-32">
    <div class="max-w-4xl mb-24">
        <span class="sub-header-caps mb-6 block"><?= $block->label() ?></span>
        <h3 class="serif-display text-5xl md:text-7xl mb-10"><?= $block->title()->kti() ?></h3>
        <p class="text-[var(--text-muted)] text-2xl leading-[1.8] font-light">
            <?= $block->intro()->kti() ?>
        </p>
    </div>

    <div class="portfolio-content space-y-24">
        <?= $block->content()->toBlocks() ?>
    </div>
</section>
