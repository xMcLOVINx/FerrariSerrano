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
}
