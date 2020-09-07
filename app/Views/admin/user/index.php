
<link href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.css') ?>" rel="stylesheet" />
<link href="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
			<h4>Listagem de usuários</h4>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
					</li>

					<li class="breadcrumb-item active">
						Usuários
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
		<div class="col-sm-12">
			<div class="card-box table-responsive">
				<h4 class="m-b-30 header-title">
					<b>Usuários</b>
				</h4>

				<table id="datatable" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th></th>
							<th>Nome</th>
							<th>Telefone</th>
							<th class="actions">Permissão</th>
							<th class="actions">
								<i class="fas fa-cog"></i>
							</th>
						</tr>
					</thead>

					<tbody>
					<?php foreach ($users as $item) : ?>
						<tr>
							<td width="60" style="text-align: center">
								<img src="<?= convertImage($item->avatar) ?>" alt="thumb" title="thumb" class="img-circle thumb-sm" />
							</td>

							<td><?= $item->nomeCompleto ?></td>

							<td><?= $item->telefone ?></td>

							<td class="text-center">
								<span class="label label-table label-danger">
									<?= $item->titulo ?>
								</span>
							</td>

							<td class="actions" width="180">
								<a href="<?= base_url('admin/users/update/' . $item->idUsuario) ?>" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Editar">
									<i class="md md-edit"></i>
								</a>

								<a href="javascript:void(0)" data-href="<?= base_url('admin/users/delete/' . $item->idUsuario) ?>" class="table-action-btn delete-action" data-toggle="tooltip" data-placement="top" title="Deletar">
                                    <i class="md md-close"></i>
                                </a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
jQuery(document).ready(function()
{
	$('#datatable').dataTable();
});
</script>
