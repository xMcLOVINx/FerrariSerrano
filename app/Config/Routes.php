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
	$routes->get('clients/create', 'Admin\Client::insert');
	$routes->add('clients/create', 'Admin\Client::store');
	$routes->get('clients/update/(:num)', 'Admin\Client::edit');
	$routes->add('clients/update/(:num)', 'Admin\Client::update');
	$routes->add('clients/delete/(:num)', 'Admin\Client::delete');

	#=== [ USER ]
	$routes->get('users', 'Admin\User::index');
	$routes->get('users/create', 'Admin\User::insert');
	$routes->add('users/create', 'Admin\User::store');
	$routes->get('users/update/(:num)', 'Admin\User::edit');
	$routes->add('users/update/(:num)', 'Admin\User::update');
	$routes->add('users/delete/(:num)', 'Admin\User::delete');

	#=== [ MONTHLY ]
	$routes->get('monthly', 'Admin\Monthly::index');
	$routes->add('monthly/create', 'Admin\Monthly::insert');
	$routes->post('monthly/create', 'Admin\Monthly::store');
	$routes->get('monthly/update/(:num)', 'Admin\Monthly::edit');
	$routes->post('monthly/update/(:num)', 'Admin\Monthly::update');
	$routes->post('monthly/pay/(:num)', 'Admin\Monthly::payInvoice');
	$routes->get('monthly/finalize', 'Admin\Monthly::finalize');

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