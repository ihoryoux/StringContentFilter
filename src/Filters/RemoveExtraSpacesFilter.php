<?php

namespace Iyoux\TextFilters\Filters;

use Iyoux\TextFilters\FilterInterface;

final class RemoveExtraSpacesFilter implements FilterInterface
{
    /**
     * @param string $content
     * @return string
     */
    public function transform(string $content): string
    {
        return preg_replace('/\s+/', ' ', trim($content)) ?? '';
    }
}
