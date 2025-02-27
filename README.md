# String Content Filters

A small PHP 8+ library for pipeline-style text processing using a collection of filters.

## Features

- **FilterManager** – A manager class that allows you to add multiple filters and apply them sequentially to a string.
- **FilterInterface** – A shared interface for all filters, requiring a `transform(string $content): string` method.
- **Available Filters** (examples):
    - `AddAttributeToTagFilter` – Allows to add or update a specific HTML attribute on a given tag.
    - `AddPrefixSuffixFilter` – Adds a prefix and/or suffix to your text.
    - `RemoveExtraSpacesFilter` – Removes leading/trailing whitespace and converts multiple spaces into a single space.
    - `ReplaceTextFilter` – Replaces text either by string matching or using a regular expression.
    - `StripHtmlTagsFilter` – Remove all HTML tags, leaving only plain text.

## Basic Usage Example

```php
use Iyoux\TextFilters\FilterManager;
use Iyoux\TextFilters\Filters\RemoveExtraSpacesFilter;
use Iyoux\TextFilters\Filters\AddAttributeToTagFilter;

// 1. Create the manager
$manager = new FilterManager();

// 2. Add filters in the desired sequence
$manager
    ->addFilter(new RemoveExtraSpacesFilter());
    ->addFilter(new AddAttributeToTagFilter('img', 'data-attr', 'value'));

// 3. Execute
$original = '   <img src="image.jpg"   >   Some    text  ';
$processed = $manager->execute($original);

echo $processed;
// Outputs: <img src="image.jpg" data-attr="value"> Some text
