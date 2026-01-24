<?php

return [
  'debug' => true,
  'date.handler' => 'date',
  'date.timezone' => 'America/New_York',
  'panel' => [
    'install' => true
  ],
  'tobimori.seo.robots.enabled' => false,
  'postmark' => [
    'token' => getenv('POSTMARK_TOKEN')
  ],
  'hooks' => [
      'page.render:before' => function ($contentType, $data, $page) {
          // Auto-Publish Logic: Check strictly for scheduled posts on every page load
          // Only running if we aren't in the panel/API to avoid overhead, but hooks run on frontend render
          
          // Performance Check: Only run every ~5 mins or if random chance? 
          // For a portfolio, running on every load is fine (low traffic).
          
          $blog = site()->find('thoughts');
          if ($blog) {
              $scheduled = $blog->children()->unlisted()->filter(function($p) {
                  return $p->date()->toDate() <= time();
              });

              if ($scheduled->count() > 0) {
                  kirby()->impersonate('kirby'); // Permissions
                  foreach ($scheduled as $post) {
                      $post->changeStatus('listed');
                  }
              }
          }
      }
  ],
  'routes' => [
    [
      'pattern' => 'sitemap.xml',
      'action'  => function() {
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
      'action'  => function() {
        return go('sitemap.xml', 301);
      }
    ]
  ]
];
