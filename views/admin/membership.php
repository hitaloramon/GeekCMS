<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php switch($viewData['action']): case 'add': ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Planos de Acesso</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="w-100"><h4 class="card-title"><span class="lstick"></span>Adicionar Plano de Acesso</h4></div>
                        </div>

                        <div class="row p-10">
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
                                            <label class="control-label">Preço</label>
                                            <input type="text" id="price" name="price" required class="form-control" data-mask="0000000.00" data-mask-reverse="true">
                                            <small class="form-control-feedback" id="price-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Tempo</label>
                                            <input type="number" id="days" name="days" class="form-control">
                                            <small class="form-control-feedback" id="days-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Período</label>
                                            <select class="form-control custom-select" id="period" name="period">
                                                <option value="D">Dias</option>
                                                <option value="S">Semanas</option>
                                                <option value="M">Meses</option>
                                                <option value="A">Anos</option>
                                            </select>
                                            <small class="form-control-feedback" id="membership_id-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Imagem</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="img" name="img">
                                                <span class="input-group-append">
                                                    <button onclick="javascript:open_popup('<?php echo BASE; ?>/libs/filemanager/dialog.php?type=1&popup=1&field_id=img&relative_url=1')" class="btn btn-secondary" type="button"><i class="mdi mdi-folder"></i></button>
                                                </span>
                                            </div>
                                            <small class="form-control-feedback" id="img-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Avaliação</label>
                                        <div class="m-t-10">
                                            <input name="trial" type="radio" id="trial-yes" class="with-gap radio-col-light-blue" value="1" />
                                            <label for="trial-yes">Sim</label>
                                            <input name="trial" type="radio" id="trial-no" checked class="with-gap radio-col-light-blue" value="0"/>
                                            <label for="trial-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Plano Privado</label>
                                        <div class="m-t-10">
                                            <input name="private" type="radio" id="private-yes" class="with-gap radio-col-light-blue" value="1" />
                                            <label for="private-yes">Sim</label>
                                            <input name="private" type="radio" id="private-no" checked class="with-gap radio-col-light-blue" value="0"/>
                                            <label for="private-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Ativo</label>
                                        <div class="m-t-10">
                                            <input name="active" type="radio" id="active-yes" checked class="with-gap radio-col-light-blue" value="1" />
                                            <label for="active-yes">Sim</label>
                                            <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0"/>
                                            <label for="active-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-10">
                                        <div class="form-group">
                                            <label class="control-label">Descrição</label>
                                            <textarea class="form-control" name="description" required id="description" rows="2"></textarea>
                                            <small class="form-control-feedback" id="description-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="card-body text-center">
                                            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar Plano</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body geek-help">
                    <ul id="themecolors" class="m-t-20">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                        <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                        <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme working">7</a></li>
                        <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<?php break; ?>
