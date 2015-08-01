<?php

namespace ChaosTangent\ASS\Exception;

use ChaosTangent\ASS\Block\Block;

/**
 * Invalid block exception
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class InvalidBlockException extends ASSException
{
    /** @var Block */
    protected $block;

    public function __construct(Block $block, $message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->block = $block;
    }

    /**
     * @return Block
     */
    public function getBlock()
    {
        return $this->block;
    }
}
