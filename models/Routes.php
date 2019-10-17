<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Routes extends model {

        public function getRoutes(){
            if(file_exists('models/modules/module_route.json')){
                $json = file_get_contents('models/modules/module_route.json');
                $json = json_decode($json, true);
                return $json;
            }else{
                return false;
            }
        }

        public function updateRoutes($module, $router){
            if(file_exists('models/modules/module_route.json')){
                $json = file_get_contents('models/modules/module_route.json');
                $json = json_decode($json, true);
                $json[$module] = $router;
                file_put_contents('models/modules/module_route.json', json_encode($json));
            }
        }
    }
?>