<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Slider</h3>
            </div>
        </div>

        <div id="msc-app" class="app-container"></div>
        <?php require_once 'template.php'; ?>

    </div>
</div>

<script>
    var underscore = _.noConflict();
    var app = new App({
        container: '#msc-app',
        baseUrl: '/',
        uploadUrl: '<?php echo BASE_UPLOADS;?>/modules/slider/',
        controllerUrl: 'slider/',
        lang: {
            "apply":"Aplicar",
            "save":"Salvar",
            "save_as_new":"Salvar como novo",
            "close":"Fechar",
            "new":"Novo",
            "open":"Abrir",
            "logout":"Sair",
            "slide_new":"Novo Slider",
            "slide_copy":"Copiar Slider",
            "slide_delete":"Excluir Slider",
            "slide_animation_play":"Reproduzir Animação do Slider",
            "empty":"Vazio",
            "layers":"Camadas",
            "layer_add":"Adicionar Camada",
            "animation_in":"Animação - Entrada",
            "animation_out":"Animação - Saída",
            "no_animation":"Sem Animações",
            "delay":"Atraso",
            "color":"Cor",
            "image":"Imagem",
            "upload":"Enviar",
            "layer_options":"Opções de Camada",
            "layer_type":"Tipo de Camada",
            "layer_type_text":"Texto",
            "layer_type_image":"Imagem",
            "layer_type_video":"Vídeo",
            "layer_type_icon":"Icone",
            "layer_copy":"Copiar Camada",
            "layer_delete":"Excluir Camada",
            "layer_show_hide":"Mostrar / Ocultar",
            "effect_n_delay":"Efeito e Atraso",
            "no_effect":"Sem Efeito",
            "text":"Texto",
            "font_n_size":"Fonte e Tamanho",
            "text_style":"Estilo de Texto",
            "line_height":"Altura da linha",
            "icon":"Icone",
            "choose":"Escolher",
            "choose_icon":"Escolher Icone",
            "padding":"Espaçamento",
            "text_color":"Cor do Texto",
            "background_color":"Cor de Fundo",
            "link":"Link",
            "link_video":"Vídeo URL",
            "source":"Source",
            "name":"Nome",
            "show_arrows":"Mostrar Setas",
            "effects_from_first":"Reproduzir efeitos do primeiro slider",
            "pages_nav":"Navegação de Páginas",
            "auto_play":"Reproduzir Automaticamente",
            "stop_play_mouseover":"Parar a Reprodução ao passar o mouse",
            "delete":"Excluir",
            "preview":"Pre-visualizar",
            "confirm_delete_slider":"Você deseja excluir o slider?",
            "alert_no_slides":"Sem slider para salvar",
            "without_text":"Sem Texto",
            "add_code_to_head":"Adicione este código à sua tag HEAD",
            "example":"Exemplo",
            "example1_desc":"Mostrar Slider.",
            "example2_desc":"Use o modelo HTML para exibir o conteúdo dinâmico (código PHP)."
        }
    });
    app.start();
</script>