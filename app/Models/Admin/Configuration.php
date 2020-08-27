<?php
namespace App\Models\Admin;

class Configuration extends \App\Models\BiTModel
{
	protected $table = 'configuracoes';

	protected $allowedFields = [
		'tituloPagina',
		'valorServico',
		'termosCondicoes',
		'logoPainel',
		'logoApp'
	];
}