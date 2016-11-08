<?php

use ChaosTangent\ASS\Reader;
use ChaosTangent\ASS\Script;
use ChaosTangent\ASS\Exception\InvalidScriptException;
use ChaosTangent\ASS\Block\ScriptInfo;
use ChaosTangent\ASS\Writer;

/**
 * Script test
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class ScriptTest extends PHPUnit_Framework_TestCase
{
    public function testParseValid()
    {
        $scriptDir = __DIR__.'/../../scripts/';
        $scripts = [ 'minimal.ass', 'small.ass', 'large.ass' ];

        foreach ($scripts as $scriptName) {
            $content = file_get_contents($scriptDir.$scriptName);
            $script = new Script($content, $scriptName);
            $script->parse();

            $this->assertTrue($script->isParsed());
        }
    }

    public function testParseUTF8()
    {
        $scriptPath = __DIR__.'/../../scripts/utf8.ass';
        $content = file_get_contents($scriptPath);
        $script = new Script($content, basename($scriptPath));
        $script->parse();

        $this->assertTrue($script->hasBlock('Events'));
        $this->assertCount(3, $script->getBlocks());
        $this->assertCount(371, $script->getBlock('Events')->getLines());
    }

    /**
     * @expectedException ChaosTangent\ASS\Exception\InvalidScriptException
     */
    public function testParseMalformed1()
    {
        $scriptPath = __DIR__.'/../../scripts/malformed1.ass';
        $content = file_get_contents($scriptPath);
        $script = new Script($content, basename($scriptPath));
        $script->parse();
    }

    /**
     * @expectedException ChaosTangent\ASS\Exception\InvalidScriptException
     */
    public function testParseMalformed2()
    {
        $scriptPath = __DIR__.'/../../scripts/malformed2.ass';
        $content = file_get_contents($scriptPath);
        $script = new Script($content, basename($scriptPath));
        $script->parse();
    }

    /**
     * @expectedException ChaosTangent\ASS\Exception\InvalidScriptException
     */
    public function testParseEmpty()
    {
        $scriptPath = __DIR__.'/../../scripts/empty.ass';
        $content = file_get_contents($scriptPath);
        $script = new Script($content, basename($scriptPath));
        $script->parse();
    }

    public function testParseFlag()
    {
        $scriptPath = __DIR__.'/../../scripts/minimal.ass';
        $content = file_get_contents($scriptPath);

        $script = new Script($content, basename($scriptPath));

        $this->assertFalse($script->isParsed());
        $script->parse();
        $this->assertTrue($script->isParsed());
    }

    public function testAddBlock()
    {
        $script = new Script('');
        $block = new ScriptInfo();

        $script->addBlock($block);
        $this->assertTrue($script->hasBlock($block));
        $this->assertTrue($script->hasBlock(ScriptInfo::DEFAULT_ID));

        $blocks = $script->getBlocks();
        $this->assertContains($block, $blocks);
        $this->assertEquals($block, $script->getBlock($block->getId()));
    }

    public function testRemoveBlock()
    {
        $script = new Script('');
        $block = new ScriptInfo();

        $script->addBlock($block);
        $this->assertTrue($script->hasBlock($block));

        $script->removeBlock($block);
        $this->assertFalse($script->hasBlock($block));

        $blocks = $script->getBlocks();
        $this->assertNotContains($block, $blocks);
    }

    public function testIterator()
    {
        $script = new Script('');
        $block = new ScriptInfo();

        $script->addBlock($block);

        $this->assertContains($block, $script);
    }

    /**
     * @dataProvider scriptFiles
     */
    public function testReadWrite($file, $expectedResultFile)
    {
        $outputPath = __DIR__.'/../../scripts/'.$expectedResultFile;
        $expectedContent = file_get_contents($outputPath);

        $reader = new Reader();
        $script = $reader->fromFile(__DIR__.'/../../scripts/'.$file);

        $writer = new Writer();
        $newcontent = $writer->toString($script);

        /*
         * Expected output is not exactly the same as input, since we remove
         * irrelevant information from the file (e.g. extra line feeds, comments and
         * code that might've been added by editors).
         */
        $this->assertEquals($expectedContent, $newcontent);
    }

    public function scriptFiles() {
        return [
            [ 'utf8.ass', 'utf8_output.ass' ],
            [ 'small.ass', 'small_output.ass' ],
            [ 'minimal.ass', 'minimal_output.ass' ]
        ];
    }
}
