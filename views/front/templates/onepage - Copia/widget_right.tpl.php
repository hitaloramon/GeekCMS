<?php
 if (!defined("_VALID_PHP"))
	 die('Acesso direto negado');
?>
<?php if($widget_right):?>
	<?php foreach ($widget_right as $rrow): ?>
		<div class="row mb-5">
			<div class="sidebar <?php if($rrow['space'] != "") echo ' col-md-'.$rrow['space'];?>">
			<?php if ($rrow['show_title'] == 1):?>
			<h4><?php echo $rrow['title'];?></h4>
			<div class="separator"></div>
			<?php endif;?>
			<?php if ($rrow['body'] && $rrow['show_order'] == 0) echo '<div class="widget-body">'.html_entity_decode($rrow['body']).'</div>';?>
			<?php if ($rrow['system'] == 1):?>
				<?php $this->renderWidget($rrow['widget_alias'], $rrow['widget_data'], $viewData); ?>
			<?php endif;?>
			<?php if ($rrow['body'] && $rrow['show_order'] == 1) echo '<div class="widget-body">'.html_entity_decode($rrow['body']).'</div>';?>
			</div>
		</div>
		<?php unset($rrow);?>
	<?php endforeach; ?>
<?php endif; ?>