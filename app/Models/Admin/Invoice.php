<?php
namespace App\Models\Admin;

class Invoice extends \App\Models\BiTModel
{
	protected $table = 'mensalidades_parcelas';

	protected $allowedFields = [
		'idMensalidade',
		'valorParcela',
		'dataVencimento',
		'dataPagamento',
		'pago',
		'metodoPagamento'
	];


	public function count($where = [], $retrieveType = 'simple') {
		if (
			$this->select()->join(
				'mensalidades',
				'mensalidades.idMensalidade = mensalidades_parcelas.idMensalidade',
				'inner'
			)->where($where)
		) {
			return $this->countAllResults();
		}
	}
}
