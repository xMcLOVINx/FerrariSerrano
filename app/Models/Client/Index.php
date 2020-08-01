<?php
namespace App\Models\Client;

class Index extends \App\Models\BiTModel
{
	protected $table = 'indices';

	protected $allowedFields = [
		'idUsuario',
		'faturamento',
		'impostosR',
		'impostosP',
		'comissaoR',
		'comissaoP',
		'custosFixosR',
		'custosFixosP',
		'lucroDesejadoR',
		'lucroDesejadoP'
	];
}
