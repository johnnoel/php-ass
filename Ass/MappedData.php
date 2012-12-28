<?php
/**
 * @version 1.0
 * @author John Noel <john.noel@chaostangent.com>
 * @package ASSREADER
 */

namespace chaostangent\Ass;

class MappedData
{
    protected $blockName = '';

    public function __construct($name, $formatMap, $data)
    {
        $this->blockName = $name;

        foreach ($formatMap as $k => $internalName) {
            $this->$internalName = $data[$k];
        }
    }

    public function getName() { return $this->blockName; }
}
