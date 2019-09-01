
<!-- Templates -->
<script type="text/template" id="msc-layout-template">
    <div class="app-container-inner">

        <div class="card mb-3" id="msc-container">
            <div class="card-header" style="background-color:#fff">

                <div class="row">
                    <div class="col-md-8">
                        <div class="row form-group d-inline-flex">
                            <div class="col-md-3 no-padding-right">
                                <input class="form-control input-sm" type="number" name="slider_width" value="" min="150" step="1">
                            </div>
                            <div class="col-md-3 no-padding-right">
                                <input class="form-control input-sm" type="number" name="slider_height" value="" min="150" step="1">
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-outline-info button-slider-accept" data-toggle="tooltip" title="Aplicar"><i class="fas fa-check"></i></button>
                                <button class="btn btn-outline-info margin-horizontal button-slider-zoom-in"><i class="fas fa-search-plus"></i></button>
                                <button class="btn btn-outline-info margin-horizontal button-slider-zoom-out"><i class="fas fa-search-minus"></i></button>
                                <button class="btn btn-outline-info margin-horizontal button-slider-ruler"><i class="fas fa-ruler"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-right text-xs-center">
                        <button class="btn btn-outline-success margin-horizontal button-slider-save"><i class="fas fa-save"></i> Salvar</button>
                        <div class="dropdown display-inline-block margin-horizontal">
                            <button type="button" class="btn btn-outline-info button-open" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item button-slider-new" href="#"><i class="fas fa-file"></i></i> Novo</a>
                                <a class="dropdown-item button-slider-open" href="#"><i class="fas fa-folder"></i></i> Abrir</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card-body p-0">
                <div class="msc-slides-wrapper" id="msc-slides-wrapper">
                    <div class="msc-slides-container" id="msc-slides-container" style="min-width: 700px;">
                        <div class="inner et-wrapper" style="width: 700px; height: 350px;">
                            <div class="msc-slide et-page et-page-current"></div>
                        </div>
                    </div>
                    <div class="msc-right-panel" id="msc-right-panel"></div>
                </div>
            </div>
            <div class="card-footer" id="msc-slide-placeholder-container">
                <div class="row">
                    <div class="col-5 col-sm-5 col-md-7 list-container"></div>
                    <div class="col-7 col-sm-7 col-md-5 msc-slides-buttons-container">
                        <div class="msc-slides-buttons">
                            <button type="button" class="btn btn-outline-success button-play-slide" data-toggle="tooltip" title="Reproduzir Animação do Slider"><i class="fas fa-play"></i></button>
                            <span class="divider-vert"></span>
                            <button type="button" class="btn btn-outline-info button-add-slide" data-toggle="tooltip" title="Novo Slider"><i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-outline-info button-copy-slide" data-toggle="tooltip" title="Copiar Slider"><i class="fas fa-copy"></i></button>
                            <button type="button" class="btn btn-outline-danger button-remove-slide" data-toggle="tooltip" title="Excluir Slider"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div id="msc-options-layer"></div>
            </div>
            <div class="col-lg-6">
                <div id="msc-layer-placeholder-wrapper"></div>
            </div>
        </div>
    </div>
    <div id="msc-modals"></div>
</script>

<script type="text/template" id="msc-layer-placeholder-empty-template">
    <div class="alert alert-warning text-xs-center" role="alert">Vazio</div>
</script>

<script type="text/template" id="msc-modal-template">
    <div class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><%- modalTitle %></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body max-height max-height400"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/template" id="msc-modal-submit-template">
    <div class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><%- modalTitle %></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body max-height max-height400"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info button-submit" data-dismiss="modal"> Salvar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fechar</button>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/template" id="msc-modal-slider-save-template">
    <div class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><%- modalTitle %></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body max-height"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info button-submit" data-dismiss="modal">Salvar</button>
                    <button type="button" class="btn btn-outline-info button-submit-new">Salvar como novo</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/template" id="msc-icon-button-template">
    <i class="<%- name %>" title="<%- name %>"></i>
</script>

