<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Widget extends model {

        public function getWidget($id = null){
            $array = array();
            if($id === null){
                $sql = "SELECT * FROM widgets";
            }else{
                $sql = "SELECT * FROM widgets WHERE id = $id";
            }
            
            $array = $this->db->fetchAll($sql);
            return ($array) ? $array : 0;
        }


        public function getWidgetDataTable($id = null){
            $array = $this->db->fetchAll("SELECT id, title, widget_alias, hasconfig, system FROM widgets");
            echo json_encode($array);
        }

        public function widgetInsert($array_data){
            $return = '';
            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'         => 'required|max_len,200',
                'show_title'    => 'required|integer|max_len,1',
                'show_order'    => 'required|integer|max_len,1',
                'active'        => 'required|integer|max_len,1'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'show_title'    => 'trim|sanitize_numbers',
                'show_order'    => 'trim|sanitize_numbers',
                'active'        => 'trim|sanitize_numbers',
                'body'          => 'htmlencode'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){

                $array_diff = array_diff_key($array_data, $filters);
                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $this->db->insert('widgets', $array_data);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Widget adicionar com sucesso!";
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

        public function widgetUpdate($array_data, $id){
            $return = '';
            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'         => 'required|max_len,200',
                'show_title'    => 'required|integer|max_len,1',
                'show_order'    => 'required|integer|max_len,1',
                'container'     => 'required|integer|max_len,1',
                'active'        => 'required|integer|max_len,1'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'info'          => 'trim|sanitize_string',
                'show_title'    => 'trim|sanitize_numbers',
                'show_order'    => 'trim|sanitize_numbers',
                'container'     => 'trim|sanitize_numbers',
                'active'        => 'trim|sanitize_numbers',
                'body'          => 'htmlencode'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                
                $array_diff = array_diff_key($array_data, $filters);
                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $this->db->update('widgets', $array_data, ['id = ?'=> $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Widget atualizado com sucesso!";
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


        public function widgetDelete($id){
            $id = (int)$id;
            
            $this->db->delete('widgets', ['id = ?' => $id, 'system = ?' => 0]);
    
            $json['heading'] = "Sucesso";
            $json['text'] =  "Widget excluído com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }
    }

?>