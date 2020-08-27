<?php
namespace App\Controllers\Admin;

class Configuration extends \App\Controllers\BaseController
{
	private $model;
	private $validation;


	public function __construct()
	{
		$this->model = new \App\Models\Admin\Configuration;

		$this->session = \Config\Services::session();
		$this->validation = \Config\Services::validation();
	}


	public function getPrice()
	{
		if (!$this->request->isAJAX()) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		return $this->response->setJSON([
			'success' => true,
			'price' => $this->model->getLast()->valorServico
		]);
	}

	public function priceUpdate()
	{
		if ($this->request->getPost('confirmacao-modal') == 'S') {
			$result = $this->model->edit([
				'valorServico' => $this->request->getPost('valor-servico-modal')
			]);

			$this->session->setFlashdata([
				'success' => true
			]);
		} else {
			$this->session->setFlashdata([
				'success' => false
			]);
		}

		return cRedirect('dashboard', 'a');
	}

	public function edit()
	{
		$configuration = $this->model->getLast();

		return vAdmin('configuration/insertUpdate', [
			'item' => $configuration
		]);
	}
}
