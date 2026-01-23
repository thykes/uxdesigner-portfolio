<?php snippet('header') ?>

<article>
<!-- Project Hero -->
<section class="pt-20 pb-24">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end">
        <div class="lg:col-span-8">
            <span class="block text-sm font-bold text-[var(--accent)] uppercase tracking-[0.2em] mb-8"><?= $page->subtitle()->or('Elite UX Case Study') ?></span>
            <h1 class="serif-display text-7xl md:text-8xl lg:text-9xl leading-tight">
                <?= $page->hero_title()->isNotEmpty() ? $page->hero_title()->kti() : $page->title()->html() ?>
            </h1>
            <p class="mt-14 text-2xl md:text-3xl text-[var(--text-main)] max-w-4xl font-light leading-[1.8]">
                <?= $page->intro()->html() ?>
            </p>
        </div>
        <div class="lg:col-span-4 flex flex-col gap-10 pb-4">
            <?php if ($page->role()->isNotEmpty()): ?>
            <div class="border-l border-white/20 pl-6">
                <span class="text-xs uppercase tracking-widest text-[var(--text-muted)]">Role</span>
                <p class="font-medium mt-2"><?= $page->role() ?></p>
            </div>
            <?php endif ?>
            
            <?php if ($page->timeline()->isNotEmpty()): ?>
            <div class="border-l border-white/20 pl-6">
                <span class="text-xs uppercase tracking-widest text-[var(--text-muted)]">Timeline</span>
                <p class="font-medium mt-2"><?= $page->timeline() ?></p>
            </div>
            <?php endif ?>
        </div>
    </div>
</section>

<!-- Stats Grid -->
<?php if ($page->stats()->isNotEmpty()): ?>
<section class="mb-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border-y border-white/10">
        <?php foreach ($page->stats()->toStructure() as $stat): ?>
        <div class="p-12 md:first:border-r md:last:border-none border-white/10 flex flex-col justify-center relative [&:nth-child(2)]:border-r">
            <span class="block text-sm font-bold text-[var(--accent)] uppercase tracking-[0.2em] mb-4"><?= $stat->label() ?></span>
            <h2 class="text-6xl md:text-7xl font-black text-white mb-6 tracking-tighter"><?= $stat->value() ?></h2>
            <p class="text-sm text-[var(--accent)] uppercase tracking-wider font-semibold"><?= $stat->description() ?></p>
        </div>
        <?php endforeach ?>
    </div>
</section>
<?php endif ?>

<!-- Flexible Layout Canvas -->
<?php if ($page->modules()->isNotEmpty()): ?>
<section class="mb-32">
    <?php foreach ($page->modules()->toLayouts() as $layout): ?>
    <div class="grid grid-cols-1 md:grid-cols-<?= $layout->columns()->count() ?> gap-12 mb-24" id="<?= $layout->id() ?>">
        <?php foreach ($layout->columns() as $column): ?>
        <div class="column" style="--span:<?= $column->span() ?>">
            <div class="blocks">
                <?= $column->blocks() ?>
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <?php endforeach ?>
</section>
<?php endif ?>

<!-- Hero Image (Legacy/Optional) -->
<?php if ($image = $page->cover()->toFile()): ?>
<section class="mb-32">
    <div class="aspect-[21/7] w-full bg-[var(--charcoal)] relative overflow-hidden group">
        <img alt="<?= $image->alt() ?>" class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-1000" src="<?= $image->url() ?>"/>
        <div class="absolute inset-0 flex items-center justify-center bg-black/40">
            <div class="text-center px-6">
                <h3 class="serif-display text-5xl md:text-7xl text-white">Visualizing <span class="italic">ROI</span></h3>
                <p class="text-[var(--accent)] tracking-[0.5em] uppercase text-xs mt-6 font-bold">Design that performs under pressure</p>
            </div>
        </div>
    </div>
</section>
<?php endif ?>

