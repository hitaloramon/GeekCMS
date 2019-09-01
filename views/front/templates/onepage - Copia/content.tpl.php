<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>
<?php
function getContentPluginAssets($string){
    preg_match_all("/{{(.*?)}}/", $string, $matches);
    return ($matches[1]) ? $matches[1] : 0;
  }

?>

<?php require_once "widget_top.tpl.php"; ?>
<?php switch(true): case $widget_left and $widget_right: ?>
<section class="main-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm"><?php include("widget_left.tpl.php");?></div>
            <div class="col-6"><?php echo html_entity_decode($viewData['body']); ?></div>
            <?php $this->renderPage($viewData['type_page']); ?>
            <?php $this->renderModule($viewData['module_name'], $viewData); ?>
            <div class="col-sm"><?php include("widget_right.tpl.php");?></div>
        </div>
    </div>
</section>
<?php break;?>
<?php case $widget_left: ?>
<section class="main-container mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"><?php include("widget_left.tpl.php");?></div>
            <div class="col-md-9"><?php echo html_entity_decode($viewData['body']); ?>
                <?php $this->renderPage($viewData['type_page']); ?>
                <?php $this->renderModule($viewData); ?>
            </div>
        </div>
    </div>
</section>
<?php break;?>
<?php case $widget_right: ?>
<section class="main-container mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <?php echo html_entity_decode($viewData['body']); ?>
                <?php $this->renderPage($viewData['type_page']); ?>
                <?php $this->renderModule($viewData); ?>
            </div>
            <div class="col-md-3"><?php include("widget_right.tpl.php");?></div>
        </div>
    </div>
</section>
<?php break;?>
<?php default: ?>
<section class="main-container mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php echo html_entity_decode($viewData['body']); ?>
                <?php $this->renderPage($viewData['type_page']); ?>
                <?php $this->renderModule($viewData); ?>
            </div>
        </div>
    </div>
</section>
<?php break;?>
<?php endswitch;?>
<?php require_once("widget_bottom.tpl.php");?>