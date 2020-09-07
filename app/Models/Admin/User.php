<?php
namespace App\Models\Admin;

class User extends \App\Models\BiTModel
{
	protected $table = 'usuarios';

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


	public function getUsers($where = [])
	{
		if (
			$builder = $this->select()->join(
				'
					(
						SELECT
							permissoes.idPermissao,
							permissoes.titulo
						FROM
							permissoes
					) permissoes
				',
				'usuarios.idPermissao = permissoes.idPermissao',
				'inner'
			)->where($where)
		) {
			return $builder->get();
		}
	}
}
