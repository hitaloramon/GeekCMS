<?php
class adminController extends controller{

    protected $user; 
    protected $permission;

    public function __construct(){
        parent::__construct();

        $this->user = new User();
        $this->permission = new Permissions();
    }

    public function index(){
        $this->user->verifyLogin();

        $data = array();
        $hits = $visits = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        
        $stats = new Stats();
        $data['totalhits'] = $stats->getTotalHits();
        $data['uniquevisits'] = $stats->getUniqueVisits();
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

    public function stats($action = null){
        $this->user->verifyLogin();

        $stats = new Stats();
        switch ($action):
            case 'clear':
                $stats->clearStats();
            break;
            case 'datatable':
                header('Content-type: application/json');
                echo json_encode($stats->getOnlineData());
                exit;
            break;
        endswitch;
    }

    public function page($action = null, int $id = null){
        $this->user->verifyLogin();
        
        $p = new Page();
        $data = array('action' => $action, 'id' => $id);
        
        
        switch ($action):
            case 'add':
                $this->permission->hasPermission('page', 'add');
                if(isset($_POST) && !empty($_POST)){
                    $p->pageInsert($_POST);
                    exit;
                }
            break;
            case 'edit':
                $this->permission->hasPermission('page', 'edit');
                $data['pages'] = $p->getPageByID($id);

                if(isset($_POST) && !empty($_POST)){
                    $p->pageUpdate($_POST, $id);
                    exit; 
                }
            break;
            case 'delete':
                $this->permission->hasPermission('page', 'delete');
                $trash = new Trash();
                $trash->setTrash('pages', $id);
                $p->pageDelete($id);
                exit;
            break;
            case 'datatable':
                header('Content-type: application/json');
                $this->permission->hasPermission('page', 'view');
                $p->getPagesDatatable();
                exit;
            break;
        endswitch;

        $this->permission->hasPermission('page', 'view');
        $this->loadTemplateInAdmin('admin/page', $data);
    }

    
    public function menu($action = null, $id = null){
        $this->user->verifyLogin();

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


        switch ($action):
            case 'edit':
                $this->permission->hasPermission('menu', 'edit');
                $data['menus'] = $menu->getMenuByID($id);

                if(isset($_POST) && !empty($_POST)){
                   $menu->menuUpdate($_POST, $id);
                   exit;
                }
            break;
            case 'delete':
                $this->permission->hasPermission('menu', 'delete');
                $menu->deleteMenu($id);
            break;
            case 'sort':
                $this->permission->hasPermission('menu', 'edit');
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
                    $this->permission->hasPermission('menu', 'add');
                    $menu->menuInsert($_POST);
                    exit;
                }
            break;
        endswitch;

        $this->permission->hasPermission('menu', 'view');
        $this->loadTemplateInAdmin('admin/menu', $data);
    }


    public function notification($action = null, int $id = null){
        $this->user->verifyLogin();
        
        $data = array('action' => $action, 'id' => $id);
        $notification = new Notification();

        switch ($action):
            case 'datatable':
                header('Content-type: application/json');
                $this->permission->hasPermission('notification', 'view');
                $data = $notification->datatable();
                echo json_encode($data);
                exit;
            break;
            case 'delete':
                $this->permission->hasPermission('notification', 'delete');
                $notification->delete($id);
                exit;
            break;
            case 'deleteall':
                $this->permission->hasPermission('notification', 'delete');
                $notification->deleteAll($_POST['data']);
                exit;
            break;
        endswitch;

        $this->permission->hasPermission('notification', 'view');
        $this->loadTemplateInAdmin('admin/notification', $data);
    }

    public function user($action = null, int $id = null){
        $this->user->verifyLogin();
        
        $data = array('action' => $action, 'id' => $id);

        switch ($action):
            case 'edit':
                $this->permission->hasPermission('user', 'edit');
                $data['user'] = $this->user->getUser($id);
                if(isset($_POST) && !empty($_POST)){
                    $this->user->userUpdate($_POST, $id); 
                    exit;
                }
            break;
            case 'add':
                $this->permission->hasPermission('user', 'add');
                if(isset($_POST) && !empty($_POST)){
                    $this->user->userInsert($_POST);
                    exit;
                }
            break;
            case 'manage':
                $this->permission->hasPermission('user', 'delete');
                if(isset($_POST) && !empty($_POST)){
                    $typeuser = $_POST['typeuser'];
                    if(isset($_POST['days'])){
                        $days = intval($_POST['days']);
                    }else{
                        $days = null;
                    }
                    $this->user->userManageDelete($typeuser, $days);
                    exit;
                }
            break;
            case 'delete':
                $this->permission->hasPermission('user', 'delete');
                $trash = new Trash();
                $trash->setTrash('users', $id);
                $this->user->userDelete($id);
                exit;
            break;
            case 'datatable':
                header('Content-type: application/json');
                $this->permission->hasPermission('user', 'view');
                $this->user->getUserDatatable();
                exit;
            break;
        endswitch;

        $this->permission->hasPermission('user', 'view');
        $this->loadTemplateInAdmin('admin/user', $data);
    }

