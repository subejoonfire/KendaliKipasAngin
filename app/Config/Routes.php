<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/logout', 'Home::logout');
$routes->post('authenticate', 'Home::authenticate');
$routes->get('toggle-fan', 'Home::toggleFan');
