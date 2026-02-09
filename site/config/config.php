<?php

return [
  'debug' => true,
  'date.handler' => 'date',
  'date.timezone' => 'America/New_York',
  'panel' => [
    'install' => true
  ],
  'thumbs' => [
    'driver' => 'imagick',
    'quality' => 80,
    'srcsets' => [
      'default' => [300, 600, 900, 1200]
    ]
  ],
  'tobimori.seo.robots.enabled' => false,
  'postmark' => [
    'token' => getenv('POSTMARK_TOKEN')
  ],

  'routes' => [
    [
      'pattern' => 'sitemap.xml',
      'action' => function () {
        $pages = site()->pages()->index();

        // fetch the pages to ignore from the config settings,
        // if nothing is set, we ignore the error page
        $ignore = kirby()->option('sitemap.ignore', ['error']);

        $content = snippet('sitemap', compact('pages', 'ignore'), true);

        // return response with correct header type
        return new Kirby\Cms\Response($content, 'application/xml');
      }
    ],
    [
      'pattern' => 'sitemap',
      'action' => function () {
        return go('sitemap.xml', 301);
      }
    ],
    [
      'pattern' => 'debug-content',
      'action' => function () {
        $root = kirby()->root('content') . '/works';
        $output = [];

        $output[] = '<h2>Content Directory Debug</h2>';

        if (!is_dir($root)) {
          return 'Works directory not found at ' . $root;
        }

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS));

        foreach ($iterator as $file) {
          $path = $file->getPathname();
          $perms = substr(sprintf('%o', fileperms($path)), -4);
          $owner = fileowner($path);
          $output[] = "File: $path | Perms: $perms | Owner: $owner";

          if ($file->getFilename() === '.DS_Store') {
            if (unlink($path)) {
              $output[] = "<strong>Deleted .DS_Store at $path</strong>";
            } else {
              $output[] = "<strong>Failed to delete .DS_Store at $path</strong>";
            }
          }
        }

        $output[] = '<h3>Attempting Permission Fix...</h3>';

        // Try to chmod folders
        try {
          $dirs = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST);
          foreach ($dirs as $dir) {
            if ($dir->isDir()) {
              if (chmod($dir->getPathname(), 0755)) {
                $output[] = 'Chmod 755 ' . $dir->getPathname() . ' [OK]';
              } else {
                $output[] = 'Chmod 755 ' . $dir->getPathname() . ' [FAILED]';
              }
            }
          }
        } catch (Exception $e) {
          $output[] = 'Error chmod: ' . $e->getMessage();
        }

        return implode("<br>", $output);
      }
    ]
  ]
];
