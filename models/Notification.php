<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Notification extends model {

        public function getNotification($status = null){
            if($status == null){
                $array = $this->db->fetchAll("SELECT * FROM notification ORDER BY date DESC");
            }else{
                $array = $this->db->fetchAll("SELECT * FROM notification WHERE status = 1 ORDER BY date DESC");
            }
            return ($array) ? $array : 0;
        }

        public function datatable(){
            $array = $this->db->fetchAll("SELECT * FROM notification ORDER BY id DESC");
            return ($array) ? $array : 0;
        }



        public function insert($array_data){
            $return = '';

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'  => 'required|max_len,200',
                'msg'    => 'required',
                'icon'   => 'required',
                'color'  => 'required',
                'status' => 'integer|max_len,1'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'  => 'trim|sanitize_string',
                'msg'    => 'trim|sanitize_string',
                'icon'   => 'trim|sanitize_string',
                'color'  => 'trim|sanitize_string',
                'status' => 'trim|sanitize_numbers'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){

                $array_diff = array_diff_key($array_data, $filters);
                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $this->db->insert('notification', $array_data);

            }
        }

        public function delete($id){
            $id = (int)$id;
            $this->db->delete('notification', ['id = ?' => $id]);

            $json['heading'] = "Sucesso";
            $json['text'] =  "Notificação excluída com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }


        public function deleteAll($array_data){
            $data = implode(',', $array_data);
            $this->db->query("DELETE FROM notification WHERE id IN({$data})");
        }
    }

?>