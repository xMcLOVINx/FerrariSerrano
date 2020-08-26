<?php
namespace App\Models\Admin;

class Installment extends \App\Models\BiTModel
{
	protected $table = 'parcelamentos';

	protected $allowedFields = [
		'titulo',
		'parcelas',
		'desconto',
		'valorParcela',
		'dataCadastro'
	];
}
