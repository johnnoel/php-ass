# php-ass

A library for reading Advanced Substation Alpha subtitle files.

## Specification

The ASS file specs are available in various parts in various places:

1. [Wikipedia has a good overview](https://en.wikipedia.org/wiki/SubStation_Alpha#Advanced_SubStation_Alpha)
2. [The original format in Microsoft Word .doc format](http://www.perlfu.co.uk/projects/asa/ass-specs.doc)
3. [How the files are incorporated into Matroska (MKV) files](http://www.matroska.org/technical/specs/subtitles/ssa.html)

In short: ASS files are an advanced version of the original SSA (Sub Station Alpha) subtitle files and include several improvements in terms of styling and effects.

A valid script file starts with [Script Info] and contains several sections in INI style format.

## Quick start

Install using composer:

```shell
composer require johnnoel/php-ass
```

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

The [`ChaosTangent\ASS\Script`](src/ChaosTangent/ASS/Script.php) class represents the root object of an ASS script.

You instantiate a `Script` with the content of a script as well as an optional filename:

```php
$script = new Script('[Script Info]', 'mytestscript.ass');
```

Once instantiated you can check whether what's been passed looks like a valid ASS script:

```php
if ($script->isASSScript()) {
    // do more processing
}
```

This only checks the first few bytes for the "[Script Info]" string, it doesn't guarantee that a passed script is valid or readable.

To parse the passed script:

```php
$script->parse();
```

This will go through the content passed when creating the script and parse it into blocks and lines.

To get the current collection of blocks, you can call `getBlocks()` or treat the script as an iterator:

```php
foreach ($script as $block) {
    // block processing
}
```

To check if a script has a block:

```php
if ($script->hasBlock('Script Info')) {
    $script->getBlock('Script Info');
}
```

### Block

Every ASS script is comprised of a few different blocks. The [`ChaosTangent\ASS\Block\Block`](src/ChaosTangent/ASS/Block/Block.php) abstract class represents one of these blocks.

At the moment php-ass supports the following blocks:

* Script Info as [`ChaosTangent\ASS\Block\ScriptInfo`](src/ChaosTangent/ASS/Block/ScriptInfo.php)
* V4+ Styles as [`ChaosTangent\ASS\Block\Styles`](src/ChaosTangent/ASS/Block/Styles.php)
* Events as [`ChaosTangent\ASS\Block\Events`](src/ChaosTangent/ASS/Block/Events.php)

Any other kind of block (e.g. "Aegisub Project Garbage", "Fonts") are silently ignored when parsing.

`ScriptInfo` blocks provide functions for common fields:

```php
$scriptInfoBlock->getTitle();
$scriptInfoBlock->getWrapStyle();
$scriptInfoBlock->getScriptType();
```

Otherwise you can just treat blocks as containers for lines. You can use array access to get a specific line:

```php
$scriptInfoBlock[123]; // line 124 of this block
```

Or treat the block as an iterator:

```php
foreach ($scriptInfoBlock as $line) {
    // line processing
}
```

### Line

Lines are the core of a script file. Any line that isn't a comment (not to be confused with a comment event line) uses the base class [`ChaosTangent\ASS\Line\Line`](src/ChaosTangent/ASS/Line/Line.php).

Lines in some blocks are mapped according to a special "Format" line. These are represented by [`ChaosTangent\ASS\Line\Format`](src/ChaosTangent/ASS/Line/Format.php). Format lines have a special `getMapping()` method that returns an array that can be used to parse other lines.

If all of this sounds a bit complicated, you mostly won't have to worry about it if parsing files as it's all taken care of for you. All it means is that for Dialogue and Style lines, you can use methods to get the different parts:

```php
$styleLine->getName();
$styleLine->getPrimaryColour();
$dialogueLine->getLayer();
$dialogueLine->getText();
```

Dialogue lines also have an extra method for getting the text of a line without any style override codes in it:

```php
$dialogueLine->getTextWithoutStyleOverrides();
```

For all lines you can use the generic `getKey()` and `getValue()` methods which will return the key of the line (e.g. "Dialogue", "Format", "Style") and its unparsed value:

```php
$dialogueLine->getKey(); // == 'Dialogue'
$dialogueLine->getValue(); // e.g. 0,0:00:00.98,0:00:05.43,ED_English,,0,0,0,,{\fad(100,200)\blur5\c&H000010&\3c&H80A0C0&}My destiny,
```

If you only want lines of a specific type, just do an `instanceof` check when iterating through:

```php
foreach ($block as $line) {
    if ($line instanceof Dialogue) {
        echo $line->getTextWithoutStyleOverrides().PHP_EOL;
    }
}
```

## Tests

There is a growing test suite for this library that you can use [phpunit](http://phpunit.de) to validate against. Any esoteric or known broken scripts would be a welcome addition.

## TODO

* Allow reading of embedded information (images, fonts etc.)
* Allow construction and writing of ASS files
* More line type support
* More block type support
* Test completion
