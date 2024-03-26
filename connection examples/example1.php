<?php

/**
 * Basic driver connection without composer (not a recommended method)
 * PHP Mongo drivers must be installed
 * See docs: https://www.mongodb.com/docs/drivers/php-drivers/
 *
 * Tested in PHP 8.10 and mongo db version 1.13 from PECL
 * I have installed and tested on Mongo Community Edition 7 in Windows 64-bit
 * Installed with default complete setup
 *
 * Use MongoDBCompass application to connect with database
 */

$client = new MongoDB\Driver\Manager("mongodb://localhost:27017");

// Build the listDatabases command
$command = new MongoDB\Driver\Command(["listDatabases" => 1]);

// Execute the command and handle potential errors
try {
    $cursor = $client->executeCommand("admin", $command);
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit;
}

// Iterate through the results and print database names (check for property name)
foreach ($cursor as $databaseInfo) {
    $nameProperty = 'databases'; // Adjust if necessary based on your driver version or implementation
    if (isset($databaseInfo->$nameProperty)) {
        foreach ($databaseInfo->$nameProperty as $database) {
            echo "Database Name: " . $database->name . "\n"; // Assuming 'name' is the property for database name
        }
    } else {
        echo "Database information not found in expected format.\n";
    }
}
