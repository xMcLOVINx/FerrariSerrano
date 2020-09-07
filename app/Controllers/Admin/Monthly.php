<?php
namespace App\Controllers\Admin;

class Monthly extends \App\Controllers\BiTController
{
	private $model;


	public function __construct()
	{
		parent::__construct();

		$this->model = new \App\Models\Admin\Monthly;
	}


	public function index()
	{
		return vAdmin('monthly/index', [
			'monthly' => $this->model->getMonthly([
				'finalizado' => '0',
				'deletado' => '0'
			])
		]);
	}

	public function insert()
	{
		return vAdmin('monthly/insertUpdate');
	}

	public function store()
	{
		$installment = (new \App\Controllers\Admin\installment)->getLast(
			$this->request->getPost('parcelamento-id')
		);

		$monthly = $this->model->add([
			'idParcelamento' => $installment->idParcelamento,
			'idUsuario' => $this->request->getPost('cliente-id'),
			'dataLancamento' => convertDate(
				$this->request->getPost('lancamento'), true
			),
			'dataCadastro' => date('Y-m-d')
		]);

		if ($monthly) {
			$configurations = new \App\Controllers\Admin\Configuration;
			$dueDate = new \App\Libraries\Date(convertDate(
				$this->request->getPost('lancamento'), true
			));

			$servicePrice = $configurations->getPrice(true);
			$invoicesPrice = (
				($servicePrice - (($servicePrice * $installment->desconto) / 100)) /
				($installment->parcelas)
			);

			for ($i = 0; $i < $installment->parcelas; $i++) {
				$dueDate->add()->days(30);

				$invoices = (new \App\Controllers\Admin\Invoice)->store([
					'idMensalidade' => $monthly,
					'valorParcela' => $invoicesPrice,
					'dataVencimento' => $dueDate->get()
				]);
			}
		}

		if ($monthly && $invoices) {
			$this->session->setFlashdata([
				'success' => true
			]);
		} else {
			$this->session->setFlashdata([
				'success' => false
			]);
		}

		return cRedirect('monthly/update/' . $monthly, 'a');
	}

	public function edit()
	{
		$configurations = new \App\Models\Shared\Client;
		$invoices = new \App\Models\Admin\Invoice;

		$monthly = $this->model->getLast(
			['idMensalidade' => $this->request->uri->getSegment(4)]
		);

		return vAdmin('monthly/insertUpdate', [
			'client' => $configurations->getLast([
				'idUsuario' => $monthly->idUsuario
			]),
			'invoices' => $invoices->get([
				'idMensalidade' => $monthly->idMensalidade
			]),
			'item' => $monthly
		]);
	}

	public function update()
	{
		return cRedirect('monthly', 'a');
	}

	public function payInvoice()
	{
		if (!$this->request->isAJAX()) {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$invoices = array();
		parse_str($this->request->getPost('parcelas'), $invoices);
		$invoivesSelected = count($invoices['parcela']);

		$invoice = new \App\Models\Admin\Invoice;

		$invoicesAllowed = $invoice->get([
			'idMensalidade' => $this->request->uri->getSegment(4),
			'pago' => '0'
		]);

		for ($i = 0; $i < $invoivesSelected; $i++) {
			$return = $invoice->edit([
				'metodoPagamento' => $this->request->getPost('metodoPgd'),
				'dataPagamento' => convertDate(
					$this->request->getPost('dataRecebimento'), true
				),
				'pago' => '1'
			], [
				'idMensalidadeParcela' => $invoicesAllowed[$i]->idMensalidadeParcela
			]);
		}

		$this->session->setFlashdata([
			'success' => true
		]);

		return $this->response->setJSON([
			'success' => true
		]);
	}

	public function finalize()
	{
		$invoice = new \App\Models\Admin\Invoice;

		foreach (
			$this->model->getMonthly(['finalizado' => '0']) as 
			$key => $item
		) {
			if (
				$item->parcelasTotal !== 0 &&
				$item->parcelasTotal == $item->parcelasPagas
			) {
				$lastInvoice = $invoice->getLast([
					'idMensalidade' => $item->idMensalidade
				]);

				if ($lastInvoice->dataVencimento < date('Y-m-d')) {
					$result = $this->model->edit([
						'finalizado' => '1'
					], [
						'idMensalidade' => $item->idMensalidade
					]);
				}
			}
		}

		return $this->response->setJSON([
			'success' => true
		]);
	}
}
