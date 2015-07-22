<?php

namespace ChaosTangent\ASS\Line;

use ChaosTangent\ASS\Parseable;

/**
 * Line base class
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Line implements Parseable
{
    /** @var string */
    protected $key;
    /** @var string */
    protected $value;

    /**
     * Set key
     *
     * @param string $key
     * @return Line
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Line
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritDoc}
     */
    public function parse($content)
    {
        // comment, do nothing
        if (substr($content, 0, 1) == ';') {
            $this->value = $content;
            return;
        }

        $matches = [];
        if (preg_match('/^([^:]+):\s*(.*)$/', trim($content), $matches) !== 1) {
            $this->value = $content;
            return;
        }

        $this->key = $matches[1];
        $this->value = $matches[2];

        $this->doParse($this->value);
    }

    /**
     * Do any subsequent, type specific parsing
     *
     * @param string $value
     */
    protected function doParse($value)
    {
    }
}
