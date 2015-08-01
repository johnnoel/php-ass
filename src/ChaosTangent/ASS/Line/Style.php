<?php

namespace ChaosTangent\ASS\Line;

/**
 * Style line
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Style extends MappedLine
{
    // ASS mapping names
    const NAME = 'Name';
    const FONT_NAME = 'Fontname';
    const FONT_SIZE = 'Fontsize';
    const PRIMARY_COLOUR = 'PrimaryColour';
    const SECONDARY_COLOUR = 'SecondaryColour';
    const OUTLINE_COLOUR = 'OutlineColour';
    const BACK_COLOUR = 'BackColour';
    const BOLD = 'Bold';
    const ITALIC = 'Italic';
    const UNDERLINE = 'Underline';
    const STRIKE_OUT = 'StrikeOut';
    const SCALE_X = 'ScaleX';
    const SCALE_Y = 'ScaleY';
    const SPACING = 'Spacing';
    const ANGLE = 'Angle';
    const BORDER_STYLE = 'BorderStyle';
    const OUTLINE = 'Outline';
    const SHADOW = 'Shadow';
    const ALIGNMENT = 'Alignment';
    const MARGIN_L = 'MarginL';
    const MARGIN_R = 'MarginR';
    const MARGIN_V = 'MarginV';
    const ALPHA_LEVEL = 'AlphaLevel';
    const ENCODING = 'Encoding';

    /** @var string */
    protected $name;
    /** @var string */
    protected $fontname;
    /** @var string */
    protected $fontsize;
    /** @var integer */
    protected $primaryColour;
    /** @var integer */
    protected $secondaryColour;
    /** @var integer */
    protected $outlineColour;
    /** @var integer */
    protected $backColour;
    /** @var boolean */
    protected $bold;
    /** @var boolean */
    protected $italic;
    /** @var boolean */
    protected $underline;
    /** @var boolean */
    protected $strikeOut;
    /** @var float */
    protected $scaleX;
    /** @var float */
    protected $scaleY;
    /** @var integer */
    protected $spacing;
    /** @var float */
    protected $angle;
    /** @var integer */
    protected $borderStyle;
    /** @var integer */
    protected $outline;
    /** @var integer */
    protected $shadow;
    /** @var integer */
    protected $alignment;
    /** @var integer */
    protected $marginL;
    /** @var integer */
    protected $marginR;
    /** @var integer */
    protected $marginV;
    /** @var integer */
    protected $alphaLevel;
    /** @var string */
    protected $encoding;

    /**
     * Set name
     *
     * @param string $name
     * @return Style
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
     * Set fontname
     *
     * @param string $fontname
     * @return Style
     */
    public function setFontName($fontname)
    {
        $this->fontname = $fontname;

        return $this;
    }

    /**
     * Get fontname
     *
     * @return string
     */
    public function getFontName()
    {
        return $this->fontname;
    }

    /**
     * Set fontsize
     *
     * @param string $fontsize
     * @return Style
     */
    public function setFontSize($fontsize)
    {
        $this->fontsize = $fontsize;

        return $this;
    }

    /**
     * Get fontsize
     *
     * @return string
     */
    public function getFontSize()
    {
        return $this->fontsize;
    }

    /**
     * Set primaryColour
     *
     * @param integer $primaryColour
     * @return Style
     */
    public function setPrimaryColour($primaryColour)
    {
        $this->primaryColour = $primaryColour;

        return $this;
    }

    /**
     * Get primaryColour
     *
     * @return integer
     */
    public function getPrimaryColour()
    {
        return $this->primaryColour;
    }

    /**
     * Set secondaryColour
     *
     * @param integer $secondaryColour
     * @return Style
     */
    public function setSecondaryColour($secondaryColour)
    {
        $this->secondaryColour = $secondaryColour;

        return $this;
    }

    /**
     * Get secondaryColour
     *
     * @return integer
     */
    public function getSecondaryColour()
    {
        return $this->secondaryColour;
    }

    /**
     * Set outlineColour
     *
     * @param integer $outlineColour
     * @return Style
     */
    public function setOutlineColour($outlineColour)
    {
        $this->outlineColour = $outlineColour;

        return $this;
    }

    /**
     * Get outlineColour
     *
     * @return integer
     */
    public function getOutlineColour()
    {
        return $this->outlineColour;
    }

    /**
     * Set backColour
     *
     * @param integer $backColour
     * @return Style
     */
    public function setBackColour($backColour)
    {
        $this->backColour = $backColour;

        return $this;
    }

    /**
     * Get backColour
     *
     * @return integer
     */
    public function getBackColour()
    {
        return $this->backColour;
    }

    /**
     * Set bold
     *
     * @param boolean $bold
     * @return Style
     */
    public function setBold($bold)
    {
        $this->bold = $bold;

        return $this;
    }

    /**
     * Get bold
     *
     * @return boolean
     */
    public function getBold()
    {
        return $this->bold;
    }

    /**
     * Set italic
     *
     * @param boolean $italic
     * @return Style
     */
    public function setItalic($italic)
    {
        $this->italic = $italic;

        return $this;
    }

    /**
     * Get italic
     *
     * @return boolean
     */
    public function getItalic()
    {
        return $this->italic;
    }

    /**
     * Set underline
     *
     * @param boolean $underline
     * @return Style
     */
    public function setUnderline($underline)
    {
        $this->underline = $underline;

        return $this;
    }

    /**
     * Get underline
     *
     * @return boolean
     */
    public function getUnderline()
    {
        return $this->underline;
    }

    /**
     * Set strikeOut
     *
     * @param boolean $strikeOut
     * @return Style
     */
    public function setStrikeOut($strikeOut)
    {
        $this->strikeOut = $strikeOut;

        return $this;
    }

    /**
     * Get strikeOut
     *
     * @return boolean
     */
    public function getStrikeOut()
    {
        return $this->strikeOut;
    }

    /**
     * Set scaleX
     *
     * @param float $scaleX
     * @return Style
     */
    public function setScaleX($scaleX)
    {
        $this->scaleX = $scaleX;

        return $this;
    }

    /**
     * Get scaleX
     *
     * @return float
     */
    public function getScaleX()
    {
        return $this->scaleX;
    }

    /**
     * Set scaleY
     *
     * @param float $scaleY
     * @return Style
     */
    public function setScaleY($scaleY)
    {
        $this->scaleY = $scaleY;

        return $this;
    }

    /**
     * Get scaleY
     *
     * @return float
     */
    public function getScaleY()
    {
        return $this->scaleY;
    }

    /**
     * Set spacing
     *
     * @param integer $spacing
     * @return Style
     */
    public function setSpacing($spacing)
    {
        $this->spacing = $spacing;

        return $this;
    }

    /**
     * Get spacing
     *
     * @return integer
     */
    public function getSpacing()
    {
        return $this->spacing;
    }

    /**
     * Set angle
     *
     * @param float $angle
     * @return Style
     */
    public function setAngle($angle)
    {
        $this->angle = $angle;

        return $this;
    }

    /**
     * Get angle
     *
     * @return float
     */
    public function getAngle()
    {
        return $this->angle;
    }

    /**
     * Set borderStyle
     *
     * @param integer $borderStyle
     * @return Style
     */
    public function setBorderStyle($borderStyle)
    {
        $this->borderStyle = $borderStyle;

        return $this;
    }

    /**
     * Get borderStyle
     *
     * @return integer
     */
    public function getBorderStyle()
    {
        return $this->borderStyle;
    }

    /**
     * Set outline
     *
     * @param integer $outline
     * @return Style
     */
    public function setOutline($outline)
    {
        $this->outline = $outline;

        return $this;
    }

    /**
     * Get outline
     *
     * @return integer
     */
    public function getOutline()
    {
        return $this->outline;
    }

    /**
     * Set shadow
     *
     * @param integer $shadow
     * @return Style
     */
    public function setShadow($shadow)
    {
        $this->shadow = $shadow;

        return $this;
    }

    /**
     * Get shadow
     *
     * @return integer
     */
    public function getShadow()
    {
        return $this->shadow;
    }

    /**
     * Set alignment
     *
     * @param integer $alignment
     * @return Style
     */
    public function setAlignment($alignment)
    {
        $this->alignment = $alignment;

        return $this;
    }

    /**
     * Get alignment
     *
     * @return integer
     */
    public function getAlignment()
    {
        return $this->alignment;
    }

    /**
     * Set marginL
     *
     * @param integer $marginL
     * @return Style
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
     * @return Style
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
     * @return Style
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
     * Set alphaLevel
     *
     * @param integer $alphaLevel
     * @return Style
     */
    public function setAlphaLevel($alphaLevel)
    {
        $this->alphaLevel = $alphaLevel;

        return $this;
    }

    /**
     * Get alphaLevel
     *
     * @return integer
     */
    public function getAlphaLevel()
    {
        return $this->alphaLevel;
    }

    /**
     * Set encoding
     *
     * @param string $encoding
     * @return Style
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Get encoding
     *
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * {@inheritDoc}
     */
    protected function getMapping()
    {
        return [
            self::NAME => 'name',
            self::FONT_NAME => 'fontname',
            self::FONT_SIZE => 'fontsize',
            self::PRIMARY_COLOUR => 'primaryColour',
            self::SECONDARY_COLOUR => 'secondaryColour',
            self::OUTLINE_COLOUR => 'outlineColour',
            self::BACK_COLOUR => 'backColour',
            self::BOLD => 'bold',
            self::ITALIC => 'italic',
            self::UNDERLINE => 'underline',
            self::STRIKE_OUT => 'strikeOut',
            self::SCALE_X => 'scaleX',
            self::SCALE_Y => 'scaleY',
            self::SPACING => 'spacing',
            self::ANGLE => 'angle',
            self::BORDER_STYLE => 'borderStyle',
            self::OUTLINE => 'outline',
            self::SHADOW => 'shadow',
            self::ALIGNMENT => 'alignment',
            self::MARGIN_L => 'marginL',
            self::MARGIN_R => 'marginR',
            self::MARGIN_V => 'marginV',
            self::ALPHA_LEVEL => 'alphaLevel',
            self::ENCODING => 'encoding',
        ];
    }
}
