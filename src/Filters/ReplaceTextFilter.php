<?php

namespace Iyoux\TextFilters\Filters;

use Iyoux\TextFilters\FilterInterface;

class ReplaceTextFilter implements FilterInterface
{
    /**
     * @param string $search
     * @param string $replace
     * @param bool $isRegex
     */
    public function __construct(
        private string $search,
        private string $replace,
        private bool $isRegex
    ) {
    }

    /**
     * @param string $content
     * @return string
     */
    public function transform(string $content): string
    {
        if ($this->isRegex) {
            return (string) preg_replace($this->search, $this->replace, $content);
        }

        return str_replace($this->search, $this->replace, $content);
    }
}
