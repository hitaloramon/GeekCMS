<?php
 if (!defined("_VALID_PHP"))
	 die('Acesso direto negado');
?>
<?php if($widget_left):?>
	<?php foreach ($widget_left as $lrow): ?>
		<div class="row mb-5">
			<div class="sidebar <?php if($lrow['space'] != "") echo ' col-md-'.$lrow['space'];?>">
			<?php if ($lrow['show_title'] == 1):?>
			<h4><?php echo $lrow['title'];?></h4>
			<div class="separator"></div>
			<?php endif;?>
			<?php if ($lrow['body'] && $lrow['show_order'] == 0) echo '<div class="widget-body">'.html_entity_decode($lrow['body']).'</div>';?>
			<?php if ($lrow['system'] == 1):?>
			<?php $this->renderWidget($lrow['widget_alias'], $lrow['widget_data'], $viewData); ?>
			<?php endif;?>
			<?php if ($lrow['body'] && $lrow['show_order'] == 1) echo '<div class="widget-body">'.html_entity_decode($lrow['body']).'</div>';?>
			</div>
		</div>
		<?php unset($lrow);?>
	<?php endforeach; ?>
<?php endif; ?>