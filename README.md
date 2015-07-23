# php-ass

A library for reading and writing Advanced Substation Alpha subtitle files.

## Specification

The ASS file specs are available in various parts in various places:

1. [Wikipedia has a good overview](https://en.wikipedia.org/wiki/SubStation_Alpha#Advanced_SubStation_Alpha)
2. [The original format in Microsoft Word .doc format](http://www.perlfu.co.uk/projects/asa/ass-specs.doc)
3. [How the files are incorporated into Matroska (MKV) files](http://www.matroska.org/technical/specs/subtitles/ssa.html)

In short: ASS files are an advanced version of the original SSA (Sub Station Alpha) subtitle files and include several improvements in terms of styling and effects.

A valid script file starts with [Script Info] and contains several sections in INI style format.

## Quick start

Install using composer:

```composer require johnnoel/php-ass```

Then start using:

```php
require __DIR__.'/vendor/autoload.php';

use ChaosTangent\ASS\Reader;

$reader = new Reader();
$script = $reader->fromFile(__DIR__.'/examples/example.ass');

foreach ($script as $block) {
    echo $block->getId().PHP_EOL;

    foreach ($block as $line) {
        echo $line->getKey().': '.$line->getValue();
    }
}
```

## Parts

### Script

The ```ChaosTangent\ASS\Script``` class represents the root object of an ASS script.

### Block

### Line

## TODO

* Allow reading of embedded information (images, fonts etc.)
