<?php
namespace App\Controllers;

class BaseController extends \CodeIgniter\Controller
{
	protected $helpers = [
		'template_helper',
		'redirect_helper',
		'base_url_helper',
		'common_helper'
	];


	public function initController(
		\CodeIgniter\HTTP\RequestInterface $request,
		\CodeIgniter\HTTP\ResponseInterface $response,
		\Psr\Log\LoggerInterface $logger
	) {
		parent::initController($request, $response, $logger);
	}
}
