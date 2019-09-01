<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>

<section class="main-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php echo $body; ?>
                <?php $this->renderModule($viewData); ?>
            </div>
        </div>
    </div>
</section>