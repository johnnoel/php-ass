<?php
/**
 * @version 1.0
 * @author John Noel <john.noel@chaostangent.com
 * @package ASSREADER
 */

namespace chaostangent\Ass;

class Block
{
    protected $name = '';
    protected $formatMap = null;
    protected $entries = null;

    public function __construct($name) {
        $this->name = $name;
        $this->entries = new Entries();
    }

    public function addLine($line) {
        $l = trim($line);

        if (substr($l, 0, 8) == 'Format: ') {
            $this->formatMap = array_map('trim', explode(',', trim(substr($l, 8))));
            return;
        }

        if (!empty($l)) {
            if ($this->formatMap !== null) {
                $colonPos = strpos($line, ':');
                $name = substr($line, 0, $colonPos);
                $data = array_map('trim', explode(',', substr($line, $colonPos+1)));

                $this->entries[] = new MappedData($name, $this->formatMap, $data);
            } else {
                $this->entries[] = $l;
            }
        }
    }

    public function getEntries()
    {
        return $this->entries;
    }

    public function getName() {
        return $this->name;
    }
}

