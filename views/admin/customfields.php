<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php switch($viewData['action']): case 'edit': ?>
<div class="d-flex no-block m-b-15">
    <div><h3 class="text-themecolor">Campos Personalizados</h3></div>
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
                        <h4 class="card-title"><span class="lstick"></span>Editar Campos Personalizados</h4>
                    </div>
                </div>
            
                <form action="#" method="post" id="form-geek">
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Título do Campo</label>
                                <input type="text" id="title" name="title" required class="form-control" value="<?php echo $fields['title']; ?>">
                                <small class="form-control-feedback" id="title-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome Único do Campo</label>
                                <input type="text" id="name" name="name" class="form-control" value="<?php echo $fields['name']; ?>">
                                <small class="form-control-feedback" id="name-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Colunas</label>
                                <select class="form-control custom-select" id="col" name="col">
                                    <option value="1" <?php getSelected(1, $fields['col']); ?>>1 Coluna</option>
                                    <option value="2" <?php getSelected(2, $fields['col']); ?>>2 Colunas</option>
                                    <option value="3" <?php getSelected(3, $fields['col']); ?>>3 Colunas</option>
                                    <option value="4" <?php getSelected(4, $fields['col']); ?>>4 Colunas</option>
                                    <option value="5" <?php getSelected(5, $fields['col']); ?>>5 Colunas</option>
                                    <option value="6" <?php getSelected(6, $fields['col']); ?>>6 Colunas</option>
                                    <option value="7" <?php getSelected(7, $fields['col']); ?>>7 Colunas</option>
                                    <option value="8" <?php getSelected(8, $fields['col']); ?>>8 Colunas</option>
                                    <option value="9" <?php getSelected(9, $fields['col']); ?>>9 Colunas</option>
                                    <option value="10" <?php getSelected(10, $fields['col']); ?>>10 Colunas</option>
                                    <option value="11" <?php getSelected(11, $fields['col']); ?>>11 Colunas</option>
                                    <option value="12" <?php getSelected(12, $fields['col']); ?>>12 Colunas</option>
                                </select>
                                <small class="form-control-feedback" id="col-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Tipo de Página</label>
                                <select class="form-control custom-select" id="type_page" name="type_page">
                                    <option value="register" <?php getSelected('register', $fields['type_page']); ?>>Cadastro</option>
                                    <option value="profile" <?php getSelected('profile', $fields['type_page']); ?>>Perfil</option>
                                </select>
                                <small class="form-control-feedback" id="type_page-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Tipo do Campo</label>
                                <select class="form-control custom-select" id="type" name="type" onchange="checkSelect(this.value);">
                                    <option value="color" <?php getSelected('color', $fields['type']); ?>>Cor</option>
                                    <option value="date" <?php getSelected('date', $fields['type']); ?>>Data</option>
                                    <option value="email" <?php getSelected('email', $fields['type']); ?>>Email</option>
                                    <option value="time" <?php getSelected('time', $fields['type']); ?>>Hora</option>
                                    <option value="number" <?php getSelected('number', $fields['type']); ?>>Número</option>
                                    <option value="text" <?php getSelected('text', $fields['type']); ?>>Texto</option>
                                    <option value="tel" <?php getSelected('tel', $fields['type']); ?>>Telefone</option>
                                    <option value="url" <?php getSelected('url', $fields['type']); ?>>URL</option>
                                    <option value="select" <?php getSelected('select', $fields['type']); ?>>Seleção</option>
                                </select>
                                <small class="form-control-feedback" id="type-feedback"></small>
                            </div>
                        </div>
                    
                        <div id="select_form" class="w-100">
                            <p class="control-label m-l-15">Opções da Seleção</p>
                            <div id="select_option" class="row w-100 p-0 m-0">
                                <?php 
                                    $options_value = explode(',', $fields['options_value']); 
                                    $options_name = explode(',', $fields['options_name']); 
                                    $options_combine = array_combine($options_value, $options_name);
                                    $first = true;
                                ?>

                                <?php foreach ($options_combine as $oc_key => $oc_value): ?>
                                    <?php if($first == true): $first = false; ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="options_value" name="options_value[]" value="<?php echo $oc_key; ?>" placeholder="Valor">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="options_name" name="options_name[]" value="<?php echo $oc_value; ?>" placeholder="Nome">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="button" onclick="select_fields();"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                    <div class="w-100 d-flex remove<?php echo $oc_key; ?>">
                                        <div class="col-md-6">
                                            <div class="form-group"><input type="text" class="form-control" id="options_value" name="options_value[]" value="<?php echo $oc_key; ?>" placeholder="Valor"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="options_name" name="options_name[]" value="<?php echo $oc_value; ?>" placeholder="Nome">
                                                    <div class="input-group-append"><button class="btn btn-danger" type="button" onclick="remove_fields('<?php echo $oc_key; ?>');"> <i class="fa fa-minus"></i> </button></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div id="select_fields" class="w-100"></div>
                            </div>
                        </div>
                        <div class="col-md-6 m-t-30">
                            <label class="control-label">Campo Obrigatório</label>
                            <div class="m-t-10">
                                <input name="req" type="radio" id="req-yes" class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $fields['req']); ?> />
                                <label for="req-yes">Sim</label>
                                <input name="req" type="radio" id="req-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $fields['req']); ?> />
                                <label for="req-no">Não</label>
                            </div>
                        </div>
                        <div class="col-md-6 m-t-30">
                            <label class="control-label">Campo Ativo</label>
                            <div class="m-t-10">
                                <input name="active" type="radio" id="active-yes" checked class="with-gap radio-col-light-blue" value="1" <?php getChecked('1', $fields['active']); ?> />
                                <label for="active-yes">Sim</label>
                                <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0" <?php getChecked('0', $fields['active']); ?> />
                                <label for="active-no">Não</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="card-body text-center">
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Atualizar Campo</button>
                            </div>
                        </div>
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
            
        </div>
    </div>
