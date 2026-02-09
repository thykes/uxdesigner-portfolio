<?php snippet('header') ?>

<article>
    <!-- Project Hero -->
    <section class="pt-20 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end">
            <div class="lg:col-span-8">
                <?php if ($page->subtitle()->isNotEmpty()): ?>
                    <span
                        class="block text-sm font-bold text-[var(--accent)] uppercase tracking-[0.2em] mb-8"><?= $page->subtitle()->html() ?></span>
                <?php endif ?>
                <h1 class="serif-display text-7xl md:text-8xl lg:text-9xl leading-tight">
                    <?= $page->hero_title()->isNotEmpty() ? $page->hero_title()->kti() : $page->title()->html() ?>
                </h1>
                <?php if ($page->intro()->isNotEmpty()): ?>
                    <p class="mt-14 text-2xl md:text-3xl text-[var(--text-main)] max-w-4xl font-light leading-[1.8]">
                        <?= $page->intro()->html() ?>
                    </p>
                <?php endif ?>
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

    <!-- Case Study Content Blocks -->
    <section class="mb-32">
        <div class="portfolio-content space-y-24">
            <?= $page->text()->toBlocks() ?>
        </div>
    </section>

    <!-- Next Project -->
    <?php if ($next = $page->nextListed()): ?>
        <section class="py-32 border-t border-white/10 flex flex-col items-center">
            <span class="sub-header-caps mb-8 text-xs uppercase tracking-widest text-[var(--text-muted)]">Next
                Project</span>
            <a href="<?= $next->url() ?>" class="group">
                <h3
                    class="serif-display text-6xl md:text-8xl group-hover:text-[var(--accent)] transition-all cursor-pointer">
                    <?= $next->title() ?>
                </h3>
            </a>
        </section>
    <?php endif ?>

</article>

<?php snippet('footer') ?>