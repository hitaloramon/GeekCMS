<?php
 if (!defined("_VALID_PHP"))
	 die('Acesso direto negado');
?>

<div class="container-fluid">
	<div class="row">
	<?php if($widget_top):?>
		<?php $is_column = 0;?>
		<?php foreach ($widget_top as $trow): ?>

			<?php 
			if($trow['space'] != 12 && $is_column == 0){
				$is_column = 1;
			}else{
				$is_column = 0;
			}
			?>

			<?php if($trow['container'] == 0 && $trow['space'] != 12): ?>
				<?php if($is_column == 1): ?>
				<div class="container">
					<div class="row">
				<?php endif; ?>
			<?php endif; ?>

			<div class="<?php echo 'col-md-'.$trow['space'];?>">
			<?php if ($trow['show_title'] == 1):?>
			<h4><?php echo $trow['title'];?></h4>
			<?php endif;?>
			<?php if ($trow['body'] && $trow['show_order'] == 0) echo '<div class="widget-body">'.html_entity_decode($trow['body']).'</div>';?>
			<?php if ($trow['system'] == 1): ?>
			<?php $this->renderWidget($trow['widget_alias'], $trow['widget_data'], $viewData); ?>
			<?php endif;?>
			<?php if ($trow['body'] && $trow['show_order'] == 1) echo '<div class="widget-body">'.html_entity_decode($trow['body']).'</div>';?>
			</div>

			<?php if($trow['container'] == 0 && $trow['space'] != 12): ?>
				<?php if($is_column == 0): ?>
					</div> <!-- fechamento do row -->
				</div> <!-- fechamento do container -->
				<?php endif; ?>
			<?php endif; ?>
			

		<?php unset($trow);?>
		<?php endforeach; ?>
	<?php endif; ?>
	</div>
</div>
