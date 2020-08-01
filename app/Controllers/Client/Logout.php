<?php
namespace App\Controllers\Client;

class Logout extends \App\Controllers\BiTController
{
	public function index()
	{
		$this->session->destroy();

		return redirect()->to(base_url());
	}
}
