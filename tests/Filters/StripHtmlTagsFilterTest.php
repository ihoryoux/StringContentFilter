<?php

namespace Tests\Filters;

use Iyoux\TextFilters\Filters\StripHtmlTagsFilter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(StripHtmlTagsFilter::class)]
final class StripHtmlTagsFilterTest extends TestCase
{
    public function testStripHtmlTags(): void
    {
        $filter = new StripHtmlTagsFilter();
        $this::assertSame('value', $filter->transform('<p>value</p>'));
    }
}
