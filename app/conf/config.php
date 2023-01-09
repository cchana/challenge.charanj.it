<?php

# Toggle for maintenance mode
define('__MAINTENANCE_MODE', false);

# treat /xyz as user defined route
define('__CATCH_FIRST_PARAM', false);

# List of files to use as error templates
define('__ERROR_TEMPLATES', [
    'docs/global/header',
    'errors',
    'docs/global/footer'
]);

# Are we in production?
function setMode($var) {
    $env = getenv($var);
    if($env == 'production') {
        return true;
    }
    return false;
}

# Toggle for production
define('__PRODUCTION', setMode('environment'));

# IF this is NOT production
if(!__PRODUCTION) {
    # DISPLAY ALL THE ERRORS
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

define('__TITLE', 'Challenge');

// cache number (change this for increment the cache buster)
$cacheNumber = 1;

// if this is the live site, use the simplified cache busting technique
if($_SERVER['SERVER_NAME'] == 'challenge.charanj.it') {
    define('__CACHE', date('Y').'.'.$cacheNumber);
// for anywhere else, bust the cache with a random number
} else {
    define('__CACHE', date('Y').'.'.$cacheNumber.'.'.rand());
}
