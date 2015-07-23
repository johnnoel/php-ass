<?php
/**
 * ASS file reading example
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */

require __DIR__.'/../vendor/autoload.php';

use ChaosTangent\ASS\Reader;
use ChaosTangent\ASS\Line\Dialogue;

$reader = new Reader();
$script = $reader->fromFile(__DIR__.'/../tests/scripts/small.ass');

foreach ($script as $block) {
    echo '['.$block->getId().'] ('.get_class($block).')'.PHP_EOL;

    foreach ($block as $line) {
        echo $line->getKey().' ('.get_class($line).'): '.$line->getValue().PHP_EOL;
    }

    echo PHP_EOL;
}