<script type="text/template" id="msc-layer-placeholder-collection-template">
    <div class="card" id="msc-layer-placeholder-container">
        <div class="card-body">
            <h4 class="card-title m-b-40"><span class="lstick"></span>Camadas</h4>   
            <div class="form-group">
                <button class="btn btn-outline-info btn-block button-add-layer">
                    <i class="fas fa-plus"></i>
                    Adicionar Camada
                </button>
            </div>
            <div class="list-container"></div>
        </div>
    </div>
</script>

<script type="text/template" id="msc-layer-placeholder-template">
    <div class="card-body p-2">
        <div class="row">
            <div class="col-2 col-sm-2 col-md-1 placeholder-icon">
                <i class="fas fa-arrows-alt"></i>
            </div>
            <div class="col-6 col-sm-6 col-md-7 card-text">
                <div class="ellipsis">
                    <%- placeholderText %>
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-4 text-xs-right msc-layer-buttons-container">
                <div class="msc-layer-buttons">
                    <button type="button" class="btn btn-outline-info btn-sm show-on-hover button-layer-copy" data-toggle="tooltip" title="Copiar Camada">
                        <i class="fas fa-copy"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm show-on-hover button-layer-remove" data-toggle="tooltip" title="Excluir Camada">
                        <i class="fas fa-times"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info btn-sm button-layer-visible" data-toggle="tooltip" title="Mostrar / Ocultar">
                        <% if( isVisible ){ %>
                        <i class="fas fa-eye"></i>
                        <% } else { %>
                        <i class="fas fa-eye-slash"></i>
                        <% } %>
                    </button>
                </div>
            </div>
        </div>
    </div>
</script>

