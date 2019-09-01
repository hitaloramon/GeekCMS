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
<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
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
        <div class="topbar fixed-header">
            <div class="header4 po-relative">
                <div class="h4-navbar">
                    <div class="container">
                        <nav class="navbar navbar-light navbar-expand-lg h4-nav-bar">
                            <a href="<?php echo BASE; ?>" class="navbar-brand"><img src="<?php echo BASE; ?>/uploads/<?php echo $this->config['site_logo']; ?>" alt="<?php echo $this->config['site_name']; ?>"/></a>
                        </nav>
                    </div>
                </div>
                <div class="h4-topbar">
                    <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <button class="navbar-toggler b-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse hover-dropdown" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                            <?php 
                                $menu = new Menu(); 
                                $menu_array = $menu->getMenu(true);
                                echo $menu->bootstrap_menu($menu_array);
                            ?>
                            </ul>
                        </div>
                    </nav>
                    </div>
                </div>
            </div>
        </div>
    <div class="page-wrapper">