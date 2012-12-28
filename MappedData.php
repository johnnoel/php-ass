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
            // special case for text which subsumes the remaining data parts
            if ($internalName == 'Text') {
                $this->$internalName = implode('', array_slice($data, $k));
            } else {
                $this->$internalName = $data[$k];
            }
        }
    }

    public function getName() { return $this->blockName; }
}
