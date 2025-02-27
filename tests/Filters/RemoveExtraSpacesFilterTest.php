<?php

namespace Tests\Filters;

use Iyoux\TextFilters\Filters\RemoveExtraSpacesFilter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(RemoveExtraSpacesFilter::class)]
final class RemoveExtraSpacesFilterTest extends TestCase
{
    public function testRemovesLeadingAndTrailingSpaces(): void
    {
        $filter = new RemoveExtraSpacesFilter();
        $result = $filter->transform("   Test   ");
        $this::assertSame("Test", $result);
    }

    public function testRemovesMultipleInnerSpaces(): void
    {
        $filter = new RemoveExtraSpacesFilter();
        $result = $filter->transform("Test   Test  !");
        $this::assertSame("Test Test !", $result);
    }
}
