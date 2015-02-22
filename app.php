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

$acl = new \Phalcon\Acl\Adapter\Memory();

// Create some roles
$roleAdmins = new \Phalcon\Acl\Role("Admins", "Super-User role");
$roleGuests = new \Phalcon\Acl\Role("Guests");

// Add "Guests" role to acl
$acl->addRole($roleGuests);
$acl->addRole($roleAdmins);

// Define the "SpecialPages" resource
$pageResource = new \Phalcon\Acl\Resource("SpecialPages");

// Add "SpecialPages" resource with a couple of operations
$acl->addResource($pageResource, "view");
$acl->addResource($pageResource, "edit");

$acl->allow("Admins", "SpecialPages", "view");
$acl->deny("Guests", "SpecialPages", "view");

$app->get('/auth', function () use ($app, $acl) {
  // get our Admins role if it is set
  $role = ($app->request->getQuery('role', 'string')) ? $app->request->getQuery('role', 'string'): "Guests";
  $allowed = $acl->isAllowed($role, "SpecialPages", "view");
  // warning: $acl->isAllowed returns a bool, Phalcon\Acl::ALLOW returns an int!
  if ($allowed === true) {
    echo $app->view->render('index/auth', array(
      'role' => $role
      ));
  } else {
    $app->response->setStatusCode(403, "Forbidden")->sendHeaders();
    echo $app->view->render('errors/403');
  }
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

$app->get('/cached', function () use ($app) {
  //Cache this view with the key "latest-cache"
  $app->view->cache(array(
      'key' => 'latest-cache' // this becomes the filename
      ));
  // this will only be changed when the cache is invalidated
  $latest = time();
  echo $app->view->render('index/latest', array(
    'latest' => $latest
    ));
});

// This route makes a redirection to another route
$app->get('/home', function () use ($app) {
  $app->response->redirect("")->sendHeaders();
});

/**
 * Not found handler
 */
$app->notFound(function () use ($app) {
  $app->response->setStatusCode(404, "Not Found")->sendHeaders();
  echo $app->view->render('errors/404');
});
