<?php snippet('header') ?>

<section class="py-20 md:py-32 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24 items-start">
    <div class="lg:col-span-5 relative order-2 lg:order-1">
        <div class="aspect-[4/5] bg-[var(--charcoal)] relative">
            <?php if($image = $page->cover()->toFile()): ?>
                <img alt="<?= $image->alt() ?>" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700" src="<?= $image->resize(800)->url() ?>"/>
            <?php else: ?>
                <div class="w-full h-full flex items-center justify-center text-[var(--text-muted)] border border-white/10">No image</div>
            <?php endif ?>

        </div>
        <div class="mt-8 flex gap-4 items-center">
            <div class="line-accent"></div>
            <p class="text-[10px] uppercase tracking-[0.3em] text-[var(--text-muted)]"><?= $page->location()->or('Based in New York City') ?></p>
        </div>
    </div>
    <div class="lg:col-span-7 order-1 lg:order-2">
        <span class="text-[var(--accent)] uppercase tracking-widest text-xs font-semibold mb-4 block"><?= $page->role_title()->or('UX DESIGNER & STRATEGIST') ?></span>
        <h1 class="serif-display text-5xl md:text-7xl lg:text-8xl leading-tight mb-10">
            <?= $page->header_title()->or('Crafting the <span class="italic">unseen</span> details of digital life.') ?>
        </h1>
        <div class="space-y-8 max-w-2xl">
            <p class="text-xl md:text-2xl font-light leading-relaxed text-[var(--text-muted)]">
                <?= $page->intro()->kti() ?>
            </p>
            <p class="text-lg font-light leading-relaxed text-[var(--text-muted)]">
                <?= $page->detailed_bio()->kti() ?>
            </p>
        </div>
    </div>
</section>

<section class="py-24 border-t border-white/10">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
        <div class="md:col-span-4">
            <h2 class="serif-display text-4xl"><?= $page->capabilities_headline()->or('Capabilities') ?></h2>
            <p class="mt-4 text-[var(--text-muted)] text-sm max-w-xs"><?= $page->capabilities_intro() ?></p>
        </div>
        <div class="md:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-16">
            <?php $index = 1; foreach($page->capabilities()->toStructure() as $item): ?>
            <div>
                <span class="text-xs text-[var(--accent)] font-mono"><?= str_pad($index++, 2, '0', STR_PAD_LEFT) ?></span>
                <h3 class="text-xl font-medium mt-4 mb-3"><?= $item->title() ?></h3>
                <p class="text-sm text-[var(--text-muted)] leading-relaxed"><?= $item->description() ?></p>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>

<section class="py-24 border-t border-white/10 mb-20">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
        <div class="md:col-span-4">
            <h2 class="serif-display text-4xl"><?= $page->experience_headline()->or('Experience') ?></h2>
        </div>
        <div class="md:col-span-8">
            <div class="space-y-0">
                <?php foreach($page->experience()->toStructure() as $job): ?>
                <div class="group flex justify-between items-center py-8 border-b border-white/5 hover:border-[var(--accent)] transition-colors">
                    <div>
                        <h4 class="text-xl font-medium"><?= $job->role() ?></h4>
                        <p class="text-sm text-[var(--text-muted)] mt-1"><?= $job->company() ?></p>
                    </div>
                    <span class="text-sm text-[var(--text-muted)] font-mono"><?= $job->timeline() ?></span>
                </div>
                <?php endforeach ?>
            </div>
            <!-- Client section hidden per user request, but structure remains in template history if needed -->
        </div>
    </div>
</section>

<?php snippet('footer') ?>
