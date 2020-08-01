
<link href="<?= base_url('assets/plugins/jquery.steps/css/jquery.steps.css') ?>" rel="stylesheet" />

<div class="container-fluid reset hidden-xs">
	<div class="row page-breadcrumb v-align">
		<div class="col-md-5">
			<h4>Cadastro de permissão</h4>
		</div>

		<div class="col-md-7 text-right">
			<div class="d-flex justify-content-end">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= base_url('dashboard') ?>">Inicio do sistema</a>
					</li>

					<li class="breadcrumb-item">
						<a href="<?= base_url('permissions') ?>">Permissões</a>
					</li>

					<li class="breadcrumb-item active">
						Adicionar
					</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="card-box">
				<h4 class="header-title">
					<b>Cadastrar Permissão</b>
				</h4>

				<p class="text-muted m-b-30 font-13">
					Selecione os itens que deseja disponibilizar para a nova Categoría de Usuário.
				</p>

				<form id="wizard-validation-form" action="#" method="post">
					<div>
						<h3>Clientes</h3>

						<section>
							<div class="form-group clearfix">
	                        	<div class="row">
									<h4 class="col-md-12 header-title">
										<b>Dos Clientes</b>
									</h4>

	                        		<div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="cli_list" />

										    <span>Listar Todos</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="cli_add" />

										    <span>Adicionar</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="cli_edit" />

										    <span>Editar</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="cli_drop" />

										    <span>Remover</span>
										</label>
	                                </div>
	                            </div>

	                            <hr />

	                            <div class="row">
	                            	<h4 class="col-md-12 header-title">
										<b>Dos Grupos de Clientes</b>
									</h4>

	                        		<div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="g_cli_list" />

										    <span>Listar Todos</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="g_cli_add" />

										    <span>Adicionar</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="g_cli_edit" />

										    <span>Editar</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="g_cli_drop" />

										    <span>Remover</span>
										</label>
	                                </div>
	                            </div>
		                    </div>
						</section>

						<h3>Usuários</h3>

						<section>
							<div class="form-group clearfix">
	                        	<div class="row">
									<h4 class="col-md-12 header-title">
										<b>Dos Usuários</b>
									</h4>

	                        		<div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="adm_list" />

										    <span>Listar Todos</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="adm_add" />

										    <span>Adicionar</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="adm_edit" />

										    <span>Editar</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="adm_drop" />

										    <span>Remover</span>
										</label>
	                                </div>
	                            </div>

	                            <hr />

	                            <div class="row">
	                            	<h4 class="col-md-12 header-title">
										<b>Das Permissões</b>
									</h4>

	                        		<div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="g_list" />

										    <span>Listar Todos</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="g_add" />

										    <span>Adicionar</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="g_edit" />

										    <span>Editar</span>
										</label>
	                                </div>

	                                <div class="col-md-4">
										<label class="checkbox card">
										    <input type="checkbox" name="permissoes[]" value="g_drop" />

										    <span>Remover</span>
										</label>
	                                </div>
	                            </div>
		                    </div>
						</section>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url('assets/plugins/jquery-validation/js/jquery.validate.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery.steps/js/jquery.steps.min.js') ?>"></script>

<script src="<?= base_url('assets/pages/jquery.wizard-init.js') ?>"></script>
