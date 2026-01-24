<?php
// SEO Meta Tags Logic
$seoTitle = $page->seoTitle()->isNotEmpty() ? $page->seoTitle() : $page->title() . ' | ' . $site->title();
$seoDesc = $page->seoDescription()->isNotEmpty() ? $page->seoDescription() : ($page->intro()->isNotEmpty() ? $page->intro()->excerpt(160) : ($site->metaDescription()->isNotEmpty() ? $site->metaDescription() : $site->description()));
$seoImage = $page->cover()->toFile() ? $page->cover()->toFile()->url() : ($site->ogImage()->toFile() ? $site->ogImage()->toFile()->url() : '');
?>
<title><?= $seoTitle ?></title>
<link rel="canonical" href="<?= $page->url() ?>">
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
    '@type' => 'ProfilePage',
    'dateCreated' => $page->date()->toDate('c'),
    'dateModified' => $page->modified('c'),
    'mainEntity' => [
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
        'sameAs' => $page->schema_same_as()->toStructure()->count() > 0 ? $page->schema_same_as()->toStructure()->map(fn($item) => $item->url()->value())->values() : []
    ]
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>
<?php endif ?>

<?php if ($page->isHomePage()): ?>
<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => $site->title()->value(),
    'url' => $site->url(),
    'description' => $seoDesc,
    'publisher' => [
        '@type' => 'Person',
        'name' => 'Tim Hykes',
        'url' => $site->url()
    ],
    'sameAs' => $site->social_links()->toStructure()->map(fn($social) => $social->url()->value())->values()
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>
<?php endif ?>

<!-- Image Object Schema for Google Images (Licensable Badge) -->
<?php
$imagesToSchema = new Kirby\Cms\Collection();

// Add Page Cover
if ($cover = $page->cover()->toFile()) {
    $imagesToSchema->add($cover);
}

// Add Schema Image (Profile)
if ($page->template() == 'about' && $page->schema_image()->toFile()) {
    $imagesToSchema->add($page->schema_image()->toFile());
}

// Add Project Thumbs for Home/Works
if ($page->isHomePage() || $page->template() == 'works') {
    $projects = $page->isHomePage() 
        ? ($page->featured_projects()->toPages()->isNotEmpty() ? $page->featured_projects()->toPages() : site()->find('works')->children()->listed())
        : $page->children()->listed();
        
    foreach ($projects as $project) {
        if ($img = $project->cover()->toFile()) {
            $imagesToSchema->add($img);
        }
    }
}

// Add Article Thumbs for Blog Index
if ($page->template() == 'thoughts') {
    foreach ($page->children()->listed() as $article) {
        if ($img = $article->cover()->toFile()) {
            $imagesToSchema->add($img);
        }
    }
}

// Filter duplicates
$uniqueImages = $imagesToSchema->unique();

if ($uniqueImages instanceof \Kirby\Cms\Collection && $uniqueImages->count() > 0): 
?>
<script type="application/ld+json">
<?= json_encode($uniqueImages->map(function($image) use ($site) {
    // License Mapping
    $licenseUrl = $site->url(); // Default to home/copyright
    $l = $image->license()->value();
    
    if ($l == 'Unsplash') $licenseUrl = 'https://unsplash.com/license';
    if ($l == 'CC BY 4.0') $licenseUrl = 'https://creativecommons.org/licenses/by/4.0/';
    if ($l == 'CC BY-SA 4.0') $licenseUrl = 'https://creativecommons.org/licenses/by-sa/4.0/';
    if ($l == 'CC BY-NC 4.0') $licenseUrl = 'https://creativecommons.org/licenses/by-nc/4.0/';
    if ($l == 'CC BY-ND 4.0') $licenseUrl = 'https://creativecommons.org/licenses/by-nd/4.0/';
    
    // Creator Logic
    $creator = $image->photographer()->isNotEmpty() ? $image->photographer()->value() : 'Tim Hykes';

    return [
        '@context' => 'https://schema.org/',
        '@type' => 'ImageObject',
        'contentUrl' => $image->url(),
        'license' => $licenseUrl,
        'acquireLicensePage' => $site->url() . '/contact', // Best place to ask for usage rights
        'creditText' => $creator,
        'creator' => [
            '@type' => 'Person',
            'name' => $creator
        ],
        'copyrightNotice' => $creator
    ];
})->values()->toArray(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) ?>
</script>
<?php endif ?>
