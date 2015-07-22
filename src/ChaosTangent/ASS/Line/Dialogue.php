<?php

namespace ChaosTangent\ASS\Line;

/**
 * Dialogue line
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Dialogue extends Line
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
    /** @var string */
    protected $end;
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

    /** @var array */
    protected $mapping = [
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
     * Set end
     *
     * @param string $end
     * @return Dialogue
     */
    public function setEnd($end)
    {
        $this->end = $end;

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
}
