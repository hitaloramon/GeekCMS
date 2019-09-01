<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class ModRss extends model{

        public function getRss(int $id = null){
            if($id != null){
                return $this->db->fetchRow("SELECT * FROM mod_rss WHERE id = $id");
            }else{
                return $this->db->fetchAll("SELECT * FROM mod_rss");
            }
        }

        public function insert($array_data){
            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'         => 'required|max_len,200',
                'url'           => 'required|valid_url',
                'limit_rss'     => 'required|integer',
                'limit_desc'    => 'required|integer',
                'show_date'     => 'required|integer|max_len,1',
                'show_desc'     => 'required|integer|max_len,1'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'url'           => 'trim|sanitize_string',
                'limit_rss'     => 'trim|sanitize_numbers',
                'limit_desc'    => 'trim|sanitize_numbers',
                'show_date'     => 'trim|sanitize_numbers',
                'show_date'     => 'trim|sanitize_numbers',
                'show_desc'     => 'trim|sanitize_numbers'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $lastid = $this->db->insert('mod_rss', $array_data);

                $array_widget = array(
                    'title'         => 'RSS - '.$array_data['title'],
                    'system'        => 1,
                    'widget_alias'  => 'rss',
                    'widget_data'   => $lastid,
                    'module_alias'  => 'rss',
                    'hasconfig'     => 0,
                    'active'        => 1
                );

                $this->db->insert('widgets', $array_widget);

                $json['heading'] = "Sucesso";
                $json['text'] =  "RSS adicionado com sucesso!";
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

        public function update($array_data, $id){
            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'         => 'required|max_len,200',
                'url'           => 'required|valid_url',
                'limit_rss'     => 'required|integer',
                'limit_desc'    => 'required|integer',
                'show_date'     => 'required|integer|max_len,1',
                'show_desc'     => 'required|integer|max_len,1'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'url'           => 'trim|sanitize_string',
                'limit_rss'     => 'trim|sanitize_numbers',
                'limit_desc'    => 'trim|sanitize_numbers',
                'show_date'     => 'trim|sanitize_numbers',
                'show_date'     => 'trim|sanitize_numbers',
                'show_desc'     => 'trim|sanitize_numbers'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $this->db->update('mod_rss', $array_data, ['id = ?'=> $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "RSS atualizado com sucesso!";
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
        
        public function delete($id){
            $id = (int)$id;
            if(!empty($id) && is_int($id)){
                
                $id_widget = $this->db->fetchOne("SELECT widgets.id FROM mod_rss INNER JOIN widgets ON widget_data = mod_rss.id AND module_alias = 'rss'");
                $this->db->delete('mod_rss', ['id = ?' => $id]);
                $this->db->delete('widgets', ['id = ?' => $id_widget]);
                $this->db->delete('layout', ['plug_id = ?' => $id_widget]);
                

                $json['heading'] = "Sucesso";
                $json['text'] =  "RSS excluído com sucesso!";
                $json['icon'] = 'success';
            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Não foi possível excluir!";
                $json['icon'] = 'danger';
            }
            echo json_encode($json);
        }

        public function assets(){
            echo 'views/front/widgets/rss/css/style.css';
            echo 'views/front/widgets/rss/js/script.js';
        }
        
    }
?>