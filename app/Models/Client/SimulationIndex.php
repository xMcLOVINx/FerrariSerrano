<?php
namespace App\Models\Client;

class SimulationIndex extends \App\Models\BiTModel
{
	protected $table = 'simulacoes_indices';

	protected $allowedFields = [
		'idSimulacao',
		'cmv',
		'markup',
		'comissaoR',
		'comissaoP',
		'lucroDesejadoR',
		'lucroDesejadoP'
	];
}
