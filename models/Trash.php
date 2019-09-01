<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Trash extends model {

        public function getTrash($type){
            $array = $this->db->fetchAll("SELECT * FROM trash WHERE type = '$type'");
            return ($array) ? $array : 0;
        }

        public function setTrash(string $table, int $id){
            $array = $this->db->fetchRow("SELECT * FROM $table WHERE id = '$id'");
            $data = array(
                'type'    => $table,
                'dataset' => json_encode($array)
            );
            $this->db->insert('trash', $data);
        }

        public function restore(int $id){
            $array = $this->db->fetchRow("SELECT * FROM trash WHERE id = '$id'");
            $this->db->insert($array['type'], json_decode($array['dataset'], true));

            $this->db->delete('trash', ['id = ?' => $id]);

            $json['heading'] = "Sucesso";
            $json['text'] =  "Item Restaurado com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }

        public function delete($id){
            $id = (int)$id;
            
            $this->db->delete('trash', ['id = ?' => $id]);
    
            $json['heading'] = "Sucesso";
            $json['text'] =  "Item excluído com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }


        public function clean(){
            $this->db->truncate('trash');
    
            $json['heading'] = "Sucesso";
            $json['text'] =  "Lixeira esvaziada sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }
        
    }

?>