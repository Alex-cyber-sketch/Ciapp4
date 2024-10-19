<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get("articles", "Articles::index");
$routes->get("articles/(:num)", "Articles::show/$1");
$routes->get("articles/new", "Articles::new", ["as" => "new_article"]);
$routes->post("articles", "Articles::create");
$routes->get("articles/(:num)/edit", "Articles::edit/$1");
$routes->post("articles/(:num)", "Articles::update/$1");
$routes->delete("articles/(:num)", "Articles::delete/$1");

service('auth')->routes($routes);

$routes->group("", ["filter" => "login"], static function ($routes) {

    $routes->get("set-password", "Password::set");
    $routes->post("set-password", "Password::update");

    $routes->get("articles/(:num)/delete", "Articles::confirmDelete/$1");

    $routes->resource("articles", ["placeholder" => "(:num)"]);

});