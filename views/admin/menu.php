<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php switch($viewData['action']):  case 'edit': ?>
<div class="page-wrapper">
    <div class="container-fluid">
        
        <div class="d-flex m-b-15">
            <div class="w-100"><h3 class="text-themecolor">Menu</h3></div>
            <div class="flex-shrink-1"><a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick"></span>Editar Menu</h4>
                        <form action="#" method="post" id="form-geek">
                            <div class="form-group m-t-30">
                                <label class="control-label text-left">Nome do Menu:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button id="target" class="btn btn-outline-secondary" data-rows="4" data-cols="5" data-selected-class="btn-info w-100" data-unselected-class="w-100" data-arrow-class="btn-default" data-icon="<?php echo $menus['icon']; ?>" role="iconpicker" data-iconset="fontawesome5" data-search-text="Pesquisar" data-label-footer="{0} - {1} de {2} icones"></button>
                                        <input type="hidden" id="icon" name="icon" value="<?php echo $menus['icon']; ?>">
                                    </div>
                                    <input type="text" class="form-control" name="name" required value="<?php echo $menus['name']; ?>">
                                </div>
                            </div>
                            <div class="form-group m-t-30">
                                <label class="control-label text-left">Legenda:</label>
                                <input type="text" name="caption" class="form-control form-control-line" value="<?php echo $menus['caption']; ?>">
                                <small class="form-control-feedback" id="caption-feedback"></small>
                            </div>
                            <div class="form-group pm-t-30">
                                <label class="control-label text-left">Menu Principal:</label>
                                <select class="selectpicker" name="parent_id" id="parent_id" data-style="custom-select"  data-live-search="true" title="Selecione">
                                    <option value="0" selected>Nenhum</option>
                                    <?php $menu = new Menu(); $menu_array = $menu->getMenu(); foreach ($menu_array as $m): ?>
                                    <?php if($m['id'] != $menus['id']): ?>
                                    <option value="<?php echo $m['id'];?>" <?php getSelected($m['id'], $menus['parent_id']); ?>><?php echo $m['name'];?></option>
                                    <?php endif;?>
                                    <?php endforeach; ?>
                                </select>
                                <small class="form-control-feedback" id="parent_id-feedback"></small>
                            </div>
                            <div class="form-group m-t-30">
                                <label class="control-label text-left">Tipo de Conteúdo:</label>
                                <select class="form-control custom-select" name="content_type" required onchange="checkOptions(this.value);">
                                    <option value="page" <?php getSelected('page', $menus['content_type']); ?>>Página</option>
                                    <option value="web" <?php getSelected('web', $menus['content_type']); ?>>Web</option>
                                </select>
                                <small class="form-control-feedback" id="content_type-feedback"></small>
                            </div>
                            <div class="form-group pm-t-30" id="content_id_page" style="display:none;">
                                <label class="control-label text-left">Página:</label>
                                <select class="selectpicker" name="page_id" id="page_id" data-style="custom-select"  data-live-search="true" title="Selecione">
                                    <?php $p = new Page(); $p = $p->getAllPages(); foreach ($p as $page):?>
                                    <option value="<?php echo $page['id'];?>" <?php getSelected($page['id'], $menus['page_id']); ?>><?php echo $page['title'];?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="form-control-feedback" id="page_id-feedback"></small>
                            </div>
                            <div class="form-group m-t-30" id="content_id_link" style="display:none;">
                                <label class="control-label text-left">Link:</label>
                                <input type="text" name="link" class="form-control form-control-line" value="<?php echo $menus['link']; ?>">
                                <small class="form-control-feedback" id="link-feedback"></small>
                            </div>
                            <div class="form-group m-t-30" id="target_link" style="display:none;">
                                <label class="control-label text-left">Destino do Link:</label>
                                <select class="form-control" name="target">
                                    <option value="_self" <?php getSelected('_self', $menus['target']); ?>>Guia Atual</option>
                                    <option value="_blank" <?php getSelected('_blank', $menus['target']); ?>>Nova Guia</option>
                                </select>
                                <small class="form-control-feedback" id="target-feedback"></small>
                            </div>
                            <div class="row m-t-30">
                                <div class="form-group col-md-6 m-t-10">
                                    <label class="control-label">Página Inicial</label>
                                    <div class="m-t-10">
                                        <input name="home_page" type="radio" id="home_page-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $menus['home_page']); ?> />
                                        <label for="home_page-yes">Sim</label>
                                        <input name="home_page" type="radio" id="home_page-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $menus['home_page']); ?> />
                                        <label for="home_page-no">Não</label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 m-t-10">
                                    <label class="control-label">Publicar Menu</label>
                                    <div class="m-t-10">
                                        <input name="active" type="radio" id="active-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $menus['active']); ?> />
                                        <label for="active-yes">Sim</label>
                                        <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $menus['active']); ?>/>
                                        <label for="active-no">Não</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body text-center">
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar Menu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body geek-help">
                    <h5>Menus</h5>
                    <p>Arraste e solte os itens para mudar suas posições. Clique no icone <i class="fa fa-lg fa-pencil-square-o"></i> do menu correspondente acessar 
        as opções de edição. Clique no ícone <i class="fa fa-lg fa-trash-o"></i> para excluir um item do menu. Clique no botão Salvar Posição para salvar 
        as posições de menu. Nota: A exclusão de menu principal também vai apagar todas os submenus atribuídos ao menu principal que será apagado.</p>
                    <hr>
                    <h5>Legenda do Menu</h5>
                    <p>Legenda ou slogan que acompanha menu atual.</p>
                    <hr>
                    <h5>Menu Principal</h5>
                    <p>Escolha a partir da lista se o menu a ser adicionado será um menu principal ou um submenu. Você pode fitrar os itens digitando palavras correspondentes.</p>
                    <hr>
                    <h5>Tipo de Conteúdo</h5>
                    <p>Você pode criar um link para a página de conteúdo existente ou link externo.</p>
                    <hr>
                    <h5>Conteúdo do Link</h5>
                    <p>Digite a URL completa começando com http://</p>
                    <hr>
                    <h5>Ícone do Menu</h5>
                    <p>Pode atribuir ícones ao seu menu. Clique no ícone para marcar ou desmarcar.</i></p>
                </div>
            </div>
        </div>

    </div>
