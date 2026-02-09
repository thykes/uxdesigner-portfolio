</main>
<footer class="py-16 border-t border-white/10">
    <div class="flex flex-col md:flex-row justify-between items-center gap-12">
        <div class="text-center md:text-left">
            <h2 class="serif-display text-4xl mb-4">Let's create together.</h2>
            <a class="text-[var(--accent)] text-lg hover:underline underline-offset-8"
                href="mailto:tim@timhykes.com">tim@timhykes.com</a>
        </div>
        <div class="flex flex-col items-center md:items-end gap-6">
            <div class="flex space-x-6">
                <?php
                $socialMap = [
                    'instagram' => 'fa-brands fa-instagram',
                    'linkedin' => 'fa-brands fa-linkedin',
                    'youtube' => 'fa-brands fa-youtube',
                    'threads' => 'fa-brands fa-threads',
                    'bluesky' => 'fa-brands fa-bluesky',
                    'twitter' => 'fa-brands fa-x-twitter',
                    'github' => 'fa-brands fa-github'
                ];
                foreach ($site->social_links()->toStructure() as $social):
                    $platform = $social->platform()->value();
                    $iconClass = $socialMap[$platform] ?? 'fa-solid fa-link';
                    ?>
                    <a class="text-[var(--text-muted)] hover:text-white transition-colors" href="<?= $social->url() ?>"
                        target="_blank" rel="noopener noreferrer">
                        <i class="<?= $iconClass ?> text-xl"></i>
                    </a>
                <?php endforeach ?>
            </div>
            <p class="text-[10px] uppercase tracking-widest text-[var(--text-muted)] opacity-50">© <?= date('Y') ?>
                <?= $site->title() ?>. All rights reserved.</p>
        </div>
    </div>
</footer>
</div>

<!-- Global Lightbox Overlay -->
<div id="lightbox" aria-hidden="true">
    <div id="lightbox-close">
        <span class="material-symbols-outlined">close</span>
    </div>
    <img id="lightbox-img" src="" alt="Galllery Image View">
    <div id="lightbox-caption"></div>
</div>

<script>
    // Lightbox Logic
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxClose = document.getElementById('lightbox-close');

    // Close on X click
    lightboxClose.onclick = () => {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    };

    // Close on background click
    lightbox.onclick = (e) => {
        if (e.target === lightbox) {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }
    };

    // Close on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightbox.classList.contains('active')) {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Global trigger for any data-lightbox element
    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('[data-lightbox]');
        if (trigger) {
            e.preventDefault();
            const src = trigger.getAttribute('data-lightbox');
            const caption = trigger.getAttribute('data-caption') || '';

            lightboxImg.src = src;
            lightboxCaption.textContent = caption;
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    });
</script>
</body>

</html>