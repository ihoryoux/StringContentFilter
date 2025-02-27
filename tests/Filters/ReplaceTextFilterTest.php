<?php

namespace Tests\Filters;

use Iyoux\TextFilters\Filters\ReplaceTextFilter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ReplaceTextFilter::class)]
final class ReplaceTextFilterTest extends TestCase
{
    public function testSimpleStringReplace(): void
    {
        $filter = new ReplaceTextFilter('value1', 'value2', false);
        $this::assertSame('value2', $filter->transform('value1'));
    }

    public function testStringReplaceNoMatch(): void
    {
        $filter = new ReplaceTextFilter('value3', 'value4', false);
        $this::assertSame('value1', $filter->transform('value1'));
    }

    public function testRegexReplace(): void
    {
        $filter = new ReplaceTextFilter('/\d+/', 'NUMBER', true);
        $this::assertSame('Value NUMBER, Value NUMBER', $filter->transform('Value 123, Value 45'));
    }

    public function testRegexReplaceNoMatch(): void
    {
        $filter = new ReplaceTextFilter('/\d+/', 'NUMBER', true);
        $this::assertSame('Value', $filter->transform('Value'));
    }

    public function testEmptyInputString(): void
    {
        $filter = new ReplaceTextFilter('any', 'replacement', false);
        $this::assertSame('', $filter->transform(''));
    }
}
