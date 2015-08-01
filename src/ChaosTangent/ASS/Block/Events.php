<?php

namespace ChaosTangent\ASS\Block;

/**
 * Events block
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Events extends MappedBlock
{
    const DEFAULT_ID = 'Events';

    public function __construct($id = self::DEFAULT_ID)
    {
        $this->id = $id;
    }
}
