<?php
 if (!defined("_VALID_PHP"))
	 die('Acesso Direto Negado');
?>
<?php if($widget_bottom):?>
	<?php foreach ($widget_bottom as $brow): ?>
		<?php if($brow['container'] == false): ?>
			<div class="container">
			<?php endif;?>
				<div class="row">
					<div class="sidebar <?php if($brow['space'] != "") echo ' col-md-'.$brow['space'];?>">
					<?php if ($brow['show_title'] == 1):?>
					<h4><?php echo $brow['title'];?></h4>
					<div class="separator"></div>
					<?php endif;?>
					<?php if ($brow['body'] && $brow['show_order'] == 0) echo '<div class="widget-body">'.html_entity_decode($brow['body']).'</div>';?>
					<?php if ($brow['system'] == 1): ?>
					<?php $this->renderWidget($brow['widget_alias'], $brow['widget_data'], $viewData); ?>
					<?php endif;?>
					<?php if ($brow['body'] && $brow['show_order'] == 1) echo '<div class="widget-body">'.html_entity_decode($brow['body']).'</div>';?>
					</div>
				</div>
			<?php if($brow['container'] == false): ?>
			</div>
		<?php endif;?>
	<?php unset($brow);?>
	<?php endforeach; ?>
<?php endif; ?>