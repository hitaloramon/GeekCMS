<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Layout extends model {

        public function getLayout($pageid){
            $array = $this->db->fetchAll("SELECT l.*, w.id as widget_id, w.widget_alias as widget_alias, w.title FROM layout AS l INNER JOIN widgets AS w ON w.id = l.plug_id WHERE l.page_id = {$pageid} ORDER BY l.position ASC, w.title ASC");
            return ($array) ? $array : 0;
        }

        public function getConfigPage($pageid){
            $array = $this->db->fetchAll("SELECT id, slug FROM pages WHERE id != '{$pageid}'");
            return ($array) ? $array : 0;
        }

        public function getConfigAllPages($pageid, $place){
            $array = $this->db->fetchAll("SELECT * FROM layout WHERE place = '{$place}' AND page_id = '{$pageid}'");
            return ($array) ? $array : 0;
        }

        public function load($pageid){
            $array = $this->db->fetchAll("SELECT id, widget_alias, title FROM widgets WHERE id NOT IN (SELECT plug_id FROM layout WHERE page_id = $pageid) AND active = 1");
            return ($array) ? $array : 0;
        }

        public function layoutInsert($data){

            $checkLayout = $this->db->fetchRow("SELECT * FROM layout WHERE plug_id = '{$data['plug_id']}' AND page_slug = '{$data['page_slug']}'");

            if($checkLayout == false){
                $this->db->insert('layout', $data);
            }else{
                unset($data['space']);
                $this->db->update('layout', $data, ['plug_id = ?' => $data['plug_id'], 'page_id = ?' => $data['page_id'], 'page_slug = ?' => $data['page_slug']]);
            }
        
        }

        public function layoutUpdate($data, $plug_id, $page_id){
            $this->db->update('layout', $data, ['plug_id = ?' => $plug_id, 'page_id = ?' => $page_id]);
        }

        public function layoutDelete($data){
            $this->db->delete('layout', $data);
        }
    }

?>