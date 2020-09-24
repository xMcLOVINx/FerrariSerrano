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


	public function getClient($where = [])
	{
		if (
			$builder = $this->select()->join(
				'
					(
						SELECT
							mensalidades.idMensalidade,
							mensalidades.idUsuario,
							mensalidades.finalizado
						FROM
							mensalidades
						LIMIT
							1
					) mensalidades
				',
				'
					mensalidades.finalizado != 0 AND 
					mensalidades.idUsuario = usuarios.idUsuario
				',
				'left'
			)->join(
				'
					(
						SELECT
							mensalidades_parcelas.idMensalidade,
							mensalidades_parcelas.dataVencimento
						FROM
							mensalidades_parcelas
						WHERE
							mensalidades_parcelas.pago = 1
						ORDER BY
							mensalidades_parcelas.idMensalidadeParcela DESC
						LIMIT
							1
					) mensalidades_parcelas
				',
				'mensalidades.idMensalidade = mensalidades_parcelas.idMensalidade',
				'left'
			)->where($where)
		) {
			return $builder->get();
		}
	}
}
