<?php
namespace App\Controllers\Admin;

class Permission extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Admin\Permission;
	}


	public function index()
	{
		return vAdmin('permission/index', [
			'permissions' => $this->model->get([
				'deletado' => '0'
			])
		]);
	}

	public function insert()
	{
		return vAdmin('permission/insertUpdate');
	}
}