<script type="text/template" id="msc-options-slide-template">
    <div class="msc-right-panel-b shadow-20">
        <div class="inner">

            <div id="msc-options-wrapper">
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-slide-color">Cor</label>
                        <input type="text" class="form-control form-control-sm input-color option-control" name="color" data-validate="color-rgb" id="options-slide-color">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-layer-image">Imagem</label>
                        <button type="button" class="btn btn-secondary btn-sm btn-block button-upload" id="options-layer-image"><i class="fas fa-image"></i> Enviar</button>
                        <input type="file" name="image" accept="image/gif,image/jpeg,image/png" style="display:none;">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-slide-transition-in">Animação de Entrada</label>
                        <select class="form-control form-control-sm option-control" name="transitionIn" id="options-slide-transition-in">
                            <option value="">Sem Animação</option>
                            <option value="rotateSlideIn">rotateSlideIn</option>
                            <option value="rotateSidesIn">rotateSidesIn</option>
                            <option value="rotateCarouselBottomIn">rotateCarouselBottomIn</option>
                            <option value="rotateCarouselTopIn">rotateCarouselTopIn</option>
                            <option value="rotateCarouselRightIn">rotateCarouselRightIn</option>
                            <option value="rotateCarouselLeftIn">rotateCarouselLeftIn</option>
                            <option value="rotateCubeBottomIn">rotateCubeBottomIn</option>
                            <option value="rotateCubeTopIn">rotateCubeTopIn</option>
                            <option value="rotateCubeRightIn">rotateCubeRightIn</option>
                            <option value="rotateCubeLeftIn">rotateCubeLeftIn</option>
                            <option value="rotateRoomBottomIn">rotateRoomBottomIn</option>
                            <option value="rotateRoomTopIn">rotateRoomTopIn</option>
                            <option value="rotateRoomRightIn">rotateRoomRightIn</option>
                            <option value="rotateRoomLeftIn">rotateRoomLeftIn</option>
                            <option value="rotateUnfoldBottom">rotateUnfoldBottom</option>
                            <option value="rotateUnfoldTop">rotateUnfoldTop</option>
                            <option value="rotateUnfoldRight">rotateUnfoldRight</option>
                            <option value="rotateUnfoldLeft">rotateUnfoldLeft</option>
                            <option value="moveFromTopFade">moveFromTopFade</option>
                            <option value="moveFromLeftFade">moveFromLeftFade</option>
                            <option value="moveFromRightFade">moveFromRightFade</option>
                            <option value="moveFromBottomFade">moveFromBottomFade</option>
                            <option value="rotatePullTop">rotatePullTop</option>
                            <option value="rotatePullBottom">rotatePullBottom</option>
                            <option value="rotatePullLeft">rotatePullLeft</option>
                            <option value="rotatePullRight">rotatePullRight</option>
                            <option value="moveFromTop">moveFromTop</option>
                            <option value="moveFromBottom">moveFromBottom</option>
                            <option value="moveFromLeft">moveFromLeft</option>
                            <option value="moveFromRight">moveFromRight</option>
                            <option value="scaleUp">scaleUp</option>
                            <option value="scaleUpDown">scaleUpDown</option>
                            <option value="scaleUpCenter">scaleUpCenter</option>
                            <option value="flipInTop">flipInTop</option>
                            <option value="flipInBottom">flipInBottom</option>
                            <option value="flipInLeft">flipInLeft</option>
                            <option value="flipInRight">flipInRight</option>
                            <option value="rotateInNewspaper">rotateInNewspaper</option>
                        </select>

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-slide-transition-out">Animação de Saída</label>
                        <select class="form-control form-control-sm option-control" name="transitionOut" id="options-slide-transition-out">
                            <option value="">Sem Animação</option>
                            <option value="rotateSlideOut">rotateSlideOut</option>
                            <option value="rotateSidesOut">rotateSidesOut</option>
                            <option value="rotateCarouselBottomOut">rotateCarouselBottomOut</option>
                            <option value="rotateCarouselTopOut">rotateCarouselTopOut</option>
                            <option value="rotateCarouselRightOut">rotateCarouselRightOut</option>
                            <option value="rotateCarouselLeftOut">rotateCarouselLeftOut</option>
                            <option value="rotateCubeBottomOut">rotateCubeBottomOut</option>
                            <option value="rotateCubeTopOut">rotateCubeTopOut</option>
                            <option value="rotateCubeRightOut">rotateCubeRightOut</option>
                            <option value="rotateCubeLeftOut">rotateCubeLeftOut</option>
                            <option value="rotateRoomBottomOut">rotateRoomBottomOut</option>
                            <option value="rotateRoomTopOut">rotateRoomTopOut</option>
                            <option value="rotateRoomRightOut">rotateRoomRightOut</option>
                            <option value="rotateRoomLeftOut">rotateRoomLeftOut</option>
                            <option value="rotateFoldBottom">rotateFoldBottom</option>
                            <option value="rotateFoldTop">rotateFoldTop</option>
                            <option value="rotateFoldRight">rotateFoldRight</option>
                            <option value="rotateFoldLeft">rotateFoldLeft</option>
                            <option value="moveToBottomFade">moveToBottomFade</option>
                            <option value="moveToTopFade">moveToTopFade</option>
                            <option value="moveToRightFade">moveToRightFade</option>
                            <option value="moveToLeftFade">moveToLeftFade</option>
                            <option value="rotatePushBottom">rotatePushBottom</option>
                            <option value="rotatePushTop">rotatePushTop</option>
                            <option value="rotatePushRight">rotatePushRight</option>
                            <option value="rotatePushLeft">rotatePushLeft</option>
                            <option value="moveToBottom">moveToBottom</option>
                            <option value="moveToTop">moveToTop</option>
                            <option value="moveToRight">moveToRight</option>
                            <option value="moveToLeft">moveToLeft</option>
                            <option value="scaleDown">scaleDown</option>
                            <option value="scaleDownUp">scaleDownUp</option>
                            <option value="flipOutBottom">flipOutBottom</option>
                            <option value="flipOutTop">flipOutTop</option>
                            <option value="flipOutLeft">flipOutLeft</option>
                            <option value="flipOutRight">flipOutRight</option>
                            <option value="fade">fade</option>
                            <option value="rotateOutNewspaper">rotateOutNewspaper</option>
                        </select>

                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-slide-delay">Atraso</label>
                        <input type="number" class="form-control form-control-sm option-control" name="timeDelay" value="0" min="0" id="options-slide-delay">
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="button-toggle">
        <button class="btn btn-secondary" type="button">
            <i class="fas icon"></i>
        </button>
    </div>
</script>

