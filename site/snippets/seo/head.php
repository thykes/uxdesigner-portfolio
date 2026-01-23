<?php
// SEO Meta Tags Logic
$seoTitle = $page->seoTitle()->isNotEmpty() ? $page->seoTitle() : $page->title() . ' | ' . $site->title();
$seoDesc = $page->seoDescription()->isNotEmpty() ? $page->seoDescription() : $page->text()->excerpt(160);
$seoImage = $page->cover()->toFile() ? $page->cover()->toFile()->url() : ($site->seoImage()->toFile() ? $site->seoImage()->toFile()->url() : '');
?>
<title><?= $seoTitle ?></title>
<meta name="description" content="<?= $seoDesc ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?= $page->url() ?>">
<meta property="og:title" content="<?= $seoTitle ?>">
<meta property="og:description" content="<?= $seoDesc ?>">
<?php if ($seoImage): ?>
<meta property="og:image" content="<?= $seoImage ?>">
<?php endif ?>

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?= $page->url() ?>">
<meta property="twitter:title" content="<?= $seoTitle ?>">
<meta property="twitter:description" content="<?= $seoDesc ?>">
<?php if ($seoImage): ?>
<meta property="twitter:image" content="<?= $seoImage ?>">
<?php endif ?>

<!-- Structured Data (JSON-LD) for Blog Posts -->
<?php if ($page->template() == 'article'): ?>
<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BlogPosting',
    'headline' => $page->title()->value(),
    'name' => $page->title()->value(),
    'description' => (string)$seoDesc,
    'datePublished' => $page->date()->toDate('c'),
    'dateModified' => $page->modified('c'),
    'author' => [
        '@type' => 'Person',
        'name' => 'Tim Hykes',
        'url' => $site->url()
    ],
    'image' => $seoImage ? [$seoImage] : [],
    'mainEntityOfPage' => [
        '@type' => 'WebPage',
        '@id' => $page->url()
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>
<?php endif ?>

<?php if ($page->template() == 'about'): ?>
<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    '@id' => $page->url() . '#person',
    'name' => $page->schema_name()->isNotEmpty() ? $page->schema_name()->value() : $site->title()->value(),
    'alternateName' => $page->schema_alternate_name()->value(),
    'url' => $site->url(),
    'image' => $page->schema_image()->toFile() ? $page->schema_image()->toFile()->url() : ($page->cover()->toFile() ? $page->cover()->toFile()->url() : ''),
    'description' => $page->intro()->value(),
    'jobTitle' => $page->schema_job_title()->value(),
    'worksFor' => $page->schema_works_for_name()->isNotEmpty() ? [
        '@type' => 'Organization',
        'name' => $page->schema_works_for_name()->value(),
        'sameAs' => $page->schema_works_for_url()->value()
    ] : null,
    'alumniOf' => $page->schema_alumni_name()->isNotEmpty() ? [
        [
            '@type' => 'EducationalOrganization',
            'name' => $page->schema_alumni_name()->value(),
            'sameAs' => $page->schema_alumni_url()->value()
        ]
    ] : [],
    'birthDate' => $page->schema_birth_date()->isNotEmpty() ? $page->schema_birth_date()->toDate('Y-m-d') : null,
    'birthPlace' => $page->schema_birth_place()->isNotEmpty() ? [
        '@type' => 'Place',
        'name' => $page->schema_birth_place()->value()
    ] : null,
    'knowsAbout' => $page->schema_knows_about()->isNotEmpty() ? $page->schema_knows_about()->split(',') : [],
    'award' => $page->schema_award()->isNotEmpty() ? $page->schema_award()->split(',') : [],
    'sameAs' => $page->schema_same_as()->toStructure()->count() > 0 ? $page->schema_same_as()->toStructure()->map(fn($item) => $item->url()->value())->values()->toArray() : []
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>
<?php endif ?>
