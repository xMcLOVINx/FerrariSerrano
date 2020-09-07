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
		$configuration = new \App\Models\Shared\Base;
		$configuration->table = "configuracoes";

		return view('client/login/login', [
			'configuration' => $configuration->getLast()
		]);
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

		$client = new \App\Models\Shared\Client;

		$result = $client->getClient([
			'usuarios.idUsuario' => $result[0]->idUsuario
		]);

		if ($result[0]->dataVencimento < date('Y-m-d')) {
			$this->session->setFlashdata([
				'success' => false,
				'message' =>
					'Acesso negado! Sua mensalidade venceu no dia: ' . 
					convertDate($result[0]->dataVencimento) . 
					' . Caso queira voltar a ter acesso, pague a mensalidade.'
			]);

			return redirect()->to(base_url());
		}

		$this->session->set([
			'id' => $result[0]->idUsuario,
			'nome' => $result[0]->nomeCompleto,
			'avatar' => $result[0]->avatar,
			'dataVencimento' => $result[0]->dataVencimento
		]);

		return cRedirect('simulation/create');
	}
}
