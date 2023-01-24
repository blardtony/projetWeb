<?php

use Exceptions\RouteNotFoundException;
use Router\Router;

require '../vendor/autoload.php';

define('BASE_VIEW_PATH', dirname(__DIR__). DIRECTORY_SEPARATOR . 'View' . DIRECTORY_SEPARATOR);
define('BASE_CSS', "/DiamondDogsProject/public/assets/css/" );
define('BASE_IMG', "/DiamondDogsProject/public/assets/img/" );


// var_dump(BASE_VIEW_PATH);

$router = new Router($_GET['url']);

$router->get('/', 'Controller\HomeController@index');

// Authentication
$router->get('/login', 'Controller\LoginController@index');
$router->post('/login', 'Controller\LoginController@login');

$router->get('/token', 'Controller\TokenController@index');
$router->get('/token-verify', 'Controller\TokenController@token');

$router->get('/email-verify', 'Controller\TokenController@expired');
$router->post('/email-verify', 'Controller\TokenController@send');

$router->get('/signup', 'Controller\SignupController@index');
$router->post('/signup', 'Controller\SignupController@insert');

//Reset Password

$router->get('/reset-password', 'Controller\LoginController@resetPassword');
$router->post('/reset-password', 'Controller\LoginController@updatePassword');

// Group
$router->get('/group', 'Controller\GroupController@index');
$router->get('/group/create', 'Controller\GroupController@create');
$router->post('/group/create', 'Controller\GroupController@insert');
//Group matchs
$router->get('/group/games', 'Controller\GroupController@game');
$router->get('/group/games/:id/bet', 'Controller\GroupController@bet');
$router->post('/group/games/:id/bet', 'Controller\GroupController@insertBet');
$router->get('/group/games/:id/gameDetails', 'Controller\GroupController@gameDetails');
$router->post('/group/games/:id/gameDetails', 'Controller\GroupController@insertComment');
$router->get('/group/games/create', 'Controller\GroupController@createGame');
$router->post('/group/games/create', 'Controller\GroupController@insertGame');
//Group add score
$router->get('/group/games/:id/add-score', 'Controller\GroupController@addScore');
$router->post('/group/games/:id/add-score', 'Controller\GroupController@updateScore');

//Group invite user

$router->get('/group/add-user', 'Controller\GroupController@inviteUser');
$router->post('/group/add-user', 'Controller\GroupController@sendInviteUser');

//User
$router->get('/user/me', 'Controller\UserController@me');
$router->get('/user/settings', 'Controller\UserController@settings');
$router->get('/user/settings/update-pseudo', 'Controller\UserController@pseudo');
$router->post('/user/settings/update-pseudo', 'Controller\UserController@updatePseudo');
$router->get('/user/settings/update-password', 'Controller\UserController@password');
$router->post('/user/settings/update-password', 'Controller\UserController@updatePassword');
$router->get('/user/settings/update-email', 'Controller\UserController@email');
$router->post('/user/settings/update-email', 'Controller\UserController@updateEmail');

// Logout
$router->get('/logout', 'Controller\UserController@logout');

//Admin
$router->get('/admin', 'Controller\AdminController@index');
$router->get('/admin/user', 'Controller\AdminController@user');
$router->get('/admin/user/:id/deactivate', 'Controller\AdminController@deactivate');
$router->get('/admin/user/:id/activate', 'Controller\AdminController@activate');
$router->get('/admin/comment', 'Controller\AdminController@comment');
$router->get('/admin/comment/:id/delete', 'Controller\AdminController@deleteComment');

try {
    $router->run();
}catch(RouteNotFoundException $e) {
    echo $e->route404();
}
