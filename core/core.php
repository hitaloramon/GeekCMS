<?php
    class core {

        private $currentController;
        private $currentAction;

        public function run(){
            $url = explode('index.php', $_SERVER['PHP_SELF']);
            $url = end($url);
            
            $params = array();
            if(!empty($url)){
                $url = explode('/', $url);
                array_shift($url);

                $currentController = $url[0].'Controller';
                array_shift($url);

                if(isset($url[0])){
                    $currentAction = $url[0];
                    array_shift($url);
                }else{
                    $currentAction = 'index';
                }

                if(count($url) > 0){
                    $params = $url;
                }
            }else{
                $currentController = 'pageController';
                $currentAction = 'index';
            }

            if(file_exists('controllers/'.$currentController.'.php')){
                $c = new $currentController();
            }else{
                $c = new pageController();
                $currentAction = 'index';
                $pageName = explode('Controller', $currentController);
                $pageName = $pageName[0];
                $params = array($pageName);
            }

            //call_user_func_array(array($c, $currentAction), $params);
            
            if(method_exists($currentController, $currentAction)){
                call_user_func_array(array($c, $currentAction), $params);
            }else{
                if($currentAction == 'index'){
                    call_user_func_array(array($c, $currentAction), $params);
                }else{
                    header('Location: '.BASE.'/404.php');
                }
                
            }
            
        }

    }
?>