<?php switch($viewData['mod_action']): ?>
<?php case 'addpost': ?>
<div class="page-wrapper">
    <div class="container-fluid">
        
        <div class="d-flex no-block">
           <div><h3 class="text-themecolor"><a href="<?php echo BASE_ADMIN; ?>/module/view/blog">Blog</a></h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Adicionar Postagem</h4>
                            </div>
                        </div>

                        <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Título</label>
                                        <input type="text" id="title" name="title" required class="form-control">
                                        <small class="form-control-feedback" id="title-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">URL Amigável</label>
                                        <input type="text" id="slug" name="slug" class="form-control">
                                        <small class="form-control-feedback" id="slug-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Categoria</label>
                                        <select class="form-control custom-select" id="category_id" name="category_id" required>
                                            <?php foreach ($category as $cat): ?>
                                                <option value="<?php echo $cat['id']?>"><?php echo $cat['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-control-feedback" id="category_id-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Plano de Acesso</label>
                                        <select class="selectpicker" name="membership_id[]" id="membership_id" multiple data-style="form-control custom-select" title="Selecione">
                                            <?php $m = new Memberships(); $m = $m->getMemberships(); foreach ($m as $membership):?>
                                            <option value="<?php echo $membership['id'];?>"><?php echo $membership['title'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-control-feedback" id="membership_id-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Agendar de Publicação</label>
                                        <input type="datetime-local" id="created" name="created" class="form-control">
                                        <small class="form-control-feedback" id="created-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Imagem</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="thumb" name="thumb">
                                            <span class="input-group-append">
                                                <button onclick="javascript:open_popup('<?php echo BASE; ?>/libs/filemanager/dialog.php?type=1&popup=1&field_id=thumb&relative_url=1')" class="btn btn-secondary" type="button"><i class="mdi mdi-folder"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Resumo</label>
                                        <textarea class="form-control" name="description" required id="description" rows="2"></textarea>
                                        <small class="form-control-feedback" id="description-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Palavras Chave (SEO)</label>
                                        <div class="tags-default">
                                            <input type="text" name="keywords" id="keywords" data-role="tagsinput" />
                                        </div>
                                        <small class="form-control-feedback" id="keywords-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-t-10">
                                        <label class="control-label">Mostrar Autor</label>
                                        <div class="m-t-10">
                                            <input name="show_author" type="radio" id="show_author-yes" class="with-gap radio-col-light-blue" value="1" checked />
                                            <label for="show_author-yes">Sim</label>
                                            <input name="show_author" type="radio" id="show_author-no" class="with-gap radio-col-light-blue" value="0" />
                                            <label for="show_author-no">Não</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-t-10">
                                        <label class="control-label">Mostrar Comentários</label>
                                        <div class="m-t-10">
                                            <input name="show_comments" type="radio" id="show_comments-yes" class="with-gap radio-col-light-blue" value="1" checked />
                                            <label for="show_comments-yes">Sim</label>
                                            <input name="show_comments" type="radio" id="show_comments-no" class="with-gap radio-col-light-blue" value="0" />
                                            <label for="show_comments-no">Não</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-t-10">
                                        <label class="control-label">Mostrar Data de Criação</label>
                                        <div class="m-t-10">
                                            <input name="show_created" type="radio" id="show_created-yes" class="with-gap radio-col-light-blue" value="1" checked />
                                            <label for="show_created-yes">Sim</label>
                                            <input name="show_created" type="radio" id="show_created-no" class="with-gap radio-col-light-blue" value="0" />
                                            <label for="show_created-no">Não</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-t-10">
                                        <label class="control-label">Publicar</label>
                                        <div class="m-t-10">
                                            <input name="active" type="radio" id="active-yes" class="with-gap radio-col-light-blue" value="1" checked />
                                            <label for="active-yes">Sim</label>
                                            <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0" />
                                            <label for="active-no">Não</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="geekfull" class="col-md-12 m-t-20" style="height:500px">
                                    <div class="d-flex no-block">
                                        <div><h5>Conteúdo</h5></div>
                                        <div class="ml-auto">
                                            <a class="nav-link" href="#" onclick="requestFullScreen('#geekfull')"><i class="mdi mdi-fullscreen"></i></a>
                                        </div>
                                    </div>
                                    <div id="geekeditor" data-fieldname="body"></div>
                                    <small class="form-control-feedback" id="body-feedback"></small>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar Postagem</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php break; ?>
<?php case 'editpost': ?>
<div class="page-wrapper">
    <div class="container-fluid">
        
        <div class="d-flex no-block">
           <div><h3 class="text-themecolor"><a href="<?php echo BASE_ADMIN; ?>/module/view/blog">Blog</a></h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Editar Postagem</h4>
                            </div>
                        </div>

                        <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Título</label>
                                        <input type="text" id="title" name="title" required class="form-control" value="<?php echo $blog['title']; ?>">
                                        <small class="form-control-feedback" id="title-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">URL Amigável</label>
                                        <input type="text" id="slug" name="slug" class="form-control" value="<?php echo $blog['slug']; ?>">
                                        <small class="form-control-feedback" id="slug-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Categoria</label>
                                        <select class="form-control custom-select" id="category_id" name="category_id" required>
                                            <?php foreach ($category as $cat): ?>
                                                <option value="<?php echo $cat['id']; ?>" <?php getSelected($cat['id'], $blog['category_id']); ?>><?php echo $cat['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-control-feedback" id="category_id-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Plano de Acesso</label>
                                        <select class="selectpicker" name="membership_id[]" id="membership_id" multiple data-style="form-control custom-select" title="Selecione">
                                            <?php $m = new Memberships(); $m = $m->getMemberships(); foreach ($m as $membership):?>
                                                <option value="<?php echo $membership['id'];?>" <?php getSelected($membership['id'], $blog['membership_id']); ?>><?php echo $membership['title'];?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-control-feedback" id="membership_id-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Agendar de Publicação</label>
                                        <input type="datetime-local" id="created" name="created" class="form-control" value="<?php echo date("Y-m-d\TH:i:s", strtotime($blog['created'])); ?>">
                                        <small class="form-control-feedback" id="created-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Imagem</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="thumb" name="thumb" value="<?php echo $blog['thumb']; ?>">
                                            <span class="input-group-append">
                                                <button onclick="javascript:open_popup('<?php echo BASE; ?>/libs/filemanager/dialog.php?type=1&popup=1&field_id=thumb&relative_url=1')" class="btn btn-secondary" type="button"><i class="mdi mdi-folder"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Resumo</label>
                                        <textarea class="form-control" name="description" required id="description" rows="2"><?php echo $blog['description']; ?></textarea>
                                        <small class="form-control-feedback" id="description-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Palavras Chave (SEO)</label>
                                        <div class="tags-default">
                                            <input type="text" name="keywords" id="keywords" data-role="tagsinput" value="<?php echo $blog['keywords']; ?>" />
                                        </div>
                                        <small class="form-control-feedback" id="keywords-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-t-10">
                                        <label class="control-label">Mostrar Autor</label>
                                        <div class="m-t-10">
                                            <input name="show_author" type="radio" id="show_author-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $blog['show_author']); ?> />
                                            <label for="show_author-yes">Sim</label>
                                            <input name="show_author" type="radio" id="show_author-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $blog['show_author']); ?> />
                                            <label for="show_author-no">Não</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-t-10">
                                        <label class="control-label">Mostrar Comentários</label>
                                        <div class="m-t-10">
                                            <input name="show_comments" type="radio" id="show_comments-yes" class="with-gap radio-col-light-blue" value="1"  <?php getChecked('1', $blog['show_comments']); ?> />
                                            <label for="show_comments-yes">Sim</label>
                                            <input name="show_comments" type="radio" id="show_comments-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $blog['show_comments']); ?> />
                                            <label for="show_comments-no">Não</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-t-10">
                                        <label class="control-label">Mostrar Data de Criação</label>
                                        <div class="m-t-10">
                                            <input name="show_created" type="radio" id="show_created-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $blog['show_created']); ?> />
                                            <label for="show_created-yes">Sim</label>
                                            <input name="show_created" type="radio" id="show_created-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $blog['show_created']); ?> />
                                            <label for="show_created-no">Não</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group m-t-10">
                                        <label class="control-label">Publicar</label>
                                        <div class="m-t-10">
                                            <input name="active" type="radio" id="active-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $blog['active']); ?> />
                                            <label for="active-yes">Sim</label>
                                            <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $blog['active']); ?> />
                                            <label for="active-no">Não</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="geekfull" class="col-md-12 m-t-20" style="height:500px">
                                    <div class="d-flex no-block">
                                        <div><h5>Conteúdo</h5></div>
                                        <div class="ml-auto">
                                            <a class="nav-link" href="#" onclick="requestFullScreen('#geekfull')"><i class="mdi mdi-fullscreen"></i></a>
                                        </div>
                                    </div>
                                    <div id="geekeditor" data-fieldname="body"><?php echo html_entity_decode($blog['body']); ?></div>
                                    <small class="form-control-feedback" id="body-feedback"></small>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar Postagem</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php break; ?>
<?php case 'addcat': ?>
<div class="page-wrapper">
    <div class="container-fluid">
        
        <div class="d-flex no-block m-b-15">
            <div><h3 class="text-themecolor"><a href="<?php echo BASE_ADMIN; ?>/module/view/blog">Blog</a></h3></div>
        </div>
        
        <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><span class="lstick"></span>Categorias</h4>
                            <div class="myadmin-dd-empty dd" id="nestable2">
                                <ol class="dd-list">
                                    <?php  $blog = new ModBlog();foreach ($blog->getAllCategories() as $cat): ?>
                                        <li class="dd-item dd3-item">
                                            <div class="dd3-content">
                                                <div class="d-flex no-block">
                                                    <div><i class="<?php echo $cat['icon']; ?>"></i> <?php echo $cat['name']; ?></div>
                                                    <div class="ml-auto">
                                                        <a href="<?php echo BASE_ADMIN; ?>/module/view/blog/editcat/<?php echo $cat['id']; ?>" class="m-r-10"><i class="mdi mdi-pencil"></i></a>
                                                        <a onclick="deleteRedirect(`<?php echo BASE_ADMIN; ?>/module/view/blog/deletecat/<?php echo $cat['id']; ?>`);"><i class="fa fa-times text-danger"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><span class="lstick"></span>Adicionar Nova Categoria</h4>
                            <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label text-left">Nome da Categoria:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="target" class="btn btn-outline-secondary" data-rows="4" data-cols="5" data-selected-class="btn-info w-100" data-unselected-class="w-100" data-arrow-class="btn-default" data-icon="" role="iconpicker" data-iconset="fontawesome5" data-search-text="Pesquisar" data-label-footer="{0} - {1} de {2} icones"></button>
                                                <input type="hidden" id="icon" name="icon">
                                            </div>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Exibir</label>
                                        <select class="form-control custom-select" id="active" name="active">
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                        <small class="form-control-feedback" id="active-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">URL Amigável</label>
                                        <input type="text" id="slug" name="slug" class="form-control">
                                        <small class="form-control-feedback" id="slug-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar Categoria</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
<?php break; ?>
<?php case 'editcat': ?>
<div class="page-wrapper">
    <div class="container-fluid">
        
        <div class="d-flex no-block m-b-15">
            <div><h3 class="text-themecolor"><a href="<?php echo BASE_ADMIN; ?>/module/view/blog">Blog</a></h3></div>
        </div>
        
        <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><span class="lstick"></span>Categorias</h4>
                            <div class="myadmin-dd-empty dd" id="nestable2">
                                <ol class="dd-list">
                                    <?php  $blog = new ModBlog();foreach ($blog->getAllCategories() as $cat): ?>
                                        <li class="dd-item dd3-item">
                                            <div class="dd3-content">
                                                <div class="d-flex no-block">
                                                    <div><i class="<?php echo $cat['icon']; ?>"></i> <?php echo $cat['name']; ?></div>
                                                    <div class="ml-auto">
                                                        <a href="<?php echo BASE_ADMIN; ?>/module/view/blog/editcat/<?php echo $cat['id']; ?>" class="m-r-10"><i class="mdi mdi-pencil"></i></a>
                                                        <a onclick="deleteRedirect(`<?php echo BASE_ADMIN; ?>/module/view/blog/deletecat/<?php echo $cat['id']; ?>`);"><i class="fa fa-times text-danger"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><span class="lstick"></span>Editar Categoria</h4>
                            <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label text-left">Nome da Categoria:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button id="target" class="btn btn-outline-secondary" data-rows="4" data-cols="5" data-selected-class="btn-info w-100" data-unselected-class="w-100" data-arrow-class="btn-default" data-icon="<?php echo $category['icon']; ?>" role="iconpicker" data-iconset="fontawesome5" data-search-text="Pesquisar" data-label-footer="{0} - {1} de {2} icones"></button>
                                                <input type="hidden" id="icon" name="icon" value="<?php echo $category['icon']; ?>">
                                            </div>
                                            <input type="text" class="form-control" name="name" required value="<?php echo $category['name']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Exibir</label>
                                        <select class="form-control custom-select" id="active" name="active">
                                            <option value="1" <?php getSelected(1, $category['active']); ?>>Sim</option>
                                            <option value="0" <?php getSelected(0, $category['active']); ?>>Não</option>
                                        </select>
                                        <small class="form-control-feedback" id="active-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">URL Amigável</label>
                                        <input type="text" id="slug" name="slug" class="form-control" value="<?php echo $category['slug']; ?>">
                                        <small class="form-control-feedback" id="slug-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <div class="card-body text-center">
                                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar Categoria</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
<?php break; ?>
<?php case 'comments': ?>
<div class="page-wrapper">
    <div class="container-fluid">
        
        <div class="d-flex no-block">
            <div><h3 class="text-themecolor"><a href="<?php echo BASE_ADMIN; ?>/module/view/blog">Blog</a></h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div id="toolbar">
                                <h4 class="card-title">Comentários</h4>
                            </div>
                            <div class="table-responsive p-10">
                                <table id="table" data-toggle="table" data-url="<?php echo BASE_ADMIN;?>/module/view/blog/commentsdata" data-show-refresh="true" data-show-columns="true" data-toolbar="#toolbar" data-advanced-search="true" data-pagination="true" data-mobile-responsive="true" data-search="true" class="table display table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th data-field="id" data-visible="false" data-sortable="true" data-width="50px">ID</th>
                                            <th data-field="avatar" data-sortable="true" data-width="60px" data-formatter="avatarFormatter" data-align="center">Avatar</th>
                                            <th data-field="name" data-sortable="true" data-width="150px" data-align="center">Nome</th>
                                            <th data-field="comment" data-sortable="true">Comentário</th>
                                            <th data-field="created" data-formatter="dateFormatter" data-sortable="true" data-width="100px" data-align="center">Criada em</th>
                                            <th data-field="status" data-formatter="activeBlogFormatter" data-sortable="true" data-width="100px" data-align="center">Status</th>
                                            <th data-formatter="actionCommentsFormatter" data-align="center" data-width="80px">Ações</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div> <!--table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php break; ?>
<?php default: ?>
<div class="page-wrapper">
    <div class="container-fluid">
        
        <div class="d-flex no-block">
            <div><h3 class="text-themecolor"><a href="<?php echo BASE_ADMIN; ?>/module">Módulos</a></h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div><h4 class="card-title"><span class="lstick"></span>Blog</h4></div>
                            <div class="ml-auto">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-rounded btn-block btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ações</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo BASE_ADMIN; ?>/module/view/blog/addpost">Adicionar Postagem</a>
                                        <a class="dropdown-item" href="<?php echo BASE_ADMIN; ?>/module/view/blog/addcat">Categorias</a>
                                        <a class="dropdown-item" href="<?php echo BASE_ADMIN; ?>/module/view/blog/comments">Comentários</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive p-10">
                                <table id="table" data-toggle="table" data-url="<?php echo BASE_ADMIN;?>/module/view/blog/datatable" data-show-refresh="true" data-show-columns="true" data-toolbar="#toolbar" data-advanced-search="true" data-pagination="true" data-mobile-responsive="true" data-search="true" class="table display table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th data-field="id" data-sortable="true" data-width="50px">ID</th>
                                            <th data-field="title" data-sortable="true">Título</th>
                                            <th data-field="category" data-sortable="true" data-width="150px" data-align="center">Categoria</th>
                                            <th data-field="fname" data-sortable="true" data-width="150px" data-align="center">Autor</th>
                                            <th data-field="created" data-formatter="dateFormatter" data-sortable="true" data-width="100px" data-align="center">Criada em</th>
                                            <th data-field="active" data-formatter="activeBlogFormatter" data-sortable="true" data-width="100px" data-align="center">Status</th>
                                            <th data-formatter="actionBlogFormatter" data-align="center" data-width="80px">Ações</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div> <!--table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php break; ?>
<?php endswitch;?>

<script>
window.onload = function() {
    $('#target').on('change', function(e) {
        $("#icon").val(e.icon);
    });
}

function activeBlogFormatter(value, row){
    if(value == 1){
        return '<span class="label label-success label-rounded">Publicado</span>';
    }else{
        return '<span class="label label-warning label-rounded">Pendente</span>';
    }
}

function avatarFormatter(value, row){
    return '<img class="img-circle b-all" width="60px" src="<?php echo BASE_UPLOADS; ?>/users/'+value+'">';
}

function actionBlogFormatter(value, row) {
    var btn = '';
    btn += '<a href="<?php echo BASE_ADMIN; ?>/module/view/blog/editpost/'+row['id']+'" data-toggle="tooltip" data-original-title="Editar"> <i class="mdi mdi-pencil m-r-10"></i></a>';
    btn += '<a href="#" onclick="deleteInfo(this, `<?php echo BASE_ADMIN; ?>/module/view/blog/delete/'+row['id']+'`);" data-toggle="tooltip" data-original-title="Excluir"> <i class="mdi mdi-delete text-danger m-r-10"></i></a>';
   return btn;
}

function actionCommentsFormatter(value, row) {
    var btn = '';
    btn += `<a href="#" onclick="msgInfo(this, 'Aprovar Comentário', 'Deseja aprovar esse comentário?', 'blue', '<?php echo BASE_ADMIN; ?>/module/view/blog/approvecomment/`+row['id']+`');" data-toggle="tooltip" data-original-title="Aprovar"> <i class="fas fa-check m-r-10"></i></a>`;
    btn += '<a href="#" onclick="deleteInfo(this, `<?php echo BASE_ADMIN; ?>/module/view/blog/deletecomment/'+row['id']+'`);" data-toggle="tooltip" data-original-title="Excluir"> <i class="mdi mdi-delete text-danger m-r-10"></i></a>';
   return btn;
}

function dateFormatter(value, row) {
   return mysqlDate(value);
}

</script>