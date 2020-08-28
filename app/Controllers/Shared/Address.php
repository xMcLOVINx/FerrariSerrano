<?php
namespace App\Controllers\Shared;

class Address extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Shared\Address;
	}


	public function store($request)
	{
		$result = $this->model->add([
			'cep' => $request->getPost('cep'),
			'cidade' => $request->getPost('cidade'),
			'estado' => $request->getPost('estado'),
			'logradouro' => $request->getPost('rua'),
			'bairro' => $request->getPost('bairro'),
			'numero' => $request->getPost('numero')
		]);

		return $result;
	}

	public function update($request, $id)
	{
		$result = $this->model->edit([
			'cep' => $request->getPost('cep'),
			'cidade' => $request->getPost('cidade'),
			'estado' => $request->getPost('estado'),
			'logradouro' => $request->getPost('rua'),
			'bairro' => $request->getPost('bairro'),
			'numero' => $request->getPost('numero')
		], ['idEndereco' => $id]);

		return $result;
	}
}
