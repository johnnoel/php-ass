<?php

namespace ChaosTangent\ASS;

use ChaosTangent\ASS\Exception\InvalidScriptException;
use ChaosTangent\ASS\Line\Format;

/**
 * Advanced Sub Station Alpha file reader
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Writer
{
    const VERSION = '1.0.0';

    public function toFile($filename, Script $script)
    {
        if (!file_exists($filename) || !is_writable($filename)) {
            throw new \InvalidArgumentException('Unable to write file: '.$filename);
        }

        file_put_contents($filename, $this->toString($script));
    }

    public function toString(Script $script)
    {
        $string = '';

        foreach($script->getBlocks() as $block) {
            $string .= sprintf("[%s]\n", $block->getId());
            foreach($block->getLines() as $line) {
                $mapping = [];
                if ($line instanceof Format) {
                    $mapping = $line->getMapping();
                }
                $value = $line->toString($mapping);
                $string .= sprintf("%s\n", $value);
            }
        }

        return $string;
    }
}