<!-- Legacy Hardcoded Sections (Only show if fields are populated AND Modules are empty to avoid duplication) -->
<?php if ($page->challenge_text()->isNotEmpty() && $page->modules()->isEmpty()): ?>
<!-- Challenge Section -->
<section class="mb-32">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-start">
        <div class="relative">
            <?php if ($image = $page->challenge_image()->toFile()): ?>
            <div class="aspect-[4/5] overflow-hidden bg-[var(--charcoal)]">
                <img alt="<?= $image->alt() ?>" class="w-full h-full object-cover grayscale" src="<?= $image->url() ?>"/>
            </div>
            <p class="mt-6 text-[10px] uppercase tracking-widest text-[var(--text-muted)]"><?= $image->caption() ?></p>
            <?php endif ?>
        </div>
        <div class="pt-10">
            <h3 class="serif-display text-5xl md:text-6xl mb-10">The <span class="italic">Challenge</span></h3>
            <p class="text-[var(--text-muted)] text-xl leading-relaxed mb-12">
                <?= $page->challenge_text()->kt() ?>
            </p>
            
            <?php if ($page->challenge_points()->isNotEmpty()): ?>
            <div class="space-y-10">
                <?php foreach ($page->challenge_points()->toStructure() as $point): ?>
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
<?php endif ?>

<?php if ($page->strategy_intro()->isNotEmpty() && $page->modules()->isEmpty()): ?>
<div class="section-divider mb-32"></div>

<!-- Strategic Intervention -->
<section class="mb-32">
    <div class="max-w-4xl mb-24">
        <span class="sub-header-caps mb-6 block">Strategic Intervention</span>
        <h3 class="serif-display text-5xl md:text-7xl mb-10">Engineering <span class="italic text-[var(--accent)]">Elegance</span></h3>
        <p class="text-[var(--text-muted)] text-2xl leading-[1.8] font-light">
            <?= $page->strategy_intro()->kt() ?>
        </p>
    </div>

    <!-- Blocks Field for Dynamic Content -->
    <div class="portfolio-content space-y-24">
        <?= $page->text()->toBlocks() ?>
    </div>
</section>
<?php endif ?>

<!-- Alternative Paths (Rejected Concepts) -->
<?php if ($page->alternative_paths()->isNotEmpty()): ?>
<section class="mb-32">
    <span class="sub-header-caps mb-12 block">Alternative Paths</span>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <?php foreach ($page->alternative_paths()->toStructure() as $concept): ?>
        <div class="p-10 border border-white/10 hover:border-[var(--accent)]/30 transition-colors">
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-white/40 text-sm">close</span>
                <h4 class="uppercase tracking-[0.2em] text-[10px] font-bold text-white/60"><?= $concept->concept() ?></h4>
            </div>
            <p class="text-sm text-[var(--text-muted)] mb-8 leading-relaxed"><?= $concept->description() ?></p>
            <div class="pt-6 border-t border-white/5">
                <span class="text-[10px] uppercase text-[var(--accent)] font-bold block mb-2">Outcome</span>
                <p class="text-xs text-white/80 leading-relaxed italic"><?= $concept->outcome() ?></p>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</section>
<?php endif ?>

<!-- Inclusion & Accessibility -->
<?php if ($page->inclusion_points()->isNotEmpty()): ?>
<section class="mb-40">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <div class="lg:col-span-5">
            <span class="sub-header-caps mb-6 block">Inclusion Standards</span>
            <h3 class="serif-display text-5xl mb-8">Accessibility <br/><span class="italic">&amp; Compliance</span></h3>
            <p class="text-[var(--text-muted)] text-lg leading-relaxed max-w-md">
                <?= $page->inclusion_intro()->or("Luxury is for everyone. We ensured the dark theme wasn't just aesthetic, but compliant with global accessibility standards.") ?>
            </p>
        </div>
        <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-12 pt-4">
            <?php foreach ($page->inclusion_points()->toStructure() as $point): ?>
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-[var(--accent)]"><?= $point->icon() ?></span>
                    <span class="badge-aa"><?= $point->badge() ?></span>
                </div>
                <h4 class="font-bold text-sm uppercase tracking-widest text-white"><?= $point->title() ?></h4>
                <p class="text-xs text-[var(--text-muted)] leading-[1.8]"><?= $point->description() ?></p>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<?php endif ?>

