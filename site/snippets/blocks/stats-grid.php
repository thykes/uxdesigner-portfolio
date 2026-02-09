<?php /** @var \Kirby\Cms\Block $block */ ?>
<?php if ($block->stats()->isNotEmpty()): ?>
    <section class="mb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border-y border-white/10">
            <?php foreach ($block->stats()->toStructure() as $stat): ?>
                <div
                    class="p-12 md:first:border-r md:last:border-none border-white/10 flex flex-col justify-center relative [&:nth-child(2)]:border-r">
                    <span class="block text-sm font-bold text-[var(--accent)] uppercase tracking-[0.2em] mb-4">
                        <?= $stat->label() ?>
                    </span>
                    <h2 class="text-6xl md:text-7xl font-black text-white mb-6 tracking-tighter">
                        <?= $stat->value() ?>
                    </h2>
                    <p class="text-sm text-[var(--accent)] uppercase tracking-wider font-semibold">
                        <?= $stat->description() ?>
                    </p>
                </div>
            <?php endforeach ?>
        </div>
    </section>
<?php endif ?>