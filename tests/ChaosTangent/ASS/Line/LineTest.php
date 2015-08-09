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

        $validFull = 'Dialogue: 6,0:00:00.00,0:00:00.00,Style name,,0,0,0,,';

        $dialogue = Line::parse($validFull, $mapping);

        $this->assertInstanceOf(Dialogue::class, $dialogue);
        $this->assertEquals(6, $dialogue->getLayer());
    }

    public function testTextViews()
    {
        $format = 'Format: Layer, Start, End, Style, Name, MarginL, MarginR, MarginV, Effect, Text';
        $formatLine = Line::parse($format);
        $mapping = $formatLine->getMapping();

        $withCodesAndComments = 'Dialogue: 10,0:08:45.51,0:08:48.01,GJ-01,Mao,0,0,0,,{Rub a dub dub~ }{\move(563,35,563,25,0,100)}Thanks for the grub!{Why is she eating all the fried rice first?!}';

        $dialogue = Line::parse($withCodesAndComments, $mapping);

        $this->assertInstanceOf(Dialogue::class, $dialogue);
        $this->assertEquals('{Rub a dub dub~ }{\move(563,35,563,25,0,100)}Thanks for the grub!{Why is she eating all the fried rice first?!}', $dialogue->getText());
        $this->assertEquals('{Rub a dub dub~ }Thanks for the grub!{Why is she eating all the fried rice first?!}', $dialogue->getTextWithoutStyleOverrides());
        $this->assertEquals('Thanks for the grub!', $dialogue->getVisibleText());
    }
}