    public function module($action = null, $module = null, $mod_action = null, $mod_id = null){
        $this->user->verifyLogin();


        $data = array(
            'action'     => $action,
            'module'     => $module,
            'mod_action' => $mod_action,
            'mod_id'     => $mod_id
        );


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
                
                Asset::add('script', [
                    'name'    => 'filterizr',
                    'url'  => ''.BASE.'/assets/plugins/filterizr/jquery.filterizr.min.js',
                    'footer'  => true
                ]);

                $this->permission->hasPermission('module', 'view');
                $modules = new Modules();
                $data['modules'] = $modules->getModules();
            break;
        endswitch;

        $this->permission->hasPermission('module', 'view');
        $this->loadTemplateInAdmin('admin/module', $data);
    }


    public function membership($action = null, int $id = null){
        $this->user->verifyLogin();

        $data = array('action' => $action);
        $memberships = new Memberships();

        switch ($action):
            case 'edit':
                $this->permission->hasPermission('membership', 'edit');
                $data['memberships'] = $memberships->getMembershipByID($id);
                if(isset($_POST) && !empty($_POST)){
                    $memberships->membershipUpdate($_POST, $id); 
                    exit;
                }
            break;
            case 'add':
                $this->permission->hasPermission('membership', 'add');
                if(isset($_POST) && !empty($_POST)){
                    $memberships->membershipInsert($_POST); 
                    exit;
                }
            break;
            case 'delete':
                $this->permission->hasPermission('membership', 'delete');
                $memberships->membershipDelete($id);
            break;
            default:
                $data['memberships'] = $memberships->getMemberships();
            break;
        endswitch;
        
        $this->permission->hasPermission('membership', 'view');
        $this->loadTemplateInAdmin('admin/membership', $data);
    }


    public function filemanager($action = null, int $id = null){
        $this->user->verifyLogin();
        $data = array('action' => $action);

        $this->permission->hasPermission('filemanager', 'view');
        $this->loadTemplateInAdmin('admin/filemanager', $data);
    }


    public function permissions($action = null, int $id = null){
        $this->user->verifyLogin();

        $data = array('action' => $action);

        switch ($action):
            case 'edit':
                $this->permission->hasPermission('permission', 'edit');
                $data['groups'] = $this->permission->getGroups($id);
                $data['params_action'] = $this->permission->getAction($id);
                $data['params'] = $this->permission->getParams();
                if(isset($_POST) && !empty($_POST)){
                    $this->permission->addParams($id, $_POST);
                    exit;
                }
            break;
            case 'add':
                $this->permission->hasPermission('permission', 'add');
                $this->permission->addGroup();
                header('Location: '.BASE_ADMIN.'/permissions');
            break;
            case 'delete':
                $this->permission->hasPermission('permission', 'delete');
                $this->permission->groupDelete($id);
                header('Location: '.BASE_ADMIN.'/permissions');
            break;
            default:
                $data['groups'] = $this->permission->getGroups();
            break;
        endswitch;

        $this->permission->hasPermission('permission', 'view');
        $this->loadTemplateInAdmin('admin/permissions', $data);
    }


    public function backup($action = null, $file = null){
        $this->user->verifyLogin();

        $data = array('action' => $action);
        $backup = new Backup();

        switch ($action):
            case 'add':
                $this->permission->hasPermission('backup', 'add');
                $folder = "backup/";
                $archive_name = date('d-m-Y_H-i') . ".sql";
                $archive = $folder . '/' . $archive_name;
                $open = fopen("{$archive}", "w");
                fwrite($open, $backup->backupSystem());
                header('Location: '.BASE_ADMIN.'/backup');
            break;
            case 'restore':
                $this->permission->hasPermission('backup', 'edit');
                if($backup->import('backup/'.$file) == true){
                    $json['heading'] = "Sucesso";
                    $json['text'] =  "Banco de dados restaurado com sucesso!";
                    $json['icon'] = 'success';
                    echo json_encode($json);
                }
            break;
            case 'delete':
                $this->permission->hasPermission('backup', 'delete');
                unlink('backup/'.$file);
                header('Location: '.BASE_ADMIN.'/backup');
            break;
        endswitch;

        $this->permission->hasPermission('backup', 'view');
        $this->loadTemplateInAdmin('admin/backup', $data);
    }


