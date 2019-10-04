<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php switch($viewData['action']): case 'edit': ?>

    <div class="row page-titles">
        <div class="col-md-12 align-self-center">
            <h3 class="text-themecolor">Permissões</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div class="w-100"><h4 class="card-title"><span class="lstick"></span>Editar Permissões do Grupo</h4></div>
                    </div>
                    <div class="alert alert-warning alert-rounded"><i class="mdi mdi-alert"></i> Cuidado! É importante você NÃO definir o acesso para alterar permissões do sistema para grupos de nível inferior.</div>
                    <form action="#" method="post" id="form-geek">
                        <div class="row p-t-20">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Nome do Grupo</label>
                                    <input type="text" id="name" name="name" required class="form-control" value="<?php echo $groups['name']; ?>">
                                    <small class="form-control-feedback" id="name-feedback"></small>
                                </div>
                            </div>
                        </div>
                        <div class="row p-20">
                            <ul class="nav nav-tabs customtab w-100" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#pages" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Painel</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#modules" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Módulos</span></a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content w-100">
                                <div class="tab-pane active" id="pages" role="tabpanel">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr class="table-active">
                                                <th>Permissões</th>
                                                <th>Ações</th>
                                                <th>Mostrar Conteúdo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; foreach ($params as $p): ?>
                                                <?php if(strpos($p['name'], 'mod/') === false): ?>
                                                    <tr>
                                                        <td width="180px"><?php echo $p['display_name']; ?></td>
                                                        <td width="300px">
                                                            <input type="checkbox" name="<?php echo $p['name']; ?>[]" class="filled-in chk-col-light-blue d-none hidden" checked />
                                                            <input type="checkbox" name="<?php echo $p['name']; ?>[]" id="view_<?php echo $p['id']; ?>"  <?php echo(isset($params_action[$i]) && strpos($params_action[$i]['action'], 'view') !== false) ? 'checked' : ''; ?> <?php echo(strpos($p['action'], 'view') !== false) ? '' : 'disabled'; ?> class="filled-in chk-col-light-blue d-none" value="view" />
                                                            <label for="view_<?php echo $p['id']; ?>" class="m-r-15">Visualizar</label>
                                                            <input type="checkbox" name="<?php echo $p['name']; ?>[]" id="add_<?php echo $p['id']; ?>" <?php echo(isset($params_action[$i]) && strpos($params_action[$i]['action'], 'add') !== false) ? 'checked' : ''; ?> <?php echo(strpos($p['action'], 'add') !== false) ? '' : 'disabled'; ?> class="filled-in chk-col-light-blue d-none" value="add" />
                                                            <label for="add_<?php echo $p['id']; ?>" class="m-r-15">Adicionar</label>
                                                            <input type="checkbox" name="<?php echo $p['name']; ?>[]" id="edit_<?php echo $p['id']; ?>" <?php echo(isset($params_action[$i]) && strpos($params_action[$i]['action'], 'edit') !== false) ? 'checked' : ''; ?> <?php echo(strpos($p['action'], 'edit') !== false) ? '' : 'disabled'; ?> class="filled-in chk-col-light-blue d-none" value="edit" />
                                                            <label for="edit_<?php echo $p['id']; ?>" class="m-r-15">Editar</label>
                                                            <input type="checkbox" name="<?php echo $p['name']; ?>[]" id="delete_<?php echo $p['id']; ?>" <?php echo(isset($params_action[$i]) && strpos($params_action[$i]['action'], 'delete') !== false) ? 'checked' : ''; ?> <?php echo(strpos($p['action'], 'delete') !== false) ? '' : 'disabled'; ?> class="filled-in chk-col-light-blue d-none" value="delete" />
                                                            <label for="delete_<?php echo $p['id']; ?>" class="m-r-15">Excluir</label>
                                                        </td>
                                                        <td width="100px">
                                                            <?php if($p['config_view'] == 1): ?>
                                                                <input name="<?php echo $p['name']; ?>_view" type="radio" required id="<?php echo $p['name']; ?>_user" <?php echo($params_action[$i]['content_view'] == 0) ? 'checked' : '' ;?> class="with-gap radio-col-light-blue" value="0">
                                                                <label for="<?php echo $p['name']; ?>_user">Usuário</label>
                                                                <input name="<?php echo $p['name']; ?>_view" type="radio" required id="<?php echo $p['name']; ?>_all"  <?php echo($params_action[$i]['content_view'] == 1) ? 'checked' : '' ;?> class="with-gap radio-col-light-blue" value="1">
                                                                <label for="<?php echo $p['name']; ?>_all">Todos</label>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="modules" role="tabpanel">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr class="table-active">
                                                <th>Permissões</th>
                                                <th>Ações</th>
                                                <th>Mostrar Conteúdo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; foreach ($params as $p): ?>
                                                <?php if(strpos($p['name'], 'mod/') !== false): ?>
                                                    <tr>
                                                        <td width="180px"><?php echo $p['display_name']; ?></td>
                                                        <td width="300px">
                                                            <input type="checkbox" name="<?php echo $p['name']; ?>[]" class="filled-in chk-col-light-blue d-none hidden" checked />
                                                            <input type="checkbox" name="<?php echo $p['name']; ?>[]" id="view_<?php echo $p['id']; ?>"  <?php echo(isset($params_action[$i]) && strpos($params_action[$i]['action'], 'view') !== false) ? 'checked' : ''; ?> <?php echo(strpos($p['action'], 'view') !== false) ? '' : 'disabled'; ?> class="filled-in chk-col-light-blue d-none" value="view" />
                                                            <label for="view_<?php echo $p['id']; ?>" class="m-r-15">Visualizar</label>
                                                            <input type="checkbox" name="<?php echo $p['name']; ?>[]" id="add_<?php echo $p['id']; ?>" <?php echo(isset($params_action[$i]) && strpos($params_action[$i]['action'], 'add') !== false) ? 'checked' : ''; ?> <?php echo(strpos($p['action'], 'add') !== false) ? '' : 'disabled'; ?> class="filled-in chk-col-light-blue d-none" value="add" />
                                                            <label for="add_<?php echo $p['id']; ?>" class="m-r-15">Adicionar</label>
                                                            <input type="checkbox" name="<?php echo $p['name']; ?>[]" id="edit_<?php echo $p['id']; ?>" <?php echo(isset($params_action[$i]) && strpos($params_action[$i]['action'], 'edit') !== false) ? 'checked' : ''; ?> <?php echo(strpos($p['action'], 'edit') !== false) ? '' : 'disabled'; ?> class="filled-in chk-col-light-blue d-none" value="edit" />
                                                            <label for="edit_<?php echo $p['id']; ?>" class="m-r-15">Editar</label>
                                                            <input type="checkbox" name="<?php echo $p['name']; ?>[]" id="delete_<?php echo $p['id']; ?>" <?php echo(isset($params_action[$i]) && strpos($params_action[$i]['action'], 'delete') !== false) ? 'checked' : ''; ?> <?php echo(strpos($p['action'], 'delete') !== false) ? '' : 'disabled'; ?> class="filled-in chk-col-light-blue d-none" value="delete" />
                                                            <label for="delete_<?php echo $p['id']; ?>" class="m-r-15">Excluir</label>
                                                        </td>
                                                        <td width="100px">
                                                            <?php if($p['config_view'] == 1): ?>
                                                                <input name="<?php echo $p['name']; ?>_view" type="radio" required id="<?php echo $p['name']; ?>_user" <?php echo($params_action[$i]['content_view'] == 0) ? 'checked' : '' ;?> class="with-gap radio-col-light-blue" value="0">
                                                                <label for="<?php echo $p['name']; ?>_user">Usuário</label>
                                                                <input name="<?php echo $p['name']; ?>_view" type="radio" required id="<?php echo $p['name']; ?>_all"  <?php echo($params_action[$i]['content_view'] == 1) ? 'checked' : '' ;?> class="with-gap radio-col-light-blue" value="1">
                                                                <label for="<?php echo $p['name']; ?>_all">Todos</label>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card-body text-center">
                            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar Permissões</button>
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
            <h3 class="text-themecolor">Permissões</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block m-b-15">
                        <div><h4 class="card-title"><span class="lstick"></span>Gerenciar Permissões</h4></div>
                        <div class="ml-auto">
                            <a href="<?php echo BASE_ADMIN. '/permissions/add';?>" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar Grupo</a>
                        </div>
                    </div>
                    <div class="row m-t-30">
                        <?php foreach ($groups as $g): ?>
                        <div class="col-lg-3 col-md-3">
                            <div class="card">
                                    <div class="d-flex flex-row b-all">
                                        <div class="p-10 bg-info">
                                            <h3 class="text-white box m-b-0"><i class="mdi mdi-lock"></i></h3></div>
                                        <div class="align-self-center m-l-20">
                                            <h3 class="m-b-0 text-info"><?php echo $g['name']; ?></h3>
                                            <a href="<?php echo BASE_ADMIN. '/permissions/edit/'.$g['id'];?>" class="text-muted">Editar</a> | <a href="#" onclick="deleteRedirect(`<?php echo BASE_ADMIN.'/permissions/delete/'.$g['id']; ?>`);" class="text-muted">Excluir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php break; ?>
<?php endswitch;?>