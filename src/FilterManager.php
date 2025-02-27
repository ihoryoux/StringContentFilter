<?php

namespace Iyoux\TextFilters;

class FilterManager
{
    /**
     * @var FilterInterface[]
     */
    private array $filters = [];

    /**
     * @param FilterInterface $filter
     * @return $this
     */
    public function addFilter(FilterInterface $filter): self
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * @param string $content
     * @return string
     */
    public function execute(string $content): string
    {
        $output = $content;
        foreach ($this->filters as $filter) {
            $output = $filter->transform($output);
        }

        return $output;
    }
}
