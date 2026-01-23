<?php snippet('header') ?>

<style>
    /* Contact Page Specific Styles */
    input, textarea, select {
        background: transparent !important;
        border-top: none !important;
        border-left: none !important;
        border-right: none !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
        padding-left: 0 !important;
        padding-right: 0 !important;
        border-radius: 0 !important;
        transition: border-color 0.3s ease;
    }
    input:focus, textarea:focus, select:focus {
        outline: none !important;
        border-bottom-color: var(--accent) !important;
        box-shadow: none !important;
    }
    .contact-link-hover {
        position: relative;
        display: inline-block;
    }
    .contact-link-hover::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background-color: var(--accent);
        transition: width 0.3s ease;
    }
    .contact-link-hover:hover::after {
        width: 100%;
    }
</style>

<div class="py-20 lg:py-32">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start">
        <div class="lg:col-span-6">
            <div class="serif-display text-6xl md:text-7xl lg:text-8xl leading-[1.1] tracking-tight mb-16">
                <?= $page->headline()->kt() ?>
            </div>
            <div class="space-y-12">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-[var(--text-muted)] mb-4"><?= $page->direct_contact_title()->or('Direct Contact') ?></p>
                    <a class="serif-display text-2xl md:text-3xl contact-link-hover" href="mailto:<?= $page->email()->or('hello@johndoe.design') ?>"><?= $page->email()->or('hello@johndoe.design') ?></a>
                </div>
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-[var(--text-muted)] mb-6"><?= $page->social_title()->or('Social Channels') ?></p>
                    <div class="flex gap-8">
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
                        <a class="text-[var(--text-main)] hover:text-[var(--accent)] transition-colors" href="<?= $social->url() ?>" target="_blank" rel="noopener noreferrer">
                            <i class="<?= $iconClass ?> text-2xl"></i>
                        </a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-6 lg:pl-12">
            
            <?php if($success): ?>
            <div class="mb-10 text-[var(--accent)] p-6 border border-[var(--accent)]">
                <?= $success ?>
            </div>
            <?php else: ?>
                <?php if (isset($alert['error'])): ?>
                    <div class="mb-10 text-red-500 p-6 border border-red-500">
                        <?= $alert['error'] ?>
                    </div>
                <?php endif ?>

                <form class="space-y-12" method="POST" action="<?= $page->url() ?>">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="group">
                            <label class="text-[10px] uppercase tracking-widest text-[var(--text-muted)] block mb-2">Name</label>
                            <input class="w-full text-lg font-light text-white placeholder:text-white/20" 
                                   placeholder="Johnathan Doe" 
                                   type="text" 
                                   name="name" 
                                   value="<?= esc($data['name'] ?? '') ?>" 
                                   required/>
                        </div>
                        <div class="group">
                            <label class="text-[10px] uppercase tracking-widest text-[var(--text-muted)] block mb-2">Email Address</label>
                            <input class="w-full text-lg font-light text-white placeholder:text-white/20" 
                                   placeholder="john@example.com" 
                                   type="email" 
                                   name="email" 
                                   value="<?= esc($data['email'] ?? '') ?>" 
                                   required/>
                        </div>
                    </div>
                    <div class="group">
                        <label class="text-[10px] uppercase tracking-widest text-[var(--text-muted)] block mb-2">Project Type</label>
                        <select class="w-full text-lg font-light text-white appearance-none cursor-pointer" name="project_type">
                            <option class="bg-[var(--bg-deep)]" <?= (isset($data['project_type']) && $data['project_type'] == 'General Inquiry') ? 'selected' : '' ?>>General Inquiry</option>
                            <option class="bg-[var(--bg-deep)]" <?= (isset($data['project_type']) && $data['project_type'] == 'Brand Identity') ? 'selected' : '' ?>>Brand Identity</option>
                            <option class="bg-[var(--bg-deep)]" <?= (isset($data['project_type']) && $data['project_type'] == 'Product Photography') ? 'selected' : '' ?>>Product Photography</option>
                            <option class="bg-[var(--bg-deep)]" <?= (isset($data['project_type']) && $data['project_type'] == 'Digital Design') ? 'selected' : '' ?>>Digital Design</option>
                            <option class="bg-[var(--bg-deep)]" <?= (isset($data['project_type']) && $data['project_type'] == 'Art Direction') ? 'selected' : '' ?>>Art Direction</option>
                        </select>
                    </div>
                    <div class="group">
                        <label class="text-[10px] uppercase tracking-widest text-[var(--text-muted)] block mb-2">Message</label>
                        <textarea class="w-full text-lg font-light text-white placeholder:text-white/20 resize-none" 
                                  placeholder="Tell me about your vision..." 
                                  rows="4" 
                                  name="text" 
                                  required><?= esc($data['text'] ?? '') ?></textarea>
                    </div>
                    
                    <div style="display: none;" hidden>
                        <input type="text" name="website" value="<?= esc($data['website'] ?? '') ?>">
                    </div>

                    <div class="pt-6">
                        <button class="w-full md:w-auto px-16 py-5 bg-[var(--accent)] text-black text-sm uppercase tracking-[0.2em] font-bold hover:bg-white transition-all duration-500" 
                                type="submit" 
                                name="submit" 
                                value="Submit">
                            Send Message
                        </button>
                    </div>
                </form>
            <?php endif ?>
            
        </div>
    </div>
</div>

<?php snippet('footer') ?>
