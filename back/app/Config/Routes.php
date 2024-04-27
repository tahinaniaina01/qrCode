<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//$routes['welcome'] = 'welcome';
//$routes->get('Test/','Test::welcome');
$routes->setAutoRoute(true);
