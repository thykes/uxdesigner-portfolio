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
                <?= $site->title() ?>. All rights reserved.
            </p>
        </div>
    </div>
</footer>
</div>

<!-- Global Lightbox Overlay -->
<div id="lightbox" aria-hidden="true">
    <div id="lightbox-close">
        <span class="material-symbols-outlined">close</span>
    </div>

    <!-- Navigation Arrows -->
    <button id="lightbox-prev"
        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 backdrop-blur-sm w-14 h-14 rounded-full flex items-center justify-center transition-all opacity-0 pointer-events-none"
        aria-label="Previous image">
        <span class="material-symbols-outlined text-white text-3xl">chevron_left</span>
    </button>

    <button id="lightbox-next"
        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 backdrop-blur-sm w-14 h-14 rounded-full flex items-center justify-center transition-all opacity-0 pointer-events-none"
        aria-label="Next image">
        <span class="material-symbols-outlined text-white text-3xl">chevron_right</span>
    </button>

    <img id="lightbox-img" src="" alt="Gallery Image View">
    <div id="lightbox-caption"></div>
</div>

<script>
    // Lightbox Logic with Gallery Navigation
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');

    let currentGallery = null;
    let currentIndex = 0;
    let galleryImages = [];

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
        currentGallery = null;
        currentIndex = 0;
        galleryImages = [];
        lightboxPrev.style.opacity = '0';
        lightboxPrev.style.pointerEvents = 'none';
        lightboxNext.style.opacity = '0';
        lightboxNext.style.pointerEvents = 'none';
    }

    function showImage(index) {
        if (!galleryImages.length) return;
        
        currentIndex = index;
        const imageData = galleryImages[currentIndex];
        
        lightboxImg.src = imageData.src;
        lightboxCaption.textContent = imageData.caption || '';
        
        // Show/hide navigation arrows based on position
        if (galleryImages.length > 1) {
            lightboxPrev.style.opacity = currentIndex > 0 ? '1' : '0.5';
            lightboxPrev.style.pointerEvents = currentIndex > 0 ? 'auto' : 'none';
            
            lightboxNext.style.opacity = currentIndex < galleryImages.length - 1 ? '1' : '0.5';
            lightboxNext.style.pointerEvents = currentIndex < galleryImages.length - 1 ? 'auto' : 'none';
        }
    }

    function navigatePrev() {
        if (currentIndex > 0) {
            showImage(currentIndex - 1);
        }
    }

    function navigateNext() {
        if (currentIndex < galleryImages.length - 1) {
            showImage(currentIndex + 1);
        }
    }

    // Close on X click
    lightboxClose.onclick = closeLightbox;

    // Close on background click
    lightbox.onclick = (e) => {
        if (e.target === lightbox) {
            closeLightbox();
        }
    };

    // Navigation button  clicks
    lightboxPrev.onclick = (e) => {
        e.stopPropagation();
        navigatePrev();
    };

    lightboxNext.onclick = (e) => {
        e.stopPropagation();
        navigateNext();
    };

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('active')) return;
        
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            navigatePrev();
        } else if (e.key === 'ArrowRight') {
            navigateNext();
        }
    });

    // Global trigger for any data-lightbox element
    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('[data-lightbox]');
        if (trigger) {
            e.preventDefault();
            
            const galleryId = trigger.getAttribute('data-gallery');
            const index = parseInt(trigger.getAttribute('data-index') || '0');
            
            // If part of a gallery, collect all images in that gallery
            if (galleryId) {
                currentGallery = galleryId;
                galleryImages = Array.from(document.querySelectorAll(`[data-gallery="${galleryId}"]`)).map(el => ({
                    src: el.getAttribute('data-lightbox'),
                    caption: el.getAttribute('data-caption') || ''
                }));
            } else {
                // Single image (not part of a gallery)
                galleryImages = [{
                    src: trigger.getAttribute('data-lightbox'),
                    caption: trigger.getAttribute('data-caption') || ''
                }];
            }
            
            showImage(index);
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    });
</script>
</body>

</html>