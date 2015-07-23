<?php

namespace ChaosTangent\ASS\Block;

/**
 * Styles block
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Styles extends MappedBlock
{
    const DEFAULT_ID = 'V4+ Styles';

    public function __construct($id = self::DEFAULT_ID)
    {
        $this->id = $id;
    }
}
