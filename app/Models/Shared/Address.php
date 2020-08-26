<?php
namespace App\Models\Shared;

class Address extends \App\Models\BiTModel
{
	protected $table = 'enderecos';

	protected $allowedFields = [
		'cep',
		'cidade',
		'estado',
		'logradouro',
		'bairro',
		'numero'
	];
}
