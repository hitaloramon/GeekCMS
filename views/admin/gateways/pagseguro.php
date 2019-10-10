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
                <div class="alert alert-info">É necessário ter uma conta do PagSeguro do tipo Vendedor ou Empresarial para usar essa forma de pagamento.</div>
                <form action="#" method="post" id="form-geek">
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input type="text" id="displayname" name="displayname" required class="form-control" value="<?php echo $gateways['displayname']; ?>">
                                <small class="form-control-feedback" id="title-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Ativo</label>
                                <select class="form-control custom-select" id="active" name="active">
                                    <option value="1" <?php getSelected('1', $gateways['active']); ?>>Sim</option>
                                    <option value="0" <?php getSelected('0', $gateways['active']); ?>>Não</option>
                                </select>
                                <small class="form-control-feedback" id="type_page-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Ambiente</label>
                                <select class="form-control custom-select" id="sandbox" name="sandbox">
                                    <option value="1" <?php getSelected('1', $gateways['sandbox']); ?>>Sandbox</option>
                                    <option value="0" <?php getSelected('0', $gateways['sandbox']); ?>>Produção</option>
                                </select>
                                <small class="form-control-feedback" id="sandbox-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Email PagSeguro</label>
                                <input type="text" id="info1" name="info1" required class="form-control" value="<?php echo $gateways['info1']; ?>">
                                <small class="form-control-feedback" id="title-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Token</label>
                                <input type="text" id="info2" name="info2" required class="form-control" value="<?php echo $gateways['info2']; ?>">
                                <small class="form-control-feedback" id="title-feedback"></small>
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