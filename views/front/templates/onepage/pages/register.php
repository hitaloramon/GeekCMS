<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>

<?php if($this->config['reg_allowed'] == true): ?>
<div class="mb-4">
<h4 class="mb-3">Cadastro</h4>
<form id="form-register" method="post" action="<?php echo BASE; ?>/controller/register">
  <div id="msg-register"></div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <label for="fname">Nome: </label>
          <input type="text" class="form-control" id="fname" required name="fname">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <label for="lname">Sobrenome: </label>
          <input type="text" class="form-control" id="lname" required name="lname">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group has-feedback">
          <label for="email">Email: </label>
          <input type="email" class="form-control" id="email" required name="email">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <label for="password">Senha: </label>
          <input type="password" class="form-control" id="password" required name="password" autocomplete="off">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <label for="confirm_password">Confirmar Senha: </label>
          <input type="password" class="form-control" id="confirm_password" required name="confirm_password" autocomplete="off">
        </div>
      </div>
      <?php $custom = new CustomFields(); ?>
      <?php echo $custom->renderCustomFields('register'); ?>
      <div class="col-md-12">
        <div class="form-group has-feedback">
          <label for="code">Captcha: </label>
          <div class="input-group">
              <input type="number" class="form-control" id="captcha" required name="captcha" placeholder="Insira o código ao lado.">
              <span class="input-group-addon"><img src="<?php echo BASE;?>/captcha.php" alt="" class="captcha-append" /></span>
          </div>
        </div>
      </div>
    </div>
  <button type="submit" id="btn_submit" class="btn btn-info waves-effect waves-light m-t-10">Registrar</button>
</form>
</div>
<script>
  $("#form-register").submit(function (e) {
      e.preventDefault();
      var data = $(this).serialize()
      $.ajax({
          url: $(this).attr('action'),
          type: "post",
          data: data,
          success: function (response) {
              try {
                  response = JSON.parse(response);
                  if (response.icon == 'success') {
                      $('#msg-register').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                  } else {
                      $('#msg-register').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                  }
                  $('body,html').animate({ scrollTop: 0 }, 500);
              } catch (e) {
                  $('#msg-register').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response + '</div>');
              }
          }
      });
  });
</script>
<?php else: ?>
<div class="alert alert-warning mt-4 mb-4" role="alert">
  O administrador desativou novos cadastros no site. Não é possível se cadastrar no momento.
</div>
<?php endif; ?>