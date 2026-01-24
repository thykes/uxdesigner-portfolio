<?php snippet('header') ?>

<section class="py-32 px-6">
    <h1 class="text-4xl font-bold">Debug Mode - Server Check</h1>
    <p class="mt-4">Server Time: <?= date('Y-m-d H:i:s') ?></p>
    <p>Memory Usage: <?= memory_get_usage(true) / 1024 / 1024 ?> MB</p>
    
    <ul class="mt-8 space-y-4">
        <li><a href="/panel" class="underline text-blue-400">Go to Panel</a></li>
        <li><a href="/about" class="underline text-blue-400">About Page</a></li>
    </ul>
</section>

<?php snippet('footer') ?>
