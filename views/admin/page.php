<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php switch($viewData['action']): ?>
<?php case 'add': ?>
<div class="page-wrapper">
    <div class="container-fluid">

        <div class="d-flex no-block">
            <div><h3 class="text-themecolor">Páginas</h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Adicionar Página</h4>
                            </div>
                        </div>
                        <!-- Inicio do Conteúdo -->
                        <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Título da Página</label>
                                        <input type="text" id="title" name="title" required class="form-control">
                                        <small class="form-control-feedback" id="title-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">URL Amigável</label>
                                        <input type="text" id="slug" name="slug" class="form-control">
                                        <small class="form-control-feedback" id="slug-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Legenda</label>
                                        <input type="text" id="caption" name="caption" class="form-control">
                                        <small class="form-control-feedback" id="caption-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tipo de Página</label>
                                        <select class="form-control custom-select" id="type_page" name="type_page">
                                            <option value="normal" selected>Normal</option>
                                            <option value="activate">Ativação</option>
                                            <option value="register">Cadastro</option>
                                            <option value="account">Conta</option>
                                            <option value="login">Login</option>
                                            <option value="home">Página Inicial</option>
                                            <option value="search">Pesquisa</option>
                                            <option value="profile">Perfil</option>
                                        </select>
                                        <small class="form-control-feedback" id="type_page-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Acesso</label>
                                        <select class="form-control custom-select" id="access" name="access" onchange="checkOptions(this.value)">
                                            <option value="1" selected="">Público</option>
                                            <option value="2">Registrado</option>
                                            <option value="3">Membro</option>
                                        </select>
                                        <small class="form-control-feedback" id="access-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Plano de Acesso</label>
                                        <select class="selectpicker" name="membership_id[]" id="membership_id" multiple data-style="form-control custom-select" title="Selecione">
                                            <?php $m = new Memberships(); $m = $m->getMemberships(); foreach ($m as $membership):?>
                                            <option value="<?php echo $membership['id'];?>"><?php echo $membership['title'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-control-feedback" id="membership_id-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 m-t-30">
                                    <label class="control-label">Publicar Página</label>
                                    <div class="m-t-10">
                                        <input name="active" type="radio" id="active-yes" checked class="with-gap radio-col-light-blue" value="1" />
                                        <label for="active-yes">Sim</label>
                                        <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0" />
                                        <label for="active-no">Não</label>
                                    </div>
                                </div>
                                <div class="col-md-6 m-t-30">
                                    <label class="control-label">Visibilidade</label>
                                    <div class="m-t-10">
                                        <input name="is_admin" type="radio" id="is_admin-yes" class="with-gap radio-col-light-blue" value="1" />
                                        <label for="is_admin-yes">Admin</label>
                                        <input name="is_admin" type="radio" id="is_admin-no" checked class="with-gap radio-col-light-blue" value="0" />
                                        <label for="is_admin-no">Público</label>
                                    </div>
                                </div>
                                <div class="col-md-6 m-t-30">
                                    <div class="form-group">
                                        <label class="control-label">Descrição</label>
                                        <textarea class="form-control" name="description" required id="description" rows="2"></textarea>
                                        <small class="form-control-feedback" id="description-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 m-t-30">
                                    <div class="form-group">
                                        <label class="control-label">Palavras Chave (SEO)</label>
                                        <div class="tags-default">
                                            <input type="text" name="keywords" id="keywords" data-role="tagsinput" />
                                        </div>
                                        <small class="form-control-feedback" id="keywords-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-20" style="height:600px">
                                    <div id="geekeditor" data-fieldname="body"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar Página</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Fim do Conteúdo -->
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
        <div class="d-flex no-block">
            <div><h3 class="text-themecolor">Páginas</h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Editar Página</h4>
                            </div>
                        </div>
                        <?php $data = $viewData['pages']; ?>
                        <!-- Inicio do Conteúdo -->
                        <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Título da Página</label>
                                        <input type="text" id="title" name="title" required class="form-control" value="<?php echo $data['title']; ?>">
                                        <small class="form-control-feedback" id="title-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">URL Amigável</label>
                                        <input type="text" id="slug" name="slug" class="form-control" value="<?php echo $data['slug']; ?>">
                                        <small class="form-control-feedback" id="slug-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Legenda</label>
                                        <input type="text" id="caption" name="caption" class="form-control" value="<?php echo $data['caption']; ?>">
                                        <small class="form-control-feedback" id="caption-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Página Inicial</label>
                                        <select class="form-control custom-select" id="type_page" name="type_page">
                                            <option value="normal" <?php getSelected('normal', $data['type_page']); ?>>Não</option>
                                            <option value="home" <?php getSelected('home', $data['type_page']); ?>>Sim</option>
                                        </select>
                                        <small class="form-control-feedback" id="type_page-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Acesso</label>
                                        <select class="form-control custom-select" id="access" name="access" onchange="checkOptions(this.value)">
                                            <option value="1" <?php getSelected('1', $data['access']); ?>>Público</option>
                                            <option value="2" <?php getSelected('2', $data['access']); ?>>Registrado</option>
                                            <option value="3" <?php getSelected('3', $data['access']); ?>>Membro</option>
                                        </select>
                                        <small class="form-control-feedback" id="access-feedback"></small>
                                    </div>
                                </div>
                                <?php $data['membership_id'] = explode(',', $data['membership_id']); ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Plano de Acesso</label>
                                        <select class="selectpicker" name="membership_id[]" id="membership_id" multiple data-style="form-control custom-select" title="Selecione">
                                            <?php $m = new Memberships(); $m = $m->getMemberships(); foreach ($m as $membership):?>
                                            <option value="<?php echo $membership['id'];?>" <?php echo (in_array($membership['id'], $data['membership_id'])) ? 'selected' : ''; ?>><?php echo $membership['title'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-control-feedback" id="membership_id-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 m-t-30">
                                    <label class="control-label">Publicar Página</label>
                                    <div class="m-t-10">
                                        <input name="active" type="radio" id="active-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $data['active']); ?> />
                                        <label for="active-yes">Sim</label>
                                        <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $data['active']); ?> />
                                        <label for="active-no">Não</label>
                                    </div>
                                </div>
                                <div class="col-md-6 m-t-30">
                                    <label class="control-label">Visibilidade</label>
                                    <div class="m-t-10">
                                        <input name="is_admin" type="radio" id="is_admin-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $data['is_admin']); ?> />
                                        <label for="is_admin-yes">Admin</label>
                                        <input name="is_admin" type="radio" id="is_admin-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $data['is_admin']); ?> />
                                        <label for="is_admin-no">Público</label>
                                    </div>
                                </div>
                                <div class="col-md-6 m-t-30">
                                    <div class="form-group">
                                        <label class="control-label">Descrição</label>
                                        <textarea class="form-control" name="description" required id="description" rows="2"><?php echo $data['description']; ?></textarea>
                                        <small class="form-control-feedback" id="description-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6 m-t-30">
                                    <div class="form-group">
                                        <label class="control-label">Palavras Chave</label>
                                        <div class="tags-default">
                                            <input type="text" name="keywords" id="keywords" data-role="tagsinput" value="<?php echo $data['keywords']; ?>" />
                                        </div>
                                        <small class="form-control-feedback" id="keywords-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-20" data-keditor="html" style="height:600px">
                                    <div id="geekeditor" data-fieldname="body">
                                        <?php echo html_entity_decode($data['body']); ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar Página</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Fim do Conteúdo -->
                    </div>
                </div>
            </div>
        </div>

        <!-- .right-sidebar -->
        
    </div>
</div>
<?php break;?>
<?php default: ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="d-flex no-block">
            <div><h3 class="text-themecolor">Páginas</h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div id="toolbar">
                                <h4 class="card-title">Todas as Páginas</h4>
                            </div>
                            <div class="table-responsive p-10">
                                <table id="table" data-toggle="table" data-url="<?php echo BASE_ADMIN;?>/page/datatable" data-show-refresh="true" data-show-columns="true" data-toolbar="#toolbar" data-advanced-search="true" data-pagination="true" data-mobile-responsive="true" data-search="true" class="table display table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th data-field="id" data-sortable="true" data-width="50px">ID</th>
                                            <th data-field="title" data-sortable="true">Título</th>
                                            <th data-field="fname" data-sortable="true" data-width="150px" data-align="center">Criada Por</th>
                                            <th data-field="created" data-formatter="dateFormatter" data-sortable="true" data-width="150px" data-align="center">Criada em</th>
                                            <th data-formatter="actionFormatter" data-align="center" data-width="80px">Ações</th>
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
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body geek-help">
                    <h5>Páginas</h5>
                    <p>Aqui você pode gerenciar o conteúdo das suas páginas. Atenção: A exclusão da página também excluirá layouts correspondentes a página..</p>
                </div>
            </div>
        </div>

    </div>
</div>
<?php break; ?>
<?php endswitch;?>

<script>
function actionFormatter(value, row) {
    var btn = '';
    if(row['type_page'] == 'normal'){
        btn = '<?php echo BASE_ADMIN; ?>/page/delete/' + row['id'];
        btn = '<a href="#" onclick="deleteInfo(this, \''+btn+'\');" data-toggle="tooltip" data-original-title="Excluir"> <i class="mdi mdi-delete text-danger m-r-10"></i></a>'

    }
   return '<a href="page/edit/'+row['id']+'" data-toggle="tooltip" data-original-title="Editar"> <i class="mdi mdi-pencil m-r-10"></i></a>' + btn;
}

function dateFormatter(value, row) {
   return mysqlDate(value);
}

$(document).ready(function () {
    <?php if(isset($data['access'])){echo "checkOptions('".$data['access']."');";} ?>
});

function checkOptions(type_value) {
    if(type_value == '1' || type_value == '2'){
        $('#membership_id').prop("disabled", true);
        $('#membership_id').selectpicker('refresh');
    }else{
        $('#membership_id').prop("disabled", false);
        $('#membership_id').selectpicker('refresh');
    }
}
</script>