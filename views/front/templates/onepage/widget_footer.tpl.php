<!-- <?php
 if (!defined("_VALID_PHP"))
	 die('Acesso direto negado');
?>
<?php if($widget_footer):?>
<div class="container">
	<div class="row">
		<?php foreach ($widget_footer as $frow): ?>
		<div class="<?php if($frow['space'] != "") echo ' col-md-'.$frow['space'];?>">
		<?php if ($frow['show_title'] == 1):?>
		<div class="h4 m-b-20 m-t-30"><?php echo $frow['title'];?></div>
		<div class="separator"></div>
		<?php endif;?>
		<?php if ($frow['body'] && $frow['show_order'] == 0) echo '<div class="widget-body">'.html_entity_decode($frow['body']).'</div>';?>
		<?php if ($frow['system'] == 1):?>
		<?php $this->renderWidget($frow['widget_alias'], $frow['widget_data'], $viewData); ?>
		<?php endif;?>
		<?php if ($frow['body'] && $frow['show_order'] == 1) echo '<div class="widget-body">'.html_entity_decode($frow['body']).'</div>';?>
		</div>
		<?php unset($frow);?>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?> -->