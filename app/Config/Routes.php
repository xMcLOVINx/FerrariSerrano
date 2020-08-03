<?php namespace Config;

#=========================

$routes = Services::routes(true);

#=========================

if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

#=========================

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

#=========================

#=== [ CLIENT ]
#=== [ LOGIN ]
$routes->get('/', 'Client\Home::index');
$routes->post('/', 'Client\Home::attemptLogin');

$routes->group('client', ['filter' => 'auth'], function($routes)
{
	#=== [ PROFILE ]
	$routes->get('profile', 'Client\Profile::index');
	$routes->post('profile', 'Client\Profile::update');

	#=== [ SIMULATION ]
	$routes->get('simulation', 'Client\Simulation::index');
	$routes->get('simulation/create', 'Client\Simulation::create');
	$routes->post('simulation/store', 'Client\Simulation::store');
	$routes->put('simulation/update/(:num)', 'Client\Simulation::update');
	$routes->get('simulation/view/(:num)', 'Client\Simulation::view');
});

#=== [ ADMIN ]
#=== [ LOGIN ]
$routes->add('admin', 'Admin\Home::index');
$routes->post('admin', 'Admin\Home::attemptLogin');

$routes->group('admin', function($routes)
{
	#=== [ DASHBOARD ]
	$routes->get('dashboard', 'Admin\Dashboard::index');

	#=== [ PROFILE ]
	$routes->get('perfil', 'Admin\Profile::index');
	$routes->post('perfil', 'Admin\Profile::update');

	#=== [ LOGOUT ]
	$routes->get('logout', 'Admin\Logout::index');

	#=== [ CLIENT ]
	$routes->get('clientes', 'Admin\Client::index');
	$routes->get('clientes/inserir', 'Admin\Client::insert');
	$routes->add('clientes/inserir', 'Admin\Client::store');
	$routes->get('clientes/atualizar/(:num)', 'Admin\Client::edit');
	$routes->add('clientes/atualizar/(:num)', 'Admin\Client::update');
	$routes->add('clientes/deletar/(:num)', 'Admin\Client::delete');

	#=== [ USER ]
	$routes->get('administradores', 'Admin\User::index');
	$routes->get('administradores/inserir', 'Admin\User::insert');
	$routes->add('administradores/inserir', 'Admin\User::store');
	$routes->get('administradores/atualizar/(:num)', 'Admin\User::edit');
	$routes->add('administradores/atualizar/(:num)', 'Admin\User::update');
	$routes->add('administradores/deletar/(:num)', 'Admin\User::delete');

	#=== [ PERMISSION ]
	$routes->get('permissoes', 'Admin\Permission::index');
	$routes->add('permissoes/inserir', 'Admin\Permission::insert');
	$routes->put('permissoes/atualizar/(:num)', 'Admin\Permission::update');

	#=== [ SALE ]
	$routes->get('mensalidades', 'Admin\Monthly::index');
	$routes->add('mensalidades/inserir', 'Admin\Monthly::insert');
	$routes->put('mensalidades/atualizar/(:num)', 'Admin\Monthly::update');
});

#=========================

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}