<script type="text/template" id="msc-options-layer-template">
    <div class="card">
        <div class="card-body msc-options-container">
            <h4 class="card-title m-b-40"><span class="lstick"></span>Opções de Camada</h4>                
            <form action="" method="post">
                <div class="row form-group">
                    <div class="col-md-12 form-group">
                        <label for="options-layer-type">Tipo de Camada</label>
                        <select class="form-control option-control" name="type" id="options-layer-type">
                            <option value="text">Texto</option>
                            <option value="image">Imagem</option>
                            <option value="video">Vídeo</option>
                            <option value="icon">Icone</option>
                        </select>
                    </div>
                </div>

                <div class="row form-group d-inline-flex">
                    <div class="col-md-8 form-group">
                        <label for="options-layer-effect">Efeito</label>
                        <select class="form-control form-control-sm option-control" name="effect" id="options-layer-effect">
                            <option value="">Sem Efeito</option>
                            <option value="bounce">bounce</option>
                            <option value="flash">flash</option>
                            <option value="pulse">pulse</option>
                            <option value="rubberBand">rubberBand</option>
                            <option value="shake">shake</option>
                            <option value="headShake">headShake</option>
                            <option value="swing">swing</option>
                            <option value="tada">tada</option>
                            <option value="wobble">wobble</option>
                            <option value="jello">jello</option>
                            <option value="bounceIn">bounceIn</option>
                            <option value="bounceInDown">bounceInDown</option>
                            <option value="bounceInLeft">bounceInLeft</option>
                            <option value="bounceInRight">bounceInRight</option>
                            <option value="bounceInUp">bounceInUp</option>
                            <option value="fadeIn">fadeIn</option>
                            <option value="fadeInDown">fadeInDown</option>
                            <option value="fadeInDownBig">fadeInDownBig</option>
                            <option value="fadeInLeft">fadeInLeft</option>
                            <option value="fadeInLeftBig">fadeInLeftBig</option>
                            <option value="fadeInRight">fadeInRight</option>
                            <option value="fadeInRightBig">fadeInRightBig</option>
                            <option value="fadeInUp">fadeInUp</option>
                            <option value="fadeInUpBig">fadeInUpBig</option>
                            <option value="flipInX">flipInX</option>
                            <option value="flipInY">flipInY</option>
                            <option value="lightSpeedIn">lightSpeedIn</option>
                            <option value="rotateIn">rotateIn</option>
                            <option value="rotateInDownLeft">rotateInDownLeft</option>
                            <option value="rotateInDownRight">rotateInDownRight</option>
                            <option value="rotateInUpLeft">rotateInUpLeft</option>
                            <option value="rotateInUpRight">rotateInUpRight</option>
                            <option value="hinge">hinge</option>
                            <option value="rollIn">rollIn</option>
                            <option value="zoomIn">zoomIn</option>
                            <option value="zoomInDown">zoomInDown</option>
                            <option value="zoomInLeft">zoomInLeft</option>
                            <option value="zoomInRight">zoomInRight</option>
                            <option value="zoomInUp">zoomInUp</option>
                            <option value="slideInDown">slideInDown</option>
                            <option value="slideInLeft">slideInLeft</option>
                            <option value="slideInRight">slideInRight</option>
                            <option value="slideInUp">slideInUp</option>
                        </select>

                    </div>
                    <div class="col-md-4">
                        <label for="options-layer-effect">Atraso</label>
                        <input type="number" class="form-control form-control-sm option-control" name="timeDelay" value="0" min="0" step="0.2" id="options-layer-delay">
                    </div>
                </div>

                <% if( type == 'text' ){ %>

                <div class="row form-group">
                    <div class="col-md-4">
                        <label for="options-layer-text">Texto</label>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control form-control-sm option-control" name="text" value="" cols="20" rows="3" id="options-layer-text"></textarea>
                    </div>
                </div>

                <div class="row form-group d-inline-flex">
                    <div class="col-md-12">
                        <label for="options-layer-font">Fonte e Tamanho</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select class="form-control form-control-sm option-control" name="font" id="options-layer-font">
                            <option value="Arial, Helvetica, sans-serif">Arial</option>
                            <option value="'Arial Black', Gadget, sans-serif">Arial Black</option>
                            <option value="'Comic Sans MS', cursive, sans-serif">Comic Sans MS</option>
                            <option value="Impact, Charcoal, sans-serif">Impact</option>
                            <option value="Tahoma, Geneva, sans-serif">Tahoma</option>
                            <option value="'Trebuchet MS', Helvetica, sans-serif">Trebuchet MS</option>
                            <option value="Verdana, Geneva, sans-serif">Verdana</option>
                            <option value="Georgia, serif">Georgia</option>
                            <option value="Palatino, serif">Palatino Linotype</option>
                            <option value="'Times New Roman', Times, serif">Times New Roman</option>
                            <option value="'Courier New', Courier, monospace">Courier New</option>
                            <option value="'Lucida Console', Monaco, monospace">Lucida Console</option>
                        </select>

                    </div>
                    <div class="col-md-4 form-group">
                        <select class="form-control form-control-sm option-control" name="fontSize" id="options-layer-fontSize">
                            <option value="16">16</option>
                            <option value="18">18</option>
                            <option value="20">20</option>
                            <option value="22">22</option>
                            <option value="24">24</option>
                            <option value="28">28</option>
                            <option value="32">32</option>
                            <option value="36">36</option>
                            <option value="40">40</option>
                            <option value="46">46</option>
                            <option value="52">52</option>
                            <option value="72">72</option>
                            <option value="80">80</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-4">
                        <label for="options-layer-text-style">Estilo de Texto</label>
                    </div>
                    <div class="col-md-8">

                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-secondary btn-sm option-label">
                                <input type="radio" name="textAlign" value="left" autocomplete="off">
                                <i class="fas fa-align-left"></i>
                            </label>
                            <label class="btn btn-secondary btn-sm option-label">
                                <input type="radio" name="textAlign" value="center" autocomplete="off">
                                <i class="fas fa-align-center"></i>
                            </label>
                            <label class="btn btn-secondary btn-sm option-label">
                                <input type="radio" name="textAlign" value="right" autocomplete="off">
                                <i class="fas fa-align-right"></i>
                            </label>
                            <label class="btn btn-secondary btn-sm option-label">
                                <input type="checkbox" name="bold" value="on" autocomplete="off" class="d-none">
                                <i class="fas fa-bold"></i>
                            </label>
                            <label class="btn btn-secondary btn-sm option-label">
                                <input type="checkbox" name="underline" value="on" autocomplete="off" class="d-none">
                                <i class="fas fa-underline"></i>
                            </label>
                            <label class="btn btn-secondary btn-sm option-label">
                                <input type="checkbox" name="italic" value="on" autocomplete="off" class="d-none">
                                <i class="fas fa-italic"></i>
                            </label>
                            <label class="btn btn-secondary btn-sm option-label">
                                <input type="checkbox" name="lineThrough" value="on" autocomplete="off" class="d-none">
                                <i class="fas fa-strikethrough"></i>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-layer-line-height">Altura da linha</label>
                        <input type="range" class="option-control" name="lineHeight" value="1.2" min="0.5" max="5" step="0.2" id="options-layer-line-height">
                    </div>
                </div>

                <% } %>

                <% if( _.contains(['icon'], type) ){ %>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-layer-icon">Icone</label>
                        <button type="button" class="btn btn-secondary btn-sm btn-block button-icons-select" id="options-layer-icon">
                            <i class="fas fa-list"></i> Escolher
                        </button>
                    </div>
                </div>

                <% } %>

                <% if( _.contains(['text', 'icon'], type) ){ %>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-layer-padding">Espaçamento</label>
                        <input type="range" class="option-control" name="padding" value="0" min="0" max="70" step="1" id="options-layer-padding">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-layer-text-color">Cor do Texto</label>
                        <input type="text" class="form-control form-control-sm input-color option-control" name="textColor" data-validate="color-rgb" id="options-layer-text-color">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-layer-background">Cor de Fundo</label>
                        <input type="text" class="form-control form-control-sm input-color-bg option-control" name="background" data-validate="color-rgb" id="options-layer-background">
                    </div>
                </div>

                <% } %>

                <% if( _.contains(['image'], type) ){ %>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-layer-image">Imagem</label>
                        <button type="button" class="btn btn-secondary btn-sm btn-block button-upload" id="options-layer-image">
                            <i class="fas fa-image"></i> Enviar
                        </button>
                        <input type="file" name="image" accept="image/gif,image/jpeg,image/png" style="display:none;">
                    </div>
                </div>

                <% } %>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="options-layer-link">
                            <% if( _.contains(['video'], type) ){ %>
                            Vídeo URL
                            <% } else { %>
                            Link
                            <% } %>
                        </label>
                        <input type="text" class="form-control form-control-sm option-control" name="link" data-validate="link" value="" id="options-layer-link">
                    </div>
                </div>

                <!-- <% if( type != 'icon' ){ %>
                <div class="row form-group">
                    <div class="col-md-4">
                        <label for="options-layer-source">Source</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control form-control-sm option-control" name="source" id="options-layer-source">
                    </div>
                </div>
                <% } %> -->

            </form>

        </div>
    </div>
