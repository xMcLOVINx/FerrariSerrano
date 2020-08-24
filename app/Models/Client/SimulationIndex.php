<?php
namespace App\Models\Client;

class SimulationIndex extends \App\Models\BiTModel
{
	protected $table = 'simulacoes_indices';

	protected $allowedFields = [
		'idSimulacao',
		'markup',
		'precoEmpate',
		'comissaoR',
		'comissaoP',
		'lucroDesejadoR',
		'lucroDesejadoP'
	];
}
