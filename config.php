<?php
if (!defined("_VALID_PHP")){
    die('Acesso direto negado.');
}

global $config_db;
$config_db = array();

$config_db['host'] = 'localhost';
$config_db['dbname'] = 'cms';
$config_db['dbuser'] = 'root';
$config_db['dbpass'] = 'root';
$config_db['port'] = '[default_mysql_port]';

?>