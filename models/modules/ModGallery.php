<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Gallery extends model{

        public function oi(){
            $result = $this->db->fetchAll('SELECT * FROM pages');

            return $result;
        }
    }
?>