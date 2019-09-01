<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>

<div class="page-wrapper">
    <div class="container-fluid">

        <div class="d-flex no-block">
            <div><h3 class="text-themecolor">Modelo de Emails</h3></div>
            <div class="w-25 ml-auto m-b-15">
                <select class="selectpicker" name="page" id="page" data-style="custom-select w-100"  data-live-search="true" title="Selecione" onchange="if(this.value != '0') window.location = '<?php echo BASE_ADMIN ?>/emailmodel/'+this[this.selectedIndex].value; else window.location = '<?php echo BASE_ADMIN ?>/layout';">
                     <?php foreach ($viewData['allmodel'] as $model): ?>
                        <option value="<?php echo $model['id']; ?>" <?php getSelected($viewData['id'], $model['id']); ?>><?php echo $model['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="m-t-5"><a class="right-side-toggle m-l-15" href="javascript:void(0)"><i class="mdi mdi-help"></i></a></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Gerenciar Modelo</h4>
                            </div>
                        </div>
                        <div class="alert alert-info alert-rounded"><i class="mdi mdi-info"></i><?php echo $viewData['model']['help']; ?></div>
                        
                        <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nome do Modelo</label>
                                        <input type="text" id="name" name="name" required class="form-control" value="<?php echo $viewData['model']['name']; ?>">
                                        <small class="form-control-feedback" id="name-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Assunto</label>
                                        <input type="text" id="subject" name="subject" class="form-control" value="<?php echo $viewData['model']['subject']; ?>">
                                        <small class="form-control-feedback" id="subject-feedback"></small>
                                    </div>
                                </div>
                                <div id="geekfull" class="col-md-12 m-t-40" style="height:500px">
                                    <div class="d-flex no-block">
                                        <div><h5>Conteúdo</h5></div>
                                        <div class="ml-auto">
                                            <a class="nav-link" href="#" onclick="requestFullScreen('#geekfull')"><i class="mdi mdi-fullscreen"></i></a>
                                        </div>
                                    </div>
                                    <div id="geekeditor" data-fieldname="body"><?php echo html_entity_decode($viewData['model']['body']); ?></div>
                                    <small class="form-control-feedback" id="body-feedback"></small>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar Modelo</button>
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
                    <b></b>
                    <p>As palavras entre os colchetes serão substituídas por valores.</p>
                    <hr>
                    <h5>Valores Permitidos:</h5>
                    <br>
                    <p>Logotipo: [LOGO]</p>
                    <p>Link do Site: [SITE_URL]</p>
                    <p>Nome do Site: [SITE_NAME]</p>
                    <p>Nome do Usuário: [NAME]</p>
                    <p>Login do Usuário [USERNAME]</p>
                    <p>Email do Usuário: [EMAIL]</p>
                    <p>Token: [TOKEN]</p>
                    <p>IP do Usuário: [IP]</p>
                    </div>
            </div>
        </div>

    </div>
</div>