</div>
<?php break;?>
<?php default: ?>
<div class="page-wrapper">
    <div class="container-fluid">

        <div class="d-flex no-block">
            <div><h3 class="text-themecolor">Menu</h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>

        <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><span class="lstick"></span>Ordenar os Menus</h4>
                            <div class="myadmin-dd-empty dd" id="nestable2">
                                <ol class="dd-list">
                                    <?php 
                                        $menu = new Menu(); 
                                        $menu_array = $menu->getMenu();
                                        echo $menu->menuBuilder($menu_array);
                                    ?>
                                </ol>
                            </div>
                            <div class="card-body text-center">
                                <button type="button" id="save_position" class="m-t-10 btn waves-effect waves-light btn-rounded btn-outline-secondary">Salvar Posição</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><span class="lstick"></span>Adicionar Novo Menu</h4>
                            <form action="#" method="post" id="form-geek">
                                <div class="form-group m-t-30">
                                    <label class="control-label text-left">Nome do Menu:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button id="target" class="btn btn-outline-secondary" data-rows="4" data-cols="5" data-selected-class="btn-info w-100" data-unselected-class="w-100" data-arrow-class="btn-default" data-icon="" role="iconpicker" data-iconset="fontawesome5" data-search-text="Pesquisar" data-label-footer="{0} - {1} de {2} icones"></button>
                                            <input type="hidden" id="icon" name="icon">
                                        </div>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group m-t-30">
                                    <label class="control-label text-left">Legenda:</label>
                                    <input type="text" name="caption" class="form-control form-control-line">
                                    <small class="form-control-feedback" id="caption-feedback"></small>
                                </div>
                                <div class="form-group pm-t-30">
                                    <label class="control-label text-left">Menu Principal:</label>
                                    <select class="selectpicker" name="parent_id" id="parent_id" data-style="custom-select"  data-live-search="true" title="Selecione">
                                        <option value="0" selected>Nenhum</option>
                                        <?php foreach ($menu_array as $m): ?>
                                        <option value="<?php echo $m['id'];?>"><?php echo $m['name'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-control-feedback" id="parent_id-feedback"></small>
                                </div>
                                <div class="form-group m-t-30">
                                    <label class="control-label text-left">Tipo de Conteúdo:</label>
                                    <select class="form-control custom-select" name="content_type" required onchange="checkOptions(this.value);">
                                        <option value="" disabled selected>Selecione o Tipo de Conteúdo</option>
                                        <option value="page">Página</option>
                                        <option value="web">Web</option>
                                    </select>
                                    <small class="form-control-feedback" id="content_type-feedback"></small>
                                </div>
                                <div class="form-group pm-t-30" id="content_id_page" style="display:none;">
                                    <label class="control-label text-left">Página:</label>
                                    <select class="selectpicker" name="page_id" id="page_id" data-style="custom-select"  data-live-search="true" title="Selecione">
                                        <?php $p = new Page(); $p = $p->getAllPages(); foreach ($p as $page):?>
                                        <option value="<?php echo $page['id'];?>"><?php echo $page['title'];?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-control-feedback" id="page_id-feedback"></small>
                                </div>
                                <div class="form-group m-t-30" id="content_id_link" style="display:none;">
                                    <label class="control-label text-left">Link:</label>
                                    <input type="text" name="link" class="form-control form-control-line">
                                    <small class="form-control-feedback" id="link-feedback"></small>
                                </div>
                                <div class="form-group m-t-30" id="target_link" style="display:none;">
                                    <label class="control-label text-left">Destino do Link:</label>
                                    <select class="form-control" name="target">
                                        <option value="_self">Guia Atual</option>
                                        <option value="_blank">Nova Guia</option>
                                    </select>
                                    <small class="form-control-feedback" id="target-feedback"></small>
                                </div>
                                <div class="row m-t-30">
                                    <div class="form-group col-md-6 m-t-10">
                                        <label class="control-label">Página Inicial</label>
                                        <div class="m-t-10">
                                            <input name="home_page" type="radio" id="home_page-yes" class="with-gap radio-col-light-blue" value="1" />
                                            <label for="home_page-yes">Sim</label>
                                            <input name="home_page" type="radio" id="home_page-no" checked class="with-gap radio-col-light-blue" value="0"/>
                                            <label for="home_page-no">Não</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 m-t-10">
                                        <label class="control-label">Publicar Menu</label>
                                        <div class="m-t-10">
                                            <input name="active" type="radio" id="active-yes" checked class="with-gap radio-col-light-blue" value="1" />
                                            <label for="active-yes">Sim</label>
                                            <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0"/>
                                            <label for="active-no">Não</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card-body text-center">
                                    <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Cadastrar Menu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body geek-help">
                    <h5>Menus</h5>
                    <p>Arraste e solte os itens para mudar suas posições. Clique no icone <i class="fa fa-lg fa-pencil-square-o"></i> do menu correspondente acessar 
        as opções de edição. Clique no ícone <i class="fa fa-lg fa-trash-o"></i> para excluir um item do menu. Clique no botão Salvar Posição para salvar 
        as posições de menu. Nota: A exclusão de menu principal também vai apagar todas os submenus atribuídos ao menu principal que será apagado.</p>
                    <hr>
                    <h5>Legenda do Menu</h5>
                    <p>Legenda ou slogan que acompanha menu atual.</p>
                    <hr>
                    <h5>Menu Principal</h5>
                    <p>Escolha a partir da lista se o menu a ser adicionado será um menu principal ou um submenu. Você pode fitrar os itens digitando palavras correspondentes.</p>
                    <hr>
                    <h5>Tipo de Conteúdo</h5>
                    <p>Você pode criar um link para a página de conteúdo existente ou link externo.</p>
                    <hr>
                    <h5>Conteúdo do Link</h5>
                    <p>Digite a URL completa começando com http://</p>
                    <hr>
                    <h5>Ícone do Menu</h5>
                    <p>Pode atribuir ícones ao seu menu. Clique no ícone para marcar ou desmarcar.</i></p>
                </div>
            </div>
        </div>

    </div>
</div>
<?php break; ?>
<?php endswitch;?>

<script>
    window.onload = function() {

        $('#nestable2').nestable({maxDepth: 3});

        $('#target').on('change', function(e) {
            $("#icon").val(e.icon);
        });

        $('#save_position').click(function(){
            var menu_serialize = $('.dd').nestable('serialize');
            $.ajax({
                url: "menu/sort",
                type: "post",
                data: {menu: menu_serialize},
                success: function (response) {
                    response = JSON.parse(response);
                    $.toast({
                        heading: ''+response.heading+'',
                        text: ''+response.text+'',
                        position: 'bottom-right',
                        icon: ''+response.icon+'',
                        hideAfter: 3000, 
                        stack: 6
                    });
                }
            });
        });

    <?php if(isset($menus)){echo "checkOptions('".$menus['content_type']."');";} ?>
    }


    function checkOptions(type_value) {
        if(type_value == 'page'){
            $('#content_id_page').css("display", "block");
            $('#target_link').css("display", "none");
            $('#content_id_link').css("display", "none");
        }else if(type_value == 'web'){
            $('#content_id_page').css("display", "none");
            $('#target_link').css("display", "block");
            $('#content_id_link').css("display", "block");
        }else{
            $('#target_link').css("display", "none");
            $('#content_id_link').css("display", "none");
            $('#content_id_page').css("display", "none");
        }
    }
</script>