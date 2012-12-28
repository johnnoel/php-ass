# php-ass

A set of classes for reading information from .ass (ASS, Advanced Substation Alpha) subtitle files.

## Concept

For further details of the file format, see the [ASS file specs](http://matroska.org/technical/specs/subtitles/ssa.html).

ASS files are split into several blocks or sections in an INI style format. Within each block is a series of unsorted entries.

The classes here allow you to read a valid Sub Station Alpha v4.00+ file and search and retrieve the data within it.

## Usage

Use your autoloader for the files or ```require``` them as needed.

Call one of the static methods to read from a file:

```php
$assFile = chaostangent\Ass\Ass::fromFile($filename);
```

Or from a string:

```php
$assFile = chaostangent\Ass\Ass::fromString($data);
```

Once you've read in the file, you can get all of the read blocks by calling ```$ass->getBlocks();``` or if you want to try and find a specific block by name ```$ass->findBlocks('string');```. Block names are string matched, case sensitive.

For each block you can get the list of entries by doing ```$block->getEntries();```.

Once you have a block you can do one of three things: extract, pluck or search.

### Extract

Extract gets you all of one type of data from an ASS file, the currently supported types are dialoge, styles, comments, and misc (everything else).

```php
$styleEntries = $block->getEntries()->extract(chaostangent\Ass\Entries::ENTRY_STYLE);
```

### Pluck

Plucking doesn't return an array of entry objects but an array of strings for a specified type. For instance, if you wanted to gather all of the 'Fontname' values from style entries:

```php
$fontNames = $block->getEntries()->pluck(chaostangent\Ass\Entries::ENTRY_STYLE, 'Fontname');
```

### Search

Does exactly what you expect, do a search for all entries with a specific type, key name and value:

```php
$things = $block->getEntries()->search(chaostangent\Ass\Entries::ENTRY_STYLE, 'Fontname', 'Arial');
```

## TODO

* Allow reading of embedded information (images, fonts etc.)
* More consistent interface

## Goals

* Allow reading of dialogue data (and only dialogue data) from ASS files
