<?php

namespace ChaosTangent\ASS;

use ChaosTangent\ASS\Block\Block;

/**
 * ASS script
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Script implements \IteratorAggregate
{
    /** @var string */
    protected $filename;
    /** @var string */
    protected $content;
    /** @var array */
    protected $blocks = [];
    /** @var boolean */
    protected $parsed = false;

    /**
     * @param string $content The plain text content of the ASS script
     */
    public function __construct($content, $filename = null)
    {
        $this->content = $content;
        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Quick check as to whether the content looks like an ASS script
     *
     * @param string $content
     * @return boolean True if it does, false otherwise
     */
    public function isASSScript($content)
    {
        $string = '[Script Info]';
        return substr($content, 0, strlen($string)) == $string;
    }

    /**
     * Add a block to this script
     *
     * @param Block $block
     * @return Script
     */
    public function addBlock(Block $block)
    {
        $this->blocks[$block->getId()] = $block;

        return $this;
    }

    /**
     * Remove a block from this script
     *
     * @param Block $block
     * @return Script
     */
    public function removeBlock(Block $block)
    {
        unset($this->blocks[$block->getId()]);

        return $this;
    }

    /**
     * Whether a block exists within this script
     *
     * @param Block $block
     * @return boolean
     */
    public function hasBlock(Block $block)
    {
        return array_key_exists($block->getId(), $this->blocks);
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->blocks);
    }
}
