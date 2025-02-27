<?php

namespace Tests\Filters;

use Iyoux\TextFilters\Filters\AddPrefixSuffixFilter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AddPrefixSuffixFilter::class)]
final class AddPrefixSuffixFilterTest extends TestCase
{
    public function testAddPrefixSuffix(): void
    {
        $filter = new AddPrefixSuffixFilter('Before', 'After');
        $this::assertSame('BeforeTestAfter', $filter->transform('Test'));
    }
}
