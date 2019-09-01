<?php
    class model {

        protected $db;

        public function __construct(){
            global $config_db;

            $this->db = OneDB::load([
                'host'      => $config_db['host'],
                'port'      => $config_db['port'],
                'charset'   => 'utf8',
                'database'  => $config_db['dbname'],
                'user'      => $config_db['dbuser'],
                'password'  => $config_db['dbpass']
            ]);
        }
    }
?>