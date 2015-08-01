<?php

namespace ChaosTangent\ASS\Block;

use ChaosTangent\ASS\Line\Line;
use ChaosTangent\ASS\Exception\InvalidBlockException;

/**
 * ASS script block base class
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
abstract class Block implements \IteratorAggregate, \ArrayAccess
{
    /** @var string */
    protected $id;
    /** @var array */
    protected $lines = [];
    /** @var array */
    protected static $classMap = [
        'Script Info' => ScriptInfo::class,
        'V4+ Styles' => Styles::class,
        'Events' => Events::class,
        //'Fonts' => null,
        //'Graphics' => null,
    ];

    /**
     * Whether the passed line is a block header
     *
     * @param string $line
     * @return boolean
     */
    public static function isBlockHeader($line)
    {
        return preg_match('/^\[[^\]]+\]\s*$/', $line) === 1;
    }

    /**
     * Parse an array of lines into this block
     *
     * @param array $lines Raw (string) lines
     * @return Block|null
     * @throws InvalidBlockException
     */
    public static function parse(array $lines)
    {
        $rawId = $lines[0];
        $matches = [];

        if (preg_match('/^\[([^\]]+)\]\s*$/', $rawId, $matches) !== 1) {
            throw new InvalidBlockException(null, 'Cannot read ID for block, first line: '.$rawId);
        }

        $id = $matches[1];

        // don't recognise the key or not yet implemented
        if (!array_key_exists($id, self::$classMap)) {
            return null;
        }

        $block = new self::$classMap[$id];
        $block->setId($id);
        $block->doParse(array_slice($lines, 1));

        return $block;
    }

    /**
     * Add a line
     *
     * @param Line $line
     * @return Block
     */
    public function addLine(Line $line)
    {
        $this->lines[] = $line;

        return $this;
    }

    /**
     * Remove a line
     *
     * @param Line $line
     * @return Block
     */
    public function removeLine(Line $line)
    {
        $k = array_search($line, $this->lines, true);
        if ($k !== false) {
            unset($this->lines[$k]);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getLines()
    {
        return $this->lines;
    }

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
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->lines);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return $this->lines[$offset];
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        if (!($value instanceof Line)) {
            throw new \InvalidArgumentException('You must only set Lines using array access');
        }

        if ($offset === null) {
            $this->lines[] = $value;
        } else {
            $this->lines[$offset] = $value;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->lines[$offset]);
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->lines);
    }


    /**
     * Parse the remainder of the block according to its type
     *
     * @param array $lines The individual lines to parse
     */
    abstract protected function doParse(array $lines);
}
