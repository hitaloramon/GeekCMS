<?php
class adminController extends controller{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $u = new User();
        $u->verifyLogin();

        $data = $array = array();
        $hits = $visits = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        
        $stats = new Stats();
        $data['totalhits'] = $stats->getTotalHits();
        $data['uniquevisits'] = $stats->getUniqueVisits();
        $data['online'] = $stats->getOnline();
        $data['today'] = $stats->getVisitsToday();
        $data['browser'] = $stats->getStatsBrowser();
        $data['device'] = $stats->getStatsDevice();

        foreach ($stats->getStats() as $statsData) {
            $hits[$statsData['idMonth'] - 1] = $statsData['hits'];
            $visits[$statsData['idMonth'] - 1] = $statsData['visits'];
        }

        $data['statsHits'] = json_encode($hits);
        $data['statsVisits'] = json_encode($visits);

        $this->loadTemplateInAdmin('admin/home', $data);
    }

    public function clearstats(){
        $u = new User();
        $u->verifyLogin();

        $stats = new Stats();
        $stats->clearStats();
    }

    public function layout($id = null){
        $u = new User();
        $u->verifyLogin();

        $layout = new Layout;
        $permission = new Permissions();

        if(isset($_POST) && !empty($_POST)){
            switch ($_GET['action']) {
                case 'load':
                    $pageid = intval($_POST['page_id']);
                    $pos = $_POST['position'];
                    
                    $widgetrow = $layout->load($pageid);

                    if (is_array($widgetrow)){
                        print '<div id="plavailable" class="row mb40">';
                            foreach ($widgetrow as $mrow):
                            print '<div class="col-md-6"><a data-id="'.$mrow['id'].'" data-alias="'.$mrow['widget_alias'].'" data-position="'.$pos.'" class="list plugin-list">'.$mrow['title'].'</a></div>';
                            endforeach;
                        print '<div>';
                    }else{
                        print 'Sem Widgets';
                    }
                break;
                case 'columm':
                    $permission->hasPermission('layout', 'edit');
                    $plug_id = intval($_POST['id']);
                    $cols = intval($_POST['cols']);
                    $page_id = intval($_POST['page_id']);
                    $data = array('space' => $cols);
                    
                    $layout->layoutUpdate($data, $plug_id, $page_id);
                break;
                case 'allpages':
                    $permission->hasPermission('layout', 'edit');
                    $page_id = intval($_POST['page_id']);
                    $place = $_POST['place'];

                    $Pages = $layout->getConfigPage($page_id);
                    foreach ($Pages as $p) {
                        $Layout = $layout->getConfigAllPages($page_id, $place);
                        if(!empty($Layout)){
                            foreach ($Layout as $L) {
                                $data = array(
                                    'plug_id' => $L['plug_id'],
                                    'page_id' => $p['id'],
                                    'page_slug' => $p['slug'], //  slug talvez não será necessário. assim como o is_content na tabela
                                    'place' => $L['place'],
                                    'plug_name' => $L['plug_name'],
                                    'space' => $L['space'],
                                    'position' => $L['position']
                                );

                                $layout->layoutDelete(["plug_id = ?" => $L['plug_id'], "page_id = ?" => $p['id'], "place = ?" => $place]);
                                $layout->layoutInsert($data);
                            }
                        }else{
                            $layout->layoutDelete(["page_id = ?" => $p['id']]);
                        }

                    }

                    $json['heading'] = "Sucesso";
                    $json['text'] =  "Configuração aplicada com sucesso!";
                    $json['icon'] = 'success';
                    echo json_encode($json);
                break;
                case 'delete':
                    $permission->hasPermission('layout', 'delete');
                    $plug_id = intval($_POST['id']);
                    $page_id = intval($_POST['page_id']);
                    $layout->layoutDelete(['plug_id = ?' => $plug_id, 'page_id = ?' => $page_id]);
                break;
                default:
                    $permission->hasPermission('layout', 'edit');
                    $sort = $_GET['layout'];
                    @$sorted = str_replace("list-", "", $_POST[$sort]);

                    if($sorted){
                        foreach ($sorted as $plug_id){
                            list($order, $plug_id, $alias, $space) = explode("|", $plug_id);
                            $stylename = explode("-", $sort);
                            $page_id = $stylename[1];

                            $data = array(
                                'plug_id' => $plug_id,
                                'page_id' => (isset($_GET['pageslug'])) ? $page_id : 0,
                                'page_slug' => (isset($_GET['pageslug'])) ? $_GET['pageslug'] : NULL,
                                'place' => $stylename[0],
                                'position' => $order,
                                'space' => $space
                            );
                        
                            //$layout->layoutDelete(['plug_id = ?' => $plug_id, 'page_id = ?' => $page_id]);
                            $layout->layoutInsert($data);
                        };
                    };
                break;
            }
        }else{
            $id = ($id == null) ? 1 : $id ;

            $result = $layout->getLayout($id);
            $data = array('pageid' => (int)$id, 'layout' => $result);
            $this->loadTemplateInAdmin('admin/layout', $data);
        }
    }



    public function page($action = null, int $id = null){
        $u = new User();
        $u->verifyLogin();
        
        $p = new Page();
        $data = array('action' => $action, 'id' => $id);
        
        $permission = new Permissions();
        
        switch ($action):
            case 'add':
                $permission->hasPermission('page', 'add');
                if(isset($_POST) && !empty($_POST)){
                    $p->pageInsert($_POST);
                    exit;
                }
            break;
            case 'edit':
                $permission->hasPermission('page', 'edit');
                $data['pages'] = $p->getPageByID($id);

                if(isset($_POST) && !empty($_POST)){
                    $p->pageUpdate($_POST, $id);
                    exit; 
                }
            break;
            case 'delete':
                $permission->hasPermission('page', 'delete');
                $trash = new Trash();
                $trash->setTrash('pages', $id);
                $p->pageDelete($id);
                exit;
            break;
            case 'datatable':
                $permission->hasPermission('page', 'view');
                $p->getPagesDatatable();
                exit;
            break;
        endswitch;

        $permission->hasPermission('page', 'view');
        $this->loadTemplateInAdmin('admin/page', $data);
    }

    
    public function menu($action = null, $id = null){
        $u = new User();
        $u->verifyLogin();

        Asset::add('style', [
            'name' => 'nestable',
            'url'  => ''.BASE.'/assets/plugins/nestable/nestable.css'
        ]);

        Asset::add('script', [
            'name'   => 'nestable',
            'url'    => ''.BASE.'/assets/plugins/nestable/jquery.nestable.js',
            'footer' => true
        ]);
        
        $data = array('action' => $action);
        $menu = new Menu();

        $permission = new Permissions();

        switch ($action):
            case 'edit':
                $permission->hasPermission('menu', 'edit');
                $data['menus'] = $menu->getMenuByID($id);

                if(isset($_POST) && !empty($_POST)){
                   $menu->menuUpdate($_POST, $id);
                   exit;
                }
            break;
            case 'delete':
                $permission->hasPermission('menu', 'delete');
                $menu->deleteMenu($id);
            break;
            case 'sort':
                $permission->hasPermission('menu', 'edit');
                $menu->menuProcess($_POST['menu']);
                
                $json['heading'] = "Sucesso";
                $json['text'] =  "Menus atualizados com sucesso!";
                $json['icon'] = 'success';
                echo json_encode($json);
                exit;
            break;
            case 'add':
            default:
                if(isset($_POST) && !empty($_POST)){
                    $permission->hasPermission('menu', 'add');
                    $menu->menuInsert($_POST);
                    exit;
                }
            break;
        endswitch;

        $permission->hasPermission('menu', 'view');
        $this->loadTemplateInAdmin('admin/menu', $data);
    }


    public function notification($action = null, int $id = null){
        $u = new User();
        $u->verifyLogin();
        
        $data = array('action' => $action, 'id' => $id);
        $notification = new Notification();
        $permission = new Permissions();

        switch ($action):
            case 'datatable':
                $permission->hasPermission('notification', 'view');
                $data = $notification->datatable();
                echo json_encode($data);
                exit;
            break;
            case 'delete':
                $permission->hasPermission('notification', 'delete');
                $notification->delete($id);
                exit;
            break;
            case 'deleteall':
                $permission->hasPermission('notification', 'delete');
                $notification->deleteAll($_POST['data']);
                exit;
            break;
        endswitch;

        $permission->hasPermission('notification', 'view');
        $this->loadTemplateInAdmin('admin/notification', $data);
    }

    public function user($action = null, int $id = null){
        $u = new User();
        $u->verifyLogin();
        
        $data = array('action' => $action, 'id' => $id);

        $permission = new Permissions();

        switch ($action):
            case 'edit':
                $permission->hasPermission('user', 'edit');
                $data['user'] = $u->getUser($id);
                if(isset($_POST) && !empty($_POST)){
                    $u->userUpdate($_POST, $id); 
                    exit;
                }
            break;
            case 'add':
                $permission->hasPermission('user', 'add');
                if(isset($_POST) && !empty($_POST)){
                    $u->userInsert($_POST);
                    exit;
                }
            break;
            case 'manage':
                $permission->hasPermission('user', 'delete');
                if(isset($_POST) && !empty($_POST)){
                    $typeuser = $_POST['typeuser'];
                    if(isset($_POST['days'])){
                        $days = intval($_POST['days']);
                    }else{
                        $days = null;
                    }
                    $u->userManageDelete($typeuser, $days);
                    exit;
                }
            break;
            case 'delete':
                $permission->hasPermission('user', 'delete');
                $trash = new Trash();
                $trash->setTrash('users', $id);
                $u->userDelete($id);
                exit;
            break;
            case 'datatable':
                $permission->hasPermission('user', 'view');
                $u->getUserDatatable();
                exit;
            break;
        endswitch;

        $permission->hasPermission('user', 'view');
        $this->loadTemplateInAdmin('admin/user', $data);
    }

    public function widget($action = null, $id = null){
        $u = new User();
        $u->verifyLogin();
        
        $data = array('action' => $action);

        $widget = new Widget();
        $permission = new Permissions();

        switch ($action):
            case 'add':
                $permission->hasPermission('widget', 'add');
                if(isset($_POST) && !empty($_POST)){
                    $widget->widgetInsert($_POST);
                    exit;
                }
            break;
            case 'edit':
                $permission->hasPermission('widget', 'edit');
                $data['widget'] = $widget->getWidget($id);
                if(isset($_POST) && !empty($_POST)){
                    $widget->widgetUpdate($_POST, $id);
                    exit;
                }
            break;
            case 'delete':
                $permission->hasPermission('widget', 'delete');
                $widget->widgetDelete($id);
                exit;
            break;
            case 'view':
                $permission->hasPermission('widget', 'edit');
                if(file_exists('views/admin/widget/'.$id.'/main_admin.php')){
                    $data['widget'] = $widget;

                    if(isset($_POST) && !empty($_POST)){
                        echo 'HITALO RAMON';
                        exit;
                    }
                }else{
                    header('Location:'.BASE.'/404.php');
                }
            break;
            case 'datatable':
                $permission->hasPermission('widget', 'view');
                $widget->getWidgetDataTable();
                exit;
            break;
        endswitch;

        $permission->hasPermission('widget', 'view');
        $this->loadTemplateInAdmin('admin/widget', $data);
    }

    public function module($action = null, $module = null, $mod_action = null, $mod_id = null){
        $u = new User();
        $u->verifyLogin();

        Asset::add('script', [
            'name'    => 'filterizr',
            'url'  => ''.BASE.'/assets/plugins/filterizr/jquery.filterizr.min.js',
            'footer'  => true
        ]);

        $data = array(
            'action'     => $action,
            'module'     => $module,
            'mod_action' => $mod_action,
            'mod_id'     => $mod_id
        );

        $permission = new Permissions();

        switch ($action):
            case 'view':
                if(file_exists('views/admin/modules/'.$module.'/main_admin.php')){
                    if(file_exists('views/admin/modules/'.$module.'/controller.php')){
                        require_once 'views/admin/modules/'.$module.'/controller.php';
                    }
                    $data['module'] = $module;
                }else{
                    header('Location:'.BASE.'/404.php');
                }
            break;
            default:
                $permission->hasPermission('module', 'view');
                $modules = new Modules();
                $data['modules'] = $modules->getModules();
            break;
        endswitch;

        $permission->hasPermission('module', 'view');
        $this->loadTemplateInAdmin('admin/module', $data);
    }


    public function membership($action = null, int $id = null){
        $u = new User();
        $u->verifyLogin();

        $data = array('action' => $action);
        $memberships = new Memberships();
        $permission = new Permissions();

        switch ($action):
            case 'edit':
                $permission->hasPermission('membership', 'edit');
                $data['memberships'] = $memberships->getMembershipByID($id);
                if(isset($_POST) && !empty($_POST)){
                    $memberships->membershipUpdate($_POST, $id); 
                    exit;
                }
            break;
            case 'add':
                $permission->hasPermission('membership', 'add');
                if(isset($_POST) && !empty($_POST)){
                    $memberships->membershipInsert($_POST); 
                    exit;
                }
            break;
            case 'delete':
                $permission->hasPermission('membership', 'delete');
                $memberships->membershipDelete($id);
            break;
            default:
                $data['memberships'] = $memberships->getMemberships();
            break;
        endswitch;
        
        $permission->hasPermission('membership', 'view');
        $this->loadTemplateInAdmin('admin/membership', $data);
    }


    public function filemanager($action = null, int $id = null){
        $u = new User();
        $u->verifyLogin();
        $data = array('action' => $action);
        $permission = new Permissions();

        $permission->hasPermission('filemanager', 'view');
        $this->loadTemplateInAdmin('admin/filemanager', $data);
    }


    public function permissions($action = null, int $id = null){
        $u = new User();
        $u->verifyLogin();

        $data = array('action' => $action);
        $permission = new Permissions();

        switch ($action):
            case 'edit':
                $permission->hasPermission('permission', 'edit');
                $data['groups'] = $permission->getGroups($id);
                $data['params_action'] = $permission->getAction($id);
                $data['params'] = $permission->getParams();
                if(isset($_POST) && !empty($_POST)){
                    $permission->addParams($id, $_POST);
                    exit;
                }
            break;
            case 'add':
                $permission->hasPermission('permission', 'add');
                $permission->addGroup();
                header('Location: '.BASE_ADMIN.'/permissions');
            break;
            case 'delete':
                $permission->hasPermission('permission', 'delete');
                $permission->groupDelete($id);
                header('Location: '.BASE_ADMIN.'/permissions');
            break;
            default:
                $data['groups'] = $permission->getGroups();
            break;
        endswitch;

        $permission->hasPermission('permission', 'view');
        $this->loadTemplateInAdmin('admin/permissions', $data);
    }


    public function backup($action = null, $file = null){
        $u = new User();
        $u->verifyLogin();

        $data = array('action' => $action);
        $backup = new Backup();
        $permission = new Permissions();

        switch ($action):
            case 'add':
                $permission->hasPermission('backup', 'add');
                $folder = "backup/";
                $archive_name = date('d-m-Y_H-i') . ".sql";
                $archive = $folder . '/' . $archive_name;
                $open = fopen("{$archive}", "w");
                fwrite($open, $backup->backupSystem());
                header('Location: '.BASE_ADMIN.'/backup');
            break;
            case 'restore':
                $permission->hasPermission('backup', 'edit');
                if($backup->import('backup/'.$file) == true){
                    $json['heading'] = "Sucesso";
                    $json['text'] =  "Banco de dados restaurado com sucesso!";
                    $json['icon'] = 'success';
                    echo json_encode($json);
                }
            break;
            case 'delete':
                $permission->hasPermission('backup', 'delete');
                unlink('backup/'.$file);
                header('Location: '.BASE_ADMIN.'/backup');
            break;
        endswitch;

        $permission->hasPermission('backup', 'view');
        $this->loadTemplateInAdmin('admin/backup', $data);
    }


    public function emailmodel($id = 1){
        $u = new User();
        $u->verifyLogin();

        $data = array('id' => $id);
        $permission = new Permissions();
        $emailmodel = new EmailModel();

        $data['allmodel'] = $emailmodel->getModel();
        $data['model'] = $emailmodel->getModel($id);

        if(isset($_POST) && !empty($_POST)){
            //$permission->hasPermission('emailmodel', 'edit');
            $emailmodel->update($_POST, $id);
            exit;
        }

        //$permission->hasPermission('system', 'view');
        $this->loadTemplateInAdmin('admin/emailmodel', $data);
    }


    public function system($action = null, $file = null){
        $u = new User();
        $u->verifyLogin();

        $data = array('action' => $action);
        $config = new Config();
        $permission = new Permissions();

        if(isset($_POST) && !empty($_POST)){
            $permission->hasPermission('system', 'edit');
            $config->saveConfig($_POST);
            exit;
        }else{
            $data['social'] = $config->getSocial();
        }

        $data['transaction_notify'] = explode(',', $this->config['transaction_notify']);

        $permission->hasPermission('system', 'view');
        $this->loadTemplateInAdmin('admin/system', $data);
    }
    

    public function customfields($action = null, $id = null){
        $u = new User();
        $u->verifyLogin();

        Asset::add('style', [
            'name' => 'nestable',
            'url'  => ''.BASE.'/assets/plugins/nestable/nestable.css'
        ]);

        Asset::add('script', [
            'name'   => 'nestable',
            'url'    => ''.BASE.'/assets/plugins/nestable/jquery.nestable.js',
            'footer' => true
        ]);

        $data = array('action' => $action);
        $fields = new CustomFields();
        $permission = new Permissions();

        switch ($action):
            case 'edit':
                $permission->hasPermission('customfield', 'edit');
                $data['fields'] = $fields->getFields($id);

                if(isset($_POST) && !empty($_POST)){
                    $fields->fieldUpdate($_POST, $id);
                    exit;
                }
            break;
            case 'delete':
                $permission->hasPermission('customfield', 'delete');
                $fields->fieldDelete($id);
            break;
            case 'add':
            default:
                if(isset($_POST) && !empty($_POST)){
                    $permission->hasPermission('customfield', 'add');
                    $fields->fieldInsert($_POST);
                    exit;
                }
            break;
        endswitch;

        $permission->hasPermission('customfield', 'view');
        $this->loadTemplateInAdmin('admin/customfields', $data);
    }


    public function gateway($action = null, $dir = null){
        $u = new User();
        $u->verifyLogin();

        $data = array('action' => $action);
        $gateways = new Gateways();
        $permission = new Permissions();
        
        switch ($action):
            case 'config':
                $dir = addslashes($dir);
                $permission->hasPermission('gateway', 'edit');
                if(isset($_POST) && !empty($_POST)){
                    $gateways->saveGateway($_POST, $dir);
                    exit;
                }
                $data['gateways'] = $gateways->getGateway($dir);
            break;
            default:
                $data['gateways'] = $gateways->getGateway();
            break;
        endswitch;

        $permission->hasPermission('gateway', 'view');
        $this->loadTemplateInAdmin('admin/gateway', $data);
    }


    public function financial($action = null, $id = null){
        $u = new User();
        $u->verifyLogin();

        $data = array('action' => $action);
        $permission = new Permissions();
        $transactions = new Transactions();
        
        $data['paid'] = $transactions->getPaid();
        $data['today'] = $transactions->getToday();
        $data['total'] = $transactions->getTotal();
        $data['pending'] = $transactions->getPending();

        switch ($action):
            case 'datatable':
                $permission->hasPermission('financial', 'view');
                $transactions->getDatatable();
                exit;
            break;
        endswitch;

        $permission->hasPermission('financial', 'view');
        $this->loadTemplateInAdmin('admin/financial', $data);
    }

    public function trash($action = null, $id = null){
        $u = new User();
        $u->verifyLogin();

        $data = array('action' => $action);
        $trash = new Trash();
        $permission = new Permissions();

        switch ($action):
            case 'restore':
                $permission->hasPermission('trash', 'edit');
                $trash->restore($id);
                exit;
            break;
            case 'delete':
                $permission->hasPermission('trash', 'delete');
                $trash->delete($id);
                exit;
            break;
            case 'clean':
                $permission->hasPermission('trash', 'delete');
                $trash->clean();
                header('Location: '.BASE_ADMIN.'/trash');
                exit;
            break;
            default:
                $data['trash_pages'] = $trash->getTrash('pages');
                $data['trash_users'] = $trash->getTrash('users');
            break;
        endswitch;

        $permission->hasPermission('trash', 'view');
        $this->loadTemplateInAdmin('admin/trash', $data);
    }

    public function login(){
        $data = array('error' => '');

        if(isset($_POST['login']) && !empty($_POST['login'])){
            $u = new User();
            $data = json_decode($u->loginCheck($_POST), true);

            if($data['icon'] == 'success'){
                header('Location: '.BASE_ADMIN);
            }else{
                $data['error'] = $data['text'];
            }
        }

        $this->loadView('admin/login', $data);
    }

    public function logout(){
        session_destroy();
        header('Location: '.BASE_ADMIN);
    }

    public function snippetspage(){
        $u = new User();
        $u->verifyLogin();

        $widget = new Widget();
        $data = $widget->getWidget();

        $this->loadSnippets('snippets', $data);
    }

    public function snippetsemail(){
        $u = new User();
        $u->verifyLogin();

        $this->loadSnippets('snippets');
    }
}
?>