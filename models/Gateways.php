<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Gateways extends model{

        public function getGateway($dir = null){
            if(empty($dir)){
                $result = $this->db->fetchAll("SELECT * FROM `gateways`");
            }else{
                $result = $this->db->fetchRow("SELECT * FROM `gateways` WHERE dir = '$dir'");
            }

            return $result;
        }

        public function getGatewayActive(){
            return $this->db->fetchAll("SELECT * FROM `gateways` WHERE active = 1");
        }



        public function saveGateway($array_data, $dir){

            $validator = new Gump('pt-br');
            $array_data = $validator->sanitize($array_data);
            $validator->xss_clean($array_data);

            $this->db->update('gateways', $array_data, ['dir = ?'=> $dir]);

            $json['heading'] = "Sucesso";
            $json['text'] =  "Forma de Pagamento atualizada com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }
    }
?>