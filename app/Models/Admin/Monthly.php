<?php
namespace App\Models\Admin;

class Monthly extends \App\Models\BiTModel
{
	protected $table = 'mensalidades';

	protected $allowedFields = [
		'idParcelamento',
		'idUsuario',
		'dataLancamento',
		'dataCadastro',
		'finalizado',
		'deletado'
	];


	public function getMonthly($where = [])
	{
		if (
			$builder = $this->select()->join(
				'
					(
						SELECT 
							*, 
							COUNT(mp.idMensalidadeParcela) \'parcelasTotal\',
							SUM(
								IF(mp.dataVencimento < CURRENT_DATE, 1, 0)
							) \'parcelasAtrasadas\', 
							SUM(
								IF(mp.pago = 1, 1, 0)
							) \'parcelasPagas\' 
						FROM 
							mensalidades_parcelas mp 
						GROUP BY 
							mp.idMensalidade
					) sub
				',
				'mensalidades.idMensalidade = sub.idMensalidade',
				'left'
			)->join(
				'
					(
						SELECT
							idUsuario,
							nomeCompleto,
							cnpj,
							telefone,
							dataCadastro
						FROM
							usuarios
					) usuarios
				',
				'mensalidades.idUsuario = usuarios.idUsuario',
				'inner'
			)->where($where)
		) {
			return $builder->get();
		}
	}
}
