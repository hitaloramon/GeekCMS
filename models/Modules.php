<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Modules extends model {

        public function getModules($include_page = false, $id = null){
            $array = array();
            if($id === null){
                $sql = "SELECT * FROM modules";
            }else{
                $sql = "SELECT * FROM modules WHERE id = $id ORDER BY title ASC";
            }

            if($include_page == true){
                $sql .= ' WHERE include_page = 1 ORDER BY title ASC';
            }
            
            $array = $this->db->fetchAll($sql);
            return ($array) ? $array : 0;
        }
    }

?>