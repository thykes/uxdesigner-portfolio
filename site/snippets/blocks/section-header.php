<?php
// Section Header Block
?>
<div class="mb-12">
    <?php if ($block->label()->isNotEmpty()): ?>
    <span class="sub-header-caps mb-6 block"><?= $block->label() ?></span>
    <?php endif ?>
    
    <?php if ($block->title()->isNotEmpty()): ?>
    <h3 class="serif-display text-5xl md:text-7xl mb-10 leading-tight">
        <?= $block->title()->kti() ?>
    </h3>
    <?php endif ?>
    
    <?php if ($block->description()->isNotEmpty()): ?>
    <div class="text-[var(--text-muted)] text-xl md:text-2xl leading-[1.8] font-light max-w-4xl">
        <?= $block->description()->kt() ?>
    </div>
    <?php endif ?>
</div>
