<?php
// Technical Callout Block
?>
<div class="bg-white/5 border border-[var(--accent)]/30 border-l-[6px] border-l-[var(--accent)] p-8 my-12 relative overflow-hidden group">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-r from-[var(--accent)]/5 to-transparent pointer-events-none"></div>
    
    <div class="relative z-10 flex flex-col md:flex-row gap-6 items-start">
        <?php if ($block->icon()->isNotEmpty()): ?>
        <div class="shrink-0 text-[var(--accent)]">
            <span class="material-symbols-outlined text-4xl"><?= $block->icon() ?></span>
        </div>
        <?php endif ?>
        
        <div>
            <?php if ($block->title()->isNotEmpty()): ?>
            <h4 class="font-bold uppercase tracking-widest text-sm text-[var(--accent)] mb-3">
                <?= $block->title() ?>
            </h4>
            <?php endif ?>
            
            <div class="text-[var(--text-muted)] leading-relaxed text-sm md:text-base">
                <?= $block->text()->kt() ?>
            </div>
        </div>
    </div>
</div>
