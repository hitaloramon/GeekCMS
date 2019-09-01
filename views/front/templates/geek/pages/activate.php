<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
  }
?>
<?php 
  $result = explode('/', $_SERVER['PATH_INFO']);
  if(isset($result[2]) && isset($result[3])){
    $email = $result[2];
    $token = $result[3];
  }else{
    $email = '';
    $token = '';
  }
?>

<div class="m-t-40 m-b-40">
  <form id="form-activate" method="post" action="<?php echo BASE; ?>/controller/activate">
    <div id="msg-activate"></div>
    <div class="form-group has-feedback">
      <label for="email">Email: </label>
      <input type="email" class="form-control" id="email" required name="email" placeholder="" value="<?php echo $email; ?>">
    </div>
    <div class="form-group has-feedback">
      <label for="subject">Token: </label>
      <input type="text" class="form-control" id="token" name="token" placeholder="" value="<?php echo $token; ?>">
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
$("#form-activate").submit(function (e) {
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
                    $('#msg-activate').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text);
                } else {
                    $('#msg-activate').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text);
                }
                $('body,html').animate({ scrollTop: 0 }, 500);
            } catch (e) {
                $('#msg-activate').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response);
            }
        }
    });
});
</script>
</script>