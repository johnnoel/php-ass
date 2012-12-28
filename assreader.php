<?php
/**
 * @version 1.0
 * @author John Noel <john.noel@chaostangent.com>
 * @package ASSREADER
 */

require('Ass/Ass.php');
require('Ass/Block.php');
require('Ass/MappedData.php');
require('Ass/Entries.php');

if ($argc != 2) {
    echo 'Usage: php '.basename(__FILE__). ' {filename}'.PHP_EOL;
    exit(1);
}

$filename = $argv[1];

$assFile = Ass\Ass::fromFile($filename);
$blocks = $assFile->findBlocks('V4+ Styles');

foreach ($blocks as $idx => $block) {
    echo '['.$idx.'] '.$block->getName().PHP_EOL;
    $entries = $block->getEntries();

    $styles = $entries->extract(Ass\Entries::ENTRY_STYLE);
    $fontNames = $entries->pluck(Ass\Entries::ENTRY_STYLE, 'Fontname');
    $fonts = $entries->search(Ass\Entries::ENTRY_STYLE, 'Fontname', 'Amaranth');

    var_dump($fonts);
}
