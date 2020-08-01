<?php
namespace App\Controllers\Client;

class Index extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Client\Index;
	}


	public function store($request = null, $json = true)
	{
		if (is_null($request)) {
			$request = $this->request;
		}

		if (!$request->isAJAX()) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$data = [
			'idUsuario' => $this->session->id,
			'faturamento' => cleanPrice($request->getPost('i-faturamento')) ?: 0,
			'impostosR' => cleanPrice($request->getPost('i-impostos-real')) ?: 0,
			'impostosP' => $request->getPost('i-impostos-percent') ?: 0,
			'comissaoR' => cleanPrice($request->getPost('i-comissao-real')) ?: 0,
			'comissaoP' => $request->getPost('i-comissao-percent') ?: 0,
			'custosFixosR' => cleanPrice($request->getPost('i-custos-real')) ?: 0,
			'custosFixosP' => $request->getPost('i-custos-percent') ?: 0,
			'lucroDesejadoR' => $request->getPost('i-lucro-real') ?: 0,
			'lucroDesejadoP' => $request->getPost('i-lucro-percent') ?: 0
		];

		$result = $this->checkIfACustomerRecordExists($data) ?? $this->model->add($data);

		if (!$json) {
			return $result;
		}

		return $this->response->setJSON([
			'success' => true,
			'code' => $result
		]);
	}

	private function checkIfACustomerRecordExists($data)
	{
		$result = $this->model->getLast(['idUsuario' => $this->session->id]);

		if (!is_object($result)) {
			return;
		}

		foreach ($data as $key => $value) {
			if (!property_exists($result, $key)) {
				continue;
			}

			if ($value != $result->{$key}) {
				return;
			}
		}

		return $result->idIndice;
	}
}
