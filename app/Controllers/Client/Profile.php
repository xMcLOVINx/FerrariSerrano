<?php
namespace App\Controllers\Client;

class Profile extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Client\Client;
	}


	public function index()
	{
		$result = $this->model->getLast(
			['idUsuario' => $this->session->id]
		);

		return vClient('profile/index', [
			'data' => $result
		]);
	}

	public function update()
	{
		$data = [];

		$client = $this->model->getLast(['idUsuario' => $this->session->id]);

		if ($this->request->getPost('senha_atual') !== $client->senha) {
			$this->session->setFlashdata([
				'success' => false,
				'message' => 'A senha atual está incorreta.'
			]);

			return cRedirect('profile');
		}

		if ($this->request->getPost('pergunta') == 1) {
			$data['senha'] = $this->request->getPost('senha');
		}

		if ($this->request->getFile('avatar')) {
			$userPath = "uploads/clients/";
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

		$result = $this->model->edit($data, ['idUsuario' => $this->session->id]);

		$this->session->setFlashdata([
			'success' => true
		]);

		return redirect()->to(base_url());
	}
}
