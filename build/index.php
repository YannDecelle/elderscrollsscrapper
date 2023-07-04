<?php

require_once __DIR__ . '/../src/api.php';

// Assuming $characterInfo is defined in api.php

// Access the $characterInfo variable from api.php
if (isset($characterInfo)) {
    echo($characterInfo);
} else {
    echo "Error: Unable to access character information.";
}
?>
