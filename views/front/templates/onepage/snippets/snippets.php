<?php $base_img = $this->config['site_url'].'/'.$this->config['site_dir'].'/views/front/templates/'.$this->config['site_theme'].'/snippets/preview/';?>
<?php $widget_img = $this->config['site_url'].'/'.$this->config['site_dir'].'/views/front/widgets/';?>
<?php $module_img = $this->config['site_url'].'/'.$this->config['site_dir'].'/views/admin/modules/';?>

<!-------------------------------------------------------------------------------------------------->
<!-- Containers -->
<!-------------------------------------------------------------------------------------------------->
<div data-type="container" data-preview="<?= $base_img; ?>container.svg" data-keditor-title="Container" data-keditor-categories="Colunas">
    <div class="container">
        <div class="row">
            <div class="col-sm-12" data-type="container-content">
            </div>
        </div>
    </div>
</div>

<div data-type="container" data-preview="<?= $base_img; ?>row_12.svg" data-keditor-title="1 Coluna" data-keditor-categories="Colunas">
    <div class="row">
        <div class="col-sm-12" data-type="container-content">
        </div>
    </div>
</div>

<div data-type="container" data-preview="<?= $base_img; ?>row_6_6.svg" data-keditor-title="2 Colunas (50% - 50%)" data-keditor-categories="Colunas">
    <div class="row">
        <div class="col-sm-6" data-type="container-content">
        </div>
        <div class="col-sm-6" data-type="container-content">
        </div>
    </div>
</div>

<div data-type="container" data-preview="<?= $base_img; ?>row_4_8.svg" data-keditor-title="2 Colunas (33% - 67%)" data-keditor-categories="Colunas">
    <div class="row">
        <div class="col-sm-4" data-type="container-content">
        </div>
        <div class="col-sm-8" data-type="container-content">
        </div>
    </div>
</div>

<div data-type="container" data-preview="<?= $base_img; ?>row_8_4.svg" data-keditor-title="2 Colunas (67% - 33%)" data-keditor-categories="Colunas">
    <div class="row">
        <div class="col-sm-8" data-type="container-content">
        </div>
        <div class="col-sm-4" data-type="container-content">
        </div>
    </div>
</div>

<div data-type="container" data-preview="<?= $base_img; ?>row_4_4_4.svg" data-keditor-title="3 Colunas (33% - 33% - 33%)" data-keditor-categories="Colunas">
    <div class="row">
        <div class="col-sm-4" data-type="container-content">
        </div>
        <div class="col-sm-4" data-type="container-content">
        </div>
        <div class="col-sm-4" data-type="container-content">
        </div>
    </div>
</div>

<div data-type="container" data-preview="<?= $base_img; ?>row_3_6_3.svg" data-keditor-title="3 Colunas (25% - 50% - 25%)" data-keditor-categories="Colunas">
    <div class="row">
        <div class="col-sm-3" data-type="container-content">
        </div>
        <div class="col-sm-6" data-type="container-content">
        </div>
        <div class="col-sm-3" data-type="container-content">
        </div>
    </div>
</div>

<div data-type="container" data-preview="<?= $base_img; ?>row_3_3_3_3.svg" data-keditor-title="4 Colunas (25% - 25% - 25% - 25%)" data-keditor-categories="Colunas">
    <div class="row">
        <div class="col-sm-3" data-type="container-content">
        </div>
        <div class="col-sm-3" data-type="container-content">
        </div>
        <div class="col-sm-3" data-type="container-content">
        </div>
        <div class="col-sm-3" data-type="container-content">
        </div>
    </div>
</div>

<!-------------------------------------------------------------------------------------------------->
<!-- Container with content -->
<!-------------------------------------------------------------------------------------------------->
<div data-type="container" data-preview="<?= $base_img; ?>articles_list.png" data-keditor-title="Lista de Artigos" data-keditor-categories="Texto;Cabeçalho;Imagem">
    <div class="row">
        <div class="col-sm-4 ui-resizable" data-type="container-content">
            <div data-type="component-text">
                <img src="https://i.imgur.com/FbMgjfM.png" width="100%" height="" style="display: inline-block;" class="img-circle img-responsive">
                <h3 style="text-align: center;">Lorem ipsum</h3>
                <p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel, alias, temporibus? Vero natus modi ipsa debitis, accusamus accusantium cum quam. Saepe atque quisquam pariatur voluptatem expedita reprehenderit et vitae.</p>
            </div>
        </div>
        <div class="col-sm-4 ui-resizable" data-type="container-content">
            <div data-type="component-text">
                <img src="https://i.imgur.com/FbMgjfM.png" width="100%" height="" style="display: inline-block;" class="img-circle img-responsive">
                <h3 style="text-align: center;">Lorem ipsum</h3>
                <p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, aut, earum. Quod, debitis, delectus. Maxime eius ipsam sit dolorum perspiciatis obcaecati consectetur, explicabo reprehenderit repellat tempore eos ducimus!</p>
            </div>
        </div>
        <div class="col-sm-4 ui-resizable" data-type="container-content">
            <div data-type="component-text">
                <img src="https://i.imgur.com/FbMgjfM.png" width="100%" height="" style="display: inline-block;" class="img-circle img-responsive">
                <h3 style="text-align: center;">Lorem ipsum</h3>
                <p style="text-align: center;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil voluptatibus dicta corrupti aliquam, natus voluptatem pariatur quidem nostrum nisi corporis id ratione exercitationem et recusandae incidunt assumenda soluta qui odit.</p>
            </div>
        </div>
    </div>
