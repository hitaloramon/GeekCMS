<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Config extends model{

        public function getConfig(){
            $array = array();

            $result = $this->db->fetchAll('SELECT * FROM `config`');

            if($result > 0){
                foreach ($result as $c) {
                   $array[$c['name']] = $c['value'];
                }
            }
            return $array;
        }


        public function getSocial(){
            $result = $this->db->fetchAll('SELECT * FROM `social`');
            return $result;
        }

        public function saveConfig($data){

            if(!empty($data['social_url'])){
                $social = array_combine(array_keys($data['social_url']), array_map(function ($icon, $name, $url) {
                    return compact('icon', 'name', 'url');
                }, $data['social_icon'], $data['social_name'], $data['social_url']));
                
                $this->db->truncate('social');
                foreach ($social as $s) {
                    $this->db->insert('social', ['icon' => $s['icon'], 'name' => $s['name'], 'url' => $s['url']]);
                }
            }
            
            unset($data['social_icon']);
            unset($data['social_name']);
            unset($data['social_url']);
            
            if(empty($data['transaction_notify'])){
                $data['transaction_notify'] = '';
            }else{
                $data['transaction_notify'] = implode(',', $data['transaction_notify']);
            }

            $data['site_footer'] = htmlentities($data['site_footer']);
            
            if($data > 0){
                foreach ($data as $configKey => $configValue) {
                    $this->db->query("UPDATE config SET value = '$configValue' WHERE name = '$configKey'");
                }
            }

            $json['heading'] = "Sucesso";
            $json['text'] =  "Configurações atualizadas com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }
    }
?>