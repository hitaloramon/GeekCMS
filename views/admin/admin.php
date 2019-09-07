<?php 
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title><?php echo $this->config['site_name']; ?> - Painel Administrativo</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Painel Administrativo">
    <meta name="author" content="Hitalo Ramon">
    <link rel="shortcut icon" href="<?php echo BASE; ?>/uploads/<?php echo $this->config['site_favicon']; ?>" type="image/x-icon">
    <link href="<?php echo BASE; ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" data-type="keditor-style">
    <?php echo Asset::outputStyles(); ?>
    <link href="<?php echo BASE; ?>/assets/css/pages/pricing-page.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/plugins/toast/css/jquery.toast.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/css/pages/ribbon-page.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/plugins/jquery-confirm/jquery-confirm.min.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/plugins/jquery-asColorPicker/css/asColorPicker.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/plugins/ruler/ruler.min.css" rel="stylesheet">
    <link href="//cdn.materialdesignicons.com/3.4.93/css/materialdesignicons.min.css" rel="stylesheet" >
    <link href="<?php echo BASE; ?>/assets/plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css" rel="stylesheet" />
    <!-- <link href="<?php echo BASE; ?>/assets/plugins/editor/grapes.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" data-type="keditor-style">
    <link href="<?php echo BASE; ?>/assets/plugins/editor/css/keditor.css" rel="stylesheet" data-type="keditor-style">
    <link href="<?php echo BASE; ?>/assets/plugins/editor/css/keditor-components.css" rel="stylesheet" data-type="keditor-style">
    <link href="<?php echo BASE; ?>/assets/plugins/editor/css/geekeditor.css" rel="stylesheet" data-type="keditor-style">

    <link href="<?php echo BASE; ?>/assets/css/geek.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo BASE; ?>/assets/css/colors/default-dark.css" id="theme" rel="stylesheet">

    <script type="text/javascript"> localStorage.setItem('SITEURL', '<?php echo BASE; ?>');</script>
    <script src="<?php echo BASE; ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/jqueryui/jquery-ui.min.js"></script>
    <script>
        function responsive_filemanager_callback(field_id){
            if(field_id){
                console.log(field_id);
                var url=jQuery('#'+field_id).val();
                //alert('update '+field_id+" with "+url);
                //your code
            }
        }
    </script>
    <?php echo Asset::outputScripts('header'); ?>
    
</head>

