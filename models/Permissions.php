<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Permissions extends model {

        public function getGroups($id = null){
            $array = array();
            if($id == null){
                if($_SESSION['user_group'] == 1){
                    $array = $this->db->fetchAll("SELECT * FROM permissions_groups");
                }else{
                    $array = $this->db->fetchAll("SELECT * FROM permissions_groups WHERE id = {$_SESSION['user_group']}");
                }
            }else{
                $id = intval($id);
                $array = $this->db->fetchRow("SELECT * FROM permissions_groups WHERE id = $id");
            }
            return ($array) ? $array : 0;
        }


        public function getParams(){
            $array = array();
            $array = $this->db->fetchAll("SELECT * FROM permissions_params");
            return ($array) ? $array : 0;
        }

        public function getAction($id){
            $array = array();
            $array = $this->db->fetchAll("SELECT * FROM permissions_actions WHERE id_group = $id");
            return ($array) ? $array : 0;
        }

        public function addParams($id, $data){

            $name = $data['name'];
            unset($data['name']);

            $this->db->update('permissions_groups', ['name' => $name], ['id = ?' => $id]);
            $this->db->delete('permissions_actions', ['id_group = ?' => $id]);

            foreach ($data as $key => $value) {
                if(strpos($key, '_view') === false){
                    if(!empty($value)){
                        array_shift($value);
                        $value = implode(',', $value);
                        $this->db->insert('permissions_actions', ['id_group' => $id, 'name' => $key, 'action' => $value]);
                    }
                }else{
                    $name = substr($key, 0, -5);
                    $this->db->update('permissions_actions', ['content_view' => $value], ['name = ?' => $name, 'id_group = ?' => $id]);
                }
            }

            $json['heading'] = "Sucesso";
            $json['text'] =  "Permissões atualizadas com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }

        public function addGroup(){
            $this->db->insert('permissions_groups', ['name' => 'Sem Nome']);
        }


        public function groupDelete($id){
            $id = (int)$id;
            if($id != 1){
                $this->db->delete('permissions_groups', ['id = ?' => $id]);
                $this->db->delete('permissions_actions', ['id_group = ?' => $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Grupo de Permissão excluído com sucesso!";
                $json['icon'] = 'success';
                echo json_encode($json);
            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Você não pode excluir o grupo principal!";
                $json['icon'] = 'danger';
                echo json_encode($json);
            }
        }


        public function hasPermission($name, $permission){
            $id = $_SESSION['user_group'];
            $array = $this->db->fetchOne("SELECT action FROM permissions_actions WHERE id_group = $id AND name = '$name'");
            $array = explode(',', $array);

            if(!in_array($permission, $array)){
                if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    $json['heading'] = "Erro";
                    $json['text'] =  "Você não tem permissão para executar essa ação!";
                    $json['icon'] = 'danger';
                    echo json_encode($json);
                }else{
                    header('Location: '.BASE.'/403.php');
                }
                exit;
            }
        }
    }
?>