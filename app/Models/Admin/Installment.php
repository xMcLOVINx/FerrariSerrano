<?php
namespace App\Models\Admin;

class Installment extends \App\Models\BiTModel
{
	protected $table = 'parcelamentos';

	protected $allowedFields = [
		'titulo',
		'parcelas',
		'desconto',
		'valorParcela',
		'imagem',
		'dataCadastro'
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
					parcelamentos.*,
					IFNULL(COUNT(mensalidades.idMensalidade), 0) AS itens
				'
			)->join(
				'mensalidades',
				'parcelamentos.idParcelamento = mensalidades.idParcelamento',
				'left'
			)->where($where)
		) {
			return $builder->get();
		}
	}
}
