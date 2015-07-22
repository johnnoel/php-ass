<?php

namespace ChaosTangent\ASS\Line;

/**
 * Mapped line
 *
 * A line whose value order is defined by a mapping on another line, usually
 * a Format line
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 * @see ChaosTangent\ASS\Line\Format
 */
abstract class MappedLine extends Line
{
    /**
     * Get a mapping from ASS defined names to class variables
     *
     * E.g. [ 'MarginL' => 'marginLeft' ] will map the MarginL field (from
     * the doParse passed mapping) to the class variable $marginLeft
     *
     * @return array
     */
    abstract protected function getMapping();

    /**
     * {@inheritDoc}
     */
    protected function doParse($value, array $mapping)
    {
        $classMapping = $this->getMapping();
        $parts = explode(',', $value, count($mapping));

        foreach ($parts as $offset => $part) {
            $assName = $mapping[$offset];
            $value = $part;

            if (array_key_exists($assName, $classMapping)) {
                $var = $classMapping[$assName];
                $this->$var = $value;
            } else {
                // trigger exception?
            }
        }
    }
}
