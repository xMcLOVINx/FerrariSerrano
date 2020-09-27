<?php
namespace App\Controllers\Admin;

class Dashboard extends \App\Controllers\BiTController
{
	public function index()
	{
		return vAdmin('dashboard/dashboard', [
			'count' => [
				'clients' => (new \App\Models\Shared\Client)->count([
					'deletado' => '0'
				]),
				'monthly' => 1
			],
		]);
	}
}
