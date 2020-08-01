
<link href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.css') ?>" rel="stylesheet"/>
<link href="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.css') ?>" rel="stylesheet"/>

<div class="container-fluid reset hidden-xs">
    <div class="row page-breadcrumb v-align">
        <div class="col-md-5">
            <h4>Listagem de permissões</h4>
        </div>

        <div class="col-md-7 text-right">
            <div class="d-flex justify-content-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Permissões
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
                    <b>Permissões</b>
                </h4>

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th># ID</th>
                            <th>Titúlo</th>
                            <th class="actions">Membros</th>
                            <th class="actions">
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($permissions as $item) : ?>
                    <?php
                        $user = new \App\Models\Admin\User;

                        $permissionMembers = $user->count([
                            'idPermissao' => $item->idPermissao
                        ]);
                    ?>
                        <tr>
                            <td width="60"><?= $item->idPermissao ?></td>

                            <td><?= $item->titulo ?></td>

                            <td class="text-center" width="180">
                                <span class="label label-table label-primary" data-toggle="tooltip" data-placement="top" title="Novo Item">
                                    <?= $permissionMembers ?>
                                </span>
                            </td>

                            <td class="actions" width="180">
                                <a href="<?= base_url('admin/permissoes/atualizar/' . $item->idPermissao) ?>" class="table-action-btn" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="md md-edit"></i>
                                </a>

                                <a href="javascript:void(0)" data-href="<?= base_url('admin/permissoes/deletar/' . $item->idPermissao) ?>" class="table-action-btn delete-action" data-toggle="tooltip" data-placement="top" title="Deletar">
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
$(document).ready(function()
{
    $('#datatable').dataTable();
});
</script>