</div>

<div data-type="container" data-preview="<?= $base_img; ?>featured_article.png" data-keditor-title="Artigo de Destaque" data-keditor-categories="Texto;Cabeçalho;Imagem">
    <div class="row">
        <div class="col-sm-6" data-type="container-content">
            <div data-type="component-text">
                <div class="photo-panel" style="text-align: center;">
                    <img src="<?= $base_img; ?>photo.png" width="100%" height="" style="display: inline-block; height: 334px; width: 334px;" class="img-responsive img-circle">
                </div>
            </div>
        </div>
        <div class="col-sm-6" data-type="container-content">
            <div data-type="component-text">
                <h3>Lorem ipsum</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi molestias eius quaerat, adipisci ratione aliquid eum explicabo illum temporibus? Optio facilis eveniet quam, impedit eos architecto sequi dolorum illo facere, consequatur sit voluptatibus sunt eius ad officia corrupti modi quia minima voluptas vero. Minus, maxime! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi molestias eius quaerat, adipisci ratione aliquid eum explicabo.</p>
            </div>
        </div>
    </div>
</div>

<!-------------------------------------------------------------------------------------------------->
<!-- Components -->
<!-------------------------------------------------------------------------------------------------->
<div data-type="component-text" data-preview="<?= $base_img; ?>text.png" data-keditor-title="Bloco de Texto" data-keditor-categories="Texto">
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro labore architecto fuga tempore omnis aliquid, rerum numquam deleniti ipsam earum velit aliquam deserunt, molestiae officiis mollitia accusantium suscipit fugiat esse magnam eaque cumque, iste corrupti magni? Illo dicta saepe, maiores fugit aliquid consequuntur aut, rem ex iusto dolorem molestias obcaecati eveniet vel voluptatibus recusandae illum, voluptatem! Odit est possimus nesciunt.</p>
</div>

<div data-type="component-text" data-preview="<?= $base_img; ?>jumbotron.png" data-keditor-title="Jumbotron" data-keditor-categories="Texto;Cabeçalho;Bootstrap">
    <div class="jumbotron">
        <h1>Hello, world!</h1>
        <p>This is a simple hero unit</p>
        <p><a role="button" href="#" class="btn btn-primary btn-lg">Learn more</a></p>
    </div>
</div>

<div data-type="component-audio" data-preview="<?= $base_img; ?>audio.png" data-keditor-title="Audio" data-keditor-categories="Mídia">
    <div class="audio-wrapper">
        <audio src="" controls style="width: 100%"></audio>
    </div>
</div>

<div data-type="component-youtube" data-preview="<?= $base_img; ?>youtube.png" data-keditor-title="YouTube" data-keditor-categories="Mídia">
    <div class="youtube-wrapper">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/P5yHEKqx86U"></iframe>
        </div>
    </div>
</div>

<div data-type="component-vimeo" data-preview="<?= $base_img; ?>vimeo.png" data-keditor-title="Vimeo" data-keditor-categories="Mídia">
    <div class="vimeo-wrapper">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://player.vimeo.com/video/20570767?byline=0&portrait=0&badge=0"></iframe>
        </div>
    </div>
</div>

<div data-type="component-googlemap" data-preview="<?= $base_img; ?>googlemap.png" data-keditor-title="Google Mapa" data-keditor-categories="Mapa">
    <div class="googlemap-wrapper">
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14897.682811563638!2d105.82315895!3d21.0158462!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1456466192755"></iframe>
        </div>
    </div>
</div>

