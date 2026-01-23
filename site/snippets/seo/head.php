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
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "<?= $page->title() ?>",
  "author": {
    "@type": "Person",
    "name": "Todd Hykes"
  },
  "datePublished": "<?= $page->date()->toDate('Y-m-d') ?>",
  "description": "<?= $seoDesc ?>",
  "image": "<?= $seoImage ?>"
}
</script>
<?php endif ?>
