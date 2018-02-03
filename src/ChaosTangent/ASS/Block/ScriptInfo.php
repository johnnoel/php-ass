<?php

/**
 * This file is part of the ChaosTangent PHP-ASS package
 *
 * (c) John Noel <john.noel@chaostangent.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code
 */

namespace ChaosTangent\ASS\Block;

use ChaosTangent\ASS\Line\Line;
use ChaosTangent\ASS\Exception\UnrecognizedScriptInfoLineException;

/**
 * Script info block
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class ScriptInfo extends Block
{
    const DEFAULT_ID = 'Script Info';

    /** @var string */
    protected $title;
    /** @var string */
    protected $originalScript;
    /** @var string */
    protected $originalTranslation;
    /** @var string */
    protected $originalEditing;
    /** @var string */
    protected $originalTiming;
    /** @var string */
    protected $synchPoint;
    /** @var string */
    protected $scriptUpdatedBy;
    /** @var string */
    protected $updateDetails;
    /** @var string */
    protected $scriptType;
    /** @var string */
    protected $collisions;
    /** @var string */
    protected $playResY;
    /** @var string */
    protected $playResX;
    /** @var string */
    protected $playDepth;
    /** @var string */
    protected $timer;
    /** @var integer */
    protected $wrapStyle;

    protected $lineMapping = [
        'Title' => 'title',
        'Original Script' => 'originalScript',
        'Original Translation' => 'originalTranslation',
        'Original Editing' => 'originalEditing',
        'Original Timing' => 'originalTiming',
        'Synch Point' => 'synchPoint',
        'Script Updated By' => 'scriptUpdatedby',
        'Updated Details' => 'updateDetails',
        'Script Type' => 'scriptType',
        'Collisions' => 'collisions',
        'PlayResY' => 'playResY',
        'PlayResX' => 'playResX',
        'PlayDepth' => 'PlayDepth',
        'Timer' => 'timer',
        'WrapStyle' => 'wrapStyle',
    ];

    public function __construct($id = self::DEFAULT_ID)
    {
        $this->id = $id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return ScriptInfo
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set originalScript
     *
     * @param string $originalScript
     * @return ScriptInfo
     */
    public function setOriginalScript($originalScript)
    {
        $this->originalScript = $originalScript;

        return $this;
    }

    /**
     * Get originalScript
     *
     * @return string
     */
    public function getOriginalScript()
    {
        return $this->originalScript;
    }

    /**
     * Set originalTranslation
     *
     * @param string $originalTranslation
     * @return ScriptInfo
     */
    public function setOriginalTranslation($originalTranslation)
    {
        $this->originalTranslation = $originalTranslation;

        return $this;
    }

    /**
     * Get originalTranslation
     *
     * @return string
     */
    public function getOriginalTranslation()
    {
        return $this->originalTranslation;
    }

    /**
     * Set originalEditing
     *
     * @param string $originalEditing
     * @return ScriptInfo
     */
    public function setOriginalEditing($originalEditing)
    {
        $this->originalEditing = $originalEditing;

        return $this;
    }

    /**
     * Get originalEditing
     *
     * @return string
     */
    public function getOriginalEditing()
    {
        return $this->originalEditing;
    }

    /**
     * Set originalTiming
     *
     * @param string $originalTiming
     * @return ScriptInfo
     */
    public function setOriginalTiming($originalTiming)
    {
        $this->originalTiming = $originalTiming;

        return $this;
    }

    /**
     * Get originalTiming
     *
     * @return string
     */
    public function getOriginalTiming()
    {
        return $this->originalTiming;
    }

    /**
     * Set synchPoint
     *
     * @param string $synchPoint
     * @return ScriptInfo
     */
    public function setSynchPoint($synchPoint)
    {
        $this->synchPoint = $synchPoint;

        return $this;
    }

    /**
     * Get synchPoint
     *
     * @return string
     */
    public function getSynchPoint()
    {
        return $this->synchPoint;
    }

    /**
     * Set scriptUpdatedBy
     *
     * @param string $scriptUpdatedBy
     * @return ScriptInfo
     */
    public function setScriptUpdatedBy($scriptUpdatedBy)
    {
        $this->scriptUpdatedBy = $scriptUpdatedBy;

        return $this;
    }

    /**
     * Get scriptUpdatedBy
     *
     * @return string
     */
    public function getScriptUpdatedBy()
    {
        return $this->scriptUpdatedBy;
    }

    /**
     * Set updateDetails
     *
     * @param string $updateDetails
     * @return ScriptInfo
     */
    public function setUpdateDetails($updateDetails)
    {
        $this->updateDetails = $updateDetails;

        return $this;
    }

    /**
     * Get updateDetails
     *
     * @return string
     */
    public function getUpdateDetails()
    {
        return $this->updateDetails;
    }

    /**
     * Set scriptType
     *
     * @param string $scriptType
     * @return ScriptInfo
     */
    public function setScriptType($scriptType)
    {
        $this->scriptType = $scriptType;

        return $this;
    }

    /**
     * Get scriptType
     *
     * @return string
     */
    public function getScriptType()
    {
        return $this->scriptType;
    }

    /**
     * Set collisions
     *
     * @param string $collisions
     * @return ScriptInfo
     */
    public function setCollisions($collisions)
    {
        $this->collisions = $collisions;

        return $this;
    }

    /**
     * Get collisions
     *
     * @return string
     */
    public function getCollisions()
    {
        return $this->collisions;
    }

    /**
     * Set playResY
     *
     * @param string $playResY
     * @return ScriptInfo
     */
    public function setPlayResY($playResY)
    {
        $this->playResY = $playResY;

        return $this;
    }

    /**
     * Get playResY
     *
     * @return string
     */
    public function getPlayResY()
    {
        return $this->playResY;
    }

    /**
     * Set playResX
     *
     * @param string $playResX
     * @return ScriptInfo
     */
    public function setPlayResX($playResX)
    {
        $this->playResX = $playResX;

        return $this;
    }

    /**
     * Get playResX
     *
     * @return string
     */
    public function getPlayResX()
    {
        return $this->playResX;
    }

    /**
     * Set playDepth
     *
     * @param string $playDepth
     * @return ScriptInfo
     */
    public function setPlayDepth($playDepth)
    {
        $this->playDepth = $playDepth;

        return $this;
    }

    /**
     * Get playDepth
     *
     * @return string
     */
    public function getPlayDepth()
    {
        return $this->playDepth;
    }

    /**
     * Set timer
     *
     * @param string $timer
     * @return ScriptInfo
     */
    public function setTimer($timer)
    {
        $this->timer = $timer;

        return $this;
    }

    /**
     * Get timer
     *
     * @return string
     */
    public function getTimer()
    {
        return $this->timer;
    }

    /**
     * Set wrapStyle
     *
     * @param integer $wrapStyle
     * @return ScriptInfo
     */
    public function setWrapStyle($wrapStyle)
    {
        $this->wrapStyle = $wrapStyle;

        return $this;
    }

    /**
     * Get wrapStyle
     *
     * @return integer
     */
    public function getWrapStyle()
    {
        return $this->wrapStyle;
    }

    /**
     * {@inheritDoc}
     */
    protected function doParse(array $lines)
    {
        foreach ($lines as $rawLine) {
            $line = Line::parse($rawLine);

            if ($line === null) {
                continue;
            }

            if ($line->getKey() !== null && array_key_exists($line->getKey(), $this->lineMapping)) {
                $var = $this->lineMapping[$line->getKey()];
                $this->$var = $line->getValue();
            }

            $this->lines[] = $line;
        }
    }
}
