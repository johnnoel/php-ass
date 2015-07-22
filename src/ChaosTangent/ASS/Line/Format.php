<?php

namespace ChaosTangent\ASS\Line;

/**
 * Format line
 *
 * Defines a mapping for lines in the current section
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Format extends Line
{
    /** @var array */
    protected $mapping = [];

    protected function doParse($value)
    {
        $this->mapping = array_flip(array_map('trim', explode(',', $value)));
    }
}
