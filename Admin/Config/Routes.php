<?PHP
use CodeIgniter\Router\RouteCollection;
 
/**
 * @var RouteCollection $routes
 */

$routes->group("admin", ["namespace" => "Admin\Controllers", "filter" => "session" ], static function($routes) {

    $routes->get('users', 'Users::index');
    $routes->get("users/(:num)", "Users::show/$1");
    $routes->post("users/(:num)/toggle-ban", "Users::toggleBan/$1");

});