<?php case 'edit': ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Planos de Acesso</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="w-100"><h4 class="card-title"><span class="lstick"></span>Editar Plano de Acesso</h4></div>
                        </div>

                        <div class="row p-10">
                            <form action="#" method="post" id="form-geek">
                                <div class="row p-t-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Título</label>
                                            <input type="text" id="title" name="title" required class="form-control" value="<?php echo $memberships['title']; ?>">
                                            <small class="form-control-feedback" id="title-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Preço</label>
                                            <input type="text" id="price" name="price" required class="form-control" value="<?php echo $memberships['price']; ?>" data-mask="0000000.00" data-mask-reverse="true">
                                            <small class="form-control-feedback" id="price-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Tempo</label>
                                            <input type="number" id="days" name="days" class="form-control" value="<?php echo $memberships['days']; ?>">
                                            <small class="form-control-feedback" id="days-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Período</label>
                                            <select class="form-control custom-select" id="period" name="period">
                                                <option value="D" <?php getSelected('D', $memberships['period']); ?>>Dias</option>
                                                <option value="S" <?php getSelected('S', $memberships['period']); ?>>Semanas</option>
                                                <option value="M" <?php getSelected('M', $memberships['period']); ?>>Meses</option>
                                                <option value="A" <?php getSelected('A', $memberships['period']); ?>>Anos</option>
                                            </select>
                                            <small class="form-control-feedback" id="membership_id-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Imagem</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="img" name="img" value="<?php echo $memberships['img']; ?>">
                                                <span class="input-group-append">
                                                    <button onclick="javascript:open_popup('<?php echo BASE; ?>/libs/filemanager/dialog.php?type=1&popup=1&field_id=img&relative_url=1')" class="btn btn-secondary" type="button"><i class="mdi mdi-folder"></i></button>
                                                </span>
                                            </div>
                                            <small class="form-control-feedback" id="img-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Avaliação</label>
                                        <div class="m-t-10">
                                            <input name="trial" type="radio" id="trial-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $memberships['trial']); ?> />
                                            <label for="trial-yes">Sim</label>
                                            <input name="trial" type="radio" id="trial-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $memberships['trial']); ?> />
                                            <label for="trial-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Plano Privado</label>
                                        <div class="m-t-10">
                                            <input name="private" type="radio" id="private-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $memberships['private']); ?> />
                                            <label for="private-yes">Sim</label>
                                            <input name="private" type="radio" id="private-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $memberships['private']); ?>/>
                                            <label for="private-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Ativo</label>
                                        <div class="m-t-10">
                                            <input name="active" type="radio" id="active-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $memberships['active']); ?> />
                                            <label for="active-yes">Sim</label>
                                            <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $memberships['active']); ?> />
                                            <label for="active-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-t-10">
                                        <div class="form-group">
                                            <label class="control-label">Descrição</label>
                                            <textarea class="form-control" name="description" required id="description" rows="2"><?php echo $memberships['description']; ?></textarea>
                                            <small class="form-control-feedback" id="description-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="card-body text-center">
                                            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar Plano</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body geek-help">
                    <ul id="themecolors" class="m-t-20">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                        <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                        <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme working">7</a></li>
                        <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<?php break; ?>
<?php default: ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Planos de Acesso</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block m-b-15">
                            <div><h4 class="card-title"><span class="lstick"></span>Gerenciar Planos</h4></div>
                            <div class="ml-auto">
                                <a href="<?php echo BASE_ADMIN. '/membership/add';?>" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar Plano</a>
                            </div>
                        </div>

                        <div class="row pricing-plan">
                            <?php if(!is_array($memberships)){ echo 'Sem Associações';}else{ foreach ($memberships as $m): ?>
                                <div class="col-md-4 no-padding">
                                    <div class="pricing-box">
                                        <div class="pricing-body b-l b-r">
                                            <div class="pricing-header">
                                                <?php if(!empty($m['img'])): ?>
                                                    <img src="<?php echo BASE_UPLOADS ?>/<?php echo $m['img']; ?>" class="m-b-30" />
                                                <?php endif; ?>
                                                <h4 class="text-center"><?php echo $m['title']; ?></h4>
                                                <h2 class="text-center"><span class="price-sign">R$</span><?php echo $m['price']; ?></h2>
                                                <p class="uppercase">por <?php echo $m['days']; ?> <?php echo periodText($m['period'], ($m['days'] > 1) ? true : false); ?></p>
                                            </div>
                                            <div class="price-table-content">
                                                <div class="price-row"><i class="mdi mdi-timer"></i>Avaliação: <?php echo ($m['trial']) ? 'Sim' : 'Não'; ?></div>
                                                <div class="price-row"><i class="mdi mdi-lock"></i> Privado: <?php echo ($m['private']) ? 'Sim' : 'Não'; ?></div>
                                                <div class="price-row"><i class="mdi mdi-check"></i> Ativo: <?php echo ($m['active']) ? 'Sim' : 'Não'; ?></div>
                                                <div class="price-row">
                                                    <a href="<?php echo BASE_ADMIN.'/membership/edit/'.$m['id']; ?>" class="btn btn-info waves-effect waves-light">Editar</a>
                                                    <a href="#" onclick="deleteInfo(this, '<?php echo BASE_ADMIN.'/membership/delete/'.$m['id']; ?>');" class="btn btn-danger waves-effect waves-light">Excluir</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body geek-help">
                    <ul id="themecolors" class="m-t-20">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                        <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                        <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme working">7</a></li>
                        <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<?php endswitch;?>