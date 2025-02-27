<?php

namespace Iyoux\TextFilters\Filters;

use Iyoux\TextFilters\FilterInterface;

class StripHtmlTagsFilter implements FilterInterface
{
    /**
     * @param string $content
     * @return string
     */
    public function transform(string $content): string
    {
        return strip_tags($content);
    }
}
