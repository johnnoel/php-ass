<?php

use ChaosTangent\ASS\Script;
use ChaosTangent\ASS\Exception\InvalidScriptException;
use ChaosTangent\ASS\Block\ScriptInfo;

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
}
