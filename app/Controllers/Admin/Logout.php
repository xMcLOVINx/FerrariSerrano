<?php
namespace App\Controllers\Admin;

class Logout extends \App\Controllers\BiTController
{
	public function index()
	{
		$this->session->destroy();

		return redirect()->to(base_url('admin'));
	}
}
