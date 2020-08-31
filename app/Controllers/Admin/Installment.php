<?php
namespace App\Controllers\Admin;

class Installment extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Admin\Installment;
	}


	public function index()
	{
		return vAdmin('installment/index', [
			'installments' => $this->model->get([
				'deletado' => '0'
			])
		]);
	}

	public function insert()
	{
		$configurations = new \App\Models\Admin\Configuration;

		return vAdmin('installment/insertUpdate', [
			'configurations' => $configurations->getLast()
		]);
	}

	public function store()
	{
		if ($this->request->getFile('image')) {
			$imagePath = "uploads/clients/";
			$image = $this->request->getFile('image');

			if (in_array(
				$image->getClientMimeType(),
				['image/jpg','image/jpeg','image/gif','image/png']
			)) {
				$newName = $image->getRandomName();
	            $image->move($imagePath, $newName);

	            $imagePath = $imagePath . $newName;
	        }
		}

		$clientResult = $this->model->add([
			'titulo' => $this->request->getPost('titulo'),
			'parcelas' => $this->request->getPost('parcelas'),
			'desconto' => $this->request->getPost('desconto'),
			'imagem' => $imagePath,
			'dataCadastro' => date('Y-m-d')
		]);

		if ($clientResult) {
			$this->session->setFlashdata([
				'success' => true
			]);
		} else {
			$this->session->setFlashdata([
				'success' => false
			]);
		}

		return cRedirect('installments', 'a');
	}
}
