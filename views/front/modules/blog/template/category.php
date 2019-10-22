<?php if(isset($url[1])): ?>
    <?php
        $currentPage = (isset($url[2])) ? $url[2] : 1;
        $resultsPerPage = 20; // Número máximo de postagem que será exibido antes de criar a páginação
        $start = ($resultsPerPage * $currentPage) - $resultsPerPage;
        $totalResults = $blog->getPostsCategoryNumRows($url[1]);
    ?>
    <?php $posts = $blog->getPostByCategory($url[1], $start, $resultsPerPage); if(!empty($posts)): ?>
        <?php foreach ($posts as $post): ?>
            <div class="row m-b-30">
                <?php if(!empty($post['thumb'])): ?>
                    <div class="col-md-4 mb-3">
                        <a href="<?php echo BASE.'/'.$routes['modules']['blog'].'/visualizar/'. $post['slug']; ?>"><img class="img-responsive rounded" src="<?php echo BASE_UPLOADS; ?>/<?php echo $post['thumb']; ?>"></a>
                    </div>
                <?php endif; ?>
                <div class="col-md">
                    <a href="<?php echo BASE.'/'. $routes['modules']['blog']. '/visualizar/'. $post['slug']; ?>">
                        <h5 class="media-heading"><?php echo $post['title']; ?></h5>
                    </a>
                    <ul class="list-inline list-unstyled">
                        <?php if($post['show_created']): ?>
                        <li><small class="text-muted"><i class="fas fa-calendar"></i> <?php echo time_elapsed_string(strtotime($post['created'])); ?></small></li>
                        <li>|</li>
                        <?php endif; ?>
                        <li><small class="text-muted"><i class="fas fa-tag"></i> <?php echo $post['category']; ?></small> </li>
                    </ul>
                    <p><?php echo strlen($post['description']) >= 400 ? substr($post['description'], 0, 400) . '...' : $post['description']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
        <?php 
            $link = BASE.'/'.$routes['modules']['blog'].'/categoria/'. $url[1] . '/';
            pagination($totalResults, $resultsPerPage, $currentPage, $link); 
        ?>
    <?php else: ?>
    <h4>Nenhum postagem encontrada nessa categoria.<h4>
    <?php endif; ?>
<?php endif; ?>