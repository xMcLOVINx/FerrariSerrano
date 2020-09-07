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
			'installments' => $this->model->getInstallments([
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
			$imagePath = "uploads/installments/";
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

		$result = $this->model->add([
			'titulo' => $this->request->getPost('titulo'),
			'parcelas' => $this->request->getPost('parcelas'),
			'desconto' => $this->request->getPost('desconto'),
			'imagem' => $imagePath,
			'dataCadastro' => date('Y-m-d')
		]);

		if ($result) {
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

	public function edit()
	{
		$configurations = new \App\Models\Admin\Configuration;

		$installment = $this->model->getLast(
			['idParcelamento' => $this->request->uri->getSegment(4)]
		);

		return vAdmin('installment/insertUpdate', [
			'configurations' => $configurations->getLast(),
			'item' => $installment
		]);
	}

	public function update()
	{
		$imagePath = null;

		if ($this->request->getFile('image')) {
			$imagePath = "uploads/installments/";
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

		$result = $this->model->edit([
			'titulo' => $this->request->getPost('titulo'),
			'parcelas' => $this->request->getPost('parcelas'),
			'desconto' => $this->request->getPost('desconto'),
			'imagem' => $imagePath
		],
			['idParcelamento' => $this->request->uri->getSegment(4)]
		);

		if ($result) {
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

	public function delete()
	{
		$result = $this->model->disable([
			'idParcelamento' => $this->request->uri->getSegment(4)
		]);

		if ($result) {
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

	public function search()
	{
		if (!$this->request->isAJAX()) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$installments = $this->model->getLike(
			'titulo', $this->request->getPost('search'), [
				'deletado' => '0'
			]
		);

		$results = [];

		if ($installments) {
			foreach ($installments as $key => $installment) {
				$results[] = [
					'value' => $installment->idParcelamento,
					'label' => $installment->titulo,
					'extras' => [
						'installment' => $installment->parcelas,
						'discount' => $installment->desconto
					]
				];
			}
		}

		return $this->response->setJSON([
			'success' => true,
			'results' => $results
		]);
	}

	public function getLast($id)
	{
		return $this->model->getLast([
			'idParcelamento' => $id
		]);
	}
}
