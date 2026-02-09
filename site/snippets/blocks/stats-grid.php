<?php /** @var \Kirby\Cms\Block $block */ ?>
<?php if ($block->stats()->isNotEmpty()): ?>
    <section class="mb-32">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border-y border-white/10">
            <?php foreach ($block->stats()->toStructure() as $stat): ?>
                <div
                    class="p-6 md:p-8 lg:p-12 md:first:border-r md:last:border-none border-white/10 flex flex-col justify-center relative [&:nth-child(2)]:border-r">
                    <span class="block text-xs font-bold text-[var(--accent)] uppercase tracking-[0.2em] mb-4 md:mb-6">
                        <?= $stat->label() ?>
                    </span>
                    <h2 class="text-4xl md:text-5xl lg:text-7xl font-black text-white mb-0 tracking-tight leading-none"
                        style="font-family: 'Inter', sans-serif;">
                        <?= $stat->value() ?>
                    </h2>
                </div>
            <?php endforeach ?>
        </div>
    </section>
<?php endif ?>