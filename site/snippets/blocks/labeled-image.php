<?php
// Labeled Image Block
$image = $block->image()->toFile();
?>
<?php if ($image): ?>
<figure class="relative group my-8">
    <div class="relative overflow-hidden bg-[var(--charcoal)] aspect-video md:aspect-[4/3] w-full">
        <img src="<?= $image->resize(1200)->url() ?>" 
             alt="<?= $image->alt() ?>"
             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
             loading="lazy">
             
        <?php if ($block->label()->isNotEmpty()): ?>
        <div class="absolute top-4 left-4">
             <span class="bg-black/80 backdrop-blur-sm text-white text-[10px] uppercase tracking-widest px-3 py-1.5 font-bold border border-white/10">
                 <?= $block->label() ?>
             </span>
        </div>
        <?php endif ?>
    </div>
    
    <?php if ($block->caption()->isNotEmpty()): ?>
    <figcaption class="mt-3 text-[10px] uppercase tracking-widest text-[var(--text-muted)] text-center md:text-left">
        <?= $block->caption() ?>
    </figcaption>
    <?php endif ?>
</figure>
<?php endif ?>
