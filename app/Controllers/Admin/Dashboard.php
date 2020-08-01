<?php
namespace App\Controllers\Admin;

class Dashboard extends \App\Controllers\BiTController
{
	public function index()
	{
		return vAdmin('dashboard/dashboard');
	}
}
