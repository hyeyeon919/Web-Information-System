<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Post::showHotPost');
$routes->get('/hello', 'Hello::index');
$routes->get('/login', 'Login::index');
$routes->get('/forgotPassword', 'Login::forgotPassword');
$routes->get('/post/newThread', 'Post::post_newThread');
$routes->get('/login/logout', 'Login::logout');
$routes->get('/newThread', 'Home::newThread');
$routes->get('/HotTopic', 'HotTopic::index');
$routes->get('/userinfo', 'Userinfo::index');
$routes->post('/post/upload_post', 'Post::post_newThread');
$routes->get('/newUser', 'Newuser::index');
$routes->get('/edituserinfo', 'Userinfo::edit');
$routes->post('/postdetail/newcomment', 'Comment::newComment');
$routes->get('/favlist', 'Userinfo::showfavlist');
$routes->post('/favlist', 'Userinfo::showfavlist');
$routes->get('/searchitems', 'Post::searchItem');
$routes->get('/(:alpha)', 'Post::showPostbycategory/$1');
$routes->post('/(:alpha)', 'Post::showPostbycategory/$1');

$routes->get('/verification/(:any)', 'Authorize::verifyEmail/$1');
$routes->get('/reset/(:any)', 'Authorize::setnewPassword/$1');


$routes->get('/postdetail/(:any)', 'Postdetail::detail/$1');
$routes->get('/postdetail', 'Postdetail::index');
$routes->post('/login/resetPW', 'Login::forgotPW');
$routes->post('/reset/login/updatePW', 'Login::updatePassword');

$routes->get('/newPassword/(:any)', 'Login::newPassword/$1');


$routes->post('/postdetail/like', 'Postdetail::like');
$routes->post('/postdetail/fav', 'Postdetail::favourite');
$routes->post('/HotTopic', 'Post::postlist');
$routes->post('/newUser', 'Newuser::index');
$routes->post('/newUser/signin', 'Newuser::signup');
$routes->post('/upload/upload_file', 'Upload::upload_file');
$routes->post('/login/check_login', 'Login::check_login');
$routes->post('/edituserinfo/save', 'Userinfo::saveChanges');

$routes->get('movie', 'MovieController::index');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}