<?php

use ChaosTangent\ASS\Block\Block,
    ChaosTangent\ASS\Block\ScriptInfo;
use ChaosTangent\ASS\Line\Line;

/**
 * Block test
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class BlockTest extends PHPUnit_Framework_TestCase
{
    public function testIsBlockHeader()
    {
        $this->assertFalse(Block::isBlockHeader(''));
        $this->assertFalse(Block::isBlockHeader('string string'));
        $this->assertFalse(Block::isBlockHeader('[unclosed'));
        $this->assertFalse(Block::isBlockHeader('unopened]'));
        $this->assertTrue(Block::isBlockHeader('[valid]'));
        $this->assertTrue(Block::isBlockHeader('[valid with spaces]'));
    }

    public function testAddLine()
    {
        $block = new ScriptInfo();
        $line1 = new Line();
        $line2 = new Line();

        $block->addLine($line1);
        $block->addLine($line2);
        $lines = $block->getLines();

        $this->assertCount(2, $lines);
        $this->assertTrue($lines[0] === $line1);
        $this->assertTrue($lines[1] === $line2);
    }

    public function testRemoveLine()
    {
        $block = new ScriptInfo();
        $line1 = new Line();
        $line2 = new Line();

        $block->addLine($line1);
        $block->addLine($line2);
        $lines = $block->getLines();

        $this->assertCount(2, $lines);

        $block->removeLine($line1);
        $lines = $block->getLines();

        $this->assertCount(1, $lines);
        $this->assertContains($line2, $lines);
        $this->assertNotContains($line1, $lines);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidArrayAccess()
    {
        $block = new ScriptInfo();
        $block[] = 'not a line object';
    }

    public function testArrayAccess()
    {
        $block = new ScriptInfo();
        $line = new Line();

        $block[] = $line;
        $this->assertContains($line, $block);
        $this->assertTrue($block[0] === $line);

        unset($block[0]);
        $this->assertNotContains($line, $block);
    }
}
