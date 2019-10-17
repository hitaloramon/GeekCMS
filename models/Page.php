<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Page extends model{
        
        public function getPage($url){
            $result = array();
            if($url != null){
                $sql = "SELECT * FROM pages WHERE slug = '$url'";
            }else{
                $sql = "SELECT * FROM pages WHERE type_page = 'home'";
            }
            $result = $this->db->fetchRow($sql);

            if(!empty($result)){
                return $result;
            }else{
                header('Location: '.BASE.'/404.php');
                exit;
            }
        }

        public function getAllPages(){
            $array = array();
            $array = $this->db->fetchAll("SELECT * FROM pages ORDER BY id DESC");
            
            return ($array) ? $array : 0;
        }

        public function getPagesDatatable(){
            $array = array();
            $array = $this->db->fetchAll("SELECT p.id, p.title, p.active, p.created, p.type_page, u.fname FROM pages AS p LEFT JOIN users AS u ON p.created_by = u.id ORDER BY p.id DESC");
            echo json_encode($array);
        }

        public function getPageByID(int $id){
            $array = array();
            if(is_integer($id)){
                $array = $this->db->fetchRow("SELECT * FROM pages WHERE id = $id");
            }

            return ($array) ? $array : 0;
        }

        public function getWidget($slug = null){
            $array = array();
            if($slug !== null){
                $array = $this->db->fetchAll("SELECT * FROM layout WHERE page_slug = '$slug' ORDER BY position");
            }
            return ($array) ? $array : 0;
        }

        public function countPlace($array, $position, $is_content = true){
            if ($array) {
                $result = array();
                foreach ($array as $val){
                    if ($val['place'] == $position) {
                         $result[] = $val;
                    }
                }
                return $result;
            }
        }

        public function getWidgetLayoutFront($slug, $typepage = true){
            $array = array();
            $data = ($typepage) ? "l.page_slug = '" . $slug . "'" : "l.modalias = ''";
            $array = $this->db->fetchAll("SELECT l.*, w.title, w.body, w.widget_alias, w.widget_data, w.hasconfig, w.system, w.show_title, w.show_order, w.container FROM layout AS l INNER JOIN widgets AS w ON w.id = l.plug_id WHERE {$data} AND w.active = 1 ORDER BY l.position ASC");
            return ($array) ? $array : 0;
        }

        public function pageDelete($id){
            $id = (int)$id;
            if(!empty($id) && is_int($id)){
                $result = $this->db->query("SELECT id FROM pages WHERE id = '$id' AND type_page = 'normal'");
                if(!empty($result)){
                    $this->db->delete('pages', ['id = ?' => $id, 'type_page = ?' => 'normal']);

                    $json['heading'] = "Sucesso";
                    $json['text'] =  "Página excluída com sucesso!";
                    $json['icon'] = 'success';
                }else{
                    $json['heading'] = "Erro";
                    $json['text'] =  "Você não pode excluir uma página do sistema!";
                    $json['icon'] = 'danger';
                }
                echo json_encode($json);
            }
        }


        public function pageInsert($array_data){
            if(empty($array_data['slug'])){
                $array_data['slug'] = $array_data['title'];
            }

            if(empty($array_data['membership_id'])){
                $array_data['membership_id'] = '';
            }else{
                $array_data['membership_id'] = implode(',', $array_data['membership_id']);
            }

            //Check Module
            preg_match_all("/{{(module.*?)}}/", $array_data['body'], $modules);
            $modules = array_shift($modules);
            foreach ($modules as $m) {
                $module = explode('|', $m);
                $routes = new Routes();
                $routes->updateRoutes($module[1], $array_data['slug']);
            }

            // Check Page Type
            preg_match_all("/{{(page.*?)}}/", $array_data['body'], $matches);
            if($array_data['type_page'] != 'home'){
                if(!empty($matches[1])){
                    $matches = explode('|', $matches[1][0]);
                    $array_data['type_page'] = $matches[1];
                }else{
                    $array_data['type_page'] = 'normal';
                }
            }

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'         => 'required|max_len,200',
                'caption'       => 'max_len,200',
                'active'        => 'required|integer|max_len,1',
                'access'        => 'required|integer|max_len,1',
                'description'   => 'required',
                'type_page'     => 'required',
                'keywords'      => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'slug'          => 'slug',
                'caption'       => 'trim|sanitize_string',
                'type_page'     => 'trim|sanitize_string',
                'active'        => 'trim|sanitize_numbers',
                'membership_id' => 'trim|sanitize_string',
                'access'        => 'trim|sanitize_numbers',
                'description'   => 'trim|sanitize_string',
                'keywords'      => 'trim|sanitize_string',
                'body'          => 'htmlencode'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){

                $create_menu = $array_data['create_menu'];
                $array_diff = array_diff_key($array_data, $filters);
                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $array_data['created_by'] = $_SESSION['user_id'];
                if($array_data['type_page'] == 'home'){
                    $this->db->update('pages', ['type_page' => 'normal'], ['type_page = ?'=> 'home']);
                }

                if($array_data['type_page'] != 'home' || $array_data['type_page'] != 'normal'){
                    $this->db->update('pages', ['type_page' => 'normal'], ['type_page = ?'=> $array_data['type_page']]);
                    $this->db->query("UPDATE config SET value = '{$array_data['slug']}' WHERE name = 'page_{$array_data['type_page']}'");
                }

                $checkSlug = $this->db->fetchRow("SELECT id FROM pages WHERE slug = '{$array_data['slug']}'");

                if($checkSlug == false){
                    $lastid = $this->db->insert('pages', $array_data);

                    if($create_menu){
                        $array_menu = array(
                            'page_id'       => $lastid,
                            'page_slug'     => $array_data['slug'],
                            'name'          => $array_data['title'],
                            'slug'          => $array_data['slug'],
                            'content_type'  => 'page',
                            'active'        => 1
                        );

                        if($array_data['type_page'] == 'home'){
                            $array_menu['home_page'] = 1;
                        }
                        $this->db->insert('menus', $array_menu);
                    }

                    $json['heading'] = "Sucesso";
                    $json['text'] =  "Página adicionada com sucesso!";
                    $json['icon'] = 'success';
                    echo json_encode($json);
                }else{
                    $json['heading'] = "Erro";
                    $json['text'] =  "Já existe uma página com essa URL";
                    $json['icon'] = 'danger';
                    $json['error'] = $validator->get_readable_errors(false);
                    echo json_encode($json);
                }

            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Algumas informações são necessárias!";
                $json['icon'] = 'danger';
                $json['error'] = $validator->get_readable_errors(false);
                echo json_encode($json);
            }
        }


        public function pageUpdate($array_data, $id){

            // Check Modules
            preg_match_all("/{{(module.*?)}}/", $array_data['body'], $modules);
            $modules = array_shift($modules);
            foreach ($modules as $m) {
                $module = explode('|', $m);
                $routes = new Routes();
                $routes->updateRoutes($module[1], $array_data['slug']);
            }

            // Check Page Type
            preg_match_all("/{{(page.*?)}}/", $array_data['body'], $matches);
            if($array_data['type_page'] != 'home'){
                if(!empty($matches[1])){
                    $matches = explode('|', $matches[1][0]);
                    $array_data['type_page'] = $matches[1];
                }else{
                    $array_data['type_page'] = 'normal';
                }
            }
            

            if(empty($array_data['slug'])){
                $array_data['slug'] = $array_data['title'];
            }

            if(empty($array_data['membership_id'])){
                $array_data['membership_id'] = '';
            }else{
                $array_data['membership_id'] = implode(',', $array_data['membership_id']);
            }

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'         => 'required|max_len,200',
                'slug'          => 'required',
                'caption'       => 'max_len,200',
                'type_page'     => 'required',
                'active'        => 'required|integer|max_len,1',
                'access'        => 'required|integer|max_len,1',
                'description'   => 'required',
                'keywords'      => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'slug'          => 'slug',
                'type_page'     => 'trim|sanitize_string',
                'caption'       => 'trim|sanitize_string',
                'active'        => 'trim|sanitize_numbers',
                'membership_id' => 'trim|sanitize_string',
                'access'        => 'trim|sanitize_numbers',
                'description'   => 'trim|sanitize_string',
                'keywords'      => 'trim|sanitize_string',
                'body'          => 'htmlencode'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                if($array_data['type_page'] != 'home' || $array_data['type_page'] != 'normal'){
                    $this->db->update('pages', ['type_page' => 'normal'], ['type_page = ?'=> $array_data['type_page']]);
                    $this->db->query("UPDATE config SET value = '{$array_data['slug']}' WHERE name = 'page_{$array_data['type_page']}'");
                }

                $this->db->update('pages', $array_data, ['id = ?'=> $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Página atualizada com sucesso!";
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


        public function pageSearch($search){
            $search = addslashes($search);
            return $this->db->fetchAll("SELECT * FROM pages WHERE body LIKE '%{$search}%'");
        }

    }
?>