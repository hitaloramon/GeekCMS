<h3 class="mb-4">Resultados para: <?= $url[1]; ?></h3>
<?php foreach ($blog->searchPost($url[1]) as $post): ?>
    <div class="row m-b-30">
        <?php if(!empty($post['thumb'])): ?>
            <div class="col-md-4 m-b-30">
                <a href="<?php echo BASE.'/'. $routes['blog']. '/visualizar/'. $post['slug']; ?>">
                    <img class="img-responsive rounded" src="<?php echo BASE_UPLOADS; ?>/<?php echo $post['thumb']; ?>" alt="<?php echo $post['title']; ?>">
                </a>
            </div>
        <?php endif; ?>
        <div class="col-md">
            <a href="<?php echo BASE.'/'. $routes['blog']. '/visualizar/'. $post['slug']; ?>">
                <h5 class="media-heading"><?php echo $post['title']; ?></h5>
            </a>
            <ul class="list-inline list-unstyled">
                <li><small class="text-muted"><i class="fas fa-calendar"></i> <?php echo time_elapsed_string(strtotime($post['created'])); ?></small></li>
                <li>|</li>
                <li><small class="text-muted"><i class="fas fa-tag"></i> <?php echo $post['category']; ?></small> </li>
            </ul>
            <p><?php echo strlen($post['description']) >= 400 ? substr($post['description'], 0, 400) . '...' : $post['description']; ?></p>
        </div>
    </div>
<?php endforeach; ?>