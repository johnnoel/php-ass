<?php
/**
 * @version 1.0
 * @author John Noel <john.noel@chaostangent.com>
 * @package ASSREADER
 */

namespace chaostangent\Ass;

class Entries implements \ArrayAccess, \IteratorAggregate
{
    protected $entries = array();

    const ENTRY_DIALOGUE = 1;
    const ENTRY_COMMENT = 2;
    const ENTRY_STYLE = 3;
    const ENTRY_MISC = 4;

    public function __construct($entries = array())
    {
        $this->entries = $entries;
    }

    /**
     * Extract one type of entry
     * @param int entryType The type of entry to get
     * @return array
     */
    public function extract($entryType = self::ENTRY_MISC)
    {
        $ret = array();

        foreach ($this->entries as $entry) {
            if ($entry instanceof MappedData) {
                switch (strtolower($entry->getName())) {
                case 'dialogue':
                    if ($entryType == self::ENTRY_DIALOGUE) {
                        $ret[] = $entry;
                    }
                    break;
                case 'style':
                    if ($entryType == self::ENTRY_STYLE) {
                        $ret[] = $entry;
                    }
                    break;
                case 'comment':
                    if ($entryType == self::ENTRY_COMMENT) {
                        $ret[] = $entry;
                    }
                    break;
                }
            } else if ($entryType == self::ENTRY_MISC) {
                $ret[] = $entry;
            }
        }

        return $ret;
    }

    /**
     * Pluck all of the values of a specified type and key
     * @param int entryType The type of entry to get
     * @param string key The key of the value to search for
     * @return array An array of values that match the search criteria
     */
    public function pluck($entryType, $key)
    {
        $start = $this->extract($entryType);
        $ret = array();

        foreach ($start as $entry) {
            if (($entry instanceof MappedData) && isset($entry->$key)) {
                $ret[] = $entry->$key;
            }
        }

        return $ret;
    }

    /**
     * Search for entries of the specified type, key and value
     * @param int entryType The type of entry to get
     * @param string key The key of the value to search for
     * @value string value The value to search for
     * @return array An array of values that match the search criteria
     */
    public function search($entryType, $key, $value)
    {
        $start = $this->extract($entryType);
        $ret = array();

        foreach ($start as $entry) {
            if (($entry instanceof MappedData) &&
                isset($entry->$key) &&
                ($entry->$key == $value)) {
                $ret[] = $entry;
            }
        }

        return $ret;
    }

    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->entries[] = $value;
        } else {
            $this->entries[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->entries);
    }

    public function offsetUnset($offset)
    {
        unset($this->entries[$offset]);
    }

    public function offsetGet($offset)
    {
        return (array_key_exists($offset, $this->entries)) ? $this->entries[$offset] : null;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->entries);
    }
}
