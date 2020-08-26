<?php
namespace App\Controllers\Admin;

class Installment extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Admin\Installment;
	}


	public function index()
	{
		return vAdmin('installment/index', [
			'permissions' => $this->model->get([
				'deletado' => '0'
			])
		]);
	}

	public function insert()
	{
		return vAdmin('installment/insertUpdate');
	}
}
