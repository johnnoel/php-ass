<?php

namespace ChaosTangent\ASS;

/**
 * Parseable interface
 *
 * Defines whether an object is able to parse a plain string representation
 * of itself
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
interface Parseable
{
    public function parse($content);
}
