<?php snippet('header') ?>

<div class="flex-grow flex flex-col items-center justify-center w-full relative overflow-hidden">
    <!-- Background 404 -->
    <div class="absolute top-[30%] left-1/2 -translate-x-1/2 -translate-y-1/2 text-[40vw] md:text-[35rem] font-bold text-white opacity-[0.03] pointer-events-none select-none leading-none z-0 serif-display">
        404
    </div>

    <!-- Background Decor -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[var(--accent)]/5 rounded-full blur-[100px] pointer-events-none z-0"></div>

    <div class="relative z-10 text-center px-6">
        <h1 class="serif-display italic text-6xl md:text-8xl mb-6 leading-none text-white">
            Lost in the <span class="text-[var(--accent)]">noise.</span>
        </h1>
        <p class="text-lg md:text-xl text-[var(--text-muted)] max-w-lg mx-auto mb-10 font-light leading-relaxed">
            <?= $page->text()->or("The page you are looking for has drifted into the void, or perhaps it never truly existed in this reality.") ?>
        </p>
        
        <a href="<?= $site->url() ?>" class="inline-block px-16 py-5 bg-[var(--accent)] text-black text-sm uppercase tracking-[0.2em] font-bold hover:bg-white transition-all duration-500">
            Return Home
        </a>
    </div>
</div>

<?php snippet('footer') ?>
