<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>		

 	</div> <!--  page wrapper Close Tag -->
	</div> <!-- Main Wrapper Close Tag -->
	<div class="footer3 bg-dark font-14">
		<?php require_once 'widget_footer.tpl.php'; ?>
		<div class="f3-bottom-bar">
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