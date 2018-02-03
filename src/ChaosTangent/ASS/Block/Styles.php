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
