<?php 
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }
?>

<div class="row page-titles">
    <div class="col-md-12 align-self-center">
        <h3 class="text-themecolor">Configurações</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex no-block">
                    <div>
                        <h4 class="card-title"><span class="lstick"></span>Configurações do Sistema</h4>
                    </div>
                </div>
                <form action="#" method="post" id="form-geek">
                    <div class="row">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs customtab w-100" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#general" role="tab"><i class="fas fa-cogs"></i> <span class="hidden-xs-down">Geral</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#email" role="tab"><i class="fas fa-envelope-open-text"></i> <span class="hidden-xs-down">Email</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#options" role="tab"><i class="fas fa-users-cog"></i> <span class="hidden-xs-down">Opções</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#locale" role="tab"><i class="fas fa-globe-americas"></i> <span class="hidden-xs-down">Localização</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#social" role="tab"><i class="fas fa-hashtag"></i> <span class="hidden-xs-down">Social</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#layout" role="tab"><i class="fas fa-columns"></i> <span class="hidden-xs-down">Layout</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#panel" role="tab"><i class="fas fa-tint"></i> <span class="hidden-xs-down">Painel</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content w-100 m-t-30 p-l-20 p-r-20">
                            <div class="tab-pane active" id="general" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Nome do Site</label>
                                            <input type="text" id="site_name" name="site_name" required class="form-control" value="<?php echo $this->config['site_name']; ?>">
                                            <small class="form-control-feedback" id="site_name-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Slogan</label>
                                            <input type="text" id="site_slogan" name="site_slogan" required class="form-control" value="<?php echo $this->config['site_slogan']; ?>">
                                            <small class="form-control-feedback" id="site_slogan-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">URL do Site</label>
                                            <input type="text" id="site_url" name="site_url" required class="form-control" value="<?php echo $this->config['site_url']; ?>">
                                            <small class="form-control-feedback" id="site_url-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Ativar SSL</label>
                                            <select class="form-control custom-select" id="site_enable_ssl" name="site_enable_ssl">
                                                <option value="1" <?php getSelected('1', $this->config['site_enable_ssl']); ?>>Sim</option>
                                                <option value="0" <?php getSelected('0', $this->config['site_enable_ssl']); ?>>Não</option>
                                            </select>
                                            <small class="form-control-feedback" id="site_url-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Pasta do Site</label>
                                            <input type="text" id="site_dir" name="site_dir" class="form-control" value="<?php echo $this->config['site_dir']; ?>">
                                            <small class="form-control-feedback" id="site_dir-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Google Analytics</label>
                                            <textarea class="form-control" name="site_analytics" id="site_analytics" rows="10"><?php echo $this->config['site_analytics']; ?></textarea>
                                            <small class="form-control-feedback" id="site_analytics-feedback"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="email" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email do Site</label>
                                            <input type="text" id="site_email" name="site_email" required class="form-control" value="<?php echo $this->config['site_email']; ?>">
                                            <small class="form-control-feedback" id="site_email-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Sistema de Email Padrão</label>
                                            <select class="form-control custom-select" id="site_mailer" name="site_mailer" onchange="checkMail(this.value);">
                                                <option value="PHP" <?php getSelected('PHP', $this->config['site_mailer']); ?>>PHP Mail</option>
                                                <option value="SMTP" <?php getSelected('SMTP', $this->config['site_mailer']); ?>>SMTP</option>
                                            </select>
                                            <small class="form-control-feedback" id="site_mailer-feedback"></small>
                                        </div>
                                    </div>
                                </div>
                                <div id="smtp_config" class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Host do SMTP</label>
                                            <input type="text" id="smtp_host" name="smtp_host" class="form-control" value="<?php echo $this->config['smtp_host']; ?>">
                                            <small class="form-control-feedback" id="smtp_host-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Porta</label>
                                            <input type="text" id="smtp_port" name="smtp_port" class="form-control" value="<?php echo $this->config['smtp_port']; ?>">
                                            <small class="form-control-feedback" id="smtp_port-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Autenticado</label>
                                            <select class="form-control custom-select" id="smtp_auth" name="smtp_auth">
                                                <option value="false" <?php getSelected('false', $this->config['smtp_auth']); ?>>Não</option>
                                                <option value="true" <?php getSelected('true', $this->config['smtp_auth']); ?>>Sim</option>
                                            </select>
                                            <small class="form-control-feedback" id="smtp_ssl-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Segurança do SMTP</label>
                                            <select class="form-control custom-select" id="smtp_secure" name="smtp_secure">
                                                <option value="false" <?php getSelected('false', $this->config['smtp_secure']); ?>>Padrão</option>
                                                <option value="ssl" <?php getSelected('ssl', $this->config['smtp_secure']); ?>>SSL</option>
                                                <option value="tls" <?php getSelected('tls', $this->config['smtp_secure']); ?>>TLS</option>
                                            </select>
                                            <small class="form-control-feedback" id="smtp_ssl-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Login do SMTP</label>
                                            <input type="text" id="smtp_user" name="smtp_user" class="form-control" value="<?php echo $this->config['smtp_user']; ?>">
                                            <small class="form-control-feedback" id="smtp_user-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Senha do SMTP</label>
                                            <input type="text" id="smtp_pass" name="smtp_pass" class="form-control" value="<?php echo $this->config['smtp_pass']; ?>">
                                            <small class="form-control-feedback" id="smtp_pass-feedback"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="options" role="tabpanel">
                                <div class="row">
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Permitir Cadastros</label>
                                        <div class="m-t-10">
                                            <input name="reg_allowed" type="radio" id="reg_allowed-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $this->config['reg_allowed']); ?> />
                                            <label for="reg_allowed-yes">Sim</label>
                                            <input name="reg_allowed" type="radio" id="reg_allowed-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $this->config['reg_allowed']); ?> />
                                            <label for="reg_allowed-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Cadastro Automático</label>
                                        <div class="m-t-10">
                                            <input name="auto_verify" type="radio" id="auto_verify-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $this->config['auto_verify']); ?> />
                                            <label for="auto_verify-yes">Sim</label>
                                            <input name="auto_verify" type="radio" id="auto_verify-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $this->config['auto_verify']); ?> />
                                            <label for="auto_verify-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Notificar Cadastros ao Admin</label>
                                        <div class="m-t-10">
                                            <input name="notify_admin" type="radio" id="notify_admin-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $this->config['notify_admin']); ?> />
                                            <label for="notify_admin-yes">Sim</label>
                                            <input name="notify_admin" type="radio" id="notify_admin-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $this->config['notify_admin']); ?> />
                                            <label for="notify_admin-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Mostrar Login</label>
                                        <div class="m-t-10">
                                            <input name="show_login" type="radio" id="show_login-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $this->config['show_login']); ?> />
                                            <label for="show_login-yes">Sim</label>
                                            <input name="show_login" type="radio" id="show_login-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $this->config['show_login']); ?> />
                                            <label for="show_login-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Mostrar Caixa de Pesquisa</label>
                                        <div class="m-t-10">
                                            <input name="show_search" type="radio" id="show_search-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $this->config['show_search']); ?> />
                                            <label for="show_search-yes">Sim</label>
                                            <input name="show_search" type="radio" id="show_search-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $this->config['show_search']); ?> />
                                            <label for="show_search-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Modo Manutenção</label>
                                        <div class="m-t-10">
                                            <input name="maintenance" type="radio" id="maintenance-yes" class="with-gap radio-col-light-blue" value="1" onchange="maintenanceCheck(this.value);" <?php getChecked('1', $this->config['maintenance']); ?> />
                                            <label for="maintenance-yes">Sim</label>
                                            <input name="maintenance" type="radio" id="maintenance-no" class="with-gap radio-col-light-blue" value="0" onchange="maintenanceCheck(this.value);" <?php getChecked('0', $this->config['maintenance']); ?> />
                                            <label for="maintenance-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 m-t-10">
                                        <label class="control-label">Notificar Transações</label>
                                        <select class="selectpicker" name="transaction_notify[]" multiple data-style="form-control btn-secondary" title="Notificar as seguintes transações">
                                            <option value="1" <?php echo (in_array("1", $viewData['transaction_notify'])) ? 'selected' : ''; ?>>Aguardando Pagamento</option>
                                            <option value="2" <?php echo (in_array("2", $viewData['transaction_notify'])) ? 'selected' : ''; ?>>Em Análise</option>
                                            <option value="3" <?php echo (in_array("3", $viewData['transaction_notify'])) ? 'selected' : ''; ?>>Pago</option>
                                            <option value="4" <?php echo (in_array("4", $viewData['transaction_notify'])) ? 'selected' : ''; ?>>Devolvido</option>
                                            <option value="5" <?php echo (in_array("5", $viewData['transaction_notify'])) ? 'selected' : ''; ?>>Cancelado</option>
                                            <option value="6" <?php echo (in_array("6", $viewData['transaction_notify'])) ? 'selected' : ''; ?>>Disputa</option>
                                        </select>
                                    </div>
                                    <div class="row w-100 p-20" id="row_maintenance">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Data de Manutenção</label>
                                                <input type="date" id="maintenance_date" name="maintenance_date" class="form-control" value="<?php echo $this->config['maintenance_date']; ?>">
                                                <small class="form-control-feedback" id="maintenance_date-feedback"></small>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Hora de Manutenção</label>
                                                <input type="time" id="maintenance_hour" name="maintenance_hour" class="form-control" value="<?php echo $this->config['maintenance_hour']; ?>">
                                                <small class="form-control-feedback" id="maintenance_hour-feedback"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Mensagem de Manutenção</label>
                                                <textarea class="form-control" name="maintenance_msg" id="maintenance_msg" rows="6"><?php echo $this->config['maintenance_msg']; ?></textarea>
                                                <small class="form-control-feedback" id="maintenance_msg-feedback"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="locale" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Moeda</label>
                                            <input type="text" id="currency" name="currency" required class="form-control" value="<?php echo $this->config['currency']; ?>">
                                            <small class="form-control-feedback" id="currency-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Simbolo da Moeda</label>
                                            <input type="text" id="cur_symbol" name="cur_symbol" required class="form-control" value="<?php echo $this->config['cur_symbol']; ?>">
                                            <small class="form-control-feedback" id="cur_symbol-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Fuso Horário</label>
                                            <select class="form-control custom-select select2" id="site_timezone" name="site_timezone" style="width: 100%; height:36px;">
                                                <?php echo getTimezones($this->config['site_timezone']); ?>
                                            </select>
                                            <small class="form-control-feedback" id="site_timezone-feedback"></small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Localização</label>
                                            <select class="form-control custom-select select2" id="site_locale" name="site_locale" style="width: 100%; height:36px;">
                                                <?php echo getLocale($this->config['site_locale']); ?>
                                            </select>
                                            <small class="form-control-feedback" id="site_locale-feedback"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="social" role="tabpanel">
                                <div class="w-100">
                                    <p class="control-label">Redes Sociais</p>
                                    <div id="social" class="row w-100">
                                        <?php if(empty($social)): ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <button name="social_icon[]" class="btn btn-outline-secondary social_picker" data-rows="4" data-cols="5" data-selected-class="btn-info w-100" data-unselected-class="w-100" data-arrow-class="btn-default" data-icon="" role="iconpicker" data-iconset="fontawesome5" data-search-text="Pesquisar" data-label-footer="{0} - {1} de {2} icones"></button>
                                                            <input type="hidden" id="icon" name="icon">
                                                        </div>
                                                        <input type="text" class="form-control" id="social_name" name="social_name[]" placeholder="Nome da Rede Social" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="social_url" name="social_url[]" placeholder="Link">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-success" type="button" onclick="social_fields();"><i class="fa fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <?php $first = true;  foreach ($social as $s): ?>
                                            <div class="w-100 d-flex remove<?php echo $s['id']; ?>">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <button name="social_icon[]" class="btn btn-outline-secondary social_picker" data-rows="4" data-cols="5" data-selected-class="btn-info w-100" data-unselected-class="w-100" data-arrow-class="btn-default" data-icon="<?php echo $s['icon']; ?>" role="iconpicker" data-iconset="fontawesome5" data-search-text="Pesquisar" data-label-footer="{0} - {1} de {2} icones"></button>
                                                            </div>
                                                            <input type="text" class="form-control" id="social_name" name="social_name[]" placeholder="Nome da Rede Social" value="<?php echo $s['name']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="social_url" name="social_url[]" placeholder="Link" value="<?php echo $s['url']; ?>">
                                                            <div class="input-group-append">
                                                                <?php if($first == true): $first = false; ?>
                                                                    <button class="btn btn-success" type="button" onclick="social_fields();"><i class="fa fa-plus"></i></button>
                                                                <?php else: ?>
                                                                    <button class="btn btn-danger" type="button" onclick="remove_fields('<?php echo $s['id']; ?>');"> <i class="fa fa-minus"></i></button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div id="social_fields" class="row w-100"></div>
                                </div>
                            </div>

                            <div class="tab-pane" id="layout" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Tema do Site</label>
                                            <select class="form-control custom-select" id="site_theme" name="site_theme" onchange="templatePreview(this.value);">
                                                <?php getTemplates('views/front/templates/', $this->config['site_theme'])?>
                                            </select>
                                            <small class="form-control-feedback" id="site_theme-feedback"></small>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Logo</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="site_logo" required name="site_logo" value="<?php echo $this->config['site_logo']; ?>">
                                                <span class="input-group-append">
                                                    <button onclick="javascript:open_popup('<?php echo BASE; ?>/libs/filemanager/dialog.php?type=1&popup=1&field_id=site_logo&relative_url=1')" class="btn btn-secondary" type="button"><i class="mdi mdi-folder"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Favicon</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="site_favicon" required name="site_favicon" value="<?php echo $this->config['site_favicon']; ?>">
                                                <span class="input-group-append">
                                                    <button onclick="javascript:open_popup('<?php echo BASE; ?>/libs/filemanager/dialog.php?type=1&popup=1&field_id=site_favicon&relative_url=1')" class="btn btn-secondary" type="button"><i class="mdi mdi-folder"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12 mb-2">Visualização do Tema</div>
                                        <iframe id="template_preview" src="<?php echo BASE; ?>" class="template-frame" scrolling="vertical"></iframe>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 m-t-20" style="height:400px; top:-200px">
                                        <div id="geekeditor" data-title="Rodapé" data-fieldname="site_footer"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="panel" role="tabpanel">
                                <ul id="themecolors">
                                    <li><b>Com barra lateral clara</b></li>
                                    <li><a href="javascript:void(0)" data-theme="default" class="fas default-theme">1</a></li>
                                    <li><a href="javascript:void(0)" data-theme="green" class="fas green-theme">2</a></li>
                                    <li><a href="javascript:void(0)" data-theme="red" class="fas red-theme">3</a></li>
                                    <li><a href="javascript:void(0)" data-theme="blue" class="fas blue-theme">4</a></li>
                                    <li><a href="javascript:void(0)" data-theme="purple" class="fas purple-theme">5</a></li>
                                    <li><a href="javascript:void(0)" data-theme="megna" class="fas megna-theme">6</a></li>
                                    <li class="d-block m-t-30"><b>Com barra lateral escura</b></li>
                                    <li><a href="javascript:void(0)" data-theme="default-dark" class="fas default-dark-theme">7</a></li>
                                    <li><a href="javascript:void(0)" data-theme="green-dark" class="fas green-dark-theme">8</a></li>
                                    <li><a href="javascript:void(0)" data-theme="red-dark" class="fas red-dark-theme">9</a></li>
                                    <li><a href="javascript:void(0)" data-theme="blue-dark" class="fas blue-dark-theme">10</a></li>
                                    <li><a href="javascript:void(0)" data-theme="purple-dark" class="fas purple-dark-theme">11</a></li>
                                    <li><a href="javascript:void(0)" data-theme="megna-dark" class="fas megna-dark-theme ">12</a></li>
                                </ul>
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <div class="card-body text-center">
                                    <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Salvar Configurações</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="right-sidebar">
    <div class="slimscrollright">
        <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
        <div class="r-panel-body geek-help">
            
        </div>
    </div>
