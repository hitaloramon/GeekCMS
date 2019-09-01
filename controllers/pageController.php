<?php
class pageController extends controller {

    public function __construct(){
        parent::__construct();

        if($this->config['maintenance'] == 1 && !isset($_SESSION['user_group'])){
            include 'views/front/maintenance.php';
            exit;
        }
    }

    public function index($url = null){
        $data = array();
        $p = new Page();
        $data = $p->getPage($url);
        
        $stats = new Stats();
        $stats->setStats();

        if($this->config['site_enable_ssl'] == true){
            if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
                $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                header("Location: $url");
                exit;
            }
        }
        
        $this->loadTemplate($data);
    }
}
?>