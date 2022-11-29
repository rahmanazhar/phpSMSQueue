<?php

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);

//queue routes

$router->add('queue/insert', ['controller' => 'Queue', 'action' => 'insert']);
$router->add('queue/call', ['controller' => 'Queue', 'action' => 'call']);
$router->add('queue/countmessages', ['controller' => 'Queue', 'action' => 'getTotalMessage']);
$router->add('queue/getmessages', ['controller' => 'Queue', 'action' => 'getMessage']);
    

// $router->add('{controller}/{action}');
$router->dispatch($_SERVER['QUERY_STRING']);
