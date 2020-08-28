<?php
namespace App\Controllers\Admin;

class Client extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Shared\Client;
	}


	public function index()
	{
		return vAdmin('client/index', [
			'clients' => $this->model->get([
				'cnpj !=' => null,
				'deletado' => '0',
				'idUsuario !=' => $this->session->idUsuario
			])
		]);
	}

	public function getByAjax()
	{
		if (!$this->request->isAJAX()) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$clients = $this->model->getLike(
			'razaoSocial', $this->request->getPost('search'), [
				'deletado' => '0'
			]
		);

		$results = [];
		foreach ($clients as $key => $client) {
			$results[] = [
				'value' => $client->idUsuario,
				'label' => $client->razaoSocial
			];
		}

		return $this->response->setJSON([
			'success' => true,
			'results' => $results
		]);
	}

	public function insert()
	{
		return vAdmin('client/insertUpdate');
	}

	public function store()
	{
		$address = new \App\Controllers\Shared\Address;

		if ($this->request->getFile('avatar')) {
			$clientPath = "uploads/clients/";
			$avatar = $this->request->getFile('avatar');

			if (in_array(
				$avatar->getClientMimeType(),
				['image/jpg','image/jpeg','image/gif','image/png']
			)) {
				$newName = $avatar->getRandomName();
	            $avatar->move($clientPath, $newName);

	            $avatarPath = $clientPath . $newName;
	        }
		}

		$clientResult = $this->model->add([
			'idEndereco' => $address->store($this->request),
			'razaoSocial' => $this->request->getPost('razaoSocial'),
			'cnpj' => $this->request->getPost('cnpj'),
			'telefone' => $this->request->getPost('telefone'),
			'email' => $this->request->getPost('email'),
			'senha' => $this->request->getPost('senha'),
			'dataCadastro' => date('Y-m-d')
		]);

		if ($clientResult) {
			$this->session->setFlashdata([
				'success' => true,
				'message' => 'Operação executada com sucesso.'
			]);
		} else {
			$this->session->setFlashdata([
				'success' => false,
				'message' => 'Falha ao executar a operação.'
			]);
		}

		return cRedirect('clients', 'a');
	}

	public function edit()
	{
		$address = new \App\Models\Shared\Address;

		$client = $this->model->getLast(
			['idUsuario' => $this->request->uri->getSegment(4)]
		);

		return vAdmin('client/insertUpdate', [
			'address' => $address->getLast(['idEndereco' => $client->idEndereco]),
			'item' => $client
		]);
	}

	public function update()
	{
		$client = $this->model->getLast(
			['idUsuario' => $this->request->uri->getSegment(4)]
		);

		$address = new \App\Controllers\Shared\Address;
		$address->update($this->request, $client->idEndereco);

		$data = [
			'razaoSocial' => $this->request->getPost('razaoSocial'),
			'cnpj' => $this->request->getPost('cnpj'),
			'telefone' => $this->request->getPost('telefone'),
			'email' => $this->request->getPost('email'),
			'senha' => $this->request->getPost('senha')
		];

		if ($this->request->getFile('avatar')) {
			$clientPath = "uploads/clients/";
			$avatar = $this->request->getFile('avatar');

			if (in_array(
				$avatar->getClientMimeType(),
				['image/jpg','image/jpeg','image/gif','image/png']
			)) {
				$newName = $avatar->getRandomName();
	            $avatar->move($clientPath, $newName);

	            $data['avatar'] = $clientPath . $newName;
	        }
		}

		$result = $this->model->edit($data,
			['idUsuario' => $this->request->uri->getSegment(4)]
		);

		if ($result) {
			$this->session->setFlashdata([
				'success' => true,
				'message' => 'Operação executada com sucesso.'
			]);
		} else {
			$this->session->setFlashdata([
				'success' => false,
				'message' => 'Falha ao executar a operação.'
			]);
		}

		return cRedirect('clients', 'a');
	}

	public function delete()
	{
		$result = $this->model->disable([
			'idUsuario' => $this->request->uri->getSegment(4)
		]);

		if ($result) {
			$this->session->setFlashdata([
				'success' => true,
				'message' => 'Operação executada com sucesso.'
			]);
		} else {
			$this->session->setFlashdata([
				'success' => false,
				'message' => 'Falha ao executar a operação.'
			]);
		}

		return cRedirect('clients', 'a');
	}
}
