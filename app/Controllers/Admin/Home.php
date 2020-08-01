<?php
namespace App\Controllers\Admin;

class Home extends \App\Controllers\BaseController
{
	private $model;
	private $validation;


	public function __construct()
	{
		$this->model = new \App\Models\Admin\Login;

		$this->session = \Config\Services::session();
		$this->validation = \Config\Services::validation();
	}


	public function index()
	{
		return view('admin/login/login');
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
