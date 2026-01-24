<?php

use Kirby\Cms\Page;

class ArticlePage extends Page
{
    public function readTime()
    {
        $words = str_word_count(strip_tags($this->text()->toBlocks()->toHtml()));
        $minutes = floor($words / 200);
        $seconds = floor($words % 200 / (200 / 60));
        
        $est = ($minutes < 1) ? '1' : $minutes;
        
        return $est . ' Min Read';
    }

    public function isLive(): bool
    {
        return $this->date()->toDate() <= time();
    }
}
