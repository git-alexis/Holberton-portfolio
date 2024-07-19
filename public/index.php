<?php

use App\Kernel; // Imports the Kernel class from the application

// Automatically loads all Composer dependencies
require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

// Returns an anonymous function that creates and returns a new instance of Kernel
return function (array $context) {
    // The Kernel constructor takes the environment and debug mode as arguments
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
