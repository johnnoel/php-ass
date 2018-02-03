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
use ChaosTangent\ASS\Exception\InvalidBlockException;

/**
 * Mapped block
 *
 * A block that is defined entirely by a "format" line and a series of lines
 * that are mapped using that format. Examples are [V4+ Styles] and [Events]
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
abstract class MappedBlock extends Block
{
    /**
     * {@inheritDoc}
     */
    protected function doParse(array $lines)
    {
        $format = null;

        // find formatting line
        // spec says it must appear before any other lines in the section
        foreach ($lines as $rawLine) {
            if (Line::isFormatLine($rawLine)) {
                $format = Line::parse($rawLine);
                $this->lines[] = $format;
                break;
            }
        }

        if ($format === null) {
            throw new InvalidBlockException($this, 'No valid format line found in block');
        }

        foreach ($lines as $rawLine) {
            if (Line::isFormatLine($rawLine)) {
                continue;
            }

            $line = Line::parse($rawLine, $format->getMapping());

            if ($line !== null) {
                $this->lines[] = $line;
            }
        }
    }
}
