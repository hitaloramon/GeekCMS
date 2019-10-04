<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Logs extends model{

        public function insert(array $array_data){
            $this->db->insert('logs', $array_data);
        }

        public function delete($id){
            $id = (int)$id;
            $this->db->delete('logs', ['id = ?' => $id]);
        }

    }
?>