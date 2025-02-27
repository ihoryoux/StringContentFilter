<?php

namespace Iyoux\TextFilters\Filters;

use Iyoux\TextFilters\FilterInterface;

final class AddPrefixSuffixFilter implements FilterInterface
{
    /**
     * @param string $prefix
     * @param string $suffix
     */
    public function __construct(
        private string $prefix = '',
        private string $suffix = ''
    ) {
    }

    /**
     * @param string $content
     * @return string
     */
    public function transform(string $content): string
    {
        return $this->prefix . $content . $this->suffix;
    }
}
