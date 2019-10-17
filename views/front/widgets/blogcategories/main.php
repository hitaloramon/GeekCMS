<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>
<?php
  $routes = new Routes();
  $routes = $routes->getRoutes();
  $blog = new ModBlog();
  $categories = $blog->getCategories();
?>

<ul class="list-icons mt-3">
<?php foreach ($categories as $cat): ?>
    <?php 
      $url = explode('index.php', $_SERVER['PHP_SELF']); 
      $url = explode('/', $url[1]); 
    ?>
    <li class="b-b">
      <a <?php echo (isset($url[2]) && $url[2] == 'categoria' && isset($url[3]) && $url[3] == $cat['slug']) ? 'class="text-primary"': ''; ?> href="<?php echo BASE .'/'. $routes['blog'] .'/categoria/'. $cat['slug'];?>">
        <i class="<?php echo $cat['icon']; ?>"></i> <?php echo $cat['name']; ?>
      </a>
    </li>
<?php endforeach; ?>
</ul>