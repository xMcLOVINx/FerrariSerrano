<?php
namespace App\Controllers\Admin;

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
		$configuration = new \App\Models\Shared\Base;
		$configuration->table = "configuracoes";

		return view('admin/login/login', [
			'configuration' => $configuration->getLast()
		]);
	}

	public function attemptLogin()
	{
		$result = $this->model->get([
			'cpf' => $this->request->getPost('cpf'),
			'senha' => $this->request->getPost('senha')
		]);

		if ($result == false) {
			$this->session->setFlashdata([
				'success' => false,
				'message' => 'CPF ou Senha inválido.'
			]);

			return redirect()->to(base_url('admin'));
		}

		$this->session->set([
			'idUsuario' => $result[0]->idUsuario,
			'nome' => $result[0]->nomeCompleto,
			'avatar' => $result[0]->avatar
		]);

		return cRedirect('dashboard', 'a');
	}
}
