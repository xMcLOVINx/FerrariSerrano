<?php
namespace App\Controllers\Admin;

class Monthly extends \App\Controllers\BaseController
{
	public function index()
	{
		return vAdmin('monthly/index');
	}

	public function insert()
	{
		return vAdmin('monthly/insertUpdate');
	}
}
