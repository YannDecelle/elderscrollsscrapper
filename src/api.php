<?php

class ElderScrollsCharacterScraper {
    private $dom;
    private $counter;
    private $xpath;

    public function __construct() {
        // Disable warning messages
        libxml_use_internal_errors(true);

        // Create a DOMDocument object
        $this->dom = new DOMDocument();

        // Initialize a counter variable
        $this->counter = 1;
    }

    public function scrapeCharacters() {
        // Loop through the alphabet
        foreach (range('A', 'Z') as $letter) {
            $from = $letter; // Set the value of the $from variable to the current letter

            $url = "https://elderscrolls.fandom.com/wiki/Category:Lore:_Characters?from=" . urlencode($from);

            // Load the HTML file and suppress warnings
            @$this->dom->loadHTMLFile($url);

            // Clear any previous error messages
            libxml_clear_errors();

            // Enable warning messages
            libxml_use_internal_errors(false);

            // Create a DOMXPath object
            $this->xpath = new DOMXPath($this->dom);

            // Find all <a> tags with the specified class
            $links = $this->xpath->query("//a[contains(@class, 'category-page__member-link')]");

            // Process the links
            foreach ($links as $link) {
                $characterInfo = $this->getCharacterInfo($link);


                // Increment the counter
                $this->counter++;
            }
        }
    }

    private function getCharacterInfo($link) {
        $innerUrl = "https://elderscrolls.fandom.com" . $link->getAttribute('href');
        @$this->dom->loadHTMLFile($innerUrl); // Load the inner HTML file and suppress warnings

        // Clear any previous error messages
        libxml_clear_errors();

        // Enable warning messages
        libxml_use_internal_errors(false);

        // Create a new DOMXPath object for the inner HTML
        $innerXpath = new DOMXPath($this->dom);

        // Find the h1 tag
        $h1 = $innerXpath->query("//span[@class='mw-page-title-main']");

        // Find the race and gender
        $race = $innerXpath->query("//div[@data-source='race']/div[@class='pi-data-value pi-font']");
        $gender = $innerXpath->query("//div[@data-source='gender']/div[@class='pi-data-value pi-font']");
        $physicalForm = $innerXpath->query("//div[@data-source='form']/div[@class='pi-data-value pi-font']");
        $religion = $innerXpath->query("//div[@data-source='religion']/div[@class='pi-data-value pi-font']");
        $description = $innerXpath->query("//div[@class='mw-parser-output']/p");
        $picture = $innerXpath->query("//div[@class='pi-item pi-image']/div[@class='pi-image']/a/img");

        $characterInfo = [
            'name' => $h1->length > 0 ? $h1[0]->textContent : '',
            'race' => $race->length > 0 ? $race[0]->textContent : ($physicalForm->length > 0 ? $physicalForm[0]->textContent : ''),
            'religion' => $religion->length > 0 ? $religion[0]->textContent : '',
            'gender' => $gender->length > 0 ? $gender[0]->textContent : '',
            'description' => $description->length > 0 ? str_replace(["\n", "\r"], "", $description[0]->textContent) : '',
            'image' => $picture->length > 0 ? $picture[0]->getAttribute('src') : ''
        ];

        return $characterInfo;
    }

}

?>