</script>

<script type="text/template" id="msc-save-form-template">
    <form action="" method="post">
        <div class="row form-group">
            <div class="col-md-4">
                <label for="field-name">Nome</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" name="name" value="<%- title %>" id="field-name" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label for="field-background_color">Cor de Fundo</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control form-control-sm input-color-bg" name="backgroundColor" value="<%- backgroundColor %>" id="field-background_color">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <input type="checkbox" name="arrows" id="arrows" class="filled-in chk-col-light-blue d-none custom-control-input" value="1"<% if( showArrows ){ %> checked<% } %> />
                <label for="arrows" class="m-r-15">Mostrar Setas</label>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <input type="checkbox" name="pages" id="pages" class="filled-in chk-col-light-blue d-none custom-control-input" value="1"<% if( showPages ){ %> checked<% } %> />
                <label for="pages" class="m-r-15">Navegação de páginas</label>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <input type="checkbox" name="autoPlay" id="autoPlay" class="filled-in chk-col-light-blue d-none custom-control-input" value="1"<% if( autoPlay ){ %> checked<% } %> />
                <label for="autoPlay" class="m-r-15">Reproduzir Automaticamente</label>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <input type="checkbox" name="stopAutoPlayMouseOver" id="stopAutoPlayMouseOver" class="filled-in chk-col-light-blue d-none custom-control-input" value="1"<% if( stopAutoPlayMouseOver ){ %> checked<% } %> />
                <label for="stopAutoPlayMouseOver" class="m-r-15">Parar a Reprodução ao passar o mouse</label>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <input type="checkbox" name="effectsFromFirst" id="effectsFromFirst" class="filled-in chk-col-light-blue d-none custom-control-input" value="1"<% if( effectsFromFirst ){ %> checked<% } %> />
                <label for="effectsFromFirst" class="m-r-15">Reproduzir efeitos do primeiro slider</label>
            </div>
        </div>
    </form>
</script>

<script type="text/template" id="msc-layer-template">
    <div class="inner">
        <%- text %>
    </div>
</script>

<script type="text/template" id="msc-slider-files-container">
    <table class="table table-bordered table-hover">
        <colgroup>
            <col width="15%">
            <col width="40%">
            <col width="20%">
            <col width="20%">
        </colgroup>
        <tbody></tbody>
    </table>
</script>

<script type="text/template" id="msc-slider-file-template">
    <td>
        <small><%- id %></small>
    </td>
    <td>
        <% if( isActive ){ %>
        <i class="fas fa-check"></i>
        <% } %>
        <span title="<%- size %>, <%- width %>x<%- height %>">
            <%- title %>
        </span>
    </td>
    <td>
        <small><%- mtime %></small>
    </td>
    <td class="text-xs-right">
        <a class="btn btn-sm btn-outline-info button-file-preview" href="slider/preview?id=<%- id %>" target="_blank" data-toggle="tooltip" title="Pre-visualizar">
            <i class="fas fa-link"></i>
        </a>
        <button type="button" class="btn btn-sm btn-outline-danger button-file-remove" data-toggle="tooltip" title="Excluir">
            <i class="fas fa-times"></i>
        </button>
    </td>
</script>
<!-- /Templates -->