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
	$routes->get('clients', 'Admin\Client::index');
	$routes->post('clients/search', 'Admin\Client::search');
	$routes->get('clients/inserir', 'Admin\Client::insert');
	$routes->add('clients/inserir', 'Admin\Client::store');
	$routes->get('clients/atualizar/(:num)', 'Admin\Client::edit');
	$routes->add('clients/atualizar/(:num)', 'Admin\Client::update');
	$routes->add('clients/deletar/(:num)', 'Admin\Client::delete');

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

	#=== [ MONTHLY ]
	$routes->get('mensalidades', 'Admin\Monthly::index');
	$routes->add('mensalidades/inserir', 'Admin\Monthly::insert');
	$routes->put('mensalidades/atualizar/(:num)', 'Admin\Monthly::update');

	#=== [ INSTALLMENTS ]
	$routes->get('installments', 'Admin\Installment::index');
	$routes->post('installments/search', 'Admin\Installment::search');
	$routes->add('installments/create', 'Admin\Installment::insert');
	$routes->post('installments/create', 'Admin\Installment::store');
	$routes->get('installments/update/(:num)', 'Admin\Installment::edit');
	$routes->post('installments/update/(:num)', 'Admin\Installment::update');

	#=== [ CONFIGURATIONS ]
	$routes->get('configurations/get/price', 'Admin\Configuration::getPrice');
	$routes->post('configurations/price/update', 'Admin\Configuration::priceUpdate');
	$routes->get('configurations/update', 'Admin\Configuration::edit');
	$routes->post('configurations/update', 'Admin\Configuration::update');
});

#=========================

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}