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
				'invoices' => [
					'payed' => (new \App\Models\Admin\Invoice)->count([
						'deletado' => '0',
						'dataPagamento' => date('Y-m-d')
					]),
					'pendent' => (new \App\Models\Admin\Invoice)->count([
						'deletado' => '0',
						'dataVencimento' => date('Y-m-d')
					])
				]
			],
			'monthly' => (new \App\Models\Admin\Monthly)->getMonthly([
				'parcelasVencendo >' => '0',
				'deletado' => '0',
			], 5)
		]);
	}
}