<div data-type="component-text" data-preview="<?= $base_img; ?>thumbnail_panel.png" data-keditor-title="Thumbnail Panel" data-keditor-categories="Texto;Imagem;Bootstrap">
    <div class="thumbnail">
        <img src="https://i.imgur.com/FbMgjfM.png" width="100%" height="" />
        <div class="caption">
            <h3>Thumbnail label</h3>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p>
                <a href="#" class="btn btn-primary" role="button">Button</a>
                <a href="#" class="btn btn-default" role="button">Button</a>
            </p>
        </div>
    </div>
</div>

<div data-type="component-text" data-preview="<?= $base_img; ?>heading_1.png" data-keditor-title="Cabeçalho 1" data-keditor-categories="Texto;Cabeçalho">
    <h1>Heading text 1</h1>
    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
</div>

<div data-type="component-text" data-preview="<?= $base_img; ?>media_panel.png" data-keditor-title="Media Panel" data-keditor-categories="Mídia;Imagem;Bootstrap">
    <div class="media">
        <div class="media-left">
            <a href="#">
                <img class="media-object" src="<?= $base_img; ?>yenbai_vietnam.jpg" width="150" height="" />
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">Media heading</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos minus hic praesentium, nihil nemo, optio delectus explicabo at beatae. Ullam itaque, officiis maxime quibusdam impedit vero?</p>
        </div>
    </div>
</div>

<div data-type="component-text" data-preview="<?= $base_img; ?>media_panel.png" data-keditor-title="Teste" data-keditor-categories="Mídia;Imagem;Bootstrap">
    <a href="#" class="btn btn-info">Botão</a>
</div>


<!-------------------------------------------------------------------------------------------------->
<!-- Widgets -->
<!-------------------------------------------------------------------------------------------------->
<?php foreach ($viewData['widget'] as $widget): ?>
    <div data-type="component-component" data-preview="<?= $widget_img.$widget['widget_alias'].'/thumb.svg';?>" data-keditor-title="<?= $widget['title']; ?>" data-keditor-categories="Componentes">
        <div class="widget" data-widget="<?= $widget['title']; ?>">{{widget|<?= $widget['widget_alias']; ?>|<?= $widget['widget_data']; ?>}}</div>
    </div>
<?php endforeach ?>

<!-------------------------------------------------------------------------------------------------->
<!-- Modules -->
<!-------------------------------------------------------------------------------------------------->
<?php foreach ($viewData['module'] as $module): ?>
    <div data-type="component-component" data-preview="<?= $module_img.$module['module_alias'].'/thumb.svg';?>" data-keditor-title="<?= $module['title']; ?>" data-keditor-categories="Módulos">
        <div class="widget" data-widget="<?= $module['title']; ?>">{{module|<?= $module['module_alias']; ?>|<?= $module['id']; ?>}}</div>
    </div>
<?php endforeach ?>

<!-------------------------------------------------------------------------------------------------->
<!-- System Pages  -->
<!-------------------------------------------------------------------------------------------------->
<div data-type="component-component" data-preview="<?= $base_img; ?>page.svg" data-keditor-title="Página de Ativação" data-keditor-categories="Páginas">
    <div class="container">
        <div class="widget" data-widget="Página de Ativação">{{page|activate}}</div>
    </div>
</div>

<div data-type="component-component" data-preview="<?= $base_img; ?>page.svg" data-keditor-title="Página de Perfil" data-keditor-categories="Páginas">
    <div class="container">
        <div class="widget" data-widget="Página de Perfil">{{page|profile}}</div>
    </div>
</div>

<div data-type="component-component" data-preview="<?= $base_img; ?>page.svg" data-keditor-title="Página de Cadastro" data-keditor-categories="Páginas">
    <div class="container">
        <div class="widget" data-widget="Página de Cadastro">{{page|register}}</div>
    </div>
</div>

<div data-type="component-component" data-preview="<?= $base_img; ?>page.svg" data-keditor-title="Página de Login" data-keditor-categories="Páginas">
    <div class="container">
        <div class="widget" data-widget="Página de Login">{{page|login}}</div>
    </div>
</div>

<div data-type="component-component" data-preview="<?= $base_img; ?>page.svg" data-keditor-title="Página de Pesquisa" data-keditor-categories="Páginas">
    <div class="container">
        <div class="widget" data-widget="Página de Pesquisa">{{page|search}}</div>
    </div>
</div>

<div data-type="component-component" data-preview="<?= $base_img; ?>page.svg" data-keditor-title="Página de Conta" data-keditor-categories="Páginas">
    <div class="container">
        <div class="widget" data-widget="Página de Conta">{{page|account}}</div>
    </div>
</div>