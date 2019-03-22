<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces([
    'Ls\\Models'            => $config->application->modelsDir,
    'Ls\\Controllers'       => $config->application->controllersDir,
    'Ls\\Forms'             => $config->application->formsDir,
    'Ls\\Libraries'         => $config->application->libraryDir,
    'Ls\\Common\\Helpers'   => $config->application->helpersDir

]);

$loader->register();

// Use composer autoloader to load vendor classes
require_once BASE_PATH . '/vendor/autoload.php';
