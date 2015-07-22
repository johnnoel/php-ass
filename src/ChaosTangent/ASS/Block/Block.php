<?php

namespace ChaosTangent\ASS\Block;

use ChaosTangent\ASS\Parseable;

/**
 * ASS script block base class
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
abstract class Block implements Parseable
{
    /** @var string */
    protected $id;

    /**
     * @param string $id
     * @return Block
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritDoc}
     */
    public function parse($content)
    {
        $lines = explode("\n", $content); // SSA/ASS files are always DOS
        if (count($lines) === 0) {
            throw new InvalidBlockException($block, 'No lines within the block');
        }

        $rawId = $lines[0];
        $matches = [];

        if (preg_match('/^\[([^\]]+\]$/', $rawId, $matches) !== 1) {
            throw new InvalidBlockException($this, 'Cannot read ID for block');
        }

        $this->id = $matches[1];

        $this->doParse(array_slice($lines, 1));
    }

    /**
     * Parse the remainder of the block according to its type
     *
     * @param array $lines The individual lines to parse
     */
    abstract protected function doParse(array $lines);
}
