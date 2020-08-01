<?php
namespace App\Controllers;

class BiTController extends BaseController
{
	protected $session;


	public function __construct()
	{
		$this->session = \Config\Services::session();

		parent::initController(
			\Config\Services::request(),
			\Config\Services::response(),
			\Config\Services::logger()
		);
	}
}
