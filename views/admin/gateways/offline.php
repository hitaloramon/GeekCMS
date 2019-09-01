<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex no-block">
                    <div>
                        <h4 class="card-title"><span class="lstick"></span><?php echo $gateways['displayname']; ?></h4>
                    </div>
                </div>
                <!-- Inicio do Conteúdo -->
                <form action="#" method="post" id="form-geek">
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input type="text" id="displayname" name="displayname" required class="form-control" value="<?php echo $gateways['displayname']; ?>">
                                <small class="form-control-feedback" id="title-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ativo</label>
                                <select class="form-control custom-select" id="active" name="active">
                                    <option value="1" <?php getSelected('1', $gateways['active']); ?>>Sim</option>
                                    <option value="0" <?php getSelected('0', $gateways['active']); ?>>Não</option>
                                </select>
                                <small class="form-control-feedback" id="type_page-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-12 m-t-40">
                            <div class="card">
                                <div class="d-flex no-block">
                                    <h5>Instruções de Pagamento</h5>
                                    <div class="ml-auto">
                                        <div class="card-actions">
                                            <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="info1" required id="description" rows="8"><?php echo $gateways['info1']; ?></textarea>
                                    <small class="form-control-feedback" id="description-feedback"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="card-body text-center">
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Fim do Conteúdo -->
            </div>
        </div>
    </div>
</div>