<?php

namespace Flashpoint;

use Flashpoint\Controllers\Error404;
use Flashpoint\Controllers\Rooter;

//Define and set autoloader for custom classes
function autoloader(string $name): void
{
    //Replace '\' (used in namespaces) with '/' (used to navigate through directories)
    $name = str_replace('\\', '/', $name);
    //Remove the root folder from the path (this file is already in it)
    if (strpos($name, '/') !== false) {
        $name = substr($name, strpos($name, '/') + 1);
    }
    $name .= '.php';
    require $name;
}

spl_autoload_register('Flashpoint\autoloader');

//Set character encoding
mb_internal_encoding('UTF-8');

$requestedUrl = $_SERVER['REQUEST_URI'];

//Process the request
$rooter = new Rooter();
$result = $rooter->process(array($requestedUrl));
if ($result !== true) {
    //Display the error webpage, overwrite the page headers (title, description, keywords)
    $errorController = new Error404();
    $errorController->process(array());
}

//Display the generated website
$website = $rooter->displayView();
echo $website;

