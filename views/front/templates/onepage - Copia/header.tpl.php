<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>
<!DOCTYPE html>
<html lang="<?php echo str_replace("_", "-", $this->config['site_locale']); ?>">
<head>
<?php $this->renderMetatags($viewData); ?>
<meta charset="UTF-8">
<meta name="theme-color" content="#0b6ac8">
<meta name="robots" content="index,follow">
<meta name="generator" content="Powered by GeekCMS">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="<?php echo $this->config['site_name']; ?>">
<meta name="dcterms.rights" content="<?php echo $this->config['site_name']; ?> &copy; All Rights Reserved">
<?php if(!empty($this->config['site_favicon'])): ?>
<link rel="shortcut icon" href="<?php echo BASE; ?>/uploads/<?php echo $this->config['site_favicon']; ?>" type="image/x-icon">
<?php endif; ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
<link href="<?php echo BASE; ?>/views/front/templates/<?php echo $this->config['site_theme']; ?>/assets/css/style.css" rel="stylesheet">
<link href="<?php echo BASE; ?>/views/front/templates/<?php echo $this->config['site_theme']; ?>/assets/css/demo.css" rel="stylesheet">
<link href="<?php echo BASE; ?>/views/front/templates/<?php echo $this->config['site_theme']; ?>/assets/css/aos.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript"> localStorage.setItem('SITEURL', '<?php echo BASE; ?>');</script>
<?php $this->renderAssetsWidget($widget_result); ?>

</head>
<body class="animated">
    <!-- <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
        </div>
    </div> -->
    <div class="main-wrapper">
            <div class="header13 po-relative">

                <div class="h13-topbar">
                    <div class="container">
                        <nav class="navbar navbar-expand-lg font-14">
                            <a class="navbar-brand hidden-xs-up" href="#">Menu</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header13top" aria-controls="header13top" aria-expanded="false" aria-label="Toggle">
                                <span class="sl-icon-options"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="header13top">
                                <ul class="navbar-nav">
                                    <li class="nav-item"><a class="nav-link"><i class="fas fa-clock"></i> Atendimento: Segunda a Sexta das 09:00 às 18:00.</a></li>
                                </ul>
                                <div class="links ml-auto mt-2 mb-2">
                                    <?php $social = new Social(); $social = $social->getSocial(); foreach ($social as $s): ?>
                                        <a href="<?php echo $s['url']; ?>" title="<?php echo $s['name']; ?>" target="_blank" rel="noopener noreferrer" class="link p-10"><i class="<?php echo $s['icon'];?>"></i></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="container">
                    <!-- Header 13 navabar -->
                    <nav class="navbar navbar-expand-lg hover-dropdown h13-nav">
                        <a href="<?php echo BASE; ?>" class="navbar-brand"><img src="<?php echo BASE; ?>/uploads/<?php echo $this->config['site_logo']; ?>" alt="<?php echo $this->config['site_name']; ?>"/></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header13" aria-controls="header13" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="header13">
                            <ul class="navbar-nav ml-auto" id="top-menu">
                                <?php 
                                    $menu = new Menu(); 
                                    $menu_array = $menu->getMenu(true);
                                    echo $menu->bootstrap_menu($menu_array);
                                ?>
                                <li class="nav-item"><a class="btn btn-warning" href="https://central.meupost.net"><i class="fas fa-lock"></i> Entrar</a></li>
                            </ul>
                        </div>
                    </nav>
                    <!-- End Header 13 navabar -->
                </div>
            </div>
    <div class="page-wrapper">