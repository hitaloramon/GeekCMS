<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>
<?php if(!isset($_SESSION['user_id'])): ?>
<div class="card">
    <form id="form-login">
        <div class="row m-t-10">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" id="username" required name="username" placeholder="Login" autocomplete="off">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" id="password" required name="password" placeholder="Senha" autocomplete="off">
                </div>
            </div>
            <div class="col-md-12 m-b-10">
                <a href="<?php echo BASE.'/'.$this->config['page_login']; ?>">Esqueci a Senha.</a>
            </div>
            <div class="col-md-12">
                <button type="submit" id="btn_submit" class="btn btn-info">Enviar</button>
                <button type="reset" id="btn_submit" class="btn btn-info">Limpar</button>
            </div>
        </div>
    </form>
</div>
<?php else: ?>

<?php endif; ?>