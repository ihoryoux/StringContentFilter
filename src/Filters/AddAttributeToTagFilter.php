<?php

namespace Iyoux\TextFilters\Filters;

use Iyoux\TextFilters\FilterInterface;

class AddAttributeToTagFilter implements FilterInterface
{
    /**
     * @param string $tag
     * @param string $attrName
     * @param string $attrValue
     * @param bool $append
     */
    public function __construct(
        private string $tag,
        private string $attrName,
        private string $attrValue,
        private bool $append = false
    ) {
    }

    /**
     * @param string $content
     * @return string
     */
    public function transform(string $content): string
    {
        $pattern = sprintf(
            '/(<%s\b[^>]*?)(\s+%s="[^"]*")?([^>]*>)/i',
            preg_quote($this->tag, '/'),
            preg_quote($this->attrName, '/')
        );

        return (string) preg_replace_callback($pattern, function ($matches) {
            $before       = $matches[1];              // <tag ...
            $existingAttr = $matches[2] ?? '';        //  attribute="value" / empty string
            $after        = $matches[3];              //  >

            if ($existingAttr !== '') {
                if ($this->append) {
                    // Append: attribute="value" => attribute="value value2"
                    $existingAttr = preg_replace(
                        sprintf('/%s="([^"]*)"/i', preg_quote($this->attrName, '/')),
                        sprintf('%s="$1 %s"', $this->attrName, $this->attrValue),
                        $existingAttr
                    );
                } else {
                    // Replace: attribute="value" => attribute="value2"
                    $existingAttr = preg_replace(
                        sprintf('/%s="[^"]*"/i', preg_quote($this->attrName, '/')),
                        sprintf('%s="%s"', $this->attrName, $this->attrValue),
                        $existingAttr
                    );
                }
            } else {
                // Replace with space
                $existingAttr = sprintf(' %s="%s"', $this->attrName, $this->attrValue);
            }

            return $before . $existingAttr . $after;
        }, $content);
    }
}
