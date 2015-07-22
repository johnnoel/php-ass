<?php
/**
 * ASS file reading example
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */

require __DIR__.'/../vendor/autoload.php';

use ChaosTangent\ASS\Reader;

$reader = new Reader();
$script = $reader->fromFile(__DIR__.'/[Mawaru] Shingeki no Bahamut Genesis - NCED (BD 720p) [1B955FE0].ass');

foreach ($script as $block) {
    echo '['.$block->getId().']'.PHP_EOL;

    foreach ($block as $line) {
        echo $line->getKey().' ['.get_class($line).']: '.$line->getValue().PHP_EOL;
    }

    echo PHP_EOL;
}
