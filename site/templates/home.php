<?php snippet('header') ?>

<section class="py-24 md:py-32">
    <h1 class="serif-display text-5xl sm:text-7xl md:text-8xl lg:text-9xl leading-[1.1] tracking-tight max-w-5xl [&_em]:text-[var(--accent)]">
        <?= $page->headline()->or('Designing with <span class="italic text-[var(--accent)]">purpose</span>. Building for people.') ?>
    </h1>
    <div class="mt-12 flex flex-col md:flex-row md:items-end justify-between gap-8">
        <div class="text-xl md:text-2xl text-[var(--text-muted)] max-w-xl font-light leading-relaxed [&_strong]:!text-white [&_strong]:!font-normal [&_b]:!text-white [&_b]:!font-normal">
            <?= $page->intro()->or('I’m Tim Hykes, a DC UX Designer turning <span class="text-white font-normal">complex challenges</span> into seamless, <span class="text-white font-normal">human-centered</span><br> digital experiences.') ?>
        </div>
        <div class="flex items-center gap-4 group cursor-pointer">
            <span class="text-sm uppercase tracking-[0.2em]"><?= $page->scroll_label()->or('Scroll to explore') ?></span>
            <span class="material-symbols-outlined animate-bounce">arrow_downward</span>
        </div>
    </div>
</section>

<section class="mb-16">
    <div class="flex flex-wrap gap-x-8 gap-y-4 text-xs uppercase tracking-widest text-[var(--text-muted)] border-b border-white/10 pb-6">
        <a class="filter-link active" href="#">All Projects</a>
        <!-- Dynamic filters could go here -->
    </div>
</section>

<section class="pb-32">
<div class="masonry-grid w-full">
        <?php 
        $projects = $page->featured_projects()->toPages();
        if ($projects->isEmpty()) {
            $projects = site()->find('works')->children()->listed();
        }
        $i = 0;
        ?>

        <?php foreach ($projects as $project): ?>
        <?php
            // Masonry Logic
            // Row Pattern: Large + Small (offset), then Small + Large (offset)
            $row = floor($i / 2);
            $isFirstInRow = ($i % 2 == 0);
            
            if ($row % 2 == 0) {
                // Even Rows (0, 2, 4...)
                $itemClass = $isFirstInRow ? 'item-large' : 'item-small md:mt-32';
            } else {
                // Odd Rows (1, 3, 5...)
                $itemClass = $isFirstInRow ? 'item-small' : 'item-large md:mt-32';
            }
            $i++;
        ?>
        <div class="<?= $itemClass ?> group w-full">
            <a href="<?= $project->url() ?>" class="block">
                <div class="relative overflow-hidden bg-[var(--charcoal)] aspect-[4/5] md:aspect-[16/10] rounded-3xl">
                    <?php if ($image = $project->cover()->toFile()): ?>
                    <img alt="<?= $image->alt() ?>" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110 grayscale group-hover:grayscale-0" src="<?= $image->url() ?>"/>
                    <?php endif ?>
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                <div class="mt-6 flex justify-between items-start">
                    <div>
                        <h3 class="serif-display text-3xl md:text-4xl group-hover:text-[var(--accent)] transition-colors"><?= $project->title() ?></h3>
                        <p class="text-xs uppercase tracking-widest text-[var(--text-muted)] mt-2">
                            <?= $project->subtitle()->or('Case Study') ?><?= $project->timeline()->isNotEmpty() ? ' / ' . $project->timeline() : '' ?>
                        </p>
                    </div>
                    <span class="material-symbols-outlined text-3xl opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all text-[var(--accent)]">north_east</span>
                </div>
            </a>
        </div>
        <?php endforeach ?>
    </div>
</section>

<?php snippet('footer') ?>
