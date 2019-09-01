<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Social extends model{
        
        public function getSocial(){
            $result = $this->db->fetchAll('SELECT * FROM social');
            return $result;
        }
    }
?>