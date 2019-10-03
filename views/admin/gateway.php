<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php switch($viewData['action']): case 'config':  ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Formas de Pagamento</h3>
            </div>
        </div>

        <?php 
            if(file_exists('views/admin/gateways/'.$gateways['dir'].'.php')){
                require_once 'views/admin/gateways/'.$gateways['dir'].'.php';
            } 
        ?>

    </div>
</div>
<?php break; ?>
<?php default: ?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Formas de Pagamento</h3>
            </div>
        </div>

        <div class="row">
            <?php foreach ($gateways as $g): ?>
                <div class="col-md-3">
                    <div class="card">
                        <a href="<?php echo BASE_ADMIN.'/gateway/config/'.$g['dir']; ?>">
                            <img class="card-img-top m-t-30 m-b-30 p-l-20 p-r-20" src="<?php echo BASE.'/assets/images/gateway/'.$g['dir'].'.svg';?>" alt="<?php echo $g['displayname']; ?>">
                        </a>
                        <h4 class="card-title text-center"><?php echo $g['displayname']; ?></h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Lateral -->

    </div>
</div>
<?php endswitch;?>