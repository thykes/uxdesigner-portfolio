<?php
// Pull Quote Block
?>
<div class="my-16 <?= $block->style() == 'centered' ? 'text-center max-w-4xl mx-auto' : 'border-l-[4px] border-[var(--accent)] pl-8 md:pl-12' ?>">
    <blockquote class="serif-display text-3xl md:text-4xl lg:text-5xl italic leading-tight text-white mb-6">
        "<?= $block->quote() ?>"
    </blockquote>
    
    <?php if ($block->citation()->isNotEmpty()): ?>
    <cite class="block font-sans text-xs uppercase tracking-widest text-[var(--accent)] font-bold not-italic">
        — <?= $block->citation() ?>
    </cite>
    <?php endif ?>
</div>
