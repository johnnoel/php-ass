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

        // from [EveTaku] GJ-bu - 06 (1280x720 x264-Hi10P AAC)[149728D7].mkv
        $withCodesAndComments = 'Dialogue: 10,0:08:45.51,0:08:48.01,GJ-01,Mao,0,0,0,,{Rub a dub dub~ }{\move(563,35,563,25,0,100)}Thanks for the grub!{Why is she eating all the fried rice first?!}';

        $dialogue = Line::parse($withCodesAndComments, $mapping);

        $this->assertInstanceOf(Dialogue::class, $dialogue);
        $this->assertEquals('{Rub a dub dub~ }{\move(563,35,563,25,0,100)}Thanks for the grub!{Why is she eating all the fried rice first?!}', $dialogue->getText());
        $this->assertEquals('{Rub a dub dub~ }Thanks for the grub!{Why is she eating all the fried rice first?!}', $dialogue->getTextWithoutStyleOverrides());
        $this->assertEquals('Thanks for the grub!', $dialogue->getVisibleText());
    }

    public function testDrawingCommandRemoval()
    {
        $format = 'Format: Layer, Start, End, Style, Name, MarginL, MarginR, MarginV, Effect, Text';
        $formatLine = Line::parse($format);
        $mapping = $formatLine->getMapping();

        // from [Tsumiki] Acchi Kocchi - 08 [10bit][1280x720][BC532625].mkv
        $drawingWithEnd = 'Dialogue: 0,0:16:49.15,0:16:52.49,TS2,,0,0,0,,{\an5\p1\c&HFDFDFD&\blur0.5\pos(512.674,156.653)}m 0 0 l 84 15 l 141 -1 l 166 -37 l 167 -126 l -37 -122 l -38 -62 {\p0}';
        $drawingNoEnd = 'Dialogue: 0,0:00:16.53,0:00:19.66,TS2,,0,0,0,,{\p1\fscx215\fscy200\c&HF2F2F2&\pos(837.667,459.334)}m 101 70 b 112 58 145 57 165 70 b 170 73 175 75 181 71 b 185 63 189 63 192 63 b 196 70 198 88 194 91 b 182 99 114 112 101 97 b 96 87 96 79 101 70';
        $drawingAlsoText = 'Dialogue: 0,0:00:16.53,0:00:19.66,TS2,,0,0,0,,{\p1\fscx215\fscy200\c&HF2F2F2&\pos(837.667,459.334)}m 101 70 b 112 58 145 57 165 70 b 170 {\p0}Visible text';
        $drawingTextAndCodes = 'Dialogue: 0,0:00:16.53,0:00:19.66,TS2,,0,0,0,,{\p1\fscx215\fscy200\c&HF2F2F2&\pos(837.667,459.334)}m 101 70 b 112 58 145 57 165 70 b 170 {\p0}Visible {\i1}text{\i0}';

        $dialogue1 = Line::parse($drawingWithEnd, $mapping);
        $this->assertInstanceOf(Dialogue::class, $dialogue1);
        $this->assertEmpty($dialogue1->getVisibleText());

        $dialogue2 = Line::parse($drawingNoEnd, $mapping);
        $this->assertInstanceOf(Dialogue::class, $dialogue2);
        $this->assertEmpty($dialogue2->getVisibleText());

        $dialogue3 = Line::parse($drawingAlsoText, $mapping);
        $this->assertInstanceOf(Dialogue::class, $dialogue3);
        $this->assertEquals('Visible text', $dialogue3->getVisibleText());

        $dialogue4 = Line::parse($drawingTextAndCodes, $mapping);
        $this->assertInstanceOf(Dialogue::class, $dialogue4);
        $this->assertEquals('Visible text', $dialogue4->getVisibleText());
    }

    public function testTimecodeParsing()
    {
        $this->assertEquals(3723.45, Line::parseTimecodeIntoSeconds('01:02:03.45'));
        $this->assertEquals(62.34, Line::parseTimecodeIntoSeconds('01:02.34'));
        $this->assertEquals(1.23, Line::parseTimecodeIntoSeconds('01.23'));
        $this->assertEquals(0, Line::parseTimecodeIntoSeconds('invalid'));
        $this->assertEquals(0, Line::parseTimecodeIntoSeconds('a:b:c'));
    }
}
