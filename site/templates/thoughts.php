<?php snippet('header') ?>

<main class="py-16 px-6 lg:px-20 max-w-[1440px] mx-auto min-h-screen">
    <header class="mb-20">
        <h1 class="serif-display text-6xl md:text-8xl lg:text-9xl leading-none mb-6">Thoughts<span class="text-[var(--accent)] italic">.</span></h1>
        <p class="text-[var(--text-muted)] text-sm max-w-md uppercase tracking-[0.2em] leading-relaxed">
            <?= $page->intro()->or('Critical perspectives on the intersection of design, technology, and human experience.') ?>
        </p>
    </header>

    <?php 
    // Logic to get featured and list articles
    $articles = $page->children()->listed();
    
    // THE GATE: Filter out "Scheduled" content for public (non-logged-in) users
    // "Scheduled" = Listed but Date > Now
    // if (!kirby()->user()) {
        $articles = $articles->filter(fn($p) => $p->isLive());
    // }
    
    $articles = $articles->flip();
    
    // Check for a manually featured article first
    $featured = $articles->filterBy('featured', 'true')->first();
    
    // Fallback to the most recent article if no featured one is found
    if (!$featured) {
        $featured = $articles->first();
    }
    
    // The list is everything else
    $list = $featured ? $articles->not($featured) : $articles;
    ?>

    <?php if ($featured): ?>
    <section class="mb-32">
        <a href="<?= $featured->url() ?>" class="group block relative">
            <div class="relative w-full aspect-[21/9] rounded-3xl overflow-hidden bg-[var(--charcoal)] mb-10">
                <?php if ($image = $featured->cover()->toFile()): ?>
                <img 
                    src="<?= $image->resize(1200)->url() ?>" 
                    srcset="<?= $image->srcset([800, 1200, 1600, 2000]) ?>" 
                    sizes="(min-width: 1440px) 1440px, 100vw"
                    alt="<?= $image->alt()->or($featured->title()) ?>" 
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105 opacity-80"
                />
                <?php endif ?>
                <div class="absolute inset-0 bg-gradient-to-t from-[var(--bg-deep)]/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-8 left-8">
                    <span class="bg-[var(--accent)] text-black text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Featured</span>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
                <div class="md:col-span-8">
                    <h2 class="serif-display text-4xl md:text-6xl text-white group-hover:text-[var(--accent)] transition-colors duration-500 leading-tight mb-6">
                        <?= $featured->title() ?>
                    </h2>
                    <p class="text-[var(--text-muted)] text-lg md:text-xl max-w-2xl leading-relaxed">
                        <?= $featured->description()->or($featured->intro()) ?>
                    </p>
                </div>
                <div class="md:col-span-4 md:text-right pt-4">
                    <p class="text-[var(--accent)] text-xs font-bold uppercase tracking-[0.4em] mb-2"><?= $featured->category()->or('Article') ?></p>
                    <p class="text-[var(--text-muted)]/60 text-xs font-bold uppercase tracking-widest"><?= $featured->date()->toDate('M d, Y') ?> • <?= $featured->read_time()->or('5 Min Read') ?></p>
                </div>
            </div>
        </a>
    </section>
    <?php endif ?>

    <?php if ($list->count() > 0): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-24">
        <?php foreach ($list as $article): ?>
        <article class="group">
            <a href="<?= $article->url() ?>" class="block">
                <div class="aspect-video rounded-3xl overflow-hidden bg-[var(--charcoal)] mb-8">
                    <?php if ($image = $article->cover()->toFile()): ?>
                    <img 
                        src="<?= $image->resize(800)->url() ?>" 
                        srcset="<?= $image->srcset([600, 800, 1200]) ?>" 
                        sizes="(min-width: 768px) 50vw, 100vw"
                        alt="<?= $image->alt()->or($article->title()) ?>" 
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-70" 
                    />
                    <?php endif ?>
                </div>
                <div class="flex justify-between items-start mb-4">
                    <span class="text-[var(--accent)] text-[10px] font-bold uppercase tracking-[0.4em]"><?= $article->category()->or('Article') ?></span>
                    <span class="text-[var(--text-muted)]/60 text-[10px] font-bold uppercase tracking-widest"><?= $article->date()->toDate('M d, Y') ?></span>
                </div>
                <h3 class="serif-display text-3xl text-white mb-4 group-hover:text-[var(--accent)] transition-colors duration-300">
                    <?= $article->title() ?>
                </h3>
                <p class="text-[var(--text-muted)] text-sm leading-relaxed max-w-md">
                    <?= $article->description()->or($article->intro()) ?>
                </p>
            </a>
        </article>
        <?php endforeach ?>
    </div>
    <?php endif ?>

    <!-- Newsletter / Footer CTA area from thoughts.html adapted -->
    <!-- Newsletter/CTA Removed to use global footer -->
</main>

<?php snippet('footer') ?>
