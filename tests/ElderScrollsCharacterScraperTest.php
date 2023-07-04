<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/api.php';

class ElderScrollsCharacterScraperTest extends TestCase
{
    public function testScrapeCharacters()
    {
        $scraper = new ElderScrollsCharacterScraper();
        $scraper->scrapeCharacters();

        // Check if the character count is as expected
        $this->assertEquals(10, $scraper->getCounter());

        // Add more assertions if needed
        
        // Example: Check if the first character's name is "John Doe"
        $characters = $scraper->getCharacters();
        $this->assertEquals("A'Tor", $characters[0]->getName());
    }
}
