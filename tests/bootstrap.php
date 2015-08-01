<?php

/**
 * Bootstrap for phpUnit unit tests
 *
 * @author John Noel <john.noel@chaostangent.com>
 * @package php-ass
 */

if (!class_exists('PHPUnit_Framework_TestCase') || version_compare(PHPUnit_Runner_Version::id(), '3.5') < 0) {
    die('PHPUnit framework is required, at least 3.5 version');
}

require __DIR__.'/../vendor/autoload.php';