<body class="fix-header card-no-border fix-sidebar">

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label"></p>
        </div>
    </div>

    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo BASE_ADMIN; ?>">
                        <b>
                            <!-- Dark Logo icon -->
                            <img src="<?php echo BASE; ?>/assets/images/logo-icon.png" alt="<?php echo $this->config['site_name']; ?>" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?php echo BASE; ?>/assets/images/logo-light-icon.png" alt="<?php echo $this->config['site_name']; ?>" class="light-logo" />
                        </b>
                        <span>
                            <h2 class="dark-logo"><?php echo $this->config['site_name']; ?></h2>
                            <h2 class="light-logo"><?php echo $this->config['site_name']; ?></h2>
                         </span> 
                    </a>
                </div>
               
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu mdi-24px"></i></a> </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="<?php echo BASE; ?>" target="_blank"><i class="mdi mdi-home h5"></i></a></li>
                        <li class="nav-item"><a class="nav-link" onclick="requestFullScreen()"><i class="mdi mdi-fullscreen h5"></i></a></li>

                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-br"></i></a>
                            <div class="dropdown-menu dropdown-menu-right animated bounceInDown"> 
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> 
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> 
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> 
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> 
                            </div>
                        </li> -->

                        <?php 
                            $notification = new Notification(); 
                            $notification = $notification->getNotification(true);
                        ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell-ring"></i>
                                <div class="notify"> <?php echo (is_array($notification)) ? '<span class="heartbit"></span> <span class="point"></span>' : '';?></div>
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown">
                                <ul>
                                    <li>
                                        <div class="drop-title text-center">Notificações</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <?php if(is_array($notification)): foreach ($notification as $n): ?>
                                                <a href="<?php echo BASE_ADMIN.'/notification/view/'.$n['id'];?>">
                                                    <div class="btn btn-<?php echo $n['color'];?> btn-circle"><i class="<?php echo $n['icon']; ?>"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5><?php echo $n['title']; ?></h5> 
                                                        <span class="mail-desc"><?php echo $n['msg']; ?></span> 
                                                    </div>
                                                </a>
                                            <?php endforeach; ?>
                                            <?php else: ?>
                                                <div class="mail-contnet text-center">
                                                    <span class="mail-desc">Sem Notificações</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="<?php echo BASE_ADMIN ?>/notification"> <strong>Ver todas as notificações</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                      
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo BASE_UPLOADS; ?>/users/<?php echo $_SESSION['user_avatar']; ?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?php echo BASE_UPLOADS; ?>/users/<?php echo $_SESSION['user_avatar']; ?>" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?php echo $_SESSION['user_name']; ?></h4>
                                                <p class="text-muted"></p>
                                                <a href="<?php echo BASE_ADMIN ?>/user/edit/<?php echo $_SESSION['user_id']; ?>" class="btn btn-rounded btn-danger btn-sm">Ver Perfil</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo BASE_ADMIN; ?>/logout"><i class="fa fa-power-off"></i> Sair</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="side-mini-panel">
            <ul class="mini-nav">
                <div class="togglediv hidden-sm-down">
                    <a href="javascript:void(0)" id="togglebtn"><i class="mdi mdi-backburger"></i></a>
                </div>
                <li class="<?php menuAdminActive(['', 'financial', 'notification']); ?>">
                    <a href="javascript:void(0)"><i class="mdi mdi-gauge"></i></a>
                    <div class="sidebarmenu">
                        <h3 class="menu-title">Painel</h3>
                        <ul class="sidebar-menu">
                            <li><a href="<?php echo BASE_ADMIN; ?>">Geral</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/financial">Financeiro</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/notification">Notificações</a></li>
                        </ul>
                    </div>
                </li>
                <li class="<?php menuAdminActive(['menu']); ?>"><a href="javascript:void(0)"><i class="mdi mdi-menu"></i></a>
                    <div class="sidebarmenu">
                        <h3 class="menu-title">Menu</h3>
                        <ul class="sidebar-menu">
                            <li><a href="<?php echo BASE_ADMIN; ?>/menu">Gerenciar Menu</a></li>
                        </ul>
                    </div>
                </li>
                <li class="<?php menuAdminActive(['page']); ?>"><a href="javascript:void(0)"><i class="mdi mdi-file-document"></i></a>
                    <div class="sidebarmenu">
                        <h3 class="menu-title">Páginas</h3>
                        <ul class="sidebar-menu">
                            <li><a href="<?php echo BASE_ADMIN; ?>/page/add">Adicionar Página</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/page">Gerenciar Páginas</a></li>
                        </ul>
                    </div>
                </li>
                <li class="<?php menuAdminActive(['module']); ?>"><a href="javascript:void(0)"><i class="mdi mdi-puzzle"></i></a>
                    <div class="sidebarmenu">
                        <h3 class="menu-title">Módulos</h3>
                        <ul class="sidebar-menu">
                            <li><a href="<?php echo BASE_ADMIN; ?>/module">Gerenciar Módulos</a></li>
                        </ul>
                    </div>
                </li>
                <li class="<?php menuAdminActive(['user']); ?>"><a href="javascript:void(0)"><i class="mdi mdi-account-multiple"></i></a>
                    <div class="sidebarmenu">
                        <h3 class="menu-title">Usuários</h3>
                        <ul class="sidebar-menu">
                            <li><a href="<?php echo BASE_ADMIN; ?>/user/add">Adicionar Usuário</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/user">Gerenciar Usuário</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/user/manage">Manutenção</a></li>
                        </ul>
                    </div>
                </li>
                <li class="<?php menuAdminActive(['system', 'membership', 'customfields', 'gateway', 'backup', 'filemanager', 'install', 'emailmodel', 'permissions']); ?>"><a href="javascript:void(0)"><i class="mdi mdi-settings"></i></a>
                    <div class="sidebarmenu">
                        <h3 class="menu-title">Configurações</h3>
                        <ul class="sidebar-menu">
                            <li><a href="<?php echo BASE_ADMIN; ?>/membership">Planos de Acesso</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/customfields">Campos Personalizados</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/gateway">Formas de Pagamento</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/backup">Gerenciar Backups</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/filemanager">Arquivos</a></li>
                            <!-- <li><a href="<?php echo BASE_ADMIN; ?>/install">Instalador de Conteúdo</a></li> -->
                            <li><a href="<?php echo BASE_ADMIN; ?>/emailmodel">Modelo de Emails</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/permissions">Permissões</a></li>
                            <li><a href="<?php echo BASE_ADMIN; ?>/system">Sistema</a></li>
                        </ul>
                    </div>
                </li>
                <li class="<?php menuAdminActive(['trash']); ?>"><a href="javascript:void(0)"><i class="mdi mdi-delete-empty"></i></a>
                    <div class="sidebarmenu">
                        <h3 class="menu-title">Lixeira</h3>
                        <ul class="sidebar-menu">
                            <li><a href="<?php echo BASE_ADMIN; ?>/trash">Gerenciar Lixeira</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>

    <?php $this->loadView($viewName, $viewData); ?>

    <script src="<?php echo BASE; ?>/assets/plugins/mask/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/js/sidebarmenu.js"></script>
    <script src="<?php echo BASE; ?>/assets/js/sidebar.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/toast/js/jquery.toast.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/jquery-confirm/jquery-confirm.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/bootstrap-table/bootstrap-table.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/bootstrap-table/locale/bootstrap-table-pt-BR.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/bootstrap-table/extensions/export/tableExport.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/bootstrap-table/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/chartjs/chart.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/jquery-asColorPicker/libs/jquery-asColor.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/jquery-asColorPicker/libs/jquery-asGradient.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/moment/moment.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/ruler/ruler.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/editor/ckeditor/ckeditor.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/editor/js/keditor.js"></script>
    <script src="<?php echo BASE; ?>/assets/plugins/editor/js/keditor-components.js"></script>
    
    <?php echo Asset::outputScripts('footer'); ?>
    <script src="<?php echo BASE; ?>/assets/js/geekcms.js"></script>
    <script type="text/javascript" data-keditor="script">
        $(function () {
            $('#geekeditor').keditor({
                title: 'Conteúdo',
                snippetsUrl: '<?php echo BASE_ADMIN; ?>/snippetspage',
                containerSettingEnabled: true,
                containerSettingInitFunction: function (form, keditor) {

                        form.append(`
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <a class="btn" data-toggle="collapse" data-target="#spaceCollapse" aria-expanded="false" aria-controls="spaceCollapse">Dimensões</a>
                                </h5>
                                </div>

                                <div id="spaceCollapse" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label>Espaçamento</label>
                                                    <input type="number" class="form-control config-padding" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#backgroundCollapse" aria-expanded="false" aria-controls="backgroundCollapse">Decoração</a>
                                </h5>
                                </div>
                                <div id="backgroundCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="form-horizontal">
                                            <div class="form-group">
                                                <div class="col-sm-12 mb-2">
                                                    <label>Cor de Fundo</label>
                                                    <input type="text" placeholder="Hexadecimal ou RGB" class="form-control config-bg-color" />
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label>Imagem de Fundo</label>
                                                    <input type="text" placeholder="URL da Imagem" class="form-control config-bg-img" />
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label>Repetir</label>
                                                    <select class="config-bg-repeat form-control">
                                                        <option value="no-repeat">Não repetir</option>
                                                        <option value="repeat">Repetir</option>
                                                        <option value="repeat-x">Repetir em X</option>
                                                        <option value="repeat-y">Repetir em Y</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 mb-2">
                                                    <label>Tamanho</label>
                                                    <select class="config-bg-size form-control">
                                                        <option value="auto">Auto</option>
                                                        <option value="cover">Cover</option>
                                                        <option value="contain">Contain</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);

                        // // Padding
                        // form.append(
                        //     '<div class="form-horizontal">' +
                        //     '   <div class="form-group">' +
                        //     '       <div class="col-sm-12">' +
                        //     '           <label>Espaçamento</label>' +
                        //     '           <input type="number" class="form-control config-padding" />' +
                        //     '       </div>' +
                        //     '   </div>' +
                        //     '</div>'
                        // );

                        form.find('.config-padding').on('change', function () {
                            var container = keditor.getSettingContainer();
                            var row = container.find('.row');
                            if (!container.hasClass('keditor-sub-container')) {
                                row = row.filter(function () {
                                    return $(this).parents('.keditor-container').length === 1;
                                });
                            }

                            row.css('padding', this.value + 'px');
                        });

                        
                        // // Background
                        // form.append(
                        //     '<div class="form-horizontal">' +
                        //     '   <div class="form-group">' +
                        //     '       <div class="col-sm-12 mb-2">' +
                        //     '           <label>Cor de Fundo</label>' +
                        //     '           <input type="text" class="form-control config-bg-color" />' +
                        //     '       </div>' +
                        //     '       <div class="col-sm-12 mb-2">' +
                        //     '           <label>Imagem de Fundo</label>' +
                        //     '           <input type="text" placeholder="URL da Imagem" class="form-control config-bg-img" />' +
                        //     '       </div>' +
                        //     '       <div class="col-sm-12 mb-2">' +
                        //     '           <label>Repetir</label>' +
                        //     '           <select class="config-bg-repeat form-control">'+
                        //     '               <option value="no-repeat">Não repetir</option>'+
                        //     '               <option value="repeat">Repetir</option>'+
                        //     '               <option value="repeat-x">Repetir em X</option>'+
                        //     '               <option value="repeat-y">Repetir em Y</option>'+
                        //     '           </select>' +
                        //     '       </div>' +
                        //     '       <div class="col-sm-12 mb-2">' +
                        //     '           <label>Tamanho</label>' +
                        //     '           <select class="config-bg-size form-control">'+
                        //     '               <option value="auto">Auto</option>'+
                        //     '               <option value="cover">Cover</option>'+
                        //     '               <option value="contain">Contain</option>'+
                        //     '           </select>' +
                        //     '       </div>' +
                        //     '   </div>' +
                        //     '</div>'
                        // );

                        form.find('.config-bg-color').on('change', function () {
                            var container = keditor.getSettingContainer();
                            var row = container.find('.row');
                            if (!container.hasClass('keditor-sub-container')) {
                                row = row.filter(function () {
                                    return $(this).parents('.keditor-container').length === 1;
                                });
                            }

                            if(this.value != 'url("")'){
                                row.css('background-color', this.value);
                            }
                        });

                        form.find('.config-bg-img').on('change', function () {
                            var container = keditor.getSettingContainer();
                            var row = container.find('.row');
                            if (!container.hasClass('keditor-sub-container')) {
                                row = row.filter(function () {
                                    return $(this).parents('.keditor-container').length === 1;
                                });
                            }
                        
                            row.css('background-image', 'url('+this.value+')');
                        });

                        form.find('.config-bg-repeat').on('change', function () {
                            var container = keditor.getSettingContainer();
                            var row = container.find('.row');
                            if (!container.hasClass('keditor-sub-container')) {
                                row = row.filter(function () {
                                    return $(this).parents('.keditor-container').length === 1;
                                });
                            }

                            row.css('background-repeat', this.value);
                        });

                        form.find('.config-bg-size').on('change', function () {
                            var container = keditor.getSettingContainer();
                            var row = container.find('.row');
                            if (!container.hasClass('keditor-sub-container')) {
                                row = row.filter(function () {
                                    return $(this).parents('.keditor-container').length === 1;
                                });
                            }
                            
                            row.css('background-size', this.value);
                        });
                    },
                    containerSettingShowFunction: function (form, container, keditor) {
                        var row = container.find('.row');
                        var padding = row.prop('style').padding || '';
                        var padding = padding != '' ? padding.replace('px','') : '';
                        var backgroundColor = row.prop('style').backgroundColor || '';
                        var backgroundImage = row.prop('style').backgroundImage || '';
                        var backgroundImage = backgroundImage != '' ? backgroundImage.match(/\((.*?)\)/)[1].replace(/('|")/g,'') : '';
                        var backgroundRepeat = row.prop('style').backgroundRepeat || '';
                        var backgroundSize = row.prop('style').backgroundSize || '';


                        form.find('.config-padding').val(padding);
                        form.find('.config-bg-color').val(backgroundColor);
                        form.find('.config-bg-img').val(backgroundImage);
                        form.find('.config-bg-repeat').val(backgroundRepeat);
                        form.find('.config-bg-size').val(backgroundSize);
                    },
                    containerSettingHideFunction: function (form, keditor) {
                        form.find('.config-padding').val(0);
                        form.find('.config-bg-color').val('');
                        form.find('.config-bg-img').val('');
                        form.find('.config-bg-repeat').val('');
                        form.find('.config-bg-size').val('');
                    }
            });
        });
    </script>
</body>
</html>