<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Now you can use the environment variables
$email_api_key = $_ENV['email_api_key'];
$email = $_ENV['email'];
?>