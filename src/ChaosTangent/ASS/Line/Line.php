<?php

namespace ChaosTangent\ASS\Line;

/**
 * Line base class
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */
class Line
{
    /** @var string */
    protected $key;
    /** @var string */
    protected $value;
    /** @var array */
    protected static $classMap = [
        'Style' => Style::class,
        'Dialogue' => Dialogue::class,
        'Format' => Format::class,
    ];

    /**
     * Whether the passed string is a format line
     *
     * @param string $line
     * @return boolean
     */
    public static function isFormatLine($line)
    {
        return preg_match('/^Format:\s+/', $line) === 1;
    }

    /**
     * Parse an individual line in the format "Key with spaces": "Value"
     *
     * @param string $line
     * @param array $mapping A line mapping array (from a Format line for
     *                       instances) that defines line parameter ordering
     * @return Line|null A line of a specific type or null if a comment
     *                   or unreadable
     */
    public static function parse($content, array $mapping = [])
    {
        // comment, do nothing
        if (empty($content) || substr($content, 0, 1) == ';') {
            return null;
        }

        $matches = [];
        if (preg_match('/^([^:]+):\s*(.*)$/', trim($content), $matches) !== 1) {
            // doesn't match this format, do nothing
            return null;
        }

        $key = $matches[1];
        $value = $matches[2];

        if (array_key_exists($key, self::$classMap)) {
            $line = new self::$classMap[$key];
        } else {
            $line = new self();
        }

        $line->setKey($key)
            ->setValue($value)
            ->doParse($value, $mapping);

        return $line;
    }

    /**
     * Converts a timecode into seconds
     *
     * E.g. 0:07:02.44 is 0 hours, 7 minutes, 2.44 seconds which is 422.44
     * seconds
     *
     * @param string The timecode to parse
     * @return float
     */
    public static function parseTimecodeIntoSeconds($timecode)
    {
        $parts = explode(':', $timecode);
        $ret = 0;

        if (count($parts) == 3) {
            $hours = intval(reset($parts));
            $ret += ($hours * 60 * 60);

            array_shift($parts);
        }

        if (count($parts) == 2) {
            $minutes = intval(reset($parts));
            $ret += ($minutes * 60);

            array_shift($parts);
        }

        if (count($parts) == 1) {
            $seconds = floatval(reset($parts));
            $ret += $seconds;
        }

        return $ret;
    }

    /**
     * Set key
     *
     * @param string $key
     * @return Line
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Line
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Do any subsequent, type specific parsing
     *
     * @param string $value
     */
    protected function doParse($value, array $mapping)
    {
    }

    public function toString($mapping = []) {
        return $this->key.': '.$this->value;
    }
}
