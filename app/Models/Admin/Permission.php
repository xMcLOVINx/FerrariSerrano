<?php
namespace App\Models\Admin;

class Permission extends \App\Models\BiTModel
{
	protected $table = 'permissoes';

	protected $allowedFields = [
		'titulo',
		'permissoes',
		'dataCadastro',
		'deletado'
	];
}
