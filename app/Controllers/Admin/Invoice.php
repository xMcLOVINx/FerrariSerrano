<?php
namespace App\Controllers\Admin;

class Invoice extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Admin\Invoice;
	}


	public function store($data)
	{
		return $this->model->add($data);
	}
}
