<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>
<?php
  $blog = new ModBlog();
  $popular = $blog->getPopular();
  $count = 1;
?>

<?php foreach ($popular as $pop): ?>
<div class="media m-t-20">
  <h1 class="m-r-20"><?php echo $count++; ?>.</h1>
  <div class="media-body">
    <h6 class="mt-0"><a class="text-muted" href="<?php echo BASE.'/'. $pop['slugblog']. '/visualizar/'. $pop['slug']; ?>"><?php echo $pop['title']; ?></a></h6>
  </div>
</div>
<?php endforeach; ?>