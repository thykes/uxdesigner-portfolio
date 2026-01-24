<?php snippet('header') ?>

<section class="py-32 px-6">
    <h1 class="text-4xl font-bold">Debug Mode</h1>
    <p class="mt-4">The site is currently being debugged. If you see this, the server is working.</p>
    
    <ul class="mt-8 space-y-4">
        <?php foreach(site()->find('works')->children()->listed()->limit(5) as $project): ?>
        <li>
            <a href="<?= $project->url() ?>" class="text-[var(--accent)] underline"><?= $project->title() ?></a>
        </li>
        <?php endforeach ?>
    </ul>
</section>

<?php snippet('footer') ?>
