<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Menu extends model{

        public function getMenu($active = false){
            $array = array();

            if($active == true){
                $sql = "SELECT * FROM menus WHERE active = 1 ORDER BY position";
            }else{
                $sql = "SELECT * FROM menus ORDER BY position";
            }
            $array = $this->db->fetchAll($sql);
            return $array;
        }

        public function menuBuilder($array, $parent_id = 0, $parents = array()){
            if($parent_id == 0){
                foreach ($array as $element) {
                    if (($element['parent_id'] != 0) && !in_array($element['parent_id'], $parents)) {
                        $parents[] = $element['parent_id'];
                    }
                }
            }
            $menu_html = '';
            foreach($array as $element){
                if($element['parent_id'] == $parent_id){
                    $menu_html .= '<li class="dd-item dd3-item" data-id="'.$element['id'].'">'. PHP_EOL;
                    $menu_html .= '<div class="dd-handle dd3-handle"></div>'. PHP_EOL;
                    $menu_html .= '<div class="dd3-content">
                                        <div class="d-flex no-block">
                                            <div>'.$element['name'].'</div>
                                            <div class="ml-auto">
                                                <a href="'.BASE_ADMIN.'/menu/edit/'.$element['id'].'" class="m-r-10"><i class="mdi mdi-pencil"></i></a>
                                                <a onclick="deleteRedirect(`'.BASE_ADMIN.'/menu/delete/'.$element['id'].'`);"><i class="fa fa-times text-danger"></i></a>
                                            </div>
                                        </div>
                                    </div>'. PHP_EOL;
                    if(in_array($element['id'], $parents)){
                        $menu_html .= '<ol class="dd-list">'. PHP_EOL;
                        $menu_html .= $this->menuBuilder($array, $element['id'], $parents);
                        $menu_html .= '</ol>'. PHP_EOL;
                    }
                    $menu_html .= '</li>'. PHP_EOL;
                }
            }
            return $menu_html;
        }


        public function bootstrap_menu($array, $parent_id = 0, $parents = array(), $submenu = 0, $nivel = 0){
            if($parent_id == 0){
                foreach ($array as $element) {
                    if (($element['parent_id'] != 0) && !in_array($element['parent_id'], $parents)) {
                        $parents[] = $element['parent_id'];
                    }
                }
            }
            $menu_html = '';
            foreach($array as $element){
                if($element['parent_id'] == $parent_id){
                    if(in_array($element['id'], $parents)){
                        $menu_html .= '<li class="nav-item dropdown">'. PHP_EOL;
                        $menu_html .= '<a class="nav-link dropdown-toggle" href="#" id="h6-dropdown1 '.$element['id'].'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="'.$element['icon'].'"></i> '.$element['name']. $submenu.' <i class="fa fa-angle-down m-l-5"></i></a>'. PHP_EOL;
                    }
                    else {
                        if($submenu == 0){
                            $menu_html .= '<li class="nav-item">'. PHP_EOL;
                            if($element['content_type'] == 'web'){
                                $menu_html .= '<a class="nav-link" href="'.$element['link'].'" target="'.$element['target'].'"><i class="'.$element['icon'].'"></i> ' . $element['name'] . '</a>'. PHP_EOL;
                            }else{
                                $menu_html .= '<a class="nav-link" href="'.BASE.'/'.$element['page_slug'].'"><i class="'.$element['icon'].'"></i> ' . $element['name'] . '</a>'. PHP_EOL;
                            }
                        }else{
                            $menu_html .= '<li>'. PHP_EOL;
                            if($element['content_type'] == 'web'){
                                $menu_html .= '<a class="nav-link" href="'.$element['link'].'" target="'.$element['target'].'"><i class="'.$element['icon'].'"></i> ' . $element['name'] . '</a>'. PHP_EOL;
                            }else{
                                $menu_html .= '<a class="dropdown-item" href="'.BASE.'/'.$element['page_slug'].'"><i class="'.$element['icon'].'"></i> ' . $element['name'] .'</a>'. PHP_EOL;
                            }
                        }
                    }
                    if(in_array($element['id'], $parents)){
                        $nivel += 1;
                        $menu_html .= '<ul class="dropdown-menu">'. PHP_EOL;
                        $menu_html .= $this->bootstrap_menu($array, $element['id'], $parents, 1, $nivel);
                        $menu_html .= '</ul>'. PHP_EOL;
                        $nivel = 0;
                    }
                    $menu_html .= '</li>'. PHP_EOL;
                }
            }
            return $menu_html;
        }

        public function menuProcess($list, $parent_id = 0, $m_order = 0, $submenu = 0){
            foreach($list as $item) {
                $m_order++;
                $aRetval = array(
                    'parent_id' => $parent_id,
                    'position' => $m_order
                );
                $id = $item["id"];
                $this->db->update('menus', $aRetval, array("id = ?" => $id));
                if (array_key_exists("children", $item)) {
                    $id = $item["id"];
                    $menuArray = array(
                        'link' => '#',
                        'content_type' => 'page',
                        'target' => '_self'
                    );
                    $this->db->update('menus', $aRetval, array("id = ?" => $id));
                    $this->menuProcess($item["children"], $item["id"], $m_order);
                }
            }
        }


        public function getMenuList($parent_id, $level = 0, $spacer, $selected = false){
            $menutree = $this->getMenu();
            if ($menutree) {
               foreach ($menutree as $key => $row) {
                 $sel = ($row['id'] == $selected) ? " selected=\"selected\"" : "";
                 if ($parent_id == $row['parent_id']) {
                   print "<option value=\"" . $row['id'] . "\"" . $sel . ">";
      
                   for ($i = 0; $i < $level; $i++)
                     print $spacer;
      
                   print $row['name'] . "</option>\n";
                   $level++;
                   $this->getMenuList($key, $level, $spacer, $selected);
                   $level--;
                 }
               }
               unset($row);
             }
        }


        public function menuInsert($array_data){

            $page_id = intval($array_data['page_id']);
            $slug = $this->db->fetchRow("SELECT slug FROM pages WHERE id = {$page_id}");
            $array_data['page_slug'] = $slug['slug'];
            $array_data['slug'] = $array_data['name'];

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'icon'         => 'max_len,50',
                'name'         => 'required',
                'caption'      => 'max_len,200',
                'parent_id'    => 'integer',
                'content_type' => 'required|max_len,4',
                'page_id'      => 'required|integer',
                'target'       => 'max_len,6',
                'home_page'    => 'required|integer',
                'active'       => 'required|integer'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'icon'         => 'trim|sanitize_string',
                'name'         => 'trim|sanitize_string',
                'page_slug'    => 'slug',
                'slug'         => 'slug',
                'caption'      => 'trim|sanitize_string',
                'parent_id'    => 'trim|sanitize_numbers',
                'content_type' => 'trim|sanitize_string',
                'page_id'      => 'trim|sanitize_numbers',
                'link'         => 'trim',
                'target'       => 'trim|sanitize_string',
                'home_page'    => 'trim|sanitize_numbers',
                'active'       => 'trim|sanitize_numbers'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                if($array_data['home_page'] == 1){
                    $this->db->update('menus', ['home_page' => 0], ['home_page = ?' => 1]);
                }
                $this->db->insert('menus', $array_data);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Menu adicionado com sucesso!";
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


        public function menuUpdate($array_data, $id){
            
            $id = intval($id);
            $page_id = intval($array_data['page_id']);
            $slug = $this->db->fetchOne("SELECT slug FROM pages WHERE id = {$page_id}");
            $array_data['page_slug'] = $slug;
            $array_data['slug'] = $array_data['name'];

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'icon'         => 'max_len,50',
                'name'         => 'required',
                'caption'      => 'max_len,200',
                'parent_id'    => 'integer',
                'content_type' => 'required|max_len,4',
                'page_id'      => 'required|integer',
                'target'       => 'max_len,6',
                'home_page'    => 'required|integer',
                'active'       => 'required|integer'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'icon'         => 'trim|sanitize_string',
                'name'         => 'trim|sanitize_string',
                'page_slug'    => 'slug',
                'slug'         => 'slug',
                'caption'      => 'trim|sanitize_string',
                'parent_id'    => 'trim|sanitize_numbers',
                'content_type' => 'trim|sanitize_string',
                'page_id'      => 'trim|sanitize_numbers',
                'link'         => 'trim',
                'target'       => 'trim|sanitize_string',
                'home_page'    => 'trim|sanitize_numbers',
                'active'       => 'trim|sanitize_numbers'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                if($array_data['home_page'] == 1){
                    $this->db->update('menus', ['home_page' => 0], ['home_page = ?' => 1]);
                }
                $this->db->update('menus', $array_data, ["id = ?" => $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Menu atualizado com sucesso!";
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


        public function deleteMenu($id){
            $id = intval($id);
            $this->db->delete('menus', ["id = ?" => $id]);
            $this->db->delete('menus', ["parent_id = ?" => $id]);
            header('Location: '.BASE_ADMIN.'/menu');
        }

        public function getMenuByID($id){
            $id = intval($id);
            $array = $this->db->fetchRow("SELECT * FROM menus WHERE id = {$id}");
            return ($array) ? $array : 0;
        }

    }
?>