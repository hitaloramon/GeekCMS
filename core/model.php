<?php
    class model {

        protected $db;

        public function __construct(){
            $this->db = OneDB::load([
                'host'      => CONFIG_DB['host'],
                'port'      => CONFIG_DB['port'],
                'database'  => CONFIG_DB['dbname'],
                'user'      => CONFIG_DB['dbuser'],
                'password'  => CONFIG_DB['dbpass'],
                'charset'   => 'utf8',
            ]);
        }
    }
?>