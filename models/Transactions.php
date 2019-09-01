<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Transactions extends model{

        public function insert($array_data){
            $this->db->insert('transactions', $array_data);
        }

        public function update($array_data, $id){
            $this->db->update('transactions', $array_data, ["txn_id = ?" => $id]);
        }

        public function getTransaction($id = null){
            if($id == null){
                return $this->db->fetchAll("SELECT * FROM transactions");
            }else{
                return $this->db->fetchRow("SELECT * FROM transactions WHERE txn_id = '$id'");
            }
        }

        public function getDatatable(){
            $array = array();
            $array = $this->db->fetchAll("SELECT *, t.id as id_transaction, u.fname FROM transactions AS t LEFT JOIN users AS u ON t.user_id = u.id ORDER BY t.id DESC");
            echo json_encode($array);
        }

        public function getPaid(){
            return $this->db->fetchOne("SELECT COUNT(id) as paid FROM transactions WHERE status = 3");
        }

        public function getPending(){
            return $this->db->fetchOne("SELECT COUNT(id) as paid FROM transactions WHERE status = 1");
        }

        public function getToday(){
            return $this->db->fetchOne("SELECT SUM(received) as today FROM transactions WHERE DATE(created) = CURDATE() AND status = 3");
        }

        public function getTotal(){
            return $this->db->fetchOne("SELECT SUM(received) as total FROM transactions WHERE status = 3");
        }


    }
?>