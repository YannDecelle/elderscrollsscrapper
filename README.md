# Elder Scrolls Character Scraper

The Elder Scrolls Character Scraper is a PHP library that allows you to scrape character information from the Elder Scrolls Fandom website. It retrieves data such as the character's name, race, religion, gender, description, and image.

## Installation

Clone or download the repository to include the library in your project:

```bash
git clone <repository_url>
```

## Usage

1. Include the library in your PHP file:

```php
require_once 'src/index.php';
```

2. Create an instance of the `ElderScrollsCharacterScraper` class:

```php
$scraper = new ElderScrollsCharacterScraper();
```

3. Call the `scrapeCharacters()` method to retrieve character information:

```php
$scraper->scrapeCharacters();
```

4. Customize the code as needed and add additional functionality based on your requirements.

## Example

Here's an example usage of the library:

```php
<?php
require_once 'src/index.php';

$scraper = new ElderScrollsCharacterScraper();
$scraper->scrapeCharacters();
?>
```

## Contributing

Contributions are welcome! If you find any issues or want to add new features, please open an issue or submit a pull request.

Before submitting a pull request, make sure to run tests and ensure that your changes are compatible with the library.