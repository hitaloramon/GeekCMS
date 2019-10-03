<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class ModBlog extends model{

        public function getCategories(int $id = null){
            if($id == null){
                return $this->db->fetchAll("SELECT categories.*, pages.slug as blogslug FROM mod_blog_categories AS categories LEFT JOIN pages ON pages.module_name = 'blog' WHERE categories.active = 1 ORDER BY name ASC");
            }else{
                return $this->db->fetchRow("SELECT * FROM mod_blog_categories WHERE id = {$id}");
            }
        }

        public function getAllCategories(){
            return $this->db->fetchAll("SELECT * FROM mod_blog_categories ORDER BY name ASC");
        }

        public function addCategory($array_data = array()){

            if(empty($array_data['slug'])){
                $array_data['slug'] = $array_data['name'];
            }

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'name'    => 'required|max_len,200',
                'active'  => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'name'     => 'trim|sanitize_string',
                'slug'     => 'slug',
                'icon'     => 'trim|sanitize_string',
                'active'   => 'trim|sanitize_numbers',
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $lastid = $this->db->insert('mod_blog_categories', $array_data);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Categoria adicionada com sucesso!";
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

        public function updateCategory($array_data = array(), int $id){

            if(empty($array_data['slug'])){
                $array_data['slug'] = $array_data['name'];
            }

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'name'    => 'required|max_len,200',
                'active'  => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'name'     => 'trim|sanitize_string',
                'slug'     => 'slug',
                'icon'     => 'trim|sanitize_string',
                'active'   => 'trim|sanitize_numbers',
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $this->db->update('mod_blog_categories', $array_data, ['id = ?'=> $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Categoria atualizada com sucesso!";
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


        public function deleteCategory($id){
            $id = (int)$id;
            if(!empty($id) && is_int($id)){
                
                $this->db->delete('mod_blog_categories', ['id = ?' => $id]);
                

                $json['heading'] = "Sucesso";
                $json['text'] =  "Categoria excluída com sucesso!";
                $json['icon'] = 'success';
            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Não foi possível excluir!";
                $json['icon'] = 'danger';
            }
            echo json_encode($json);
        }

        public function insert($array_data){

            if(empty($array_data['slug'])){
                $array_data['slug'] = $array_data['title'];
            }

            $array_data['user_id'] = $_SESSION['user_id'];

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'         => 'required|max_len,200',
                'slug'          => 'max_len,100',
                'category_id'   => 'required|max_len,1',
                'membership_id' => 'max_len,1',
                'thumb'         => 'max_len,200',
                'description'   => 'required',
                'keywords'      => 'required|max_len,200',
                'show_author'   => 'required|max_len,1',
                'show_comments' => 'required|max_len,1',
                'show_created'  => 'required|max_len,1',
                'active'        => 'required|max_len,1',
                'body'          => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'slug'          => 'slug',
                'category_id'   => 'trim|sanitize_numbers',
                'user_id'       => 'trim|sanitize_numbers',
                'membership_id' => 'trim|sanitize_string',
                'thumb'         => 'trim|sanitize_string',
                'description'   => 'trim|sanitize_string',
                'keywords'      => 'trim|sanitize_string',
                'show_author'   => 'trim|sanitize_numbers',
                'show_comments' => 'trim|sanitize_numbers',
                'show_created'  => 'trim|sanitize_numbers',
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
                
                $checkSlug = $this->db->fetchRow("SELECT id FROM mod_blog WHERE slug = '{$array_data['slug']}'");

                if($checkSlug == false){
                    $this->db->insert('mod_blog', $array_data);

                    $json['heading'] = "Sucesso";
                    $json['text'] =  "Postagem adicionada com sucesso!";
                    $json['icon'] = 'success';
                    echo json_encode($json);
                }else{
                    $json['heading'] = "Erro";
                    $json['text'] =  "Já existe uma postagem com essa URL";
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

        public function update($array_data, $id){

            if(empty($array_data['slug'])){
                $array_data['slug'] = $array_data['title'];
            }

            $array_data['modified'] = date('Y-m-d H:i:s');

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'title'         => 'required|max_len,200',
                'slug'          => 'max_len,100',
                'category_id'   => 'required|max_len,1',
                'membership_id' => 'max_len,1',
                'thumb'         => 'max_len,200',
                'description'   => 'required',
                'keywords'      => 'required|max_len,200',
                'show_author'   => 'required|max_len,1',
                'show_comments' => 'required|max_len,1',
                'show_created'  => 'required|max_len,1',
                'active'        => 'required|max_len,1',
                'body'          => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'title'         => 'trim|sanitize_string',
                'slug'          => 'slug',
                'category_id'   => 'trim|sanitize_numbers',
                'user_id'       => 'trim|sanitize_numbers',
                'membership_id' => 'trim|sanitize_string',
                'thumb'         => 'trim|sanitize_string',
                'description'   => 'trim|sanitize_string',
                'keywords'      => 'trim|sanitize_string',
                'show_author'   => 'trim|sanitize_numbers',
                'show_comments' => 'trim|sanitize_numbers',
                'show_created'  => 'trim|sanitize_numbers',
                'active'        => 'trim|sanitize_numbers',
                'modified'      => 'trim|sanitize_string',
                'created'       => 'trim|sanitize_string',
                'body'          => 'htmlencode'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $this->db->update('mod_blog', $array_data, ['id = ?'=> $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Postagem atualizada com sucesso!";
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
                
                $this->db->delete('mod_blog', ['id = ?' => $id]);
                

                $json['heading'] = "Sucesso";
                $json['text'] =  "Postagem excluída com sucesso!";
                $json['icon'] = 'success';
            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Não foi possível excluir!";
                $json['icon'] = 'danger';
            }
            echo json_encode($json);
        }


        public function blogDataTable(){
           return $this->db->fetchAll("SELECT blog.id, blog.title, blog.created, blog.active, category.name AS category, users.fname FROM mod_blog AS blog 
                                       LEFT JOIN users AS users ON blog.user_id = users.id 
                                       LEFT JOIN mod_blog_categories AS category ON blog.category_id = category.id");
        }

        public function commentsDataTable(){
           return $this->db->fetchAll("SELECT comments.id, comments.comment, comments.created, comments.status, IF(users.fname IS NULL, comments.name, users.fname) AS name, IF(users.avatar IS NULL, 'blank.jpg', users.avatar) AS avatar
                                       FROM mod_blog_comments AS comments 
                                       LEFT JOIN users AS users ON comments.id_user = users.id");
        }

        public function getPosts(int $offset = 0, int $limit = 20){
            return $this->db->fetchAll("SELECT blog.title, blog.slug, blog.thumb, blog.description, blog.created, users.fname AS author, category.name as category, category.slug AS category_slug, pages.slug AS blogslug FROM mod_blog AS blog 
                                        LEFT JOIN users AS users ON blog.user_id = users.id 
                                        LEFT JOIN mod_blog_categories AS category ON blog.category_id = category.id
                                        LEFT JOIN pages ON pages.module_name = 'blog'
                                        WHERE blog.created < NOW() ORDER BY blog.created DESC LIMIT {$offset},{$limit}");
        }

        public function getPostsNumRows(){
            return $this->db->fetchOne("SELECT count(id) FROM mod_blog WHERE created < NOW() ORDER BY created");
        }

        public function getPostByID(int $id){
            if(is_int($id)){
                return $this->db->fetchRow("SELECT * FROM mod_blog WHERE id = {$id}");
            }
        }

        public function searchPost($search, int $offset = 0, int $limit = 20){
            $search = addslashes($search);
            return $this->db->fetchAll("SELECT blog.*, category.name as category, pages.slug AS blogslug FROM mod_blog as blog
                                        LEFT JOIN mod_blog_categories AS category ON blog.category_id = category.id
                                        LEFT JOIN pages ON pages.module_name = 'blog'
                                        WHERE body LIKE '%{$search}%' LIMIT {$offset},{$limit}");
        }

        public function getPostByCategory($category, int $offset = 0, int $limit = 20){
            $category = addslashes($category);
            return $this->db->fetchAll("SELECT blog.*, users.fname AS author, category.name AS category, pages.slug AS blogslug FROM mod_blog AS blog
                                        LEFT JOIN mod_blog_categories AS category ON category.slug = '{$category}' 
                                        LEFT JOIN users AS users ON blog.user_id = users.id
                                        LEFT JOIN pages ON pages.module_name = 'blog'
                                        WHERE category_id = category.id LIMIT {$offset},{$limit}");
        }

        public function getPostsCategoryNumRows($category){
            $category = addslashes($category);
            return $this->db->fetchOne("SELECT count(blog.id) FROM mod_blog as blog
                                        LEFT JOIN mod_blog_categories AS category ON category.slug = '{$category}' 
                                        WHERE category_id = category.id AND created < NOW() ORDER BY created");
        }

        public function getPostBySlug($slug, $hit = false){
            if(!empty($slug)){
                $slug = addslashes($slug);
                if($hit == true){
                    $this->db->query("UPDATE mod_blog SET hits = hits + 1 WHERE slug = '{$slug}'");
                }
                return $this->db->fetchAll("SELECT blog.*, users.fname AS author, category.name AS category, category.slug AS category_slug, pages.slug AS blogslug FROM mod_blog AS blog 
                                            LEFT JOIN users AS users ON blog.user_id = users.id 
                                            LEFT JOIN mod_blog_categories AS category ON blog.category_id = category.id
                                            LEFT JOIN pages ON pages.module_name = 'blog'
                                            WHERE blog.slug = '{$slug}'");
            }
        }

        public function getPopular(int $limit = 5){
            return $this->db->fetchAll("SELECT blog.title, blog.slug, blog.thumb, pages.slug AS slugblog FROM mod_blog AS blog 
                                        LEFT JOIN pages AS pages ON pages.module_name = 'blog' 
                                        WHERE blog.created < NOW() AND blog.active = 1 ORDER BY blog.hits DESC LIMIT {$limit}");
        }

        public function getComments(int $id_post, int $id_comment = 0){
            if($id_comment == 0){
                $order = 'DESC';
            }else{
                $order = 'ASC';
            }

            return $this->db->fetchAll("SELECT comments.*, users.avatar FROM mod_blog_comments AS comments
                                        LEFT JOIN users AS users ON comments.id_user = users.id
                                        WHERE id_post = '{$id_post}' AND parent_id = '{$id_comment}' AND status = 1 ORDER BY created {$order}");
        }

        
        public function approveComment($id) {
            $this->db->update('mod_blog_comments', ['status' => 1], ['id = ?'=> $id]);

            $json['heading'] = "Sucesso";
            $json['text'] =  "Comentário aprovado com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }

        public function addComment($array_data){

            if(isset($_SESSION['user_id'])){
                $array_data['id_user'] = $_SESSION['user_id'];
                $array_data['name'] = $_SESSION['user_name'];
                $array_data['email'] = $this->db->fetchOne("SELECT email FROM users WHERE id = {$array_data['id_user']}");
            }else{
                $array_data['id_user'] = 0;
            }

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'name'      => 'required|max_len,100',
                'email'     => 'max_len,100',
                'comment'   => 'required|max_len,450'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'id_post'   => 'trim|sanitize_numbers',
                'id_user'   => 'trim|sanitize_numbers',
                'name'      => 'trim|sanitize_string',
                'email'     => 'trim|sanitize_string',
                'comment'   => 'trim|sanitize_string'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $this->db->insert('mod_blog_comments', $array_data);

                $data = array(
                    'title'   => 'Comentário Adicionado',
                    'msg'     => 'Um novo comentário foi adicionado por '. $array_data['name'],
                    'icon'    => 'fas fa-comment',
                    'color'   => 'success',
                    'link'    => 'module/view/blog/comments',
                    'status'  => 1
                );

                $notification = new Notification();
                $notification->insert($data);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Comentário enviado com sucesso. O administrador precisa aprovar o seu comentário para que ele seja exibido!";
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

        public function addCommentReplay($array_data){

            if(isset($_SESSION['user_id'])){
                $array_data['id_user'] = $_SESSION['user_id'];
                $array_data['name'] = $_SESSION['user_name'];
                $array_data['email'] = $this->db->fetchOne("SELECT email FROM users WHERE id = {$array_data['id_user']}");
            }else{
                $array_data['id_user'] = 0;
            }

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'name'      => 'required|max_len,100',
                'email'     => 'max_len,100',
                'comment'   => 'required|max_len,100'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'id_post'   => 'trim|sanitize_numbers',
                'parent_id' => 'trim|sanitize_numbers',
                'id_user'   => 'trim|sanitize_numbers',
                'name'      => 'trim|sanitize_string',
                'email'     => 'trim|sanitize_string',
                'comment'   => 'trim|sanitize_string'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $data = array(
                    'title'   => 'Comentário Adicionado',
                    'msg'     => 'Uma resposta de comentário foi adicionado por '. $array_data['name'],
                    'icon'    => 'fas fa-comment',
                    'color'   => 'success',
                    'link'    => 'module/view/blog/comments',
                    'status'  => 1
                );

                $notification = new Notification();
                $notification->insert($data);

                $this->db->insert('mod_blog_comments', $array_data);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Resposta adicionada com sucesso!";
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


        public function deleteComment($id){
            $id = (int)$id;
            if(!empty($id) && is_int($id)){
                
                $this->db->delete('mod_blog_comments', ['id = ?' => $id]);
                

                $json['heading'] = "Sucesso";
                $json['text'] =  "Comentário excluído com sucesso!";
                $json['icon'] = 'success';
            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Não foi possível excluir!";
                $json['icon'] = 'danger';
            }
            echo json_encode($json);
        }

        public function metatags($config, $viewData){
            $meta = ''. PHP_EOL;;
            $url = explode('index.php', $_SERVER['PHP_SELF']);
            $url = explode('/', $url[1]);
            if(isset($url[2]) && $url[2] == 'visualizar' && isset($url[3]) && !empty($url[3])){

                $data = $this->getPostBySlug($url[3]);
                $data = $data[0];

                $meta .= '<title>'.$config['site_name'].' - '.$data['title'].'</title>'. PHP_EOL;
                $meta .= '<meta name="keywords" content="'.$data['keywords'].'">'. PHP_EOL;
                $meta .= '<meta name="description" content="'.$data['description'].'">'. PHP_EOL;
                $meta .= '<meta property="og:url" content="'.DOMAIN.''.$_SERVER['REQUEST_URI'].'">'. PHP_EOL;
                $meta .= '<meta property="og:title" content="'.$data['title'].'">'. PHP_EOL;
                $meta .= '<meta property="og:site_name" content="'.$config['site_name'].'">'. PHP_EOL;
                $meta .= '<meta property="og:description" content="'.$data['description'].'">'. PHP_EOL;
                $meta .= '<meta property="og:image" content="'.BASE_UPLOADS.'/'.$data['thumb'].'">'. PHP_EOL;
                $meta .= '<meta property="og:type" content="article">'. PHP_EOL;
                $meta .= '<meta property="article:author" content="'.$data['author'].'">'. PHP_EOL;
                $meta .= '<meta property="article:section" content="'.$data['category'].'">'. PHP_EOL;
                $meta .= '<meta property="article:tag" content="'.$data['keywords'].'">'. PHP_EOL;
                $meta .= '<meta property="article:published_time" content="'.$data['created'].'">'. PHP_EOL;
                
            }else{
                $meta .= '<title>'.$config['site_name'].' - '.$viewData['title'].'</title>'. PHP_EOL;
                $meta .= '<meta name="keywords" content="'.$viewData['keywords'].'">'. PHP_EOL;
                $meta .= '<meta name="description" content="'.$viewData['description'].'">'. PHP_EOL;
                $meta .= '<meta property="og:url" content="'.DOMAIN.''.$_SERVER['REQUEST_URI'].'">'. PHP_EOL;
                $meta .= '<meta property="og:title" content="'.$viewData['title'].'">'. PHP_EOL;
                $meta .= '<meta property="og:site_name" content="'.$config['site_name'].'">'. PHP_EOL;
                $meta .= '<meta property="og:description" content="'.$viewData['description'].'">'. PHP_EOL;
                $meta .= '<meta property="og:image" content="'.BASE_UPLOADS.'/'.$config['site_logo'].'">'. PHP_EOL;
                $meta .= '<meta property="og:type" content="website">'. PHP_EOL;
            }

            return $meta;
        }
        
    }
?>