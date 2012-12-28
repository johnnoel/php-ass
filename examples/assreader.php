<?php
/**
 * @version 1.0
 * @author John Noel <john.noel@chaostangent.com>
 * @package ASSREADER
 */

require(__DIR__.'/../Ass.php');
require(__DIR__.'/../Block.php');
require(__DIR__.'/../MappedData.php');
require(__DIR__.'/../Entries.php');

if ($argc != 2) {
    echo 'Usage: php '.basename(__FILE__). ' {filename}'.PHP_EOL;
    exit(1);
}

$filename = $argv[1];

$assFile = chaostangent\Ass\Ass::fromFile($filename);
$blocks = $assFile->findBlocks('V4+ Styles');

foreach ($blocks as $idx => $block) {
    echo '['.$idx.'] '.$block->getName().PHP_EOL;
    $entries = $block->getEntries();

    $styles = $entries->extract(chaostangent\Ass\Entries::ENTRY_STYLE);
    $fontNames = $entries->pluck(chaostangent\Ass\Entries::ENTRY_STYLE, 'Fontname');
    $fonts = $entries->search(chaostangent\Ass\Entries::ENTRY_STYLE, 'Fontname', 'Amaranth');

    //var_dump($styles, $fontNames, $fonts);
    var_dump($fonts);
}
