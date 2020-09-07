<?php
namespace App\Models\Admin;

class Installment extends \App\Models\BiTModel
{
	protected $table = 'parcelamentos';

	protected $allowedFields = [
		'titulo',
		'parcelas',
		'desconto',
		'imagem',
		'dataCadastro',
		'deletado'
	];


	public function __construct()
	{
		parent::__construct();
	}


	public function getInstallments($where = [])
	{
		if (
			$builder = $this->select(
				'
					parcelamentos.idParcelamento,
					parcelamentos.titulo,
					parcelamentos.parcelas,
					parcelamentos.desconto,
					parcelamentos.imagem,
					parcelamentos.dataCadastro,
					parcelamentos.deletado,
					IFNULL(COUNT(mensalidades.idMensalidade), 0) AS itens
				'
			)->join(
				'
					(
						SELECT
							mensalidades.idMensalidade,
							mensalidades.idParcelamento
						FROM
							mensalidades
					) mensalidades
				',
				'parcelamentos.idParcelamento = mensalidades.idParcelamento',
				'left'
			)->where($where)->groupBy('parcelamentos.idParcelamento')
		) {
			return $builder->get();
		}
	}
}
