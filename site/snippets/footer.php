        </main>
        <footer class="py-16 border-t border-white/10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-12">
                <div class="text-center md:text-left">
                    <h2 class="serif-display text-4xl mb-4">Let's create together.</h2>
                    <a class="text-[var(--accent)] text-lg hover:underline underline-offset-8" href="mailto:tim@timhykes.com">tim@timhykes.com</a>
                </div>
                <div class="flex flex-col items-center md:items-end gap-6">
                    <div class="flex space-x-6">
                        <?php 
                        $socialMap = [
                            'instagram' => 'fa-brands fa-instagram',
                            'linkedin'  => 'fa-brands fa-linkedin',
                            'youtube'   => 'fa-brands fa-youtube',
                            'threads'   => 'fa-brands fa-threads',
                            'bluesky'   => 'fa-brands fa-bluesky',
                            'twitter'   => 'fa-brands fa-x-twitter',
                            'github'    => 'fa-brands fa-github'
                        ];
                        foreach($site->social_links()->toStructure() as $social): 
                            $platform = $social->platform()->value();
                            $iconClass = $socialMap[$platform] ?? 'fa-solid fa-link';
                        ?>
                        <a class="text-[var(--text-muted)] hover:text-white transition-colors" href="<?= $social->url() ?>" target="_blank" rel="noopener noreferrer">
                            <i class="<?= $iconClass ?> text-xl"></i>
                        </a>
                        <?php endforeach ?>
                    </div>
                    <p class="text-[10px] uppercase tracking-widest text-[var(--text-muted)] opacity-50">© <?= date('Y') ?> <?= $site->title() ?>. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
