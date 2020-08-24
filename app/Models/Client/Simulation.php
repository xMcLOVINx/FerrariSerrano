<?php
namespace App\Models\Client;

class Simulation extends \App\Models\BiTModel
{
	protected $table = 'simulacoes';

	protected $allowedFields = [
		'idIndice',
		'idUsuario',
		'produto',
		'fornecedor',
		'precoCompra',
		'precoVenda',
		'dataCadastro',
		'tipo'
	];
}
