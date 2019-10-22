<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Routes extends model {

        public function getRoutes(){
            if(file_exists('models/route.json')){
                $json = file_get_contents('models/route.json');
                $json = json_decode($json, true);
                return $json;
            }else{
                return false;
            }
        }


        public function updateRoutes($type, $slug, $router){
            if($type == 'pages' || $type == "modules"){
                $router_array = $this->getRoutes();
                $router_array[$type][$slug] = $router;
                file_put_contents('models/route.json', json_encode($router_array, JSON_PRETTY_PRINT));
            }
        }
    }
?>