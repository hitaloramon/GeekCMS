<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class ModSlider extends model{

        public function insert($title, $config){
            $lastid = $this->db->insert('mod_slider', ['title' => $title, 'config' => $config]);

            $array_widget = array(
                'title'         => 'Slider - '. $title,
                'system'        => 1,
                'widget_alias'  => 'slider',
                'widget_data'   => $lastid,
                'module_alias'  => 'slider',
                'hasconfig'     => 0,
                'active'        => 1
            );

            $this->db->insert('widgets', $array_widget);
        }

        public function update($id, $title, $data){
            $this->db->update('mod_slider', ['title' => $title, 'config' => $data], ['id = ?'=> $id]);
        }

        public function delete($id){
            $this->db->delete('mod_slider', ['id = ?'=> $id]);
            $this->db->delete('widgets', ['widget_data = ?'=> $id, 'widget_alias = ?' => 'slider']);
        }

        public function getSlider(int $id = null){
            if($id != null){
                return $this->db->fetchRow("SELECT * FROM mod_slider WHERE id = $id");
            }else{
                return $this->db->fetchAll("SELECT * FROM mod_slider");
            }
        }
    }
?>