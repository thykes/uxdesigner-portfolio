<?php snippet('header') ?>

<section class="pt-20 pb-12">
    <h1 class="serif-display text-6xl md:text-8xl lg:text-9xl leading-none">Selected <span class="italic text-[var(--accent)]">Works</span></h1>
    <p class="mt-8 text-xl md:text-2xl text-[var(--text-muted)] max-w-2xl font-light leading-relaxed">
        A curated selection of projects spanning branding, digital design, and photography.
    </p>
</section>

<section class="mb-20">
    <div class="flex flex-wrap gap-x-10 gap-y-6 text-xs uppercase tracking-[0.2em] font-semibold text-[var(--text-muted)] border-b border-white/10 pb-8">
        <a class="filter-link active" href="#">All Projects</a>
        <!-- Dynamic filters could go here -->
    </div>
</section>

<section class="pb-32">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-x-12 gap-y-24">
        <!-- Loop through projects would go here, static for now -->
        <div class="project-card group cursor-pointer">
            <div class="relative overflow-hidden bg-[var(--charcoal)] aspect-[4/3]">
                <img alt="Visual Identity Project" class="project-image w-full h-full object-cover transition-transform duration-1000 ease-out" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCETAcWHfXGbbaeRCREkfD3i-8wC7gaTKBArwG-7lWJXhXqFzB2FxakwfXZchHEIKqY7TflTDESJGxjwPgp4dnnpWNw2CH89xdtvYCOyhibuXlB0EA05YroV2y3Ko7FU4ROZqIWXV0TVaBLIpFopxLNy11ThnVKCp9y2T6OmTzk1yq0WRlXuGiTqsRy96Lo3Kcivs2AXIwIffiYEm8wJ3W-ChsVjBhXSK-860DbD2KTnJtThd3XUQXaSaGTCX6WHVTy-QboVchGnLw"/>
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                    <span class="material-symbols-outlined text-5xl text-[var(--accent)]">add</span>
                </div>
            </div>
            <div class="mt-8">
                <h3 class="serif-display text-3xl md:text-4xl font-bold group-hover:text-[var(--accent)] transition-colors">Visual Identity</h3>
                <p class="text-xs uppercase tracking-widest text-[var(--text-muted)] mt-3">Branding • 2024</p>
            </div>
        </div>
    </div>
</section>

<?php snippet('footer') ?>
