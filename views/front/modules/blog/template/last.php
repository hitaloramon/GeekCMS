<?php 
    $currentPage = (isset($url[0])) ? $url[0] : 1;
    $resultsPerPage = 20; // Número máximo de postagem que será exibido antes de criar a páginação
    $start = ($resultsPerPage * $currentPage) - $resultsPerPage;
    $totalResults = $blog->getPostsNumRows();
?>

<?php foreach ($blog->getPosts($start, $resultsPerPage) as $post): ?>
    <div class="row m-b-30">
        <?php if(!empty($post['thumb'])): ?>
            <div class="col-md-4 mb-3">
                <a href="<?php echo BASE.'/'. $viewData['slug']. '/visualizar/'. $post['slug']; ?>">
                    <img class="img-responsive rounded" src="<?php echo BASE_UPLOADS; ?>/<?php echo $post['thumb']; ?>" alt="<?php echo $post['title']; ?>">
                </a>
            </div>
        <?php endif; ?>
        <div class="col-md">
            <a href="<?php echo BASE.'/'. $viewData['slug']. '/visualizar/'. $post['slug']; ?>">
                <h5 class="media-heading"><?php echo $post['title']; ?></h5>
            </a>
            <ul class="list-inline list-unstyled">
                <li><small class="text-muted"><i class="fas fa-calendar"></i> <?php echo time_elapsed_string(strtotime($post['created'])); ?></small></li>
                <li>|</li>
                <li><small class="text-muted"><i class="fas fa-tag"></i> <a href="<?php echo BASE.'/'. $viewData['slug'].'/categoria/'. $post['category_slug'].'';?>"><?php echo $post['category']; ?></a></small> </li>
            </ul>
            <p><?php echo strlen($post['description']) >= 400 ? substr($post['description'], 0, 400) . '...' : $post['description']; ?></p>
        </div>
    </div>
<?php endforeach; ?>

<?php 
    $link = BASE.'/'. $viewData['slug'].'/';
    pagination($totalResults, $resultsPerPage, $currentPage, $link); 
?>