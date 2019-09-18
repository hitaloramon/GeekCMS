<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>GeekCMS - Login</title>
    <link href="<?php echo BASE; ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/css/pages/login-register-lock.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/css/colors/default-dark.css" id="theme" rel="stylesheet">
</head>

<body class="card-no-border">

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">GeekCMS</p>
        </div>
    </div>

    <section id="wrapper">
        <div class="login-register" style="background-color: #eeeeee;">
            <div class="login-box card">
                <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" method="post">
                    <h3 class="box-title m-b-20" style="text-align: center">Painel Administrativo</h3>
                    <?php if(!empty($error)): ?>
                         <div class="text-danger text-center"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <div class="form-group ">
                        <div class="col-xs-12"><input class="form-control" type="email" name="email" required placeholder="Email"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12"><input class="form-control" type="password" name="password" required placeholder="Senha"> </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20"><button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Entrar</button></div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <a href="../" class="text-info m-l-5"><b>Voltar ao Site</b></a>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>
    <script src="<?php echo BASE; ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
    </script>
</body>
</html>