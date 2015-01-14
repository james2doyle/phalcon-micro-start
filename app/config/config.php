<?php

return new \Phalcon\Config(array(

    'database' => array(
        'adapter'    => 'Mysql',
        'host'       => 'localhost',
        'username'   => 'root',
        'password'   => 'root',
        'dbname'     => 'test',
    ),

    'application' => array(
        'modelsDir'      => APP_PATH . '/models/',
        'viewsDir'       => APP_PATH . '/../views/',
        'compiledPath'      => APP_PATH . '/cache/', // for volt *.php files
        'compileAlways'      => true, // use false in production
        'baseUri'        => '/phalcon-micro-start/',
    )
));
