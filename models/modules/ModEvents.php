<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class ModEvents extends model{

        public function getEvents(int $id = null){
            return $this->db->fetchAll("SELECT * FROM mod_events");
        }

        public function insert($array_data){
            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'       => 'required|max_len,200',
                'color'       => 'required',
                'textColor'   => 'required',
                'start'       => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'       => 'trim|sanitize_string',
                'color'       => 'trim|sanitize_string',
                'textColor'   => 'trim|sanitize_string',
                'start'       => 'trim|sanitize_string',
                'end'         => 'trim|sanitize_string',
                'description' => 'trim|sanitize_string'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $lastid = $this->db->insert('mod_events', $array_data);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Evento adicionado com sucesso!";
                $json['icon'] = 'success';
                $json['id'] = $lastid;
                echo json_encode($json);

            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Algumas informações são necessárias!";
                $json['icon'] = 'danger';
                $json['error'] = $validator->get_readable_errors(false);
                echo json_encode($json);
            }
        }

        public function update($array_data){
            $validator = new Gump('pt-br');

            $id = $array_data['id'];
            unset($array_data['id']);
    
            // Regras para validar os campos
            $rules = array(
                'title'       => 'required|max_len,200',
                'color'       => 'required',
                'textColor'   => 'required',
                'start'       => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'       => 'trim|sanitize_string',
                'color'       => 'trim|sanitize_string',
                'textColor'   => 'trim|sanitize_string',
                'start'       => 'trim|sanitize_string',
                'end'         => 'trim|sanitize_string',
                'description' => 'trim|sanitize_string'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $this->db->update('mod_events', $array_data, ['id = ?'=> $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Evento atualizado com sucesso!";
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
                
                $this->db->delete('mod_events', ['id = ?' => $id]);
                

                $json['heading'] = "Sucesso";
                $json['text'] =  "Evento excluído com sucesso!";
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