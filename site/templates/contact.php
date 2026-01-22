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
                        <a class="text-[var(--text-main)] hover:text-[var(--accent)] transition-colors" href="#">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.01 3.8.058 1.016.048 1.71.21 2.316.446a4.688 4.688 0 011.669 1.087 4.688 4.688 0 011.087 1.669c.236.606.398 1.3.446 2.316.048 1.016.058 1.37.058 3.8s-.01 2.784-.058 3.8c-.048 1.016-.21 1.71-.446 2.316a4.688 4.688 0 01-1.087 1.669 4.688 4.688 0 01-1.087-1.669c-.236-.606-.398-1.3-.446-2.316C2.01 14.784 2 14.43 2 12s.01-2.784.058-3.8c.048-1.016.21-1.71.446-2.316a4.688 4.688 0 011.087-1.669A4.688 4.688 0 015.315 2.5c.606-.236 1.3-.398 2.316-.446 1.016-.048 1.37-.058 3.8-.058zm0 1.8c-2.43 0-2.743.01-3.703.054-.887.04-1.37.188-1.691.31-.424.165-.726.362-1.044.68-.318.318-.515.62-.68 1.044-.122.321-.27.804-.31 1.691-.044.96-.054 1.272-.054 3.703s.01 2.743.054 3.703c.04.887.188 1.37.31 1.691.165.424.362.726.68 1.044.318.318.62.515 1.044.68.321.122.804.27 1.691.31.96.044 1.272.054 3.703.054s2.743-.01 3.703-.054c.887-.04 1.37-.188 1.691-.31.424-.165.726-.362 1.044-.68.318-.318.515-.62.68-1.044.122-.321.27-.804.31-1.691.044-.96.054-1.272.054-3.703s-.01-2.743-.054-3.703c-.04-.887-.188-1.37-.31-1.691-.165-.424-.362-.726-.68-1.044-.318-.318-.62-.515-1.044-.68-.321-.122-.804-.27-1.691-.31-.96-.044-1.272-.054-3.703-.054zM12 6.865A5.135 5.135 0 1017.135 12 5.135 5.135 0 0012 6.865zm0 8.468A3.333 3.333 0 1115.333 12 3.333 3.333 0 0112 15.333zm5.338-8.303a1.2 1.2 0 100-2.4 1.2 1.2 0 000 2.4z"></path></svg>
                        </a>
                        <a class="text-[var(--text-main)] hover:text-[var(--accent)] transition-colors" href="#">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path></svg>
                        </a>
                        <a class="text-[var(--text-main)] hover:text-[var(--accent)] transition-colors" href="#">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg>
                        </a>
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
