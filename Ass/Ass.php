<?php
/**
 * @version 1.0
 * @author John Noel <john.noel@chaostangent.com>
 * @package ASSREADER
 */

namespace chaostangent\Ass;

class Ass 
{
    protected $blocks = array();
    protected $currentBlock = null;

    public function __construct() { }

    public static function fromFile($filename)
    {
        if (!file_exists($filename)) {
            throw new Exception('Unable to find file');
        }

        $ret = new self();
        $fh = fopen($filename, 'r');

        // check whether there's a UTF8 BOM
        $a = unpack('h*', fread($fh, 3));
        $utf8bom = reset($a);
        if (strtolower($utf8bom) != 'febbfb') {
            fseek($fh, 0);
        }

        while (feof($fh) !== true) {
            $line = fgets($fh, 8192);
            $ret->parseLine($line);
        }

        $ret->blocks[] = $ret->currentBlock;

        return $ret;
    }

    public static function fromString($contents)
    {
        $ret = new self();

        $lines = explode(PHP_EOL, $contents);
        foreach ($lines as $line) {
            $ret->parseLine($line);    
        }

        $ret->blocks[] = $ret->currentBlock;

        return $ret;
    }

    public function getBlocks() { return $this->blocks; }
    
    public function getBlock($idx)
    {
        if (!array_key_exists($idx, $this->blocks)) {
            throw new \Exception('Index '.$idx.' does not exists');
        }

        return $this->blocks[$idx];
    }

    public function findBlocks($name)
    {
        return array_filter($this->blocks, function($a) use ($name) {
            return ($a->getName() == $name);
        });
    }

    protected function parseLine($line)
    {
        // comment line, continue
        if (substr($line, 0, 1) == ';') {
            return;
        }

        // block
        if (substr($line, 0, 1) == '[') {
            if ($this->currentBlock !== null) {
                $this->blocks[] = $this->currentBlock;
            }

            $blockName = substr(trim($line), 1, -1);
            $this->currentBlock = new Block($blockName);
            return;
        }

        if ($this->currentBlock === null) {
            return;
        }

        $this->currentBlock->addLine($line);
    }
}

