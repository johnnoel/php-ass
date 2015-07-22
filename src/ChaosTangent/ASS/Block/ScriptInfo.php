<?php

namespace ChaosTangent\ASS\Block;

use ChaosTangent\ASS\Exception\UnrecognizedScriptInfoLineException;

/**
 * Script info block
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class ScriptInfo extends Block
{
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

    /**
     * {@inheritDoc}
     */
    protected function doParse(array $lines)
    {
        foreach ($lines as $line) {
            $parsed = $this->parseLine($line);
            if ($parsed === null) {
                continue;
            }

            list($key, $value) = $parsed;

            if (!array_key_exists($key, $this->lineMapping)) {
                throw new UnrecognisedHeaderLineException($line);
            }

            $var = $this->lineMapped[$key];
            $this->$var = $value;
        }
    }

    /**
     * Parse an individual line in the format "Key with spaces": "Value"
     *
     * @param string $line
     * @return array|null An array with [0] as the line key and [1] as the
     *                    value
     */
    protected function parseLine($line)
    {
        // comment, do nothing
        if (substr($line, 0, 1) == ';') {
            return null;
        }

        $matches = [];
        if (preg_match('/^([^:]+):\s*(.*)$/', trim($line), $matches) !== 1) {
            return null;
        }

        return [ $matches[1], $matches[2] ];
    }
}
