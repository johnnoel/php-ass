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

    /**
     * Set mapping
     *
     * @param array $mapping
     * @return Format
     */
    public function setMapping(array $mapping)
    {
        $this->mapping = $mapping;

        return $this;
    }

    /**
     * Get mapping
     *
     * @return array
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    protected function doParse($value, array $mapping)
    {
        $this->mapping = array_map('trim', explode(',', $value));
    }
}
