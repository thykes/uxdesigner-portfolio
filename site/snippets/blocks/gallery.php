<?php
// Soft Corner Gallery Block
?>
<section class="py-12 my-12 overflow-hidden full-width-breakout">
    <?php if ($block->headline()->isNotEmpty()): ?>
    <div class="px-6 md:px-12 lg:px-20 mb-8">
        <h2 class="serif-display text-3xl md:text-5xl font-bold mb-4"><?= $block->headline() ?></h2>
        <?php if ($block->intro()->isNotEmpty()): ?>
        <p class="text-[var(--text-muted)] max-w-2xl"><?= $block->intro() ?></p>
        <?php endif ?>
    </div>
    <?php endif ?>

    <!-- Horizontal Scrolling Container -->
    <div class="flex overflow-x-auto snap-x snap-mandatory gap-6 px-6 md:px-12 lg:px-20 pb-8 -mx-6 md:-mx-12 lg:-mx-20 scrollbar-hide">
        <?php foreach ($block->items()->toStructure() as $item): ?>
            <?php if ($image = $item->image()->toFile()): ?>
            <div class="snap-center shrink-0 w-[85vw] md:w-[600px] lg:w-[800px] flex flex-col group">
                <div class="relative overflow-hidden aspect-[4/3] rounded-3xl bg-[var(--charcoal)]">
                    <img src="<?= $image->resize(1200)->url() ?>" 
                         alt="<?= $image->alt() ?>" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                         loading="lazy">
                </div>
                <?php if ($item->caption_title()->isNotEmpty() || $item->caption_text()->isNotEmpty()): ?>
                <div class="mt-4 px-1">
                    <?php if ($item->caption_title()->isNotEmpty()): ?>
                    <h3 class="text-white font-bold text-lg mb-1"><?= $item->caption_title() ?></h3>
                    <?php endif ?>
                    <?php if ($item->caption_text()->isNotEmpty()): ?>
                    <p class="text-sm text-[var(--text-muted)]"><?= $item->caption_text() ?></p>
                    <?php endif ?>
                </div>
                <?php endif ?>
            </div>
            <?php endif ?>
        <?php endforeach ?>
        
        <!-- Padding div to ensure last item isn't flush with edge -->
        <div class="snap-center shrink-0 w-6 md:w-12 lg:w-20"></div>
    </div>
</section>
