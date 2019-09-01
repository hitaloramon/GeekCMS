<?php
 if (!defined("_VALID_PHP"))
	 die('Acesso direto negado');
?>
<?php if($widget_top):?>
	<?php foreach ($widget_top as $trow): ?>
		<?php if($trow['container'] == false): ?>
			<div class="container">
			<?php endif;?>
				<div class="row">
					<div class="sidebar <?php if($trow['space'] != "") echo ' col-md-'.$trow['space'];?>">
					<?php if ($trow['show_title'] == 1):?>
					<h4><?php echo $trow['title'];?></h4>
					<div class="separator"></div>
					<?php endif;?>
					<?php if ($trow['body'] && $trow['show_order'] == 0) echo '<div class="widget-body">'.html_entity_decode($trow['body']).'</div>';?>
					<?php if ($trow['system'] == 1): ?>
					<?php $this->renderWidget($trow['widget_alias'], $trow['widget_data'], $viewData); ?>
					<?php endif;?>
					<?php if ($trow['body'] && $trow['show_order'] == 1) echo '<div class="widget-body">'.html_entity_decode($trow['body']).'</div>';?>
					</div>
				</div>
			<?php if($trow['container'] == false): ?>
			</div>
		<?php endif;?>
	<?php unset($trow);?>
	<?php endforeach; ?>
<?php endif; ?>