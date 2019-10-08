<?php switch($viewData['mod_action']): case 'view':  ?>

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-themecolor">Módulo</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>Todos os Módulos</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php break; ?>
<?php case 'add': ?>

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-themecolor">Módulo</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>Leitor RSS</h4>
                        </div>
                    </div>
                    <form action="#" method="post" id="form-geek">
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Título</label>
                                    <input type="text" id="title" name="title" required class="form-control">
                                    <small class="form-control-feedback" id="title-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">URL</label>
                                    <input type="url" id="url" name="url" required class="form-control">
                                    <small class="form-control-feedback" id="url-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Número de Feeds</label>
                                    <input type="number" id="limit_rss" name="limit_rss" value="5" required class="form-control">
                                    <small class="form-control-feedback" id="limit_rss-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Limitar Descrição</label>
                                    <input type="number" id="limit_desc" name="limit_desc" required class="form-control" value="100">
                                    <small class="form-control-feedback" id="limit_desc-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Mostrar Data</label>
                                    <select class="form-control custom-select" id="show_date" name="show_date">
                                        <option value="1" selected="">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                    <small class="form-control-feedback" id="show_date-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Mostrar Descrição</label>
                                    <select class="form-control custom-select" id="show_desc" name="show_desc">
                                        <option value="1" selected="">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                    <small class="form-control-feedback" id="show_desc-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="card-body text-center">
                                    <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar</button>
                                    <a href="<?php echo BASE_ADMIN;?>/module/view/rss/" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php break; ?>
<?php case 'edit': ?>

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-themecolor">Módulo</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>Leitor RSS</h4>
                        </div>
                    </div>

                    <form action="#" method="post" id="form-geek">
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Título</label>
                                    <input type="text" id="title" name="title" required class="form-control" value="<?php echo $rss['title']; ?>">
                                    <small class="form-control-feedback" id="title-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">URL</label>
                                    <input type="url" id="url" name="url" required class="form-control" value="<?php echo $rss['url']; ?>">
                                    <small class="form-control-feedback" id="url-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Número de Feeds</label>
                                    <input type="number" id="limit_rss" name="limit_rss" required class="form-control" value="<?php echo $rss['limit_rss']; ?>">
                                    <small class="form-control-feedback" id="limit_rss-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Limitar Descrição</label>
                                    <input type="number" id="limit_desc" name="limit_desc" required class="form-control" value="<?php echo $rss['limit_desc']; ?>">
                                    <small class="form-control-feedback" id="limit_desc-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Mostrar Data</label>
                                    <select class="form-control custom-select" id="show_date" name="show_date">
                                        <option value="1" <?php getSelected('1', $rss['show_date']); ?>>Sim</option>
                                        <option value="0" <?php getSelected('0', $rss['show_date']); ?>>Não</option>
                                    </select>
                                    <small class="form-control-feedback" id="show_date-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Mostrar Descrição</label>
                                    <select class="form-control custom-select" id="show_desc" name="show_desc">
                                        <option value="1" <?php getSelected('1', $rss['show_desc']); ?>>Sim</option>
                                        <option value="0" <?php getSelected('0', $rss['show_desc']); ?>>Não</option>
                                    </select>
                                    <small class="form-control-feedback" id="show_desc-feedback"></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="card-body text-center">
                                    <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar</button>
                                    <a href="<?php echo BASE_ADMIN;?>/module/view/rss/" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php break; ?>
<?php default: ?>

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-themecolor">Módulo</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div>
                            <h4 class="card-title"><span class="lstick"></span>Leitor RSS</h4>
                        </div>
                    </div>
                    <div class="table-responsive p-10">
                        <div id="toolbar">
                            <a href="<?php echo BASE_ADMIN;?>/module/view/rss/add" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar</a>
                        </div>
                        <table id="table" data-toggle="table" data-url="<?php echo BASE_ADMIN;?>/module/view/rss/datatable" data-show-refresh="true" data-show-columns="true" data-toolbar="#toolbar" data-advanced-search="true" data-pagination="true" data-mobile-responsive="true" data-search="true" class="table display table-hover w-100">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true" data-width="50px">ID</th>
                                    <th data-field="title" data-sortable="true">Título</th>
                                    <th data-width="80px" data-formatter="modFormatter">Ações</th>
                                </tr>
                            </thead>
                        </table>
                    </div> <!--table -->
                </div>
            </div>
        </div>
    </div>
    
<script>
function modFormatter(value, row) {
    btn = '';
    btn += '<a href="<?php echo BASE_ADMIN; ?>/module/view/rss/edit/'+row['id']+'" data-toggle="tooltip" data-original-title="Editar"> <i class="mdi mdi-pencil m-r-10"></i></a>';
    btn += '<a href="#" onclick="deleteInfo(this, \'<?php echo BASE_ADMIN; ?>/module/view/rss/delete/'+row['id']+'\')" data-toggle="tooltip" data-original-title="Excluir"><i class="mdi mdi-delete text-danger m-r-10"></i></a>';
    
    return btn;
}
</script>
<?php break; ?>
<?php endswitch;?>