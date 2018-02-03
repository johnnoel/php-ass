<?php

/**
 * This file is part of the ChaosTangent PHP-ASS package
 *
 * (c) John Noel <john.noel@chaostangent.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code
 */

namespace ChaosTangent\ASS;

use ChaosTangent\ASS\Exception\InvalidScriptException;

/**
 * Advanced Sub Station Alpha file reader
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Reader
{
    const VERSION = '1.0.0';

    public function fromFile($filename)
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            throw new \InvalidArgumentException('Unable to read file: '.$filename);
        }

        $script = new Script(file_get_contents($filename), basename($filename));
        if (!$script->isASSScript()) {
            throw new InvalidScriptException($script, 'Passed file does not look like a script');
        }

        $script->parse();
        return $script;
    }

    public function fromString($string)
    {
        $script = new Script($string);
        if (!$script->isASSScript()) {
            throw new InvalidScriptException($script, 'Passed string does not look like a script');
        }

        $script->parse();
        return $script;
    }
}