</div>
<?php break;?>
<?php default: ?>
<div class="d-flex no-block m-b-15">
    <div><h3 class="text-themecolor">Campos Personalizados</h3></div>
    <div class="ml-auto">
        <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
    </div>
</div>


<div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><span class="lstick"></span>Ordenar os Campos</h4>
                    <div class="myadmin-dd-empty dd" id="nestable2">
                        <ol class="dd-list">
                            <?php 
                                $custom = new CustomFields(); 
                                $custom_array = $custom->getFields();
                                echo $custom->fieldsBuilder($custom_array);
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
                    <h4 class="card-title"><span class="lstick"></span>Adicionar Novo Campo</h4>
                    <form action="#" method="post" id="form-geek">
                    <div class="row p-t-20">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Título do Campo</label>
                                <input type="text" id="title" name="title" required class="form-control">
                                <small class="form-control-feedback" id="title-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome Único do Campo</label>
                                <input type="text" id="name" name="name" class="form-control">
                                <small class="form-control-feedback" id="name-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Colunas</label>
                                <select class="form-control custom-select" id="col" name="col">
                                    <option value="1">1 Coluna</option>
                                    <option value="2">2 Colunas</option>
                                    <option value="3">3 Colunas</option>
                                    <option value="4">4 Colunas</option>
                                    <option value="5">5 Colunas</option>
                                    <option value="6">6 Colunas</option>
                                    <option value="7">7 Colunas</option>
                                    <option value="8">8 Colunas</option>
                                    <option value="9">9 Colunas</option>
                                    <option value="10">10 Colunas</option>
                                    <option value="11">11 Colunas</option>
                                    <option value="12">12 Colunas</option>
                                </select>
                                <small class="form-control-feedback" id="col-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tipo do Campo</label>
                                <select class="form-control custom-select" id="type" name="type" onchange="checkSelect(this.value);">
                                    <option value="color">Cor</option>
                                    <option value="date">Data</option>
                                    <option value="email">Email</option>
                                    <option value="time">Hora</option>
                                    <option value="number">Número</option>
                                    <option value="text" selected>Texto</option>
                                    <option value="tel">Telefone</option>
                                    <option value="url">URL</option>
                                    <option value="select">Seleção</option>
                                </select>
                                <small class="form-control-feedback" id="type-feedback"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tipo de Página</label>
                                <select class="form-control custom-select" id="type_page" name="type_page">
                                    <option value="0">Cadastro e Perfil</option>
                                    <option value="2">Cadastro</option>
                                    <option value="7">Perfil</option>
                                </select>
                                <small class="form-control-feedback" id="type_page-feedback"></small>
                            </div>
                        </div>
                        
                        <div id="select_form" class="w-100">
                            <p class="control-label m-l-15">Opções da Seleção</p>
                            <div id="select_option" class="row w-100 p-0 m-0">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="options_value" name="options_value[]" value="" placeholder="Valor">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="options_name" name="options_name[]" value="" placeholder="Nome">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="button" onclick="select_fields();"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="select_fields" class="w-100"></div>
                        </div>
                        <div class="col-md-6 m-t-30">
                            <label class="control-label">Campo Obrigatório</label>
                            <div class="m-t-10">
                                <input name="req" type="radio" id="req-yes" class="with-gap radio-col-light-blue" value="1" />
                                <label for="req-yes">Sim</label>
                                <input name="req" type="radio" id="req-no" checked class="with-gap radio-col-light-blue" value="0" />
                                <label for="req-no">Não</label>
                            </div>
                        </div>
                        <div class="col-md-6 m-t-30">
                            <label class="control-label">Campo Ativo</label>
                            <div class="m-t-10">
                                <input name="active" type="radio" id="active-yes" checked class="with-gap radio-col-light-blue" value="1" />
                                <label for="active-yes">Sim</label>
                                <input name="active" type="radio" id="active-no" class="with-gap radio-col-light-blue" value="0" />
                                <label for="active-no">Não</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <div class="card-body text-center">
                                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Adicionar Campo</button>
                            </div>
                        </div>
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
<?php break; ?>
<?php endswitch;?>

<script>
window.onload = function() {
    $('#nestable2').nestable({maxDepth: 1});

    $('#save_position').click(function(){
        var fields_serialize = $('.dd').nestable('serialize');
        $.ajax({
            url: "customfields/sort",
            type: "post",
            data: {fields: fields_serialize},
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
}

var room = 1;

function select_fields() {

    room++;
    var objTo = document.getElementById('select_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "w-100 d-flex remove" + room);
    var rdiv = 'remove' + room;

    divtest.innerHTML = '<div class="col-md-6"><div class="form-group"><input type="text" class="form-control" id="options_value" name="options_value[]" value="" placeholder="Valor"></div></div><div class="col-md-6"><div class="form-group"><div class="input-group"><input type="text" class="form-control" id="options_name" name="options_name[]" value="" placeholder="Nome"><div class="input-group-append"><button class="btn btn-danger" type="button" onclick="remove_fields(' + room + ');"> <i class="fa fa-minus"></i> </button></div></div></div></div>';

    objTo.appendChild(divtest)
}

function remove_fields(rid) {
    $('.remove' + rid).remove();
}

<?php 
    if(isset($fields['type'])){
        echo "checkSelect('{$fields['type']}');".PHP_EOL;
    }else{
        echo "checkSelect('text');".PHP_EOL;
    }
?>
function checkSelect(type_value) {
  if(type_value == 'select'){
    $('#select_form').css("display", "");
  }else{
    $('#select_form').css("display", "none");
  }
}
</script>