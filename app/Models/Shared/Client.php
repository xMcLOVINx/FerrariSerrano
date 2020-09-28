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
				'mensalidades',
				'
					mensalidades.idUsuario = usuarios.idUsuario
				',
				'left'
			)->join(
				'
					(
						SELECT
							idMensalidadeParcela,
							idMensalidade,
							dataVencimento,
							pago
						FROM
							mensalidades_parcelas
						WHERE
							pago = 1 AND
							dataVencimento >= CURRENT_DATE
						ORDER BY
							idMensalidadeParcela DESC
					) mensalidades_parcelas
				',
				'mensalidades.idMensalidade = mensalidades_parcelas.idMensalidade',
				'left'
			)->where($where)->orderBy(
				'idMensalidadeParcela'
			)->limit(1)
		) {
			return $builder->limit(1)->get();
		}
	}
}
