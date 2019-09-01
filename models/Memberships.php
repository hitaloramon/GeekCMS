<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Memberships extends model {

        public function getMemberships($active = null){
            if($active == true){
                $array = $this->db->fetchAll("SELECT * FROM memberships WHERE active = 1 ORDER BY price ASC");
            }else{
                $array = $this->db->fetchAll("SELECT * FROM memberships ORDER BY price ASC ");
            }
            return ($array) ? $array : 0;
        }

        public function getMembershipByID($id){
            $id = intval($id);
            $array = $this->db->fetchRow("SELECT * FROM memberships WHERE id = $id");
            return ($array) ? $array : 0;
        }

        public function membershipInsert($array_data){
            $return = '';

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'        => 'required|max_len,200',
                'price'        => 'required|float',
                'days'         => 'integer',
                'period'       => 'required|max_len,1',
                'img'          => 'max_len,200',
                'trial'        => 'integer|max_len,1',
                'private'      => 'integer|max_len,1',
                'active'       => 'integer|max_len,1',
                'description'  => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'price'         => 'trim|sanitize_string',
                'days'          => 'trim|sanitize_numbers',
                'period'        => 'trim|sanitize_string',
                'img'           => 'trim|sanitize_string',
                'trial'         => 'trim|sanitize_numbers',
                'private'       => 'trim|sanitize_numbers',
                'active'        => 'trim|sanitize_numbers',
                'description'   => 'trim|sanitize_string'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){

                $array_diff = array_diff_key($array_data, $filters);
                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $this->db->insert('memberships', $array_data);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Associação adicionada com sucesso!";
                $json['icon'] = 'success';
                echo json_encode($json);

            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Algumas informações são necessárias!";
                $json['icon'] = 'danger';
                $json['error'] = $validator->get_readable_errors(false);
                echo json_encode($json);
            }
        }


        public function membershipUpdate($array_data, $id){
            $return = '';

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'        => 'required|max_len,200',
                'price'        => 'required|float',
                'days'         => 'integer',
                'period'       => 'required|max_len,1',
                'img'          => 'max_len,200',
                'trial'        => 'integer|max_len,1',
                'private'      => 'integer|max_len,1',
                'active'       => 'integer|max_len,1',
                'description'  => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'price'         => 'trim|sanitize_string',
                'days'          => 'trim|sanitize_numbers',
                'period'        => 'trim|sanitize_string',
                'img'           => 'trim|sanitize_string',
                'trial'         => 'trim|sanitize_numbers',
                'private'       => 'trim|sanitize_numbers',
                'active'        => 'trim|sanitize_numbers',
                'description'   => 'trim|sanitize_string'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){

                $array_diff = array_diff_key($array_data, $filters);
                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }
                
                $this->db->update('memberships', $array_data, ['id = ?'=> $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Plano de Acesso atualizado com sucesso!";
                $json['icon'] = 'success';
                echo json_encode($json);

            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Algumas informações são necessárias!";
                $json['icon'] = 'danger';
                $json['error'] = $validator->get_readable_errors(false);
                echo json_encode($json);
            }
        }


        public function membershipDelete($id){
            $id = (int)$id;
            $this->db->delete('memberships', ['id = ?' => $id]);

            $json['heading'] = "Sucesso";
            $json['text'] =  "Plano de Acesso excluído com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }

    }

?>