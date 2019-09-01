<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>

<div class="container">
  <?php if(isset($_GET['busca']) && !empty($_GET['busca']) && strlen($_GET['busca']) > 3): ?>
    <?php 
      $validator = new Gump('pt-br');
      $_GET = $validator->sanitize($_GET);
      $_GET = $validator->filter($_GET, ['busca' => 'trim|sanitize_string']);
      $validator->xss_clean($_GET);
  
      $page = new Page();
      $search = $page->pageSearch($_GET['busca']);
      if(is_array($search)):
        echo '<h3 class="page-title m-t-40 m-b-40">Resultados da busca para: "'.$_GET['busca'].'"</h3>Total de Resultados: ';
        echo count($search);
        foreach ($search as $s): 
    ?>
          <h4 class="title"><a href="<?php echo BASE .'/'. $s['slug']; ?>"><?php echo $s['title']; ?></a></h4>
          <?php 
            $body = strip_tags(html_entity_decode($s['body']));
            echo strlen($body) >= 400 ? substr($body, 0, 390) . '<a href="'.BASE .'/'. $s['slug'].'"> [Leia Mais]</a>' : $body;
          ?>
          <hr>
    <?php endforeach; ?> 
    <?php endif; ?>
  <?php else: ?>
    <div class="m-t-40 m-b-40">
      <form id="form-search">
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-search"></i></div>
          </div>
          <input type="text" class="form-control" name="busca" id="search" placeholder="Digite palavras chaves para pesquisar">
          <div class="input-group-append">
            <button type="submit" id="btn_submit" class="btn btn-info waves-effect waves-light">Pesquisar</button>
          </div>
        </div>
      </form>
    </div>
  <?php endif; ?>
</div>