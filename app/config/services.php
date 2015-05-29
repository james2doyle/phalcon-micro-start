<?php

use Phalcon\Mvc\View\Simple as View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Cache\Frontend\Output;
use Phalcon\Cache\Backend\File;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

$di = new FactoryDefault();

/**
 * Sets the view component
 */
$di['view'] = function() use ($config) {
    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    return $view;
};

//Set the views cache service
$di->set('viewCache', function () use ($config) {
    $frontCache = new Output(array(
        'lifetime' => $config->application->cacheLength,
        'level' => \Phalcon\Mvc\View::LEVEL_ACTION_VIEW
        ));
    // Create the component that will cache from the "Output" to a "File" backend
    $cache = new File($frontCache, array(
        "cacheDir" => $config->application->compiledPath
        ));
    return $cache;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di['url'] = function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
};

$di->set('modelsManager', function() {
    return new Manager();
});

$di['dispatcher'] = function() {
    return new Dispatcher();
};

$di['session'] = function() {
    $session = new \Phalcon\Session\Adapter\Files();
    $session->start();
    return $session;
};

$di['cookies'] = function() {
    $cookies = new Phalcon\Http\Response\Cookies();
    $cookies->useEncryption(false);
    return $cookies;
};

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di['db'] = function () use ($config) {
    return new DbAdapter(array(
        "host" => $config->database->host,
        "username" => $config->database->username,
        "password" => $config->database->password,
        "dbname" => $config->database->dbname
        ));
};
