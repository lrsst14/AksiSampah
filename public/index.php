<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
try {
    $response = (require_once __DIR__.'/../bootstrap/app.php')
        ->handle(Request::capture());
    $response->send();
} catch (\Exception $e) {
    // Handle exceptions, e.g., log or show error page
    echo 'An error occurred: ' . $e->getMessage();
}
