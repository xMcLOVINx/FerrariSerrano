<?php
namespace App\Models\Admin;

class User extends \App\Models\BiTModel
{
	protected $table = 'usuarios u';

	protected $allowedFields = [
		'idPermissao',
		'idEndereco',
		'nomeCompleto',
		'cpf',
		'telefone',
		'email',
		'senha',
		'avatar',
		'dataCadastro',
		'deletado'
	];


	public function __construct()
	{
		parent::__construct();
	}


	public function getUsers()
	{
		if (
			$builder = $this->select()->join('permissoes p', 'u.idPermissao = p.idPermissao')
		) {
			return $builder->get();
		}
	}
}
