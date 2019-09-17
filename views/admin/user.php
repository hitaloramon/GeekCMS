<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php switch($viewData['action']): ?>
<?php case 'add': ?>
<div class="page-wrapper">
    <div class="container-fluid">
        
        <div class="d-flex m-b-15">
            <div class="w-100"><h3 class="text-themecolor">Usuário</h3></div>
            <div class="flex-shrink-1"><a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a></div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Adicionar Usuário</h4>
                            </div>
                        </div>
                        <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nome</label>
                                        <input type="text" id="fname" name="fname" class="form-control">
                                        <small class="form-control-feedback" id="fname-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Sobrenome</label>
                                        <input type="text" id="lname" name="lname" class="form-control">
                                        <small class="form-control-feedback" id="lname-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Endereço de Email</label>
                                        <input type="text" id="email" name="email" class="form-control">
                                        <small class="form-control-feedback" id="email-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Senha</label>
                                        <input type="text" id="password" name="password" required class="form-control">
                                        <small class="form-control-feedback" id="password-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Nível</label>
                                        <select class="form-control custom-select" id="userlevel" name="userlevel">
                                            <option value="0" selected="">Usuário</option>
                                            <?php $p = new Permissions(); $p = $p->getGroups(); foreach ($p as $permission):?>
                                            <option value="<?php echo $permission['id'];?>"><?php echo $permission['name'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-control-feedback" id="userlevel-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <select class="form-control custom-select" id="active" name="active">
                                            <option value="y" selected="">Ativo</option>
                                            <option value="n">Inativo</option>
                                            <option value="t">Pendente</option>
                                            <option value="b">Banido</option>
                                        </select>
                                        <small class="form-control-feedback" id="active-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Plano de Acesso</label>
                                        <select class="form-control custom-select" id="membership_id" name="membership_id">
                                            <option value="0" selected="">Nenhum</option>
                                            <?php $m = new Memberships(); $m = $m->getMemberships(); foreach ($m as $membership):?>
                                            <option value="<?php echo $membership['id'];?>"><?php echo $membership['title'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-control-feedback" id="membership_id-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar Usuário</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- .right-sidebar -->

    </div>
</div>
<?php break; ?>
<?php case 'edit': ?>
<div class="page-wrapper">
    <div class="container-fluid">

        <div class="d-flex m-b-15">
            <div class="w-100"><h3 class="text-themecolor">Usuário</h3></div>
            <div class="flex-shrink-1"><a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Editar Usuário</h4>
                            </div>
                        </div>
                        <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nome</label>
                                        <input type="text" id="fname" name="fname" class="form-control" value="<?php echo $viewData['user']['fname']; ?>">
                                        <small class="form-control-feedback" id="fname-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Sobrenome</label>
                                        <input type="text" id="lname" name="lname" class="form-control" value="<?php echo $viewData['user']['lname']; ?>">
                                        <small class="form-control-feedback" id="lname-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Endereço de Email</label>
                                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $viewData['user']['email']; ?>">
                                        <small class="form-control-feedback" id="email-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Senha</label>
                                        <input type="text" id="password" name="password" class="form-control">
                                        <small class="form-control-feedback" id="password-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nível</label>
                                        <select class="form-control custom-select" id="userlevel" name="userlevel">
                                            <option value="0">Usuário</option>
                                            <?php $p = new Permissions(); $p = $p->getGroups(); foreach ($p as $permission):?>
                                            <option value="<?php echo $permission['id'];?>" <?php getSelected($permission['id'], $viewData['user']['userlevel']); ?>><?php echo $permission['name'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-control-feedback" id="active-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Inscrito na Newsletter</label>
                                        <select class="form-control custom-select" id="newsletter" name="newsletter">
                                            <option value="1" <?php getSelected('1', $viewData['user']['newsletter']); ?>>Sim</option>
                                            <option value="0" <?php getSelected('0', $viewData['user']['newsletter']); ?>>Não</option>
                                        </select>
                                        <small class="form-control-feedback" id="newsletter-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <select class="form-control custom-select" id="active" name="active">
                                            <option value="y" <?php getSelected('y', $viewData['user']['active']); ?>>Ativo</option>
                                            <option value="n" <?php getSelected('n', $viewData['user']['active']); ?>>Inativo</option>
                                            <option value="t" <?php getSelected('t', $viewData['user']['active']); ?>>Pendente</option>
                                            <option value="b" <?php getSelected('b', $viewData['user']['active']); ?>>Banido</option>
                                        </select>
                                        <small class="form-control-feedback" id="active-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Plano de Acesso</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <label class="custom-control custom-checkbox m-b-0">
                                                        <input type="checkbox" name="ext_membership" id="ext_membership" class="custom-control-input">
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <select class="form-control custom-select" id="membership_id" name="membership_id">
                                                <option value="0">Nenhum</option>
                                                <?php $m = new Memberships(); $m = $m->getMemberships(); foreach ($m as $membership):?>
                                                <option value="<?php echo $membership['id']; ?>" <?php getSelected($membership['id'], $viewData['user']['membership_id']); ?>><?php echo $membership['title'];?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Criado</label>
                                        <input type="text" disabled class="form-control" value="<?php echo $viewData['user']['created']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Último Acesso</label>
                                        <input type="text" disabled class="form-control" value="<?php echo $viewData['user']['lastlogin']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Último IP</label>
                                        <input type="text" disabled class="form-control" value="<?php echo $viewData['user']['lastip']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Plano Expira em:</label>
                                        <input type="text" disabled class="form-control" value="<?php echo $viewData['user']['mem_expire']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Notas</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="5"><?php echo $viewData['user']['notes']; ?></textarea>
                                        <small class="form-control-feedback" id="notes-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar Usuário</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- .right-sidebar -->

    </div>
</div>
<?php break; ?>
<?php case 'manage': ?>
<div class="page-wrapper">

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Usuários</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Manutenção de Usuário</h4>
                            </div>
                        </div>
                        <?php $u = new User(); ?>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card bg-success text-white">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="stats">
                                                <h1 class="text-white"><?php echo $u->getInactive(); ?></h1>
                                                <h6 class="text-white">Usuários Inativos</h6>
                                            </div>
                                            <div class="stats-icon text-right ml-auto"><i class="mdi mdi-account-alert display-5 op-3 text-dark"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card bg-warning text-white">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="stats">
                                                <h1 class="text-white"><?php echo $u->getPending(); ?></h1>
                                                <h6 class="text-white">Usuários Pendentes</h6>
                                            </div>
                                            <div class="stats-icon text-right ml-auto"><i class="mdi mdi-account-star display-5 op-3 text-dark"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card bg-danger text-white">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="stats">
                                                <h1 class="text-white"><?php echo $u->getBanned(); ?></h1>
                                                <h6 class="text-white">Usuários Banidos</h6>
                                            </div>
                                            <div class="stats-icon text-right ml-auto"><i class="mdi mdi-account-off display-5 op-3 text-dark"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="card-subtitle m-t-30 p-b-30">Gerencie seus usuários, removendo usuários inativos, pendentes ou banidos do banco de dados. Caso escolha por apagar usuários inativos, não será apagado os usuários onde o seu último login no sistema é menor ao número de dias informado.</h6>
                        <form action="#" method="post" id="form-geek">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tipo de Usuário</label>
                                        <select class="form-control custom-select" id="typeuser" name="typeuser" onchange="managerOptions(this.value);">
                                            <option value="n">Inativo</option>
                                            <option value="t">Pendente</option>
                                            <option value="b">Banido</option>
                                        </select>
                                        <small class="form-control-feedback" id="typeuser-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Número de Dias</label>
                                        <input type="number" id="days" name="days" class="form-control">
                                        <small class="form-control-feedback" id="days-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Apagar Usuários</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- .right-sidebar -->

    </div>
</div>
<?php break; ?>
<?php default: ?>
<div class="page-wrapper">

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Usuários</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <h4 class="card-title"><span class="lstick"></span>Todos os Usuários</h4>
                        </div>
                        <div class="row">
                            <div class="table-responsive p-10">
                                <div id="toolbar">
                                    <select class="form-control">
                                        <option value="all">Exportar Todos</option>
                                        <option value="selected">Exportar Selecionados</option>
                                    </select>
                                </div>
                                <table id="table" data-toggle="table" data-url="<?php echo BASE_ADMIN;?>/user/datatable" data-show-refresh="true" data-show-columns="true" data-toolbar="#toolbar" data-advanced-search="true" data-show-export="true" data-pagination="true" data-mobile-responsive="true" data-search="true" class="table display table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th data-checkbox="true"></th>
                                            <th data-field="id" data-sortable="true">ID</th>
                                            <th data-field="fname" data-sortable="true">Nome</th>
                                            <th data-field="email" data-sortable="true">Email</th>
                                            <th data-field="title" data-align="center" data-sortable="true">Membro</th>
                                            <th data-field="name" data-align="center" data-sortable="true">Nível</th>
                                            <th data-field="active" data-sortable="true" data-align="center" data-formatter="statusFormatter">Status</th>
                                            <th data-field="id" data-align="center" data-formatter="actionFormatter">Ações</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div> <!--table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- .right-sidebar -->
        
    </div>
</div>
<?php endswitch;?>


<script>
function managerOptions(type_value) {
    if(type_value == 'n'){
      $("#days").prop('disabled', false);
    }
    if(type_value == 't'){
      $("#days").prop('disabled', true);
    }
    if(type_value == 'b'){
      $("#days").prop('disabled', true);
    }
}

function statusFormatter(value, row) {
    switch (value) {
        case 'y':
            return '<span class="label label-success label-rounded">Ativo</span>'
        break;
        case 'p':
            return '<span class="label label-warning label-rounded">Pendente</span>'
        break;
        case 'b':
            return '<span class="label label-danger label-rounded">Banido</span>'
        break;
        case 'n':
            return '<span class="label label-inverse label-rounded">Inativo</span>'
        break;
    }
}

function actionFormatter(value, row) {
   var btn = '<?php echo BASE_ADMIN; ?>/user/delete/' + row['id'];
   return '<a href="user/edit/'+row['id']+'" data-toggle="tooltip" data-original-title="Editar"> <i class="mdi mdi-pencil m-r-10"></i></a><a href="#" onclick="deleteInfo(this, \''+btn+'\');" data-toggle="tooltip" data-original-title="Excluir"> <i class="mdi mdi-delete text-danger m-r-10"></i></a>';
}
</script>