<?php
namespace App\Controllers\Admin;

class Monthly extends \App\Controllers\BaseController
{
	public function index()
	{
		return vAdmin('sale/index');
	}

	public function insert()
	{
		return vAdmin('sale/insertUpdate');
	}
}
