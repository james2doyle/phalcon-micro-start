<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

$loader->registerDirs(
    array(
        $config->application->modelsDir,
        $config->application->viewsDir
    )
)->register();
