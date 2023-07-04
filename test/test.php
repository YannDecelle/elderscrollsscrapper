<?php
require_once '../src/index.php';

$scraper = new ElderScrollsCharacterScraper();
$scraper->scrapeCharacters('A', 'A');

// only returns the A characters


// Run PHPStan analysis on this test file
passthru('phpstan analyze --level=7 test.php');
?>
