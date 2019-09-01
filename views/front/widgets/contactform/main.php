<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>
<div class="container">
  <div class="m-t-40 m-b-40">
    <form id="form-contact" method="post" action="<?php echo BASE; ?>/controller/contact">
      <div id="msg-contact"></div>
      <div class="form-group has-feedback">
        <label for="name">Nome: </label>
        <input type="text" class="form-control" id="name" required name="name" placeholder="">
      </div>
      <div class="form-group has-feedback">
        <label for="email">Email: </label>
        <input type="email" class="form-control" id="email" required name="email" placeholder="">
      </div>
      <div class="form-group has-feedback">
        <label for="subject">Assunto: </label>
        <input type="text" class="form-control" id="subject" name="subject" placeholder="">
      </div>
      <div class="form-group has-feedback">
        <label for="message">Mensagem: </label>
        <textarea class="form-control" rows="6" id="message" requerid name="message" placeholder=""></textarea>
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
</div>

<script>
$("#form-contact").submit(function (e) {
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
                    $('#msg-contact').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text);
                } else {
                    $('#msg-contact').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text);
                }
                $('body,html').animate({ scrollTop: 0 }, 500);
            } catch (e) {
                $('#msg-contact').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response);
            }
        }
    });
});
</script>