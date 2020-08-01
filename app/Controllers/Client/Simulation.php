<?php
namespace App\Controllers\Client;

class Simulation extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Client\Simulation;
	}


	public function index()
	{
		$result = $this->model->count(
			['idUsuario' => $this->session->id], 'fullest'
		);

		return vClient('simulation/index', [
			'simulations' => $result['data'],
			'count' => $result['count']
		]);
	}

	public function create()
	{
		if ($this->request->uri->getSegment(4)) {
			return $this->view(true);
		}

		$index = new \App\Models\Client\Index;

		return vClient('simulation/insertUpdate', [
			'index' => $index->getLast(['idUsuario', $this->session->id])
		]);
	}

	public function store()
	{
		if (!$this->request->isAJAX()) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$index = new \App\Controllers\Client\Index;
		$indexResult = $index->store($this->request, false);

		$result = $this->model->add([
			'idIndice' => $indexResult,
			'idUsuario' => $this->session->id,
			'produto' => $this->request->getPost('produto'),
			'precoCompra' => cleanPrice($this->request->getPost('preco-compra')),
			'precoVenda' => cleanPrice($this->request->getPost('preco-venda')),
			'dataCadastro' => date('Y-m-d')
		]);

		if ($result) {
			$data = [
				'idSimulacao' => $result,
				'precoEmpate' => cleanPrice($this->request->getPost('precoEmpate')) ?: 0,
				'markup' => cleanPrice($this->request->getPost('markup')) ?: 0,
				'comissaoR' => cleanPrice($this->request->getPost('comissao-real')) ?: 0,
				'comissaoP' => $this->request->getPost('comissao-percent') ?: 0,
				'lucroDesejadoR' => $this->request->getPost('resultado') ?: 0,
				'lucroDesejadoP' => $this->request->getPost('lucro') ?: 0
			];

			$simulationIndex = new \App\Models\Client\SimulationIndex;
			$result = $simulationIndex->add($data);
		}

		return $this->response->setJSON([
			'url' => base_url('client/simulation/create'),
			'success' => ($result) ? true : false,
			'code' => ($result) ? $result : 0
		]);
	}

	public function edit()
	{
		$index = new \App\Models\Client\Index;
		$simulationIndex = new \App\Models\Client\SimulationIndex;

		$simulation = $this->model->getLast(
			['idSimulacao' => $this->request->uri->getSegment(4)]
		);

		if (!is_object($simulation) || ($simulation->idUsuario !== $this->session->id)) {
			$this->session->setFlashdata([
				'success' => false,
				'message' => 'Falha ao retornar os dados da simulação.'
			]);

			return cRedirect('simulation');
		}

		return vClient('simulation/insertUpdate', [
			'simulationIndex' => $simulationIndex->getLast(['idSimulacao' => $this->request->uri->getSegment(4)]),
			'index' => $index->getLast(['idIndice' => $simulation->idIndice]),
			'item' => $simulation
		]);
	}

	public function update()
	{
		if (!$this->request->isAJAX()) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$result = $this->model->edit(
			[
				'produto' => $this->request->getPost('produto') ?: null,
				'fornecedor' => $this->request->getPost('fornecedor') ?: null
			],
			['idSimulacao' => $this->request->uri->getSegment(4)]
		);

		$simulationIndex = new \App\Models\Client\SimulationIndex;
		$result = $simulationIndex->edit(
			[
				'precoEmpate' => cleanPrice($this->request->getPost('precoEmpate')) ?: 0,
				'markup' => cleanPrice($this->request->getPost('markup')) ?: 0,
				'comissaoR' => cleanPrice($this->request->getPost('comissao-real')) ?: 0,
				'comissaoP' => $this->request->getPost('comissao-percent') ?: 0,
				'lucroDesejadoR' => $this->request->getPost('resultado') ?: 0,
				'lucroDesejadoP' => $this->request->getPost('lucro') ?: 0
			],
			['idSimulacao' => $this->request->uri->getSegment(4)]
		);

		return $this->response->setJSON([
			'success' => true
		]);
	}

	public function view($copy = false)
	{
		$index = new \App\Models\Client\Index;
		$simulationIndex = new \App\Models\Client\SimulationIndex;

		$simulation = $this->model->getLast(
			['idSimulacao' => $this->request->uri->getSegment(4)]
		);

		if (!is_object($simulation) || ($simulation->idUsuario !== $this->session->id)) {
			$this->session->setFlashdata([
				'success' => false,
				'message' => 'Falha ao retornar os dados da simulação.'
			]);

			return cRedirect('simulation');
		}

		if ($copy) {
			$resultIndex =  $index->getLast(['idUsuario' => $this->session->id]);
		} else {
			$resultIndex = $index->getLast(['idIndice' => $simulation->idIndice]);
		}

		return vClient('simulation/insertUpdate', [
			'simulationIndex' => $simulationIndex->getLast(['idSimulacao' => $this->request->uri->getSegment(4)]),
			'index' => $resultIndex,
			'item' => $simulation
		]);
	}

	public function delete()
	{
		$simulationIndex = new \App\Models\Client\SimulationIndex;

		$resultSimulationIndex = $simulationIndex->drop([
			'idSimulacao' => $this->request->uri->getSegment(4)
		]);

		$resultSimulation = $this->model->drop([
			'idSimulacao' => $this->request->uri->getSegment(4)
		]);

		if ($resultSimulation && $resultSimulationIndex) {
			$this->session->setFlashdata([
				'success' => true,
				'message' => 'Operação executada com sucesso.'
			]);
		} else {
			$this->session->setFlashdata([
				'success' => false,
				'message' => 'Falha ao retornar os dados da simulação.'
			]);
		}

		return cRedirect('simulation');
	}
}
