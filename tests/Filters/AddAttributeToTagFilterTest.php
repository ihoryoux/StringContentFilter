<?php

namespace Tests\Filters;

use Iyoux\TextFilters\Filters\AddAttributeToTagFilter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AddAttributeToTagFilter::class)]
final class AddAttributeToTagFilterTest extends TestCase
{
    public function testAddAttributeToTagWithoutPresetValueSpaceIsNotBeforeLastSymbol(): void
    {
        $filter = new AddAttributeToTagFilter('img', 'data-attr', 'value');
        $this::assertSame('<img data-attr="value">', $filter->transform('<img>'));
    }

    public function testAddAttributeToTagWithoutPresetValueSpaceIsBeforeLastSymbol(): void
    {
        $filter = new AddAttributeToTagFilter('img', 'data-attr', 'value');
        $this::assertSame('<img data-attr="value" >', $filter->transform('<img >'));
    }

    public function testAddAttributeToTagWithPresetValue(): void
    {
        $filter = new AddAttributeToTagFilter('img', 'data-attr', 'value');
        $this::assertSame('<img data-attr="value">', $filter->transform('<img>'));
    }

    public function testAppendAttributeToTagWithPresetValue(): void
    {
        $filter = new AddAttributeToTagFilter('img', 'data-attr', 'value2', true);
        $this::assertSame('<img data-attr="value value2">', $filter->transform('<img data-attr="value">'));
    }
}