    public function emailmodel($id = 1){
        $this->user->verifyLogin();

        $data = array('id' => $id);
        $emailmodel = new EmailModel();

        $data['allmodel'] = $emailmodel->getModel();
        $data['model'] = $emailmodel->getModel($id);

        if(isset($_POST) && !empty($_POST)){
            $this->permission->hasPermission('emailmodel', 'edit');
            $emailmodel->update($_POST, $id);
            exit;
        }

        $this->permission->hasPermission('emailmodel', 'view');
        $this->loadTemplateInAdmin('admin/emailmodel', $data);
    }


    public function system($action = null, $file = null){
        $this->user->verifyLogin();

        $data = array('action' => $action);
        $config = new Config();

        if(isset($_POST) && !empty($_POST)){
            $this->permission->hasPermission('system', 'edit');
            $config->saveConfig($_POST);
            exit;
        }else{
            $data['social'] = $config->getSocial();
        }

        $data['transaction_notify'] = explode(',', $this->config['transaction_notify']);

        $this->permission->hasPermission('system', 'view');
        $this->loadTemplateInAdmin('admin/system', $data);
    }
    

    public function customfields($action = null, $id = null){
        $this->user->verifyLogin();

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

        switch ($action):
            case 'edit':
                $this->permission->hasPermission('customfield', 'edit');
                $data['fields'] = $fields->getFields($id);

                if(isset($_POST) && !empty($_POST)){
                    $fields->fieldUpdate($_POST, $id);
                    exit;
                }
            break;
            case 'delete':
                $this->permission->hasPermission('customfield', 'delete');
                $fields->fieldDelete($id);
            break;
            case 'add':
            default:
                if(isset($_POST) && !empty($_POST)){
                    $this->permission->hasPermission('customfield', 'add');
                    $fields->fieldInsert($_POST);
                    exit;
                }
            break;
        endswitch;

        $this->permission->hasPermission('customfield', 'view');
        $this->loadTemplateInAdmin('admin/customfields', $data);
    }


    public function gateway($action = null, $dir = null){
        $this->user->verifyLogin();

        $data = array('action' => $action);
        $gateways = new Gateways();
        
        switch ($action):
            case 'config':
                $dir = addslashes($dir);
                $this->permission->hasPermission('gateway', 'edit');
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

        $this->permission->hasPermission('gateway', 'view');
        $this->loadTemplateInAdmin('admin/gateway', $data);
    }


    public function financial($action = null, $id = null){
        $this->user->verifyLogin();

        $data = array('action' => $action);
        $transactions = new Transactions();
        
        $data['paid'] = $transactions->getPaid();
        $data['today'] = $transactions->getToday();
        $data['total'] = $transactions->getTotal();
        $data['pending'] = $transactions->getPending();

        switch ($action):
            case 'datatable':
                header('Content-type: application/json');
                $this->permission->hasPermission('financial', 'view');
                $transactions->getDatatable();
                exit;
            break;
        endswitch;

        $this->permission->hasPermission('financial', 'view');
        $this->loadTemplateInAdmin('admin/financial', $data);
    }

    public function trash($action = null, $id = null){
        $this->user->verifyLogin();

        $data = array('action' => $action);
        $trash = new Trash();

        switch ($action):
            case 'restore':
                $this->permission->hasPermission('trash', 'edit');
                $trash->restore($id);
                exit;
            break;
            case 'delete':
                $this->permission->hasPermission('trash', 'delete');
                $trash->delete($id);
                exit;
            break;
            case 'clean':
                $this->permission->hasPermission('trash', 'delete');
                $trash->clean();
                header('Location: '.BASE_ADMIN.'/trash');
                exit;
            break;
            default:
                $data['trash_pages'] = $trash->getTrash('pages');
                $data['trash_users'] = $trash->getTrash('users');
            break;
        endswitch;

        $this->permission->hasPermission('trash', 'view');
        $this->loadTemplateInAdmin('admin/trash', $data);
    }

    public function login(){
        $data = array('error' => '');

        if(isset($_POST['email']) && !empty($_POST['email'])){


            $data = json_decode($this->user->loginCheck($_POST), true);

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

    public function snippets($action = null){
        $this->user->verifyLogin();

        if($action == 'email'){
            $this->loadSnippets('snippetsemail');
        }else{
            $widget = new Widget();
            $module = new Modules();
            $data['widget'] = $widget->getWidget();
            $data['module'] = $module->getModules(true);

            $this->loadSnippets('snippets', $data);
        }
    }
}
?>