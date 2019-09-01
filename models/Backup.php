<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Backup extends model{

        private $final;
        private $tables;

        public function backupSystem(){
            global $config_db;
        
            $this->getTables();
            $this->generate();

            return $this->final;
        }

        private function generate(){
            foreach ($this->tables as $tbl) {
                $this->final .= '-- CREATING TABLE '.$tbl['name']."\n";
                $this->final .= 'DROP TABLE IF EXISTS `'.$tbl['name']."`;\n";
                $this->final .= $tbl['create']['Create Table'] . ";\n\n";
                $this->final .= '-- INSERTING DATA INTO '.$tbl['name']."\n";
                $this->final .= $tbl['data']."\n\n";
            }
            $this->final .= '-- THE END'."\n\n";
        }


        private function getTables(){
            global $config_db;
            $name = 'Tables_in_'.$config_db['dbname'];
            $tbs = $this->db->fetchAll('SHOW TABLES');
            $i=0;
            foreach($tbs as $table){
                $this->tables[$i]['name'] = $table[$name];
                $this->tables[$i]['create'] = $this->getColumns($table[$name]);
                $this->tables[$i]['data'] = $this->getData($table[$name]);
                $i++;
            }
            unset($tbs);
            unset($i);
            return true;
        }


        private function getColumns($tableName){
            $q = $this->db->fetchAll('SHOW CREATE TABLE '.$tableName);
            $q[0] = preg_replace("/AUTO_INCREMENT=[\w]*./", '', $q[0]);
            return $q[0];
        }
    

        private function getData($tableName){
            $q = $this->db->fetchAll("SELECT * FROM ".$tableName);
            $data = '';
            foreach ($q as $pieces){
                foreach($pieces as &$value){
                    $value = addslashes($value);
                }
                $data .= 'INSERT INTO '. $tableName .' VALUES (\'' . implode('\',\'', $pieces) . '\');'."\n";
            }
            return $data;
        }
        

        public function import($filename){
            $templine = '';
            $lines = file($filename);
            $success = true;
            foreach ($lines as $line_num => $line) {
                if (substr($line, 0, 2) != '--' && $line != '') {
                    $templine .= $line;
                    if (substr(trim($line), -1, 1) == ';') {
                        try {
                            $this->db->query($templine);
                        } catch (\Exception $e) {
                            echo "<br><pre>Exception => " . $e->getMessage() . "</pre>\n";
                            $success = false;
                        }
                        $templine = '';
                    }

                }
            }
            return $success;
        }


    }
?>