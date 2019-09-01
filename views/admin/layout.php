<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<div class="page-wrapper">
    <div class="container-fluid" >

        <div class="d-flex no-block">
            <div><h3 class="text-themecolor">Layout</h3></div>
            <div class="w-25 ml-auto m-b-15">
                <select class="selectpicker" name="page" id="page" data-style="custom-select w-100"  data-live-search="true" title="Selecione" onchange="if(this.value != '0') window.location = '<?php echo BASE_ADMIN ?>/layout/'+this[this.selectedIndex].value; else window.location = '<?php echo BASE_ADMIN ?>/layout';">
                    <?php $p = new Page(); $p = $p->getAllPages(); foreach ($p as $page): ?>
                        <?php if($page['id'] == $viewData['pageid']){ $slug = $page['slug']; } ?>
                        <option value="<?php echo $page['id']; ?>" data-tokens="<?php echo $page['title']; ?>" <?php getSelected($viewData['pageid'], $page['id']); ?>><?php echo $page['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="m-t-5"><a class="right-side-toggle m-l-15" href="javascript:void(0)"><i class="mdi mdi-help"></i></a></div>
        </div>

 
        <div class="row text-center geek-layout">
            <div class="col-md-12">
                <div class="ribbon-wrapper card">
                    <div class="ribbon ribbon-info">Superior</div>
                    <div class="ribbon ribbon-right">
                        <a class="btnAdd" data-position="top" data-toggle="tooltip" data-placement="left" data-original-title="Adicionar"><i class="mdi mdi-plus"></i></a>
                        <a class="allpages" data-position="top" data-toggle="tooltip" data-placement="left" data-original-title="Aplicar em Todas as Páginas"><i class="mdi mdi-checkbox-multiple-marked"></i></a>
                    </div>
                    <p class="ribbon-content">
                        <ul data-position="top" id="top-<?php echo $viewData['pageid'];?>" class="row sortable-list top-position">
                            <?php if($layout): ?>
                            <?php foreach ($layout as $trow): ?>
                            <?php if ($trow['place'] == "top"): ?>
                            <li class="sortable-item col-md-<?php echo $trow['space']; ?>" id="list-<?php echo $trow['widget_id'];?>" data-id="<?php echo $trow['widget_id'];?>" data-alias="<?php echo $trow['widget_alias'];?>" data-space="<?php echo $trow['space'];?>">
                                <div class="d-flex no-block">
                                    <div class="p-2"><?php echo $trow['title'];?></div>
                                    <div class="ml-auto p-2">
                                        <a class="setspace"><i class="fa fa-edit"></i></a>
                                        <a class="remove m-l-10"><i class="fa fa-times text-danger"></i></a>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php unset($trow);?>
                            <?php endif; ?>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ribbon-wrapper card">
                    <div class="ribbon ribbon-info">Esquerda</div>
                    <div class="ribbon ribbon-right">
                        <a class="btnAdd" data-position="left" data-toggle="tooltip" data-placement="left" data-original-title="Adicionar"><i class="mdi mdi-plus"></i></a>
                        <a class="allpages" data-position="left" data-toggle="tooltip" data-placement="left" data-original-title="Aplicar em Todas as Páginas"><i class="mdi mdi-checkbox-multiple-marked"></i></a>
                    </div>
                    <p class="ribbon-content">
                        <ul data-position="left" id="left-<?php echo $viewData['pageid'];?>" class="row sortable-list left-position">
                            <?php if($layout): ?>
                            <?php foreach ($layout as $trow): ?>
                            <?php if ($trow['place'] == "left"): ?>
                            <li class="sortable-item col-md-<?php echo $trow['space']; ?>" id="list-<?php echo $trow['widget_id'];?>" data-id="<?php echo $trow['widget_id'];?>" data-alias="<?php echo $trow['widget_alias'];?>" data-space="<?php echo $trow['space'];?>">
                                <div class="d-flex no-block">
                                    <div class="p-2"><?php echo $trow['title'];?></div>
                                    <div class="ml-auto p-2">
                                        <a class="setspace"></a>
                                        <a class="remove m-l-10"><i class="fa fa-times text-danger"></i></a>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php unset($trow);?>
                            <?php endif; ?>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="col-md-4 h-100">
                <div class="ribbon-wrapper card geek-layout-main">
                    <p class="ribbon-content">Conteúdo Principal</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ribbon-wrapper card">
                    <div class="ribbon ribbon-info">Direita</div>
                    <div class="ribbon ribbon-right">
                        <a class="btnAdd" data-position="right" data-toggle="tooltip" data-placement="left" data-original-title="Adicionar"><i class="mdi mdi-plus"></i></a>
                        <a class="allpages" data-position="right" data-toggle="tooltip" data-placement="left" data-original-title="Aplicar em Todas as Páginas"><i class="mdi mdi-checkbox-multiple-marked"></i></a>
                    </div>
                    <p class="ribbon-content">
                        <ul data-position="right" id="right-<?php echo $viewData['pageid'];?>" class="row sortable-list right-position">
                            <?php if($layout): ?>
                            <?php foreach ($layout as $trow): ?>
                            <?php if ($trow['place'] == "right"): ?>
                            <li class="sortable-item col-md-<?php echo $trow['space']; ?>" id="list-<?php echo $trow['widget_id'];?>" data-id="<?php echo $trow['widget_id'];?>" data-alias="<?php echo $trow['widget_alias'];?>" data-space="<?php echo $trow['space'];?>">
                                <div class="d-flex no-block">
                                    <div class="p-2"><?php echo $trow['title'];?></div>
                                    <div class="ml-auto p-2">
                                        <a class="setspace"></a>
                                        <a class="remove m-l-10"><i class="fa fa-times text-danger"></i></a>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php unset($trow);?>
                            <?php endif; ?>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ribbon-wrapper card">
                    <div class="ribbon ribbon-info">Inferior</div>
                    <div class="ribbon ribbon-right">
                        <a class="btnAdd" data-position="bottom" data-toggle="tooltip" data-placement="left" data-original-title="Adicionar"><i class="mdi mdi-plus"></i></a>
                        <a class="allpages" data-position="bottom" data-toggle="tooltip" data-placement="left" data-original-title="Aplicar em Todas as Páginas"><i class="mdi mdi-checkbox-multiple-marked"></i></a>
                    </div>
                    <p class="ribbon-content">
                        <ul data-position="bottom" id="bottom-<?php echo $viewData['pageid'];?>" class="row sortable-list bottom-position">
                            <?php if($layout): ?>
                            <?php foreach ($layout as $trow): ?>
                            <?php if ($trow['place'] == "bottom"): ?>
                            <li class="sortable-item col-md-<?php echo $trow['space']; ?>" id="list-<?php echo $trow['widget_id'];?>" data-id="<?php echo $trow['widget_id'];?>" data-alias="<?php echo $trow['widget_alias'];?>" data-space="<?php echo $trow['space'];?>">
                                <div class="d-flex no-block">
                                    <div class="p-2"><?php echo $trow['title'];?></div>
                                    <div class="ml-auto p-2">
                                        <a class="setspace"><i class="fa fa-edit"></i></a>
                                        <a class="remove m-l-10"><i class="fa fa-times text-danger"></i></a>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php unset($trow);?>
                            <?php endif; ?>
                        </ul>
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ribbon-wrapper card">
                    <div class="ribbon ribbon-info">Rodapé</div>
                    <div class="ribbon ribbon-right">
                        <a class="btnAdd" data-position="footer" data-toggle="tooltip" data-placement="right" data-original-title="Adicionar"><i class="mdi mdi-plus"></i></a>
                        <a class="allpages" data-position="footer" data-toggle="tooltip" data-placement="left" data-original-title="Aplicar em Todas as Páginas"><i class="mdi mdi-checkbox-multiple-marked"></i></a>
                    </div>
                    <p class="ribbon-content">
                        <ul data-position="footer" id="footer-<?php echo $viewData['pageid']; ?>" class="row sortable-list footer-position">
                            <?php if($layout): ?>
                            <?php foreach ($layout as $trow): ?>
                            <?php if ($trow['place'] == "footer"): ?>
                            <li class="sortable-item col-md-<?php echo $trow['space']; ?>" id="list-<?php echo $trow['widget_id'];?>" data-id="<?php echo $trow['widget_id'];?>" data-alias="<?php echo $trow['widget_alias'];?>" data-space="<?php echo $trow['space'];?>">
                                <div class="d-flex no-block">
                                    <div class="p-2"><?php echo $trow['title'];?></div>
                                    <div class="ml-auto p-2">
                                        <a class="setspace"><i class="fa fa-edit"></i></a>
                                        <a class="remove m-l-10"><i class="fa fa-times text-danger"></i></a>
                                    </div>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php unset($trow);?>
                            <?php endif; ?>
                        </ul>
                    </p>
                </div>
            </div>
        </div>

        <div class="modal fade" id="widget-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Escolha um Widget para incluir.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="widget-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
                </div>
            </div>
        </div>
        
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body geek-help">
                    <b>Gerenciar Layout</b>
                    <p>Primeiro, selecione a página que você deseja gerenciar o layout. A página inicial é selecionada por padrão.</p>
                    <hr>
                    <b>Seções do Layout</b>
                    <p>Há cinco áreas disponíveis no total, que você pode usar para atribuir seus plugins. Área Superior, Inferior, Esquerda, Direita e Rodapé. Cada área pode conter um ou mais plugins.</p>
                    <hr>
                    <b>Ordenar Plugins</b>
                    <p>Você alterar a ordem dos plugins arrastando-os para cima ou para baixo, além de poder mover os plugins de uma área para outra.</p>
                    <hr>
                    <b>Inserindo Plugins</b>
                    <p>Para inserir um novo plugin clique no icone <i class="fa fa-plus"></i> da área que deseja adicionar. Uma nova janela será aberta e você pode selecionar um ou mais plugins não utilizados.</p>
                    <hr>
                    <b>Removendo Plugins</b>
                    <p>Para remover plugin(s), clique no ícone <i class="fa fa-times"></i> do plugin correspondente para remover.</p>
                    <hr>
                    <b>Aplicando a Configuração</b>
                    <p>Clicando no icone <i class="fa fa-check-square-o"></i> você pode aplicar a configuração de uma área para todas as páginas existentes.</i></p>
                    <hr>
                    <b>Colunas dos Plugins</b>
                    <p>A área de Plugins Superior e inferior pode ser estendidos com o número de colunas. Por exemplo, se você tem 2 plugins atribuídos a área inferior, por padrão cada plugin terá 100% do espaço disponível. Você pode atribuir manualmente o número máximo de espaço ocupado por cada plugin. Por exemplo, o primeiro plugin pode levar 5 colunas, o segundo plugin pode ter 7 colunas. O total não deve exceder 12 colunas. O Primeiro plugin pode ter 3 colunas, o segundo 5 colunas e o terceiro 4 colunas. Você pode misturar e combinar qualquer colunas, mas tenha em mente que 12 é o número máximo. Cada vez que você adiciona ou remove um plugin, você precisará re-ajustar o número de colunas para cada plugin.</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
window.onload = function() {

    $(".bottom-position, .top-position, .footer-position").on("sortreceive", function (event, ui) {
        $(this).find(".setspace").html('<i class="fa fa-edit"></i>');
    });
    
    $(".left-position, .right-position").on("sortreceive", function (event, ui) {
        $(this).find(".setspace").html('');
    });
    
    // Instanciar
    $(".sortable-list").sortable({
        connectWith: '.sortable-list',
        placeholder: 'placeholder',
        tolerance: "pointer",
        cursorAt: {
            top: 0,
            left: 0
        },
        start: function (event, ui) {
            $(ui.item).width($('#left-<?php echo $viewData['pageid'];?>').width());
        },
        update: savePosition
    });


    // Salvar
    function savePosition() {
      var place = "";
      var count = 0;
      $("[id^=list-]").each(function () {
          alias = $(this).data('alias');
          space = $(this).data('space');
          count++;
          place += (this.parentNode.id + "[]" + "=" + count + "|" + this.id + '|' + alias + '|' + space + "&");
      });
      $.ajax({
          type: "post",
          url: "layout?pageslug=<?php echo $slug; ?>&action=add&layout=" + this.id,
          data: place
      });
    }


    // Carregar a Lista de Widgets disponíveis
    $('body').on('click', '.btnAdd', function () {
        var pos = $(this).data('position');
        console.log(pos);
        $.ajax({
            url: "layout?action=load",
            method: "POST",
            data: {
                position: pos,
                page_id: <?php echo $viewData['pageid'];?>,
            },
            success: function (response) {
                $('#widget-body').html(response);
                $('#widget-modal').modal('show');
            }
        });
    });

    // Adicionar Widgets
    $('body').on('click', '#plavailable a.list', function () {
          var pos = $(this).data('position');
          var id = $(this).data('id');
          var alias = $(this).data('alias');
          var name = $(this).text();

          if (pos == "top" || pos == "bottom" || pos == "footer") {
              var $list = (`<li class="sortable-item col-md-12" id="list-`+id+`" data-id="`+id+`" data-alias="`+alias+`" data-space="12">
                                <div class="d-flex no-block">
                                    <div class="p-2">`+name+`</div>
                                    <div class="ml-auto p-2">
                                        <a class="setspace"><i class="fa fa-edit"></i></a>
                                        <a class="remove m-l-10"><i class="fa fa-times text-danger"></i></a>
                                    </div>
                                </div>
                            </li>`);
          } else {
            var $list = (`<li class="sortable-item col-md-12" id="list-`+id+`" data-id="`+id+`" data-alias="`+alias+`" data-space="12">
                            <div class="d-flex no-block">
                                <div class="p-2">`+name+`</div>
                                <div class="ml-auto p-2">
                                    <a class="setspace"></a>
                                    <a class="remove m-l-10"><i class="fa fa-times text-danger"></i></a>
                                </div>
                            </div>
                        </li>`);
          }

  		$("ul[data-position='" + pos + "']").prepend($list);
  		$(this).parent().remove();

          var place = "";
          var count = 0;
          $("ul[data-position='" + pos + "'] [id^=list-]").each(function () {
              count++;
              console.log(this);
              place += (this.parentNode.id + "[]" + "=" + count + "|" + this.id + '|' + alias + '|' + 12 + "&");
          });
          console.log(place);
          $.ajax({
              type: "post",
              url: "layout?pageslug=<?php echo $slug; ?>&action=add&layout=" + pos + '-' + <?php echo $viewData['pageid'];?>,
              data: place
          });
      });

      // Remover Widgets
      $('body').on('click', 'a.remove', function () {
          var $li = $(this).closest('li');
          var id = $($li).data("id");

          $li.fadeOut(400, function () {
              $li.remove();
              $.ajax({
                type: "post",
                url: "layout?action=delete",
                data: {id: id, page_id: <?php echo $viewData['pageid']; ?>},
                success: function (msg) {}
              });

          });
      });


      // Aplicar configuração em todas as páginas
      $('body').on('click', '.allpages', function () {
          var pos = $(this).data('position');

          $.confirm({
                title: 'Aplicar Configuração',
                content: 'Tem certeza que deseja aplicar essa configuração em todas as páginas?',
                type: 'red',
                typeAnimated: true,
                icon: 'fa fa-warning',
                buttons: {
                    confirm: {
                        text: 'Sim',
                        btnClass: 'btn-red',
                        action: function(){
                            $.ajax({
                                url: "layout?action=allpages",
                                method: "POST",
                                data: {
                                    update: 'applyAllPages',
                                    place: pos,
                                    page_id: <?php echo $viewData['pageid'];?>
                                },
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
                        }
                    },
                    close: {
                        text: 'Fechar'
                    }
                }
            });

      });


      // Setar o espaço que os widgets irá ter.
      $('body').on('click', 'a.setspace', function () {
          var li = $(this).closest('li');
          var curspace = $(li).data("space");
          var id = $(li).data("id");

          console.log(li);

          var text = '<div class="spacegrid">';
          for (var i = 1; i <= 12; i++) {
              var cls = (curspace == i) ? "active" : '';
              text += '<span class="spacelist ' + cls + '">' + i + '</span>';
          }
          text += '</div>';

          $("#widget-col-body").html(text);

            $.confirm({
                title: 'Escolha um espaço',
                content: text,
                columnClass: 'col-md-6',
                buttons: {
                    confirm: {
                        text: 'Salvar',
                        action: function(){
                            var newcol = $('body span.spacelist.active').html();
                            $.ajax({
                                type: 'post',
                                url: "layout?action=columm",
                                data: {
                                    id: id,
                                    page_id: <?php echo $viewData['pageid'];?>,
                                    cols: newcol
                                },
                                success: function (msg) {
                                    $(li).removeClass('col-md-' + curspace);
                                    $(li).addClass('col-md-' + newcol);
                                    $(li).css('data-space', newcol);
                                    $(li).attr('data-space', newcol);
                                    $(li).data("space", newcol);
                                }

                            });
                        }
                    },
                    cancel: {
                        text: 'Cancelar',
                        action: function(){
                            //$.alert('Cancelar');
                        }
                    }
                }
            });

      });

      $('body').on('click', 'span.spacelist', function () {
          $('body span.spacelist.active').not(this).removeClass('active');
          $(this).toggleClass("active");
      });

}
</script>