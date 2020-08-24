
<link href="<?= base_url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/jquery-ui/jquery-ui.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
			<h4>Listagem de vendas</h4>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
					</li>

					<li class="breadcrumb-item active">
						Vendas
					</li>

					<li class="breadcrumb-item active">
						Listagem
					</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger alert-dismissible" role="alert" style="text-align: justify">
				<strong style="color: #000">Observação:</strong> Quando uma venda não foi faturada, alguns campos do mesmo possuirá o valor N/A (Not Applicable).

				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">
						<i class="fas fa-times" style="margin-top: 2px"></i>
					</span>
				</button>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="portlet">
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark text-uppercase">
						Pesquisa Avançada
					</h3>

					<div class="portlet-widgets">
						<a data-toggle="collapse" data-parent="#accordion1" href="#portlet2">
							<i class="ion-minus-round"></i>
						</a>

						<span class="divider"></span>

						<a href="#" data-toggle="remove">
							<i class="ion-close-round"></i>
						</a>
					</div>

					<div class="clearfix"></div>
				</div>

				<div id="portlet2" class="panel-collapse collapse in">
					<div class="portlet-body">
						<form action="#" method="POST" class="p-l-r-5">
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label class="control-label" for="cliente">
											Cliente *
										</label>

										<input id="cliente" name="cliente" type="text" class="required form-control" />
									</div>

									<div class="col-md-3">
										<label class="control-label" for="data_minima">
											De *
										</label>

										<input id="data_minima" name="data_minima" type="text" class="required form-control datepicker" placeholder="dia/mes/ano" />
									</div>

									<div class="col-md-3">
										<label class="control-label" for="data_limite">
											Até *
										</label>

										<input id="data_limite" name="data_limite" type="text" class="required form-control datepicker" placeholder="dia/mes/ano" />
									</div>
								</div>
							</div>

							<div class="form-group text-right m-b-0">
								<button class="btn btn-success" type="submit">
									<i class="fas fa-search"></i> FILTRAR
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="card-box table-responsive">
				<h4 class="m-b-30 header-title">
					<b>Listagem de Vendas</b>
				</h4>

				<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th># ID</th>
							<th>Cliente</th>
							<th>Valor</th>
							<th>Data Cadastro</th>
							<th class="actions">Parcelas</th>
							<th class="actions">Situação</th>
							<th class="actions">
								<i class="fas fa-cog"></i>
							</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td width="60">1</td>

							<td>Antônio Roberto Castro</td>

							<td>R$ 1,00</td>

							<td>16/01/2020</td>

							<td></td>

							<td class="text-center">
								<span class="label label-table label-primary" data-toggle="tooltip" data-placement="top" title="Novo Item">
									Novo
								</span>
							</td>

							<td class="actions" width="180">
								<a href="<?= base_url('vendas/atualizar/1') ?>" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Editar">
									<i class="md md-edit"></i>
								</a>

								<a href="javascript:void(0)" class="table-action-btn btn-view" data-toggle="tooltip" data-placement="top" title="Visualizar">
									<i class="md md-remove-red-eye"></i>
								</a>
							</td>
						</tr>

						<tr>
							<td width="60">3</td>

							<td></td>

							<td>R$ 4000,00</td>

							<td>12/01/2020</td>

							<td></td>

							<td class="text-center">
								<span class="label label-table label-danger" data-toggle="tooltip" data-placement="top" title="Situação do Pagamento">
									Pendente
								</span>
							</td>

							<td class="actions" width="180">
								<a href="<?= base_url('vendas/atualizar/1') ?>" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Editar">
									<i class="md md-edit"></i>
								</a>

								<a href="javascript:void(0)" class="table-action-btn btn-view" data-toggle="tooltip" data-placement="top" title="Visualizar">
									<i class="md md-remove-red-eye"></i>
								</a>
							</td>
						</tr>

						<tr>
							<td width="60">11</td>

							<td></td>

							<td>R$ 3000,00</td>

							<td>12/01/2020</td>

							<td></td>

							<td class="text-center">
								<span class="label label-table label-success" data-toggle="tooltip" data-placement="top" title="Situação do Pagamento">
									Pago
								</span>
							</td>

							<td class="actions" width="180">
								<a href="<?= base_url('vendas/atualizar/1') ?>" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Editar">
									<i class="md md-edit"></i>
								</a>

								<a href="javascript:void(0)" class="table-action-btn btn-view" data-toggle="tooltip" data-placement="top" title="Visualizar">
									<i class="md md-remove-red-eye"></i>
								</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div id="view-modal" class="modal-demo">
	<div class="header">
		<button type="button" class="close" onclick="Custombox.close()">
			<i class="fas fa-times"></i>
		</button>

		<h4 class="custom-modal-title">Visualizar Venda</h4>
	</div>

	<div class="modal-form">
		<form class="form">
			<div class="modal-body">
				<div class="row">
					<h4 class="col-md-12 header-title text-left">
						<b>Informações do Cliente</b>
					</h4>

					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="id_cliente">
								# ID
							</label>

							<input id="id_cliente" name="id_cliente" type="text" class="required form-control" value="21" disabled />
						</div>
					</div>

					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label" for="cliente">
								Cliente
							</label>

							<input id="cliente" name="cliente" type="text" class="required form-control" value="Kleber Palhano" disabled />
						</div>
					</div>
				</div>

				<div class="row">
					<h4 class="col-md-12 header-title text-left">
						<b>Informações da Venda</b>
					</h4>

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="descricao">
								Descrição
							</label>

							<input id="descricao" name="descricao" type="text" class="required form-control" value="Venda #993" disabled />
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="data_lancamento">
								Data Lançamento
							</label>

							<input id="data_lancamento" name="data_lancamento" type="text" class="required form-control" value="12/06/2020" disabled />
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="data_vencimento">
								Data Vencimento
							</label>

							<input id="data_vencimento" name="data_vencimento" type="text" class="required form-control" value="12/06/2020" disabled />
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label" for="valor_venda">
								Valor Venda
							</label>

							<input id="valor_venda" name="valor_venda" type="text" class="required form-control" value="R$ 300,00" disabled />
						</div>
					</div>
				</div>

				<div class="row">
					<h4 class="col-md-12 header-title text-left">
						<b>Informações do Vendedor</b>
					</h4>

					<div class="col-md-2">
						<div class="form-group">
							<label class="control-label" for="id_vendedor">
								# ID
							</label>

							<input id="id_vendedor" name="id_vendedor" type="text" class="required form-control" value="21" disabled />
						</div>
					</div>

					<div class="col-md-10">
						<div class="form-group">
							<label class="control-label" for="vendedor">
								Vendedor
							</label>

							<input id="vendedor" name="vendedor" type="text" class="required form-control" value="Maria José da Silva" disabled />
						</div>
					</div>
				</div>

				<div class="row">
					<h4 class="col-md-12 header-title text-left">
						<b>Informações do Pagamento</b>
					</h4>

					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="aprovacao">
								Data Pagamento
							</label>

							<input id="aprovacao" name="aprovacao" type="text" class="required form-control" value="N/A" disabled />
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label" for="valor_pago">
								Valor Pagamento
							</label>

							<input id="valor_pago" name="valor_pago" type="text" class="required form-control" value="N/A" disabled />
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function()
{
	$('.datepicker').datepicker({
		format: "dd/mm/yyyy"
	});

	//=========

	$('#datatable').dataTable({
		"order": [[0, "desc"]]
	});

	//=========

	var availableTags = [
		"João Silva Gomes",
		"José Roberto Marinho",
		"Olavo de Carvalho"
	];

	$("#cliente").autocomplete({
	  source: availableTags
	});

	//=========

	$('.btn-view').on('click', function()
	{
		Custombox.open({
			target: '#view-modal',
			overlayColor: '#36404a',
			overlaySpeed: '100',
			effect: 'flash'
		});
	});
});
</script>
