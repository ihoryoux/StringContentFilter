<?php

namespace Iyoux\TextFilters;

interface FilterInterface
{
    /**
     * @param string $content
     * @return string
     */
    public function transform(string $content): string;
}
