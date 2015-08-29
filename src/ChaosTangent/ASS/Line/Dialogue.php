<?php

namespace ChaosTangent\ASS\Line;

/**
 * Dialogue line
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Dialogue extends MappedLine
{
    const MARKED = 'Marked';
    const LAYER = 'Layer';
    const START = 'Start';
    const END = 'End';
    const STYLE = 'Style';
    const NAME = 'Name';
    const MARGIN_L = 'MarginL';
    const MARGIN_R = 'MarginR';
    const MARGIN_V = 'MarginV';
    const EFFECT = 'Effect';
    const TEXT = 'Text';

    /** @var boolean */
    protected $marked;
    /** @var integer */
    protected $layer;
    /** @var string */
    protected $start;
    /** @var float */
    protected $startAsSeconds;
    /** @var string */
    protected $end;
    /** @var float */
    protected $endAsSeconds;
    /** @var string */
    protected $style;
    /** @var string */
    protected $name;
    /** @var integer */
    protected $marginL;
    /** @var integer */
    protected $marginR;
    /** @var integer */
    protected $marginV;
    /** @var string */
    protected $effect;
    /** @var string */
    protected $text;

    /**
     * Set marked
     *
     * @param boolean $marked
     * @return Dialogue
     */
    public function setMarked($marked)
    {
        $this->marked = $marked;

        return $this;
    }

    /**
     * Get marked
     *
     * @return boolean
     */
    public function getMarked()
    {
        return $this->marked;
    }

    /**
     * Set layer
     *
     * @param integer $layer
     * @return Dialogue
     */
    public function setLayer($layer)
    {
        $this->layer = $layer;

        return $this;
    }

    /**
     * Get layer
     *
     * @return integer
     */
    public function getLayer()
    {
        return $this->layer;
    }

    /**
     * Set start
     *
     * @param string $start
     * @return Dialogue
     */
    public function setStart($start)
    {
        $this->start = $start;
        $this->startAsSeconds = null;

        return $this;
    }

    /**
     * Get start
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the start value as seconds from 0
     *
     * @return float
     */
    public function getStartAsSeconds()
    {
        if ($this->startAsSeconds === null) {
            $this->startAsSeconds = self::parseTimecodeIntoSeconds($this->start);
        }

        return $this->startAsSeconds;
    }

    /**
     * Set end
     *
     * @param string $end
     * @return Dialogue
     */
    public function setEnd($end)
    {
        $this->end = $end;
        $this->endAsSeconds = null;

        return $this;
    }

    /**
     * Get end
     *
     * @return string
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Get the end value as seconds from 0
     *
     * @return float
     */
    public function getEndAsSeconds()
    {
        if ($this->endAsSeconds === null) {
            $this->endAsSeconds = self::parseTimecodeIntoSeconds($this->end);
        }

        return $this->endAsSeconds;
    }

    /**
     * Set stye
     *
     * @param string $stye
     * @return Dialogue
     */
    public function setStyle($stye)
    {
        $this->stye = $stye;

        return $this;
    }

    /**
     * Get stye
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->stye;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Dialogue
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set marginL
     *
     * @param integer $marginL
     * @return Dialogue
     */
    public function setMarginL($marginL)
    {
        $this->marginL = $marginL;

        return $this;
    }

    /**
     * Get marginL
     *
     * @return integer
     */
    public function getMarginL()
    {
        return $this->marginL;
    }

    /**
     * Set marginR
     *
     * @param integer $marginR
     * @return Dialogue
     */
    public function setMarginR($marginR)
    {
        $this->marginR = $marginR;

        return $this;
    }

    /**
     * Get marginR
     *
     * @return integer
     */
    public function getMarginR()
    {
        return $this->marginR;
    }

    /**
     * Set marginV
     *
     * @param integer $marginV
     * @return Dialogue
     */
    public function setMarginV($marginV)
    {
        $this->marginV = $marginV;

        return $this;
    }

    /**
     * Get marginV
     *
     * @return integer
     */
    public function getMarginV()
    {
        return $this->marginV;
    }

    /**
     * Set effect
     *
     * @param string $effect
     * @return Dialogue
     */
    public function setEffect($effect)
    {
        $this->effect = $effect;

        return $this;
    }

    /**
     * Get effect
     *
     * @return string
     */
    public function getEffect()
    {
        return $this->effect;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Dialogue
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Gets text but without any style overrides in it
     *
     * E.g. "{\fad(100,200)\blur5\c&H000010&\3c&H80A0C0&}My destiny" will
     * become "My destiny"
     *
     * @return string
     */
    public function getTextWithoutStyleOverrides()
    {
        return preg_replace('/\{\\\[^\}]+\}/', '', $this->text);
    }

    /**
     * Gets only "visible" text
     *
     * Unlike "getTextWithoutStyle" overrides this will remove ANY text
     * within curly braces. This is because most subtitle renderers do that and
     * script authors tend to leave comments in curly braces. This deviates
     * from what the original spec says in that all style override codes begin
     * with a backslash \ meaning anything within braces without a preceding
     * slash isn't an override
     *
     * E.g. "{Rub a dub dub~ }Thanks for the grub!{Why is she eating all the
     * fried rice first?!}" is only shown as "Thanks for the grub!"
     *
     * This will also remove drawing commands which is set via "mode" switch
     *
     * E.g "{\an5\p1\c&HFDFDFD&\blur0.5\pos(512.674,156.653)}m 0 0 l 84 15 l
     * 141 -1 l 166 -37 l 167 -126 l -37 -122 l -38 -62 {\p0}"
     *
     * This will also transform any \n and \N values into linebreaks, it is up
     * to the renderer (if any) how to display these breaks depending on the
     * ScriptInfo block's WrapStyle parameter
     *
     * @see ChaosTangent\ASS\Line\Dialogue::getTextWithoutStyleOverrides()
     * @return string
     */
    public function getVisibleText()
    {
        $matches = [];
        $text = $this->text;

        // does this line contain a drawing command style override? If so:
        if (preg_match('/\{[^\}]*\\\p(\d+)(\\\[^\}]+\}|\})/', $text, $matches) === 1) {
            // replace all of the drawing command
            // a drawing command either ends at the end of the line or at {\p0}
            $text = preg_replace('/\{[^\}]*\\\p\d+(\\\[^\}]+\}|\}).*?($|\{\\\p0\})/', '', $text);
        }

        // replace new line indicators
        $text = preg_replace('/\\\n|\\\N/', "\n", $text);

        // then replace any remaining command code or comments
        return preg_replace('/\{[^\}]+\}/', '', $text);
    }

    /**
     * {@inheritDoc}
     */
    protected function getMapping()
    {
        return [
            self::MARKED => 'marked',
            self::LAYER => 'layer',
            self::START => 'start',
            self::END => 'end',
            self::STYLE => 'style',
            self::NAME => 'name',
            self::MARGIN_L => 'marginL',
            self::MARGIN_R => 'marginR',
            self::MARGIN_V => 'marginV',
            self::EFFECT => 'effect',
            self::TEXT => 'text',
        ];
    }
}
