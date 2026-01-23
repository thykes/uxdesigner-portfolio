<?php snippet('header') ?>

<main class="flex flex-col items-center">
    <!-- Hero / Header Section -->
    <div class="w-full max-w-[1200px] px-6 lg:px-20 pt-12 pb-16">
        <!-- Main Video/Image Display -->
        <!-- Main Video/Image Display -->
        <?php if ($page->hero_type()->value() == 'video_local' && ($video = $page->hero_video_file()->toFile())): ?>
            <div class="relative w-full aspect-video rounded-3xl overflow-hidden bg-[var(--charcoal)] shadow-2xl mb-16">
                 <video class="w-full h-full object-cover" autoplay muted loop playsinline poster="<?= $page->cover()->toFile() ? $page->cover()->toFile()->url() : '' ?>">
                    <source src="<?= $video->url() ?>" type="<?= $video->mime() ?>">
                </video>
            </div>
        <?php elseif ($page->hero_type()->value() == 'video_external' && $page->hero_video_url()->isNotEmpty()): ?>
             <div class="relative w-full aspect-video rounded-3xl overflow-hidden bg-[var(--charcoal)] shadow-2xl mb-16">
                <?= video($page->hero_video_url()) ?>
             </div>
        <?php elseif ($image = $page->cover()->toFile()): ?>
            <div class="relative w-full aspect-video rounded-3xl overflow-hidden bg-[var(--charcoal)] shadow-2xl group cursor-pointer mb-16">
                <img 
                    src="<?= $image->resize(1200)->url() ?>" 
                    srcset="<?= $image->srcset([800, 1200, 1600, 2000]) ?>" 
                    sizes="(min-width: 1200px) 1200px, 90vw"
                    alt="<?= $image->alt()->or($page->title()) ?>" 
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                >
            </div>
        <?php endif ?>

        <div class="flex flex-col items-center text-center">
            <p class="text-[var(--accent)] text-xs font-bold uppercase tracking-[0.4em] mb-8">
                <?= $page->category()->or('Article') ?> • <?= $page->date()->toDate('M d, Y') ?> • <?= $page->readTime() ?>
            </p>
            <h1 class="serif-display text-5xl md:text-7xl lg:text-8xl leading-[1.1] max-w-5xl text-white">
                <?= $page->title() ?>
            </h1>
            <div class="w-16 h-[1px] bg-[var(--accent)]/40 mt-12 mb-4"></div>
            <p class="text-[var(--text-muted)] text-sm uppercase tracking-widest">Written by Tim Hykes</p>
        </div>
    </div>

    <!-- Article Content -->
    <article class="max-w-[720px] px-6 w-full py-12">
        <div class="text-lg md:text-xl text-[var(--text-muted)] leading-[1.8] space-y-10 font-light">
            <?php if ($page->intro()->isNotEmpty()): ?>
            <p class="text-white/90 text-2xl italic leading-relaxed font-['Lora']">
                <?= $page->intro() ?>
            </p>
            <?php endif ?>

            <!-- Render Blocks -->
            <div class="prose prose-invert prose-lg max-w-none font-['Lora'] leading-[1.8] text-[var(--text-muted)] prose-headings:text-white prose-strong:text-white [&_p]:mb-8 [&_p]:leading-[1.8] [&_a]:text-white [&_a]:underline [&_a]:decoration-[var(--accent)] [&_a]:decoration-2 [&_a]:underline-offset-4 [&_h1]:!font-['Playfair_Display'] [&_h2]:!font-['Playfair_Display'] [&_h3]:!font-['Playfair_Display'] [&_h4]:!font-['Playfair_Display'] [&_h2]:mt-20 [&_h2]:mb-6 [&_h2]:!text-4xl [&_h2]:!text-white [&_h3]:mt-16 [&_h3]:mb-6 [&_h3]:!text-white [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:mb-8 [&_ol]:list-decimal [&_ol]:pl-5 [&_ol]:mb-8 [&_li]:mb-2 [&_li]:pl-2 [&_li::marker]:text-[var(--accent)]">
                <?= $page->text()->toBlocks() ?>
            </div>
        
            <!-- Tags -->
            <div class="mt-24 pt-12 border-t border-white/5 flex flex-wrap gap-4">
                <?php foreach($page->category()->split(',') as $tag): ?>
                <span class="px-5 py-2 bg-[var(--charcoal)] rounded-full text-[10px] font-bold text-white/40 hover:text-[var(--accent)] hover:border-[var(--accent)]/30 border border-white/5 uppercase tracking-widest transition-all">#<?= trim($tag) ?></span>
                <?php endforeach ?>
            </div>
        </div>
    </article>

    <!-- Up Next Section -->
    <?php if ($next = $page->nextListed()): ?>
    <section class="w-full bg-[var(--charcoal)]/30 border-t border-white/5 mt-20 py-32 px-6 lg:px-40">
        <div class="max-w-[1200px] mx-auto">
            <div class="flex items-center gap-6 mb-16">
                <span class="text-[var(--accent)] text-xs font-bold uppercase tracking-[0.4em]">Up Next</span>
                <div class="h-[1px] flex-1 bg-white/5"></div>
            </div>
            <a class="group block relative" href="<?= $next->url() ?>">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-12">
                    <div class="flex-1">
                        <p class="text-[var(--text-muted)] text-xs font-bold uppercase tracking-widest mb-6">Article • <?= $next->read_time() ?></p>
                        <h3 class="serif-display text-4xl md:text-7xl text-white group-hover:text-[var(--accent)] transition-colors duration-500 leading-tight">
                            <?= $next->title() ?>
                        </h3>
                    </div>
                    <div class="size-24 md:size-32 rounded-full border border-white/10 flex items-center justify-center group-hover:border-[var(--accent)] group-hover:bg-[var(--accent)] transition-all duration-700">
                        <span class="material-symbols-outlined text-4xl md:text-5xl group-hover:text-black group-hover:scale-110 transition-transform">north_east</span>
                    </div>
                </div>
            </a>
        </div>
    </section>
    <?php endif ?>

</main>

<?php snippet('footer') ?>
