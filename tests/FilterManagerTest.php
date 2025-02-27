<?php

namespace Tests;

use Iyoux\TextFilters\FilterInterface;
use Iyoux\TextFilters\FilterManager;
use Iyoux\TextFilters\Filters\AddAttributeToTagFilter;
use Iyoux\TextFilters\Filters\AddPrefixSuffixFilter;
use Iyoux\TextFilters\Filters\RemoveExtraSpacesFilter;
use Iyoux\TextFilters\Filters\ReplaceTextFilter;
use Iyoux\TextFilters\Filters\StripHtmlTagsFilter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(FilterManager::class)]
final class FilterManagerTest extends TestCase
{
    public function testCanApplySingleFilters(): void
    {
        $manager = new FilterManager();

        $mockFilter = new class implements FilterInterface {
            public function transform(string $content): string
            {
                return $content . 'Test';
            }
        };

        $manager->addFilter($mockFilter);

        $this::assertSame('SomeTest', $manager->execute('Some'));
    }

    public function testCanApplyMultipleFilters(): void
    {
        $manager = new FilterManager();

        $mockFilter1 = new class implements FilterInterface {
            public function transform(string $content): string
            {
                return $content . '1';
            }
        };

        $mockFilter2 = new class implements FilterInterface {
            public function transform(string $content): string
            {
                return $content . '2';
            }
        };

        $manager
            ->addFilter($mockFilter1)
            ->addFilter($mockFilter2);

        $this::assertSame('Test12', $manager->execute('Test'));
    }

    public function testWithRealFilters(): void
    {
        $manager = new FilterManager();

        $manager
            ->addFilter(new AddPrefixSuffixFilter('Before', '.'))
            ->addFilter(new StripHtmlTagsFilter())
            ->addFilter(new ReplaceTextFilter('tag', '<b>think</b>', false))
            ->addFilter(new AddAttributeToTagFilter('b', 'class', 'awesome'))
            ->addFilter(new RemoveExtraSpacesFilter());

        $content = '  <section> I do I  </section>   tag';

        $this::assertSame('Before I do I <b class="awesome">think</b>.', $manager->execute($content));
    }
}
