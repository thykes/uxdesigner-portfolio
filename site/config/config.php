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
    ]
  ]
];
