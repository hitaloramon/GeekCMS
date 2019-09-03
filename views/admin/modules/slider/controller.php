<?php
    if (!defined("_VALID_PHP")){
        die('Acesso Direto Negado');
    }
?>
<?php
    Asset::add('style', [
        'name' => 'myslider_constructor',
        'url'  => ''.BASE.'/views/admin/modules/slider/assets/css/myslider_constructor.min.css',
    ]);

    Asset::add('script', [
        'name'    => 'myslider_constructor',
        'url'  => ''.BASE.'/views/admin/modules/slider/assets/js/myslider_constructor.min.js?v=2.1.1',
        'footer'  => false
    ]);
    
   $this->permission->hasPermission('mod/slider', 'view');
    switch ($mod_action) {
        case 'upload':
           $this->permission->hasPermission('mod/slider', 'edit');
            require_once 'actions/uploadController.php';
            $upload = new uploadController();
            $upload->run();
            $upload->printOutput();
            exit;
        break;
        case 'item':
           $this->permission->hasPermission('mod/slider', 'view');
            require_once 'actions/itemController.php';
            $save = new itemController();
            $save->run();
            $save->printOutput();
            exit;
        break;
        case 'save':
           $this->permission->hasPermission('mod/slider', 'add');
            require_once 'actions/saveController.php';
            $save = new saveController();
            $save->run();
            $save->printOutput();
            exit;
        break;
        case 'resize':
           $this->permission->hasPermission('mod/slider', 'edit');
            require_once 'actions/resizeController.php';
            $resize = new resizeController();
            $resize->run();
            $resize->printOutput();
            exit;
        break;
        case 'getfiles':
           $this->permission->hasPermission('mod/slider', 'edit');
            require_once 'actions/getfilesController.php';
            $getfiles = new getfilesController();
            $getfiles->run();
            $getfiles->printOutput();
            exit;
        break;
        case 'icons':
            header('Content-Type: application/json');

            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );  

            $icons = file_get_contents("".BASE."/views/admin/modules/slider/icons.json", false, stream_context_create($arrContextOptions));
            echo $icons;
            exit;
        break;
    }
?>