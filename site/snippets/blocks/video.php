<div class="my-20">
    <div class="relative w-full aspect-video rounded-3xl overflow-hidden bg-[var(--charcoal)] shadow-xl border border-white/5 group">
        <?php if ($block->source()->value() == 'file' && ($file = $block->file()->toFile())): ?>
        <video class="w-full h-full object-cover" controls playsinline>
            <source src="<?= $file->url() ?>" type="<?= $file->mime() ?>">
        </video>
        <?php elseif ($block->url()->isNotEmpty()): ?>
        <div class="absolute inset-0 w-full h-full [&_iframe]:w-full [&_iframe]:h-full">
            <?= video($block->url()) ?>
        </div>
        <?php endif ?>
    </div>
    <?php if ($block->caption()->isNotEmpty()): ?>
    <p class="mt-4 text-center text-sm text-[var(--text-muted)] uppercase tracking-widest font-sans">
        <?= $block->caption() ?>
    </p>
    <?php endif ?>

    <!-- Video Object Schema -->
    <?php
    $videoSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'VideoObject',
        'name' => $block->video_title()->isNotEmpty() ? $block->video_title()->value() : ($block->caption()->isNotEmpty() ? $block->caption()->value() : 'Video'),
        'description' => $block->video_description()->isNotEmpty() ? $block->video_description()->value() : ($block->caption()->isNotEmpty() ? $block->caption()->value() : 'A video from ' . $site->title()),
        'uploadDate' => $block->upload_date()->toDate('c'),
        'thumbnailUrl' => [] // Will populate below
    ];

    if ($block->source()->value() == 'file' && ($file = $block->file()->toFile())) {
        $videoSchema['contentUrl'] = $file->url();
        $videoSchema['thumbnailUrl'][] = $file->resize(1200)->url(); // Generate a frame if possible or use a cover
        
        // Enhance with file-level metadata if available (requires custom file blueprint)
        if ($file->video_title()->isNotEmpty()) $videoSchema['name'] = $file->video_title()->value();
        if ($file->duration()->isNotEmpty()) $videoSchema['duration'] = $file->duration()->value(); 
        
    } elseif ($block->url()->isNotEmpty()) {
        $videoSchema['embedUrl'] = $block->url()->value();
        // For external videos, we ideally need a thumbnail. 
        // Kirby's video() helper doesn't give us metadata easily in PHP context without parsing.
        // We defer to the page cover or site SEO image as a fallback thumbnail.
         $videoSchema['thumbnailUrl'][] = $page->cover()->toFile() ? $page->cover()->toFile()->url() : ($site->ogImage()->toFile() ? $site->ogImage()->toFile()->url() : '');
    }
    ?>
    <script type="application/ld+json">
    <?= json_encode($videoSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
    </script>
</div>
