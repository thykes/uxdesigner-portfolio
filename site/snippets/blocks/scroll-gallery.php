<?php
/** @var \Kirby\Cms\Block $block */
$items = $block->items()->toStructure();
?>

<section class="py-12 my-12 overflow-hidden full-width-breakout">
    <?php if ($block->headline()->isNotEmpty()): ?>
        <div class="px-6 md:px-12 lg:px-20 mb-10">
            <h2 class="serif-display text-4xl md:text-6xl font-bold mb-4">
                <?= $block->headline() ?>
            </h2>
            <?php if ($block->intro()->isNotEmpty()): ?>
                <p class="text-[var(--text-muted)] text-lg max-w-2xl">
                    <?= $block->intro() ?>
                </p>
            <?php endif ?>
        </div>
    <?php endif ?>

    <!-- Horizontal Scrolling Container -->
    <div class="relative group/gallery">
        <div class="flex overflow-x-auto snap-x snap-mandatory gap-6 px-6 md:px-12 lg:px-20 pb-12 -mx-6 md:-mx-12 lg:-mx-20 scrollbar-hide no-scrollbar"
            style="scrollbar-width: none; -ms-overflow-style: none;">
            <?php foreach ($items as $item): ?>
                <?php if ($image = $item->image()->toFile()): ?>
                    <div class="snap-center shrink-0 w-[75vw] md:w-[320px] lg:w-[380px] flex flex-col">
                        <div class="relative overflow-hidden aspect-[9/19] rounded-[2.5rem] bg-[var(--charcoal)] border-8 border-white/5 shadow-2xl cursor-zoom-in group/image"
                            data-lightbox="<?= $image->url() ?>" data-caption="<?= $item->caption() ?>">
                            <img src="<?= $image->resize(800)->url() ?>" alt="<?= $image->alt() ?>"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover/image:scale-105"
                                loading="lazy">

                            <!-- Zoom Hint Overlay -->
                            <div
                                class="absolute inset-0 bg-black/20 opacity-0 group-hover/image:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-4xl">zoom_in</span>
                            </div>
                        </div>
                        <?php if ($item->caption()->isNotEmpty()): ?>
                            <p
                                class="mt-4 text-center text-sm font-medium text-[var(--text-muted)] tracking-wide uppercase italic opacity-80">
                                <?= $item->caption() ?>
                            </p>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            <?php endforeach ?>

            <!-- End Spacer -->
            <div class="snap-center shrink-0 w-6 md:w-12 lg:w-20"></div>
        </div>

        <!-- Scroll Indicators / Controls -->
        <div class="flex justify-center gap-4 mt-4 md:hidden">
            <span class="text-[var(--text-muted)] text-[10px] uppercase tracking-widest font-bold">Scroll to explore
                →</span>
        </div>
    </div>
</section>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>