</div>

<script>

checkMail('<?php echo $this->config['site_mailer']; ?>');
function checkMail(type_value) {
  if(type_value == 'SMTP'){
    $('#smtp_config').css("display", "");
  }
  if(type_value == 'PHP'){
    $('#smtp_config').css("display", "none");
  }
}


maintenanceCheck('<?php echo $this->config['maintenance']; ?>');
function maintenanceCheck(value){
    if (value == '1') {
        $('#row_maintenance').css("display", "");
    } else {
        $('#row_maintenance').css("display", "none");
    }
}

function templatePreview(template){
    $('#template_preview').attr("src", "<?php echo BASE; ?>?theme="+template);
}


<?php if(empty($social)): ?>
var room = 1;
<?php else: ?>
var room = <?php echo count($social); ?>;
<?php endif; ?>
function social_fields() {

    room++;
    var objTo = document.getElementById('social_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "w-100 d-flex remove" + room);
    var rdiv = 'remove' + room;

    divtest.innerHTML = `<div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button name="social_icon[]" class="btn btn-outline-secondary social_picker" data-rows="4" data-cols="5" data-selected-class="btn-info w-100" data-unselected-class="w-100" data-arrow-class="btn-default" data-icon="<?php echo $s['icon']; ?>" role="iconpicker" data-iconset="fontawesome5" data-search-text="Pesquisar" data-label-footer="{0} - {1} de {2} icones"></button>
                                    </div>
                                    <input type="text" class="form-control" id="social_name" name="social_name[]" placeholder="Nome da Rede Social" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="social_url" name="social_url[]" placeholder="Link" value="">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" type="button" onclick="remove_fields('`+room+`');"> <i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>`;

    objTo.appendChild(divtest)
    $('.social_picker').iconpicker();
}

function remove_fields(rid) {
    $('.remove' + rid).remove();
}

$('.social_picker').on('change', function(e) {
    $("#icon").val(e.icon);
});
</script>