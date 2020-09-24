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
		$result = $this->model->getLast([
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

		$clientResult = (new \App\Models\Shared\Client)->getClient([
			'usuarios.idUsuario' => $result->idUsuario
		]);

		if (
			($clientResult[0]->dataVencimento < date('Y-m-d')) &&
			(empty($clientResult[0]->nomeCompleto))
		) {
			$this->session->setFlashdata([
				'success' => false,
				'message' =>
					'Acesso negado! Sua mensalidade venceu no dia: ' . 
					convertDate($clientResult[0]->dataVencimento) . 
					' . Caso queira voltar a ter acesso, pague a mensalidade.'
			]);

			return redirect()->to(base_url());
		}

		$this->session->set([
			'id' => $result->idUsuario,
			'nome' => $clientResult[0]->nomeCompleto,
			'avatar' => $clientResult[0]->avatar,
			'dataVencimento' => $clientResult[0]->dataVencimento,
			'admin' => (!empty($clientResult[0]->nomeCompleto))
		]);

		return cRedirect('simulation/create');
	}
}
