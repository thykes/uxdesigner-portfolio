<?php snippet('header') ?>

<section class="pt-20 pb-12">
    <h1 class="serif-display text-6xl md:text-8xl lg:text-9xl leading-none">Selected <span class="italic text-[var(--accent)]">Works</span></h1>
    <p class="mt-8 text-xl md:text-2xl text-[var(--text-muted)] max-w-2xl font-light leading-relaxed">
        A curated selection of projects spanning branding, digital design, and photography.
    </p>
</section>

<section class="mb-20">
    <div class="flex flex-wrap gap-x-10 gap-y-6 text-xs uppercase tracking-[0.2em] font-semibold text-[var(--text-muted)] border-b border-white/10 pb-8">
        <a class="filter-link active" href="#">All Projects</a>
        <!-- Dynamic filters could go here -->
    </div>
</section>

<section class="pb-32">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-12 gap-y-24">
        <?php foreach ($page->children()->listed() as $project): ?>
        <div class="project-card group cursor-pointer">
            <a href="<?= $project->url() ?>" class="block">
                <div class="relative overflow-hidden bg-[var(--charcoal)] aspect-[4/3] rounded-3xl">
                    <?php if ($image = $project->cover()->toFile()): ?>
                    <img alt="<?= $image->alt() ?>" class="project-image w-full h-full object-cover transition-transform duration-1000 ease-out" src="<?= $image->url() ?>"/>
                    <?php endif ?>
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                        <span class="material-symbols-outlined text-5xl text-[var(--accent)]">add</span>
                    </div>
                </div>
                <div class="mt-8">
                    <h3 class="serif-display text-3xl md:text-4xl group-hover:text-[var(--accent)] transition-colors"><?= $project->title() ?></h3>
                    <p class="text-xs uppercase tracking-widest text-[var(--text-muted)] mt-3">
                        <?= $project->subtitle()->or('Project') ?><?= $project->timeline()->isNotEmpty() ? ' / ' . $project->timeline() : '' ?>
                    </p>
                </div>
            </a>
        </div>
        <?php endforeach ?>
    </div>
</section>

<?php snippet('footer') ?>
