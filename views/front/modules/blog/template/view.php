<?php if(isset($url[1])): ?>
    <?php foreach ($blog->getPostBySlug($url[1], true) as $post): ?>
        <h3 class="title"><?php echo $post['title']; ?></h3>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <?php if($post['show_author']): ?>
                        <div class="mb-2"><i class="fas fa-user-edit"></i> Por: <?php echo $post['author']; ?></div>
                    <?php endif; ?>
                    <?php if($post['show_created']): ?>
                        <div class="mb-2"><i class="fas fa-calendar"></i> <?php echo strftime('%a, %d %b %Y às %H:%Mh', strtotime($post['created'])); ?></div>
                    <?php endif; ?>
                        <div class="mb-2"><i class="fas fa-tag"></i> <a href="<?php echo BASE.'/'. $viewData['slug'].'/categoria/'. $post['category_slug'].'';?>"><?php echo $post['category']; ?></a></div>
                        <div class="mb-2">
                            <button class="btn btn-sm btn-light font-bold" onClick="fontSize('+');">A+</button>
                            <button class="btn btn-sm btn-light font-bold" onClick="fontSize('-');">A-</button>
                        </div>
                </div>
            </div>
        </div>

        <?php if(!empty($post['thumb'])): ?>
            <img class="img-fluid my-4 rounded" src="<?php echo BASE_UPLOADS; ?>/<?php echo $post['thumb']; ?>" alt="<?php $post['title']; ?>" />
        <?php endif; ?>

        <div class="accessibility"><?php echo html_entity_decode($post['body']); ?></div>
        <div class="my-5">
            <h5>Compartilhar:</h5>
            <div class="round-social">
                <a class="btn bg-facebook btn-circle" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(BASE.'/'. $viewData['slug']. '/visualizar/'. $post['slug']); ?>" title="Compartilhar no Facebook" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                <a class="btn bg-twitter btn-circle" href="http://twitter.com/intent/tweet?text=<?php echo urlencode(BASE.'/'. $viewData['slug']. '/visualizar/'. $post['slug']); ?>" title="Compartilhar no Twitter" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-success btn-circle" href="https://web.whatsapp.com/send?text=<?php echo urlencode(BASE.'/'. $viewData['slug']. '/visualizar/'. $post['slug']); ?>" title="Compartilhar no WhatsApp" target="_blank" rel="noopener noreferrer"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>

        <?php if($post['show_comments']): ?>
            <ul class="nav nav-tabs customtab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#comments" role="tab"><i class="fas fa-comments"></i> Comentários</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#comment" role="tab"><i class="fas fa-comment"></i> Comentar</a></a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="comments" role="tabpanel">
                    <div class="pt-4">
                        <h4>Comentários Recentes:</h4>
                        <ul class="list-unstyled with-noborder">
                            <?php foreach ($blog->getComments($post['id']) as $comments): ?>
                                <li class="media">
                                    <img class="d-flex mr-3 img-circle b-all" src="<?php echo BASE_UPLOADS; ?>/users/<?php echo (empty($comments['avatar'])) ? 'blank.jpg' : $comments['avatar']; ?>" width="60">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1"><?php echo $comments['name']; ?></h5> 
                                        <span class="badge mb-2"><?php echo time_elapsed_string(strtotime($comments['created'])); ?></span>
                                        <p><?php echo $comments['comment']; ?></p>
                                        <a data-toggle="collapse" href="#collapse_comment<?php echo $comments['id']; ?>" role="button" aria-expanded="false" aria-controls="collapse_comment">Responder</a>
                                        <div class="collapse" id="collapse_comment<?php echo $comments['id']; ?>">
                                            <div class="card card-body">
                                                <form class="row form-comments-replay" method="post" action="<?php echo BASE; ?>/controller/commentreplay">
                                                    <div class="msg-comment-replay col-md-12"></div>  
                                                    <?php if(!isset($_SESSION['user_id'])): ?>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" name="name" required class="form-control" placeholder="Nome">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="email" name="email" required class="form-control" placeholder="Email">
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="form-group col-md-12">
                                                        <input type="hidden" name="id_post" value="<?php echo $post['id']; ?>">
                                                        <input type="hidden" name="parent_id" value="<?php echo $comments['id']; ?>">
                                                        <textarea class="form-control" rows="5" maxlength="450" name="comment" required placeholder="Comentário (até 450 caracteres)"></textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Responder</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <?php foreach ($blog->getComments($post['id'], $comments['id']) as $commentReplay): ?>
                                            <div class="media mb-0">
                                                <img class="d-flex mr-3 img-circle b-all" src="<?php echo BASE_UPLOADS; ?>/users/<?php echo (empty($commentReplay['avatar'])) ? 'blank.jpg' : $commentReplay['avatar']; ?>" width="60" height="60">
                                                <div class="media-body">
                                                    <h5 class="mt-0"><?php echo $commentReplay['name']; ?></h5> 
                                                    <span class="badge mb-2"><?php echo time_elapsed_string(strtotime($commentReplay['created'])); ?></span>
                                                    <p><?php echo $commentReplay['comment']; ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="tab-pane pt-4" id="comment" role="tabpanel">
                    <h4>Adicionar Comentário</h4>
                    <h6 class="subtitle">Seu endereço de email não será visível</h6>
                    <div id="msg-add-comment"></div>
                    <form class="row" id="form-comments" method="post" action="<?php echo BASE; ?>/controller/commentadd">
                        <?php if(!isset($_SESSION['user_id'])): ?>
                        <div class="form-group col-md-6 m-t-20">
                            <input type="text" name="name" class="form-control" placeholder="Nome">
                        </div>
                        <div class="form-group col-md-6 m-t-20">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                        <?php endif; ?>
                        <div class="form-group col-md-12 m-t-20">
                            <input type="hidden" name="id_post" value="<?php echo $post['id']; ?>">
                            <textarea class="form-control" rows="5" maxlength="450" name="comment" placeholder="Comentário (até 450 caracteres)"></textarea>
                        </div>
                        <div class="form-group col-md-12 m-t-20">
                            <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Comentar</button>
                        </div>
                    </form>
                </div>
            </div>

            <script>

            function fontSize(e) {
                var font = parseInt($(".accessibility").css('font-size'));
                e == '+' ? font++ : font--;
                $(".accessibility").css("fontSize", font);
            }

            $(".form-comments-replay").submit(function (e) {
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: "post",
                    data: data,
                    success: function (response) {
                        try {
                            response = JSON.parse(response);
                            if (response.icon == 'success') {
                                $('.msg-comment-replay').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                            } else {
                                $('.msg-comment-replay').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                            }
                            $('.msg-comment-replay').animate({ scrollTop: 0 }, 500);
                        } catch (e) {
                            $('.msg-comment-replay').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response + '</div>');
                        }
                    }
                });
            });


            $("#form-comments").submit(function (e) {
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    type: "post",
                    data: data,
                    success: function (response) {
                        try {
                            response = JSON.parse(response);
                            if (response.icon == 'success') {
                                $('#msg-add-comment').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                            } else {
                                $('#msg-add-comment').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.text + '</div>');
                            }
                            $('#msg-add-comment').animate({ scrollTop: 0 }, 500);
                        } catch (e) {
                            $('#msg-add-comment').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response + '</div>');
                        }
                    }
                });
            });
            </script>

        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>