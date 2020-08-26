<?php
namespace App\Controllers\Admin;

class User extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Admin\User;
	}


	public function index()
	{
		return vAdmin('user/index', [
			'users' => $this->model->getUsers([
				'u.cpf !=' => null,
				'u.deletado' => '0',
				'u.idUsuario !=' => $this->session->idUsuario
			])
		]);
	}

	public function insert()
	{
		$permissions = new \App\Models\Admin\Permission;

		return vAdmin('user/insertUpdate', [
			'permissions' => $permissions->get([
				'deletado' => '0'
			])
		]);
	}

	public function store()
	{
		$address = new \App\Controllers\Shared\Address;

		if ($this->request->getFile('avatar')) {
			$userPath = "uploads/users/";
			$avatar = $this->request->getFile('avatar');

			if (in_array(
				$avatar->getClientMimeType(),
				['image/jpg','image/jpeg','image/gif','image/png']
			)) {
				$newName = $avatar->getRandomName();
	            $avatar->move($userPath, $newName);

	            $avatarPath = $userPath . $newName;
	        }
		}

		$userResult = $this->model->add([
			'idPermissao' => $this->request->getPost('permissao'),
			'idEndereco' => $address->store($this->request),
			'nomeCompleto' => $this->request->getPost('nome'),
			'cpf' => $this->request->getPost('cpf'),
			'telefone' => $this->request->getPost('telefone'),
			'email' => $this->request->getPost('email'),
			'senha' => $this->request->getPost('senha'),
			'avatar' => (isset($avatarPath)) ?: null,
			'dataCadastro' => date('Y-m-d')
		]);

		if ($userResult) {
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

		return cRedirect('administradores', 'a');
	}

	public function edit()
	{
		$permission = new \App\Models\Admin\Permission;
		$address = new \App\Models\Shared\Address;

		$user = $this->model->getLast(
			['idUsuario' => $this->request->uri->getSegment(4)]
		);

		return vAdmin('user/insertUpdate', [
			'permissions' => $permission->get(["deletado" => '0']),
			'address' => $address->getLast(['idEndereco' => $user->idEndereco]),
			'item' => $user
		]);
	}

	public function update()
	{
		$user = $this->model->getLast(
			['idUsuario' => $this->request->uri->getSegment(4)]
		);

		$address = new \App\Controllers\Shared\Address;
		$address->update($this->request, $user->idEndereco);

		$data = [
			'idPermissao' => $this->request->getPost('permissao'),
			'nomeCompleto' => $this->request->getPost('nome'),
			'cpf' => $this->request->getPost('cpf'),
			'telefone' => $this->request->getPost('telefone'),
			'email' => $this->request->getPost('email'),
			'senha' => $this->request->getPost('senha')
		];

		if ($this->request->getFile('avatar')) {
			$userPath = "uploads/users/";
			$avatar = $this->request->getFile('avatar');

			if (in_array(
				$avatar->getClientMimeType(),
				['image/jpg','image/jpeg','image/gif','image/png']
			)) {
				$newName = $avatar->getRandomName();
	            $avatar->move($userPath, $newName);

	            $data['avatar'] = $userPath . $newName;
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

		return cRedirect('administradores', 'a');
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

		return cRedirect('administradores', 'a');
	}
}
