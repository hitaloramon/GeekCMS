<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php 
    $p = new Page;

    $widget_result = $p->getWidgetLayoutFront($viewData['slug'], true);

    $widget_top = $p->countPlace($widget_result, 'top');
    $widget_left = $p->countPlace($widget_result, 'left');
    $widget_right = $p->countPlace($widget_result, 'right');
    $widget_bottom = $p->countPlace($widget_result, 'bottom');
		$widget_footer= $p->countPlace($widget_result, 'footer');
		
?>
<?php require_once 'header.tpl.php'; ?>
<?php
	switch ($viewData['access']) {
		case "1": // Publico
			require_once 'content.tpl.php';
		break;
		case "2": // Registrado
			if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != null):
				require_once 'content.tpl.php';
			else:
				echo '<div class="main-container m-3">
								<div class="container m-t-40 m-b-40">
									<div class="alert alert-warning alert-dismissable fadeIn">
										Você precisa está logado para visualizar essa página. <a href="'.BASE.'/'.$this->config['page_login'].'">Clique Aqui</a> para ir para página de login.
									</div>
								</div>
							</div>';
			endif;
		break;
		case "3": // Membro Associado
			if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != null):
				$membership_array = explode(",", $viewData['membership_id']);
				$u = new User();

				if($u->validateMembership($membership_array) == true || $u->isAdmin() == true){
					require_once 'content.tpl.php';
				}else{
					echo '<div class="main-container m-3">
							<div class="container m-t-40 m-b-40">
								<div class="alert alert-warning alert-dismissable fadeIn">
									Você precisa ter um plano de acesso válido para acessar essa página. Clique Aqui para ir para página de planos.
								</div>
							</div>
						  </div>';
				}
			else:
				echo '<div class="main-container m-3">
						<div class="container m-t-40 m-b-40">
							<div class="alert alert-warning alert-dismissable fadeIn">
								Você precisa está logado para visualizar essa página. <a href="'.BASE.'/'.$this->config['page_login'].'">Clique Aqui</a> para ir para página de login.
							</div>
						</div>
					  </div>';
			endif;
		break;
	}
?>
<?php require_once 'footer.tpl.php'; ?>