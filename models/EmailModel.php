<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class EmailModel extends model{

        public function getModel($id = null){
            if($id == null){
                $result = $this->db->fetchAll("SELECT * FROM email_templates");
            }else{
                $result = $this->db->fetchRow("SELECT * FROM email_templates WHERE id = $id");
            }
            return $result;
        }

        public function update($array_data, $id){
            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'name'     => 'required|max_len,200',
                'subject'  => 'required',
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'name'     => 'trim|sanitize_string',
                'subject'  => 'trim|sanitize_string',
                'body'     => 'htmlencode'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $this->db->update('email_templates', $array_data, ['id = ?'=> $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Modelo de Email atualizado com sucesso!";
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


    }
?>