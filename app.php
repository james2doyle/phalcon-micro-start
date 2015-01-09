<?php

/**
 * Add your routes here
 */
$app->get('/', function () use ($app) {
    echo $app->view->render('index/index', array(
      'data' => 'My Data'
      ));
});

// pass some arguments
$app->get('/hello/{name}', function ($name) use ($app) {
    echo $app->view->render('index/name', array(
      'name' => $name
      ));
});

// test: $.post('return_json', {count: 1}).done(function(res){console.log(res)})
$app->post('/return_json', function () use ($app) {
  $template = $app->view->render('partials/form', array(
    'count' => (int)$app->request->getPost('count') + 1
    ));
  $app->response->setContentType('application/json', 'UTF-8');
  $app->response->setJsonContent(array(
    "status" => "OK",
    'message' => $template
    ));
  $app->response->send();
});

// This route makes a redirection to another route
$app->get('/home', function () use ($app) {
    $app->response->redirect("")->sendHeaders();
    // $app->response->send();
});

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app->view->render('errors/404');
});
