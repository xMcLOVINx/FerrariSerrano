<?php
namespace App\Models\Shared;

class Client extends \App\Models\BiTModel
{
	protected $table = 'usuarios';

	protected $allowedFields = [
		'idEndereco',
		'razaoSocial',
		'cnpj',
		'telefone',
		'email',
		'senha',
		'avatar',
		'dataCadastro',
		'deletado'
	];
}
