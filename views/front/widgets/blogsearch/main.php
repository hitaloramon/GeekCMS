<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>
<form id="form-blog-search">
  <div class="input-group">
    <input type="text" class="form-control" name="busca" id="blogsearch" placeholder="Pesquisar no Blog">
    <div class="input-group-append">
      <button type="submit" id="btn_submit" class="btn btn-info waves-effect waves-light"><i class="fas fa-search"></i></button>
    </div>
  </div>
</form>

<script>
  $("#form-blog-search").submit(function (e) {
      e.preventDefault();
      var search = $('#blogsearch').val();
      var site_url = localStorage.getItem('SITEURL');
      if(search.length >= 1){
        window.location = site_url + '/blog/pesquisa/' + search;
      }
  });
</script>