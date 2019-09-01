<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php switch($viewData['action']): ?>
<?php case 'view': ?>
    <?php //require_once('views/admin/modules/'.$module.'/main_admin.php'); ?>
<?php break; ?>
<?php case 'add': ?>
<div class="page-wrapper">

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Componente</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Adicionar Componente</h4>
                            </div>
                        </div>
                        <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Título do Componente</label>
                                        <input type="text" id="title" name="title" required class="form-control">
                                        <small class="form-control-feedback" id="title-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Informação do Componente</label>
                                        <input type="text" id="info" name="info" class="form-control">
                                        <small class="form-control-feedback" id="info-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-3 m-t-30">
                                    <label class="control-label">Publicar Componente</label>
                                    <div class="m-t-10">
                                        <input name="active" type="radio" id="active-yes" class="with-gap radio-col-light-blue" value="1" checked />
                                        <label for="active-yes">Sim</label>
                                        <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0" />
                                        <label for="active-no">Não</label>
                                    </div>
                                </div>
                                <div class="col-md-3 m-t-30">
                                    <label class="control-label">Mostrar Título</label>
                                    <div class="m-t-10">
                                        <input name="show_title" type="radio" id="show_title-yes" class="with-gap radio-col-light-blue" value="1" checked />
                                        <label for="show_title-yes">Sim</label>
                                        <input name="show_title" type="radio" id="show_title-no" class="with-gap radio-col-light-blue" value="0" />
                                        <label for="show_title-no">Não</label>
                                    </div>
                                </div>
                                <div class="col-md-3 m-t-30">
                                    <label class="control-label">Exibir Conteúdo</label>
                                    <div class="m-t-10">
                                        <input name="show_order" type="radio" id="show_order-yes" class="with-gap radio-col-light-blue" value="0" checked />
                                        <label for="show_order-yes">Antes</label>
                                        <input name="show_order" type="radio" id="show_order-no" class="with-gap radio-col-light-blue" value="1" />
                                        <label for="show_order-no">Depois</label>
                                    </div>
                                </div>
                                <div class="col-md-3 m-t-30">
                                    <label class="control-label">Exibir Largura Total</label>
                                    <div class="m-t-10">
                                        <input name="container" type="radio" id="container-yes" class="with-gap radio-col-light-blue" value="1" />
                                        <label for="container-yes">Sim</label>
                                        <input name="container" type="radio" id="container-no" class="with-gap radio-col-light-blue" value="0" checked />
                                        <label for="container-no">Não</label>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-20" data-keditor="html" style="height:600px">
                                    <div id="geekeditor" data-fieldname="body"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar Componente</button>
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
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Componente</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Editar Componente</h4>
                            </div>
                        </div>
                        <?php $data = $viewData['widget'][0]; ?>
                        <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Título do Componente</label>
                                        <input type="text" id="title" name="title" required class="form-control" value="<?php echo $data['title']; ?>">
                                        <small class="form-control-feedback" id="title-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Informação do Componente</label>
                                        <input type="text" id="info" name="info" class="form-control" value="<?php echo $data['info']; ?>">
                                        <small class="form-control-feedback" id="info-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-3 m-t-30">
                                    <label class="control-label">Publicar Componente</label>
                                    <div class="m-t-10">
                                        <input name="active" type="radio" id="active-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $data['active']); ?> />
                                        <label for="active-yes">Sim</label>
                                        <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $data['active']); ?> />
                                        <label for="active-no">Não</label>
                                    </div>
                                </div>
                                <div class="col-md-3 m-t-30">
                                    <label class="control-label">Mostrar Título</label>
                                    <div class="m-t-10">
                                        <input name="show_title" type="radio" id="show_title-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $data['show_title']); ?> />
                                        <label for="show_title-yes">Sim</label>
                                        <input name="show_title" type="radio" id="show_title-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $data['show_title']); ?> />
                                        <label for="show_title-no">Não</label>
                                    </div>
                                </div>
                                <div class="col-md-3 m-t-30">
                                    <label class="control-label">Exibir Conteúdo</label>
                                    <div class="m-t-10">
                                        <input name="show_order" type="radio" id="show_order-yes" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $data['show_order']); ?> />
                                        <label for="show_order-yes">Antes</label>
                                        <input name="show_order" type="radio" id="show_order-no" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $data['show_order']); ?> />
                                        <label for="show_order-no">Depois</label>
                                    </div>
                                </div>
                                <div class="col-md-3 m-t-30">
                                    <label class="control-label">Exibir Largura Total</label>
                                    <div class="m-t-10">
                                        <input name="container" type="radio" id="container-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $data['container']); ?> />
                                        <label for="container-yes">Sim</label>
                                        <input name="container" type="radio" id="container-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $data['container']); ?> />
                                        <label for="container-no">Não</label>
                                    </div>
                                </div>
                                <div class="col-md-12 m-t-20" data-keditor="html" style="height:600px">
                                    <div id="geekeditor" data-fieldname="body">
                                        <?php echo html_entity_decode($data['body']); ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar Componente</button>
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
                <h3 class="text-themecolor">Componente</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="toolbar">
                                <h4 class="card-title">Todos os Componente</h4>
                            </div>
                            <table id="table" data-toggle="table" data-url="<?php echo BASE_ADMIN;?>/widget/datatable" data-show-refresh="true" data-show-columns="true" data-toolbar="#toolbar" data-advanced-search="true" data-pagination="true" data-mobile-responsive="true" data-search="true" class="table display table-hover w-100">
                                <thead>
                                    <tr>
                                        <th data-field="title" data-sortable="true">Título</th>
                                        <th data-formatter="actionFormatter" data-align="center" data-width="100px">Ações</th>
                                    </tr>
                                </thead>
                            </table>
                        </div> <!--table -->
                    </div>
                </div>
            </div>
        </div>

        <!-- .right-sidebar -->
        
    </div>
</div>
<script>
function actionFormatter(value, row) {
    html = '<a href="widget/edit/'+row['id']+'" data-toggle="tooltip" data-original-title="Editar"> <i class="mdi mdi-pencil m-r-10"></i></a>';
    if(row['hasconfig'] == 1){
       html += '<a href="widget/view/'+row['widget_alias']+'" data-toggle="tooltip" data-original-title="Visualizar"> <i class="mdi mdi-eye m-r-10"></i></a>';
    }
    if(row['system'] == 0){
       btn = '<?php echo BASE_ADMIN; ?>/widget/delete/'+ row['id'];
       html += '<a onclick="deleteInfo(this, \''+btn+'\');" data-toggle="tooltip" data-original-title="Excluir"> <i class="mdi mdi-delete text-danger m-r-10"></i></a>';
    }
    return html;
}
</script>
<?php break; ?>
<?php endswitch;?>