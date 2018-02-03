<?php

/**
 * This file is part of the ChaosTangent PHP-ASS package
 *
 * (c) John Noel <john.noel@chaostangent.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code
 */

namespace ChaosTangent\ASS;

use ChaosTangent\ASS\Exception\InvalidScriptException;
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
    /** @var boolean */
    protected $isUTF8 = false;

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
     * @return boolean True if it does, false otherwise
     */
    public function isASSScript()
    {
        // check for UTF8 BOM
        if (substr($this->content, 0, 3) == (chr(0xEF).chr(0xBB).chr(0xBF))) {
            $this->isUTF8 = true;
            $this->content = substr($this->content, 3);
        }

        $string = '[Script Info]';
        return substr($this->content, 0, strlen($string)) == $string;
    }

    /**
     * Whether this script has been parsed or not
     *
     * @return boolean
     */
    public function isParsed()
    {
        return $this->parsed;
    }

    /**
     * Parse this script
     */
    public function parse()
    {
        if ($this->parsed) {
            return;
        }

        if (!$this->isASSScript()) {
            throw new InvalidScriptException($this, 'Content doesn\'t contain "[Script Info]" as the first line');
        }

        $lines = explode("\n", $this->content); // SSA/ASS files are always DOS
        if (count($lines) == 1) {
            throw new InvalidScriptException($this, 'Only one line in the script, probably incorrect line endings.');
        }

        $lineBuffer = [];

        foreach ($lines as $line) {
            if (Block::isBlockHeader($line) && !empty($lineBuffer)) {
                $block = Block::parse($lineBuffer);
                if ($block !== null) {
                    $this->addBlock($block);
                }

                $lineBuffer = [];
            }

            $lineBuffer[] = $line;
        }

        $lastBlock = Block::parse($lineBuffer);
        if ($lastBlock !== null) {
            $this->addBlock($lastBlock);
        }

        $this->parsed = true;
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
     * You can pass either a full block object in which case this will search
     * for a Block with the same ID (not object identity) or you can pass an
     * ID e.g. hasBlock('Script Info').
     *
     * @param Block|string $block
     * @return boolean
     */
    public function hasBlock($block)
    {
        if ($block instanceof Block) {
            return array_key_exists($block->getId(), $this->blocks);
        }

        return array_key_exists($block, $this->blocks);
    }

    /**
     * Get blocks
     *
     * @return Block[] An array of blocks
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * Get a single block
     *
     * @param string $blockId
     * @return Block|null
     */
    public function getBlock($blockId)
    {
        return ($this->hasBlock($blockId)) ? $this->blocks[$blockId] : null;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->blocks);
    }
}
