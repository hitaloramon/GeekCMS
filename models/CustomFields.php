<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class CustomFields extends model{

        public function getFields($id = null){

            if($id == null){
                $sql = "SELECT * FROM custom_fields ORDER BY sorting";
                return $this->db->fetchAll($sql);
            }else{
                $sql = "SELECT * FROM custom_fields WHERE id = '$id' ORDER BY sorting";
                return $this->db->fetchRow($sql);
            }

        }

        public function fieldCheck($page){
            $array = $this->db->fetchAll("SELECT * FROM custom_fields WHERE type_page = '{$page}' AND active = 1 ORDER BY sorting");
            return $array;
        }

        public function fieldsBuilder($array){
            $menu_html = '';
            foreach($array as $element){
                        $menu_html .= PHP_EOL;
                        $menu_html .= '<li class="dd-item dd3-item" data-id="'.$element['id'].'">'. PHP_EOL;
                        $menu_html .= ' <div class="dd-handle dd3-handle"></div>'. PHP_EOL;
                        $menu_html .= '     <div class="dd3-content">'. PHP_EOL;
                        $menu_html .= '         <div class="col-xs-12">'.$element['title'].''. PHP_EOL;
                        $menu_html .= '             <div class="pull-right">'. PHP_EOL;
                        $menu_html .= '                 <a href="'.BASE_ADMIN.'/customfields/edit/'.$element['id'].'" class="m-r-10"><i class="mdi mdi-pencil"></i></a>'. PHP_EOL;
                        $menu_html .= '                 <a onclick="deleteRedirect(`'.BASE_ADMIN.'/customfields/delete/'.$element['id'].'`);"><i class="mdi mdi-delete text-danger"></i></a>'. PHP_EOL;
                        $menu_html .= '             </div>'. PHP_EOL;
                        $menu_html .= '         </div>'. PHP_EOL;
                        $menu_html .= '     </div>'. PHP_EOL;
                        $menu_html .= '</li>'. PHP_EOL;
                }
            return $menu_html;
        }

        public function fieldInsert($array_data){
            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'         => 'required|max_len,100',
                'name'          => 'required',
                'col'           => 'integer',
                'type'          => 'required|max_len,50',
                'req'           => 'required|integer',
                'type_page'     => 'required',
                'active'        => 'required|integer'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'name'          => 'slug',
                'col'           => 'trim|sanitize_numbers',
                'type'          => 'trim|sanitize_string',
                'req'           => 'trim|sanitize_string',
                'type_page'     => 'trim|sanitize_string',
                'active'        => 'trim|sanitize_numbers'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                if($array_data['type'] != 'select'){
                    unset($array_data['options_value']);
                    unset($array_data['options_name']);
                }else{
                    $array_data['options_value'] = implode(",", $array_data['options_value']);
                    $array_data['options_name'] = implode(",", $array_data['options_name']);
                }

                $this->db->insert('custom_fields', $array_data);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Campo Personalizado adicionado com sucesso!";
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


        public function fieldUpdate($array_data, $id){
            $id = intval($id);
            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'         => 'required|max_len,100',
                'tooltip'       => 'max_len,100',
                'name'          => 'required',
                'col'           => 'integer',
                'type'          => 'required|max_len,50',
                'title_pattern' => 'max_len,255',
                'req'           => 'required|integer',
                'type_page'     => 'required',
                'active'        => 'required|integer'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'tooltip'       => 'trim|sanitize_string',
                'name'          => 'slug',
                'col'           => 'trim|sanitize_numbers',
                'type'          => 'trim|sanitize_string',
                'pattern'       => 'trim|sanitize_string',
                'title_pattern' => 'trim|sanitize_string',
                'req'           => 'trim|sanitize_string',
                'type_page'     => 'trim|sanitize_string',
                'active'        => 'trim|sanitize_numbers'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                if($array_data['type'] != 'select'){
                    unset($array_data['options_value']);
                    unset($array_data['options_name']);
                }else{
                    $array_data['options_value'] = implode(",", $array_data['options_value']);
                    $array_data['options_name'] = implode(",", $array_data['options_name']);
                }
                
                //var_dump($array_data);
                //exit;
                $this->db->update('custom_fields', $array_data, ["id = ?" => $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Campo Personalizado atualizado com sucesso!";
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


        public function fieldDelete($id){
            $id = intval($id);
            $this->db->delete('custom_fields', ["id = ?" => $id]);
            header('Location: '.BASE_ADMIN.'/customfields');
        }


        public function fieldSort($list, $m_order = 0){
            foreach($list as $item) {
                $m_order++;
                $aRetval = array('sorting' => $m_order);
                $id = $item["id"];
                $this->db->update('custom_fields', $aRetval, array("id = ?" => $id));
            }

            $json['heading'] = "Sucesso";
            $json['text'] =  "Campos Personalizados ordenados com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }


        public function renderCustomFields($page){
            $array = array();
            $html = '';

            switch ($page):
                case 'register': // Cadastro
                    $array = $this->db->fetchAll("SELECT * FROM custom_fields WHERE type_page = 'register' AND active = 1 ORDER BY sorting");
                break;
                case 'profile': // Perfil
                    $array = $this->db->fetchAll("SELECT * FROM custom_fields WHERE type_page = 'profile' AND active = 1 ORDER BY sorting");
                break;
            endswitch;

            
            if(!empty($array)){
                foreach ($array as $cf) {
                    $req = ($cf['req']) ? 'required' : '';

                    if($cf['type'] == 'select'){
                        $option = '';
                        $options_value = explode(',', $cf['options_value']);
                        $options_name = explode(',', $cf['options_name']);

                        foreach ($options_name as $op_key => $op_name) {
                            $option .= '<option value="'.$options_value[$op_key].'">'.$op_name.'</option>';
                        }

                        $html .= PHP_EOL;
                        $html .= '<div class="col-md-'.$cf['col'].'">'. PHP_EOL;
                        $html .=    '<div class="form-group">'. PHP_EOL;
                        $html .=        '<label for="custom_'.$cf['name'].'">'.$cf['title'].'</label>'. PHP_EOL;
                        $html .=         '<select class="form-control" id="'.$cf['name'].'" name="'.$cf['name'].'" '.$req.'>'. PHP_EOL;
                        $html .=            $option. PHP_EOL;
                        $html .=         '</select>'. PHP_EOL;
                        $html .=    '</div>'. PHP_EOL;
                        $html .= '</div>'. PHP_EOL;
                    }else{
                        $html .= PHP_EOL;
                        $html .= '<div class="col-md-'.$cf['col'].'">'. PHP_EOL;
                        $html .=    '<div class="form-group has-feedback">'. PHP_EOL;
                        $html .=        '<label for="'.$cf['name'].'">'.$cf['title'].'</label>'. PHP_EOL;
                        $html .=        '<input type="'.$cf['type'].'" class="form-control" id="'.$cf['name'].'" name="'.$cf['name'].'" '.$req.'>'. PHP_EOL;
                        $html .=    '</div>'. PHP_EOL;
                        $html .= '</div>'. PHP_EOL;
                    }
                }
            }

            return $html;
        }

    }
?>