<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
 
 if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    echo '<script>window.location.href = "'.BASE.'";</script>';
 }

 $result = explode('/', $_SERVER['PATH_INFO']);
?>

<?php if(isset($result[2]) &&  !empty($result[2])): ?>
  <div class="mt-4 mb-4">
    <h4 class="mb-4">Trocar Senha</h4>
    <form id="form-changepassword" method="post" action="<?php echo BASE; ?>/controller/changepassword">
      <div id="msg-changepassword"></div>
      <div class="form-group has-feedback">
        <label for="token">Token: </label>
        <input type="text" class="form-control" id="token" required name="token" value="<?php echo $result[2]; ?>">
      </div>
      <div class="form-group has-feedback">
        <label for="password">Nova Senha: </label>
        <input type="password" class="form-control" id="password" required name="password">
      </div>
      <div class="form-group has-feedback">
        <label for="confirm_password">Confirmar Senha: </label>
        <input type="password" class="form-control" id="confirm_password" required name="confirm_password">
      </div>
      <div class="form-group has-feedback">
        <label for="code">Captcha: </label>
        <div class="input-group">
            <input type="number" class="form-control" id="captcha" required name="captcha" placeholder="Insira o código ao lado.">
            <span class="input-group-addon"><img src="<?php echo BASE;?>/captcha.php" alt="" class="captcha-append" /></span>
        </div>
      </div>
      <button type="submit" id="btn_submit" class="btn btn-info waves-effect waves-light m-t-10">Enviar</button>
    </form>
  </div>
  <script>
  $("#form-changepassword").submit(function (e) {
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
                      $('#msg-changepassword').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text);
                  } else {
                      $('#msg-changepassword').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text);
                  }
                  $('body,html').animate({ scrollTop: 0 }, 500);
              } catch (e) {
                  $('#msg-changepassword').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response);
              }
          }
      });
  });
</script>
  </script>
<?php else: ?>
<div class="card mt-4">

    <ul class="nav nav-tabs customtab" role="tablist">
        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#login" role="tab"><span class="hidden-sm-up"><i class="fas fa-user"></i></span> <span class="hidden-xs-down">Login de Acesso</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#passwordrecovery" role="tab"><span class="hidden-sm-up"><i class="fas fa-key"></i></span> <span class="hidden-xs-down">Esqueci a Senha</span></a> </li>
    </ul>

    <div class="tab-content tabcontent-border">
        <div class="tab-pane active" id="login" role="tabpanel">
          <form id="form-login" name="form-login" action="<?php echo BASE; ?>/controller/login" method="post">
            <div class="row m-t-10 p-20">
              <div class="col-md-12">
                <div id="msg-login" class="alert alert-danger d-none"></div>
                <div class="form-group has-feedback">
                  <label for="email">Email: </label>
                  <input type="email" class="form-control" name="email" autocomplete="off" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group has-feedback">
                  <label for="password">Senha: </label>
                  <input type="password" class="form-control" name="password" autocomplete="off" required>
                </div>
              </div>
              <div class="col-md-12 m-b-10">
                <a href="<?php echo BASE.'/'.$this->config['page_register']; ?>">Clique aqui para se cadastrar.</a>
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-info">Enviar</button>
                <button type="reset" class="btn btn-info">Limpar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="tab-pane" id="passwordrecovery" role="tabpanel">
          <form id="form-recovery-password" name="form-recovery-password" method="post" action="<?php echo BASE; ?>/controller/recovery">
              <div class="row p-20">
                <div class="col-md-12">
                  <div id="msg-passwordrecovery"></div>
                  <div class="form-group has-feedback">
                    <label for="email">Email: </label>
                    <input type="email" class="form-control" id="email" required name="email">
                  </div>
                </div>
                <div class="col-md-12">
                  <button type="submit" class="btn btn-info">Enviar</button>
                  <button type="reset" class="btn btn-info">Limpar</button>
                </div>
              </div>
            </form>
        </div>
    </div>

    <script>
      $("#form-login").submit(function (e) {
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
                          window.location.href = localStorage.getItem('SITEURL');;
                      } else {
                          $('#msg-login').removeClass('d-none').html(response.text);
                      }
                  } catch (e) {
                      $('#msg-login').removeClass('d-none').html(response);
                  }
              }
          });
      });

      $("#form-recovery-password").submit(function (e) {
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
                          $('#msg-passwordrecovery').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                      } else {
                          $('#msg-passwordrecovery').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                      }
                      $('body,html').animate({ scrollTop: 0 }, 500);
                  } catch (e) {
                      $('#msg-passwordrecovery').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response + '</div>');
                  }
              }
          });
      });
    </script>

</div>
<?php endif; ?>