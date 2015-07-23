<?php

use ChaosTangent\ASS\Line\Line,
    ChaosTangent\ASS\Line\Format,
    ChaosTangent\ASS\Line\Dialogue,
    ChaosTangent\ASS\Line\Style;

/**
 * Line test
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class LineTest extends PHPUnit_Framework_TestCase
{
    public function testIsFormatLine()
    {
        $this->assertTrue(Line::isFormatLine('Format: Name'));
        $this->assertTrue(Line::isFormatLine('Format:      Multiple spaces'));
        $this->assertFalse(Line::isFormatLine('Not format line'));
        $this->assertFalse(Line::isFormatLine(' Format: Leading space'));
        $this->assertFalse(Line::isFormatLine('Fermat: Mispelled'));
        $this->assertFalse(Line::isFormatLine(''));
    }

    public function testParseFormat()
    {
        $validFull = 'Format: Layer, Start, End, Style, Name, MarginL, MarginR, MarginV, Effect, Text';
        $validMinimal = 'Format: ';
        $invalid = 'Not a comment, just a random line';
        $empty = '';

        $this->assertNull(Line::parse($invalid));
        $this->assertNull(Line::parse($empty));
        $this->assertInstanceOf(Format::class, Line::parse($validFull));
        $this->assertInstanceOf(Format::class, Line::parse($validMinimal));
    }

    public function testParseDialogue()
    {
        $validFull = 'Dialogue: 0,0:00:00.00,0:00:00.00,Style name,,0,0,0,,';
        $validMinimal = 'Dialogue: ';
        $invalid = 'Not Dialogue';
        $empty = '';

        $this->assertNull(Line::parse($invalid));
        $this->assertNull(Line::parse($empty));
        $this->assertInstanceOf(Dialogue::class, Line::parse($validFull));
        $this->assertInstanceOf(Dialogue::class, Line::parse($validMinimal));
    }

    public function testParseDialogueWithFormat()
    {
        $format = 'Format: Layer, Start, End, Style, Name, MarginL, MarginR, MarginV, Effect, Text';
        $formatLine = Line::parse($format);
        $mapping = $formatLine->getMapping();

        $validFull = 'Dialogue: 0,0:00:00.00,0:00:00.00,Style name,,0,0,0,,';

        $dialogue = Line::parse($validFull, $mapping);

        $this->assertInstanceOf(Dialogue::class, $dialogue);
        $this->assertEquals(0, $dialogue->getLayer());
    }
}
