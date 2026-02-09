<?php

\Kirby\Cms\App::plugin('custom/tags', [
    'tags' => [
        'highlight' => [
            'html' => function ($tag) {
                return '<span class="text-white">' . kirby()->kirbytags($tag->value) . '</span>';
            }
        ],
        'italic' => [
            'html' => function ($tag) {
                return '<span class="italic">' . kirby()->kirbytags($tag->value) . '</span>';
            }
        ],
        'accent' => [
            'html' => function ($tag) {
                return '<span class="accent-text">' . kirby()->kirbytags($tag->value) . '</span>';
            }
        ],
        'br' => [
            'html' => function ($tag) {
                return '<br>';
            }
        ]
    ]
]);
