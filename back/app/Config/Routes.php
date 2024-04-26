<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// $routes->get('/Hello/key','Hello::key');
// $routes->get('/Hello/index','Hello::index');
// $routes->get('/Hello/Formulaire','Hello::Formulaire');
// $routes->get('/Hello/RecevoirDonnee','Hello::RecevoirDonnee');
$routes->setAutoRoute(true);
