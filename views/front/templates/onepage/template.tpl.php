<?php
if (!defined("_VALID_PHP")) {
	die('Acesso direto negado');
}
?>
<?php $body = $this->renderPage($viewData['body']); ?>
<?php $footer = $this->renderPage($this->config['site_footer']); ?>
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
	<?php if (!empty($this->config['site_favicon'])) : ?>
		<link rel="shortcut icon" href="<?php echo BASE; ?>/uploads/<?php echo $this->config['site_favicon']; ?>" type="image/x-icon">
	<?php endif; ?>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
	<link href="<?php echo BASE; ?>/views/front/templates/<?php echo $this->config['site_theme']; ?>/assets/css/style.css" rel="stylesheet">
	<link href="<?php echo BASE; ?>/views/front/templates/<?php echo $this->config['site_theme']; ?>/assets/css/demo.css" rel="stylesheet">
	<link href="<?php echo BASE; ?>/views/front/templates/<?php echo $this->config['site_theme']; ?>/assets/css/aos.css" rel="stylesheet">
	<?php echo Asset::outputStyles(); ?>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript">
		localStorage.setItem('SITEURL', '<?php echo BASE; ?>');
	</script>
	<?php echo Asset::outputScripts('header'); ?>
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
								<?php $social = new Social();
								$social = $social->getSocial();
								foreach ($social as $s) : ?>
									<a href="<?php echo $s['url']; ?>" title="<?php echo $s['name']; ?>" target="_blank" rel="noopener noreferrer" class="link p-10"><i class="<?php echo $s['icon']; ?>"></i></a>
								<?php endforeach; ?>
							</div>
						</div>
					</nav>
				</div>
			</div>

			<div class="container">
				<!-- Header 13 navabar -->
				<nav class="navbar navbar-expand-lg hover-dropdown h13-nav">
					<a href="<?php echo BASE; ?>" class="navbar-brand"><img src="<?php echo BASE; ?>/uploads/<?php echo $this->config['site_logo']; ?>" alt="<?php echo $this->config['site_name']; ?>" /></a>
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
						</ul>
					</div>
				</nav>
				<!-- End Header 13 navabar -->
			</div>
		</div>
		<div class="page-wrapper">
			<?php
			switch ($viewData['access']) {
				case "1": // Publico
					require_once 'content.tpl.php';
					break;
				case "2": // Registrado
					if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != null) :
						require_once 'content.tpl.php';
					else :
						echo '<div class="main-container m-3">
								<div class="container m-t-40 m-b-40">
									<div class="alert alert-warning alert-dismissable fadeIn">
										Você precisa está logado para visualizar essa página. <a href="' . BASE . '/' . $this->config['page_login'] . '">Clique Aqui</a> para ir para página de login.
									</div>
								</div>
							</div>';
					endif;
					break;
				case "3": // Membro Associado
					if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != null) :
						$membership_array = explode(",", $viewData['membership_id']);
						$u = new User();

						if ($u->validateMembership($membership_array) == true || $u->isAdmin() == true) {
							require_once 'content.tpl.php';
						} else {
							echo '<div class="main-container m-3">
							<div class="container m-t-40 m-b-40">
								<div class="alert alert-warning alert-dismissable fadeIn">
									Você precisa ter um plano de acesso válido para acessar essa página. Clique Aqui para ir para página de planos.
								</div>
							</div>
						  </div>';
						} else :
						echo '<div class="main-container m-3">
						<div class="container m-t-40 m-b-40">
							<div class="alert alert-warning alert-dismissable fadeIn">
								Você precisa está logado para visualizar essa página. <a href="' . BASE . '/' . $this->config['page_login'] . '">Clique Aqui</a> para ir para página de login.
							</div>
						</div>
					  </div>';
					endif;
					break;
			}
			?>
		</div> <!--  page wrapper Close Tag -->
	</div> <!-- Main Wrapper Close Tag -->
	<div class="footer3 font-14">
		<?php if (!empty($footer)) : ?>
			<div class="container p-t-20">
				<?php echo $footer; ?>
			</div>
		<?php endif; ?>
		<div class="f3-bottom-bar mt-4">
			<div class="container">
				<div class="font-medium text-center text-white"><?php echo $this->config['site_name']; ?> <?php echo date('Y'); ?> © Todos os Direitos Reservados.</div>
			</div>
		</div>
	</div>
	<a class="bt-top btn btn-circle btn-md btn-inverse" href="#top"><i class="fa fa-angle-up"></i></a>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="<?php echo BASE; ?>/views/front/templates/<?php echo $this->config['site_theme']; ?>/assets/js/aos.js"></script>
	<script src="<?php echo BASE; ?>/views/front/templates/<?php echo $this->config['site_theme']; ?>/assets/js/custom.js"></script>
	<script src="<?php echo BASE; ?>/assets/plugins/mask/jquery.mask.min.js"></script>
	<script src="<?php echo BASE; ?>/assets/js/payment.js"></script>
</body>

</html>