<blockquote class="py-16 px-10 my-20 bg-[var(--accent)] rounded-[2rem] relative overflow-hidden">
    <div class="relative z-10">
        <p class="serif-display italic text-3xl md:text-4xl text-black leading-[1.15]">
            "<?= $block->text() ?>"
        </p>
        <?php if ($block->citation()->isNotEmpty()): ?>
        <cite class="block mt-10 text-xs font-black uppercase tracking-widest text-black/60">— <?= $block->citation() ?></cite>
        <?php endif ?>
    </div>
    <div class="absolute -right-10 -top-10 size-40 bg-white/10 rounded-full blur-3xl"></div>
</blockquote>
