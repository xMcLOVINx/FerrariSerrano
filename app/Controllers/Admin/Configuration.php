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
				'success' => false,
				'message' => 'Operação cancelada pelo usuário.'
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

	public function update()
	{
		$configuration = $this->model->getLast();

		$data = [
			'tituloPagina' => $this->request->getPost('titulo'),
			'termosCondicoes' => $this->request->getPost('termos-condicoes')
		];

		if ($this->request->getFile('app')) {
			$userPath = "uploads/logos/";
			$app = $this->request->getFile('app');

			if (in_array(
				$app->getClientMimeType(),
				['image/jpg','image/jpeg','image/gif','image/png']
			)) {
				$newName = $app->getRandomName();
	            $app->move($userPath, $newName);

	            $data['logoApp'] = $userPath . $newName;
	        }
		}

		if ($this->request->getFile('panel')) {
			$userPath = "uploads/logos/";
			$panel = $this->request->getFile('panel');

			if (in_array(
				$panel->getClientMimeType(),
				['image/jpg','image/jpeg','image/gif','image/png']
			)) {
				$newName = $panel->getRandomName();
	            $panel->move($userPath, $newName);

	            $data['logoPainel'] = $userPath . $newName;
	        }
		}

		$result = $this->model->edit($data);

		if ($result) {
			$this->session->setFlashdata([
				'success' => true
			]);
		} else {
			$this->session->setFlashdata([
				'success' => false
			]);
		}

		return cRedirect('', 'a');
	}
}
