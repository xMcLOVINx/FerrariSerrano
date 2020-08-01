<?php
namespace App\Controllers\Admin;

class Profile extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Admin\User;
	}


	public function index()
	{
		$permission = new \App\Models\Admin\Permission;

		$result = $this->model->getLast(
			['idUsuario' => $this->session->idUsuario]
		);

		return vAdmin('profile/index', [
			'permission' => $permission->getLast(
				['idPermissao' => $result->idPermissao]
			),
			'data' => $result
		]);
	}

	public function update()
	{
		$data = [];

		$user = $this->model->getLast([
			'idUsuario' => $this->session->idUsuario
		]);

		if ($this->request->getPost('senha_atual') !== $user->senha) {
			$this->session->setFlashdata([
				'success' => false,
				'message' => 'A senha atual está incorreta.'
			]);

			return cRedirect('perfil', 'a');
		}

		if ($this->request->getPost('pergunta') == 1) {
			$data['senha'] = $this->request->getPost('senha');
		}

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

		$data['telefone'] = $this->request->getPost('telefone');
		$data['email'] = $this->request->getPost('email');

		$result = $this->model->edit($data, [
			'idUsuario' => $this->session->idUsuario
		]);

		$this->session->setFlashdata([
			'success' => true
		]);

		return redirect()->to(base_url('admin'));
	}
}
