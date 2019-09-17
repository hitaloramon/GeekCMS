<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>

<?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
<?php
  $user = new User();
  $user_data = $user->getUser($_SESSION['user_id']); 
  $user_address = $user->getAddress($_SESSION['user_id']); 
?>

<div class="container">
  <div class="card">
      <h4 class="mb-4">Gerenciar Sua Conta</h4>
      <!-- Nav tabs -->
      <ul class="nav nav-tabs customtab" role="tablist">
          <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab"><i class="fas fa-user"></i> Perfil</a></li>
          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#address" role="tab"><i class="fas fa-map"></i> Endereço</a> </li>
          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#payments" role="tab"><i class="fas fa-file-alt"></i> Pedidos</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content tabcontent-border">
          <div class="tab-pane active p-4" id="profile" role="tabpanel">
              <form id="form-profile" method="post" action="<?php echo BASE; ?>/controller/profile">
                  <div class="row">
                    <div class="col-md-12">
                      <div id="msg-profile"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="fname">Nome: </label>
                        <input type="text" class="form-control" id="fname" required name="fname" value="<?php echo $user_data['fname'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="lname">Sobrenome: </label>
                        <input type="text" class="form-control" id="lname" required name="lname" value="<?php echo $user_data['lname'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="email">Email: </label>
                        <input type="email" class="form-control" id="email" required name="email" value="<?php echo $user_data['email'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="password">Senha: </label>
                        <input type="password" class="form-control" id="password" name="password">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="birthday">Nascimento: </label>
                        <input type="date" class="form-control" id="birthday" name="birthday" required value="<?php echo $user_data['birthday'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="email">Inscrito na Newsletter: </label>
                        <select class="custom-select col-12" name="newsletter">
                            <option value="1" <?php getSelected('1', $user_data['newsletter']); ?>>Sim</option>
                            <option value="0" <?php getSelected('0', $user_data['newsletter']); ?>>Não</option>
                        </select>
                      </div>
                    </div>
                    <?php $custom = new CustomFields(); ?>
                    <?php echo $custom->renderCustomFields('profile'); ?>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="fname">Último Login: </label>
                        <input type="text" class="form-control" disabled value="<?php echo date('d/m/Y H:i A', strtotime($user_data['lastlogin'])); ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="lname">Conta Criada em: </label>
                        <input type="text" class="form-control" disabled value="<?php echo date('d/m/Y H:i A', strtotime($user_data['created'])); ?>">
                      </div>
                    </div>
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
                <button type="submit" class="btn btn-info waves-effect waves-light mt-2">Atualizar</button>
              </form>
          </div>

          <script>
            $("#form-profile").submit(function (e) {
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
                                $('#msg-profile').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                            } else {
                                $('#msg-profile').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                            }
                            $('body,html').animate({scrollTop:0}, 500);
                        } catch (e) {
                            $('#msg-profile').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response + '</div>');
                        }
                    }
                });
            });
          </script>

          <div class="tab-pane p-4" id="address" role="tabpanel">
            <form id="form-address" method="post" action="<?php echo BASE; ?>/controller/address">
                  <div class="row">
                    <div class="col-md-12">
                      <div id="msg-address"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="street">Código Postal (CEP): </label>
                        <input type="text" class="form-control" id="postal_code" required name="postal_code" value="<?php echo $user_address['postal_code'];?>">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group has-feedback">
                        <label for="phone_code">DDD: </label>
                        <input type="text" class="form-control" id="phone_code" required name="phone_code" value="<?php echo $user_address['phone_code'];?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group has-feedback">
                        <label for="phone">Telefone: </label>
                        <input type="text" class="form-control" id="phone" required name="phone" value="<?php echo $user_address['phone'];?>">
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group has-feedback">
                        <label for="fname">Endereço: </label>
                        <input type="text" class="form-control" id="street" required name="street" value="<?php echo $user_address['street'];?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group has-feedback">
                        <label for="lname">Número: </label>
                        <input type="text" class="form-control" id="number" required name="number" value="<?php echo $user_address['number'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="complement">Complemento: </label>
                        <input type="text" class="form-control" id="complement" required name="complement" value="<?php echo $user_address['complement'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="district">Bairro: </label>
                        <input type="text" class="form-control" id="district" required name="district" value="<?php echo $user_address['district'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-feedback">
                        <label for="city">Cidade: </label>
                        <input type="text" class="form-control" id="city" required name="city" value="<?php echo $user_address['city'];?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group has-feedback">
                        <label for="state">Estado: </label>
                        <input type="text" class="form-control" id="state" required name="state" value="<?php echo $user_address['state'];?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group has-feedback">
                        <label for="country">País: </label>
                        <input type="text" class="form-control" id="country" required name="country" value="<?php echo $user_address['country'];?>">
                      </div>
                    </div>
                  </div>
                <button type="submit" class="btn btn-info waves-effect waves-light mt-2">Atualizar</button>
              </form>
              <script>
              $("#form-address").submit(function (e) {
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
                                    $('#msg-address').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                                } else {
                                    $('#msg-address').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                                }
                                $('body,html').animate({ scrollTop: 0 }, 500);
                            } catch (e) {
                                $('#msg-address').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response + '</div>');
                            }
                        }
                    });
                });
              </script>
          </div>

          <div class="tab-pane p-4" id="payments" role="tabpanel">
            Histórico de Pedidos
          </div>

      </div>
  </div>
</div>

<?php else: ?>
<div class="alert alert-warning mt-4 mb-4" role="alert">
  Você não está logado no sistema. <a href="<?php echo BASE.'/'.$this->config['page_login']; ?>">Clique Aqui</a> para ir para página de login.
</div>
<?php endif; ?>

<script>
$('#postal_code').on('keyup', function () {
    var postal_code = $(this).val();
    if (postal_code.length == 8) {
        $.getJSON('https://viacep.com.br/ws/'+postal_code+'/json/', function(data){
          $('#street').val(data.logradouro);
          $('#complement').val(data.complemento);
          $('#district').val(data.bairro);
          $('#state').val(data.uf);
          $('#city').val(data.localidade);
          $('#country').val('Brasil');
        });
    }
});

$(document).ready(function(){
  $('#postal_code').mask('00000000');
  $('#state').mask('AA');
  $('#phone_code').mask('00');
  $('#phone').mask('000000000');
});
</script>