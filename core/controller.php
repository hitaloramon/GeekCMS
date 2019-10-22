<?php
    class controller {

        public  $config;

        public function __construct(){
            $cfg = new Config();
            $this->config = $cfg->getConfig();
            date_default_timezone_set($this->config['site_timezone']);
            setlocale (LC_ALL, $this->config['site_locale']);
            
            if(!defined('DOMAIN')){
                define('DOMAIN', $this->config['site_url']);
                define('BASE', $this->config['site_url'].$this->config['site_dir']);
                define('BASE_ADMIN', $this->config['site_url'].$this->config['site_dir'].'/admin');
                define('BASE_UPLOADS', $this->config['site_url'].$this->config['site_dir'].'/uploads');
                define('BASE_UPLOADS_PATH', $_SERVER['DOCUMENT_ROOT'].$this->config['site_dir'].'/uploads');
                $_SESSION['BASE'] = BASE;
            }
        }

        public function loadView($viewName, $viewData = array()){
            extract($viewData);
            include 'views/'.$viewName.'.php';
        }

        public function loadTemplate($viewData = array()){
            if(isset($_GET['theme']) && is_dir("views/front/templates/{$_GET['theme']}")){
                include 'views/front/templates/'.$_GET['theme'].'/template.tpl.php';
            }else{
                include 'views/front/templates/'.$this->config['site_theme'].'/template.tpl.php';
            }
        }

        public function loadTemplateInAdmin($viewName, $viewData = array()){
            include 'views/admin/admin.php';
        }

        public function loadSnippets($snippet, $viewData = array()){
            extract($viewData);
            include 'views/front/templates/'.$this->config['site_theme'].'/snippets/'.$snippet.'.php';
        }
        
        public function renderPage($body){
            $body = html_entity_decode($body);
            preg_match_all("/{{(.*?)}}/", $body, $matches);
            if ($matches[1]) {
                foreach ($matches[1] as $key => $result) {
                    $info = explode('|', $result);

                    // Check is Widget
                    if($info[0] == 'widget'){
                        if (file_exists("views/front/templates/{$this->config['site_theme']}/widgets/{$info[1]}/main.php")) {
                            ob_start();
                            include ("views/front/templates/{$this->config['site_theme']}/widgets/{$info[1]}/main.php");
                            $contents = ob_get_contents();
                            ob_clean();
                            $body = str_replace($matches[0][$key], $contents, $body);
                            if(file_exists("views/front/templates/{$this->config['site_theme']}/widgets/{$info[1]}/js/script.js")){
                                Asset::add('script', ['name' => $info[1], 'url'  => BASE."/views/front/templates/{$this->config['site_theme']}/widgets/{$info[1]}/js/script.js"]);
                            }
    
                            if(file_exists("views/front/templates/{$this->config['site_theme']}/widgets/{$info[1]}/css/style.css")){
                                Asset::add('style', ['name' => $info[1], 'url'  => BASE."/views/front/templates/{$this->config['site_theme']}/widgets/{$info[1]}/css/style.css"]);
                            }
                        } else {
                            if (file_exists("views/front/widgets/{$info[1]}/main.php")) {
                                ob_start();
                                include ("views/front/widgets/{$info[1]}/main.php");
                                $contents = ob_get_contents();
                                ob_clean();
                                $body = str_replace($matches[0][$key], $contents, $body);
                                
                                if(file_exists("views/front/widgets/{$info[1]}/js/script.js")){
                                    Asset::add('script', ['name' => $info[1], 'url'  => BASE."/views/front/widgets/{$info[1]}/js/script.js"]);
                                }
    
                                if(file_exists("views/front/widgets/{$info[1]}/css/style.css")){
                                    Asset::add('style', ['name' => $info[1], 'url'  => BASE."/views/front/widgets/{$info[1]}/css/style.css"]);
                                }
                            }
                        }
                    }

                    // Check is Module
                    if($info[0] == 'module'){
                        if (file_exists("views/front/templates/{$this->config['site_theme']}/modules/{$info[1]}/main.php")) {
                            ob_start();
                            include ("views/front/templates/{$this->config['site_theme']}/modules/{$info[1]}/main.php");
                            $contents = ob_get_contents();
                            ob_clean();
                            $body = str_replace($matches[0][$key], $contents, $body);
                            if(file_exists("views/front/templates/{$this->config['site_theme']}/modules/{$info[1]}/js/script.js")){
                                Asset::add('script', ['name' => $info[1], 'url'  => BASE."/views/front/templates/{$this->config['site_theme']}/modules/{$info[1]}/js/script.js"]);
                            }
    
                            if(file_exists("views/front/templates/{$this->config['site_theme']}/modules/{$info[1]}/css/style.css")){
                                Asset::add('style', ['name' => $info[1], 'url'  => BASE."/views/front/templates/{$this->config['site_theme']}/modules/{$info[1]}/css/style.css"]);
                            }
                        } else {
                            if (file_exists("views/front/modules/{$info[1]}/main.php")) {
                                ob_start();
                                include ("views/front/modules/{$info[1]}/main.php");
                                $contents = ob_get_contents();
                                ob_clean();
                                $body = str_replace($matches[0][$key], $contents, $body);
                                
                                if(file_exists("views/front/modules/{$info[1]}/js/script.js")){
                                    Asset::add('script', ['name' => $info[1], 'url'  => BASE."/views/front/modules/{$info[1]}/js/script.js"]);
                                }
    
                                if(file_exists("views/front/modules/{$info[1]}/css/style.css")){
                                    Asset::add('style', ['name' => $info[1], 'url'  => BASE."/views/front/modules/{$info[1]}/css/style.css"]);
                                }
                            }
                        }
                    }

                    if($info[0] == 'page'){
                        if(file_exists("views/front/templates/{$this->config['site_theme']}/pages/{$info[1]}.php")){
                            ob_start();
                            include ("views/front/templates/{$this->config['site_theme']}/pages/{$info[1]}.php");
                            $contents = ob_get_contents();
                            ob_clean();
                            $body = str_replace($matches[0][$key], $contents, $body);
                        }
                    }
                    
                }
                
            }

            return $body;
        }

        public function renderMetatags($viewData = array()){
            $meta = '';
            $routes = new Routes();
            $routes = $routes->getRoutes();

            if(in_array($viewData['slug'], $routes)) { 
                $module = array_search($viewData['slug'], $routes);
                $module = 'Mod'.$module;
                $module = new $module();
                 if(method_exists($module, 'metatags')){
                    $meta = $module->metatags($this->config, $viewData);
                 }
            }
            
            if(empty($meta)){
                $meta .= '<title>'.$this->config['site_name'].' - '.$viewData['title'].'</title>'. PHP_EOL;
                $meta .= '<meta name="keywords" content="'.$viewData['keywords'].'">'. PHP_EOL;
                $meta .= '<meta name="description" content="'.$viewData['description'].'">'. PHP_EOL;

                $meta .= '<meta property="og:url" content="'.DOMAIN.''.$_SERVER['REQUEST_URI'].'">'. PHP_EOL;
                $meta .= '<meta property="og:title" content="'.$viewData['title'].'">'. PHP_EOL;
                $meta .= '<meta property="og:site_name" content="'.$this->config['site_name'].'">'. PHP_EOL;
                $meta .= '<meta property="og:description" content="'.$viewData['description'].'">'. PHP_EOL;
                $meta .= '<meta property="og:image" content="'.BASE_UPLOADS.'/'.$this->config['site_logo'].'">'. PHP_EOL;
                $meta .= '<meta property="og:type" content="website">'. PHP_EOL;
            }

            $meta .= '<meta charset="UTF-8">'. PHP_EOL;
            $meta .= '<meta name="theme-color" content="#0b6ac8">'. PHP_EOL;
            $meta .= '<meta name="robots" content="index,follow">'. PHP_EOL;
            $meta .= '<meta name="generator" content="Powered by GeekCMS">'. PHP_EOL;
            $meta .= '<meta http-equiv="X-UA-Compatible" content="ie=edge">'. PHP_EOL;
            $meta .= '<meta name="apple-mobile-web-app-capable" content="yes">'. PHP_EOL;
            $meta .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">'. PHP_EOL;
            $meta .= '<meta name="author" content="'.$this->config['site_name'].'">'. PHP_EOL;
            $meta .= '<meta name="dcterms.rights" content="'.$this->config['site_name'].' &copy; All Rights Reserved">'. PHP_EOL;
            $meta .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">'. PHP_EOL;

            if (!empty($this->config['site_favicon'])){
                $meta .= '<link rel="shortcut icon" href="'.BASE_UPLOADS.'/'.$this->config['site_favicon'].'" type="image/x-icon">'. PHP_EOL;
            }

            echo($meta);
        }

        public function getConfig(){
            return $this->config;
        }
        
    }
?>