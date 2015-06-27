<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//pigeon routes
Pigeon::map(function($route){
	$route->route('admin', 'admin', function($r){
    	$prefix = 'admin';
    	$r->get('login', $prefix.'/sessions#create');
		$r->post('login', $prefix.'/sessions#create');
		$r->get('logout', $prefix.'/sessions#delete');
		$r->get('home', $prefix.'/home#index');
		$r->get('profile', 'profiles#show');
		$r->get('profile/edit', 'profiles#edit');
		$r->post('profile/update', 'profiles#update');
		$r->get('profile/edit_password', 'profiles#edit_password');
		$r->post('profile/update_password', 'profiles#update_password');

	});
	$route->resources('admin/users');
	$route->resources('admin/trainings');
	$route->route('admin/trainings/(:any)', 'admin/trainings#show', function($r){
    	$r->post('comments/create', 'admin/comments#create');
	});
	$route->resources('admin/articles');

	//user routes
	$route->get('login', 'sessions#create');
	$route->post('login', 'sessions#create');
	$route->get('logout', 'sessions#delete');
	$route->post('register', 'registration#create');
	$route->get('profile', 'profiles#show');
	$route->get('profile/edit', 'profiles#edit');
	$route->post('profile/update', 'profiles#update');
	$route->get('profile/edit_password', 'profiles#edit_password');
	$route->post('profile/update_password', 'profiles#update_password');
	$route->get('home', 'home#index');
	$route->resources('trainings');
	$route->route('trainings/(:any)', 'trainings#show', function($l){
		$prefix = 'training';
		$l->get('download_material/(:any)', 'training_materials#show');
	});
	$route->route('trainings/(:any)', 'trainings#show', function($r){
    	$r->post('comments/create', 'comments#create');
	});
	$route->get('trainings/(:any)/apply', 'trainings#apply');
	$route->get('trainings/(:any)/confirm', 'trainings#confirm');
	$route->get('trainings/(:any)/certificate/(:any)', 'trainings#certificate');
	$route->resources('articles');
});
$route = Pigeon::draw();
$route['default_controller'] = 'trainings';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
//dump($route);