<!-- Alternative Paths (Rejected Concepts) -->
<?php if ($page->alternative_paths()->isNotEmpty()): ?>
<section class="mb-32">
    <span class="sub-header-caps mb-12 block">Alternative Paths</span>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <?php foreach ($page->alternative_paths()->toStructure() as $concept): ?>
        <div class="p-10 border border-white/10 hover:border-[var(--accent)]/30 transition-colors">
            <div class="flex items-center gap-3 mb-6">
                <span class="material-symbols-outlined text-white/40 text-sm">close</span>
                <h4 class="uppercase tracking-[0.2em] text-[10px] font-bold text-white/60"><?= $concept->concept() ?></h4>
            </div>
            <p class="text-sm text-[var(--text-muted)] mb-8 leading-relaxed"><?= $concept->description() ?></p>
            <div class="pt-6 border-t border-white/5">
                <span class="text-[10px] uppercase text-[var(--accent)] font-bold block mb-2">Outcome</span>
                <p class="text-xs text-white/80 leading-relaxed italic"><?= $concept->outcome() ?></p>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</section>
<?php endif ?>

<!-- Inclusion & Accessibility -->
<?php if ($page->inclusion_points()->isNotEmpty()): ?>
<section class="mb-40">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <div class="lg:col-span-5">
            <span class="sub-header-caps mb-6 block">Inclusion Standards</span>
            <h3 class="serif-display text-5xl mb-8">Accessibility <br/><span class="italic">&amp; Compliance</span></h3>
            <p class="text-[var(--text-muted)] text-lg leading-relaxed max-w-md">
                <?= $page->inclusion_intro()->or("Luxury is for everyone. We ensured the dark theme wasn't just aesthetic, but compliant with global accessibility standards.") ?>
            </p>
        </div>
        <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-12 pt-4">
            <?php foreach ($page->inclusion_points()->toStructure() as $point): ?>
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-[var(--accent)]"><?= $point->icon() ?></span>
                    <span class="badge-aa"><?= $point->badge() ?></span>
                </div>
                <h4 class="font-bold text-sm uppercase tracking-widest text-white"><?= $point->title() ?></h4>
                <p class="text-xs text-[var(--text-muted)] leading-[1.8]"><?= $point->description() ?></p>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<?php endif ?>

<!-- Final Impact -->
<section class="mb-48 max-w-5xl mx-auto text-center">
    <span class="sub-header-caps mb-10 block">Final Impact</span>
    <h3 class="serif-display text-5xl md:text-8xl mb-12">Performance meets <span class="italic">Prestige</span></h3>
    <p class="text-[var(--text-muted)] text-2xl leading-[1.8] mb-16 font-light">
        <?= $page->outcome_text()->kt() ?>
    </p>
    <?php if ($pdf = $page->case_study_pdf()->toFile()): ?>
    <a href="<?= $pdf->url() ?>" target="_blank" class="inline-flex items-center gap-6 py-6 px-12 border border-white/20 rounded-full hover:bg-[var(--accent)] hover:text-black hover:border-[var(--accent)] transition-all duration-300 cursor-pointer group">
        <span class="font-bold uppercase tracking-widest text-xs">Download Full Case Study</span>
        <span class="material-symbols-outlined group-hover:translate-y-1 transition-transform">download</span>
    </a>
    <?php endif ?>
</section>

<!-- Next Project -->
<?php if ($next = $page->nextListed()): ?>
<section class="py-32 border-t border-white/10 flex flex-col items-center">
    <span class="sub-header-caps mb-8">Next Narrative</span>
    <a href="<?= $next->url() ?>">
        <h3 class="serif-display text-6xl md:text-8xl hover:text-[var(--accent)] transition-all cursor-pointer">
            <?= $next->title() ?>
        </h3>
    </a>
</section>
<?php endif ?>

</article>

<?php snippet('footer') ?>
