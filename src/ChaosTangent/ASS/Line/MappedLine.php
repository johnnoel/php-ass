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
     * With a string value and an array mapping, map values to this class
     *
     * @param string $value
     * @param array $mapping
     */
    public function applyMapping($value, array $mapping)
    {
        $this->setValue($value);

        $classMapping = $this->getMapping();
        $parts = explode(',', $value, count($mapping));

        foreach ($parts as $offset => $part) {
            if (!array_key_exists($offset, $mapping)) {
                continue;
            }

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

    /**
     * With a string value and an array mapping, map values to this class
     *
     * @param string $value
     * @param array $mapping
     */
    public function reverseMapping($mapping)
    {
        $classMapping = $this->getMapping();

        $string = '';
        foreach ($mapping as $attribute) {
            $id = $classMapping[$attribute];
            $string .= $this->{$id}.',';
        }

        return trim($string, ',');
    }

    /**
     * {@inheritDoc}
     */
    protected function doParse($value, array $mapping)
    {
        // if we don't have a mapping, not much else we can do
        if (empty($mapping)) {
            return;
        }

        $this->applyMapping($value, $mapping);
    }

    public function toString($mapping = []) {
        if (count($mapping)) {
            return $this->getKey() . ': ' . $this->reverseMapping($mapping);
        } else {
            return parent::toString();
        }
    }
}
