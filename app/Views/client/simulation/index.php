
<link href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
			<h4>Listagem de simulações</h4>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
					</li>

					<li class="breadcrumb-item active">
						Simulações
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
			<div class="portlet">
				<div class="portlet-heading">
					<h3 class="portlet-title text-dark text-uppercase">
						Pesquisa Avançada
					</h3>

					<div class="portlet-widgets">
						<a data-toggle="collapse" data-parent="#accordion1" href="#portlet2">
							<i class="ion-minus-round"></i>
						</a>
					</div>

					<div class="clearfix"></div>
				</div>

				<div id="portlet2" class="panel-collapse collapse in">
					<div class="portlet-body">
						<form class="p-l-r-5">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label" for="produto">
											Produto
										</label>

										<input id="produto" name="produto" type="text" class="form-control" />
									</div>
								</div>

								<div class="col-md-4 col-md-offset-4 hidden-md hidden-lg radio-btn">
									<label>
										<input class="action" type="radio" name="action" value="copy" checked />

										<div class="copy box">
											<span>Copiar</span>
										</div>
									</label>

									<label>
										<input class="action" type="radio" name="action" value="edit" />

										<div class="edit box">
											<span>Atualizar</span>
										</div>
									</label>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row hidden-sm hidden-xs">
		<div class="col-sm-12">
			<div class="card-box table-responsive">
				<h4 class="m-b-30 header-title">
					<b>Simulações</b>
				</h4>

				<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th># ID</th>
							<th>Produto</th>
							<th>Data Cadastro</th>
							<th>Preço Compra</th>
							<th class="actions">
								<i class="fas fa-cog"></i>
							</th>
						</tr>
					</thead>

					<tbody>
					<?php foreach ($simulations as $item) : ?>
						<tr>
							<td width="60"><?= $item->idSimulacao ?></td>

							<td><?= $item->produto ?></td>

							<td><?= convertDate($item->dataCadastro) ?></td>

							<td>
								R$ <?= convertPrice($item->precoCompra) ?>
							</td>

							<td class="actions" width="180">
								<a href="<?= base_url('client/simulation/create/' . $item->idSimulacao) ?>" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Copiar">
									<i class="md md-content-copy"></i>
								</a>

								<a href="<?= base_url('client/simulation/edit/' . $item->idSimulacao) ?>" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Atualizar">
									<i class="md md-mode-edit"></i>
								</a>

								<a href="<?= base_url('client/simulation/delete/' . $item->idSimulacao) ?>" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Deletar">
									<i class="md md-close"></i>
								</a>

								<a href="<?= base_url('client/simulation/view/' . $item->idSimulacao) ?>" class="table-action-btn btn-view" data-toggle="tooltip" data-placement="top" title="Visualizar">
									<i class="md md-remove-red-eye"></i>
								</a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="row cards">
	<?php foreach ($simulations as $item) : ?>
		<div class="col-md-4 card-item">
			<div class="card-container rotate small">
				<div class="card">
					<div class="front">
						<div class="cover"></div>

						<div class="content">
							<div class="main ellipsis">
								<h3 class="name" style="text-transform: uppercase">
									<?= "[{$item->idSimulacao}] " . $item->produto ?>
								</h3>

								<h6 class="text-center" style="text-transform: uppercase; font-weight: bold">
									<?= convertDate($item->dataCadastro) ?>
								</h6>
							</div>

							<div class="footer">
								<a href="<?= base_url('client/simulation/create/' . $item->idSimulacao) ?>" class="btn btn-primary circle copy" data-toggle="tooltip" data-placement="top" title="Copiar">
									<i class="fas fa-copy"></i>
								</a>

								<a href="<?= base_url('client/simulation/edit/' . $item->idSimulacao) ?>" class="btn btn-default circle edit hidden" data-toggle="tooltip" data-placement="top" title="Atualizar">
									<i class="fas fa-pencil-alt"></i>
								</a>

								<a href="<?= base_url('client/simulation/delete/' . $item->idSimulacao) ?>" class="btn btn-danger circle" data-toggle="tooltip" data-placement="top" title="Deletar">
									<i class="fas fa-close"></i>
								</a>

								<a href="<?= base_url('client/simulation/view/' . $item->idSimulacao) ?>" class="btn btn-success circle" data-toggle="tooltip" data-placement="top" title="Visualizar">
									<i class="fas fa-eye"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>

		<div class="col-md-12 text-center">
			<div id="paging" class="paging-container"></div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function()
{
	$(document).on('keypress', 'form', function(e)
	{
		var code = e.keyCode || e.which;

		if (code == 13) {
			e.preventDefault();

			return false;
		}
	});

	//=========

	$('#datatable').dataTable();

	//=========

	$('.datepicker').datepicker({
		format: "dd/mm/yyyy"
	});

	//=========

	$('.action').on('change', function()
	{
		var selected = $(this).val();

		if (selected == "copy") {
			$('a.btn.copy').removeClass('hidden');
			$('a.btn.edit').addClass('hidden');
		} else {
			$('a.btn.copy').addClass('hidden');
			$('a.btn.edit').removeClass('hidden');
		}
	});

	//=========

	$('#produto').on('keyup', function()
	{
		var value = $(this).val().toLowerCase();

		$('.table-responsive tr').filter(function()
		{
			$(this).toggle(
				$(this).text().toLowerCase().indexOf(value) > -1
			)
		});

		$('.card-item .name').filter(function()
		{
			$(this).parents('.card-item').toggle(
				$(this).text().toLowerCase().indexOf(value) > -1
			)
		});
	});
});
</script>
