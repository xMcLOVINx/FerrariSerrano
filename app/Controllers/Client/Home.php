<?php
namespace App\Controllers\Client;

class Home extends \App\Controllers\BaseController
{
	private $model;
	private $validation;


	public function __construct()
	{
		$this->model = new \App\Models\Shared\Login;

		$this->session = \Config\Services::session();
		$this->validation = \Config\Services::validation();
	}


	public function index()
	{
		return view('client/login/login');
	}

	public function attemptLogin()
	{
		$result = $this->model->get([
			'cnpj' => $this->request->getPost('cnpj'),
			'senha' => $this->request->getPost('senha')
		]);

		if ($result == false) {
			$this->session->setFlashdata([
				'success' => false,
				'message' => 'CNPJ ou Senha inválido.'
			]);

			return redirect()->to(base_url());
		}

		$this->session->set([
			'id' => $result[0]->idUsuario,
			'nome' => $result[0]->nomeCompleto,
			'avatar' => $result[0]->avatar
		]);

		return cRedirect('simulation/create');
	}
}
