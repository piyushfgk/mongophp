<?php

/**
 * Basic driver connection with composer (recommended)
 * PHP Mongo drivers must be installed
 * See docs: https://www.mongodb.com/docs/drivers/php-drivers/
 *
 * Tested in PHP 8.10 and mongo db version 1.13 from PECL
 * I have installed and tested on Mongo Community Edition 7 in Windows 64-bit
 * Installed with default complete setup
 *
 * Use MongoDBCompass application to connect with database
 */

require_once __DIR__ . '/vendor/autoload.php';

use MongoDB\Client;
use MongoDB\Driver\ServerApi;

// Replace the placeholder with your Atlas connection string
$uri = 'mongodb://localhost:27017';

// Specify Stable API version 1
$apiVersion = new ServerApi(ServerApi::V1);

// Create a new client and connect to the server
$client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);

try {
    // Send a ping to confirm a successful connection
    $client->selectDatabase('admin')->command(['ping' => 1]);
    echo "Pinged your deployment. You successfully connected to MongoDB!\n";
} catch (Exception $e) {
    printf($e->getMessage());
}
