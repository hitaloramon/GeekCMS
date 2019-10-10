<?php
class controllerController extends controller{

    public function __construct(){
        parent::__construct();
    }

    public function index(){

    }

    public function login(){
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $u = new User();
            $data = $u->loginCheck($_POST);
            echo $data;
        }
    }

    public function profile(){
        if(isset($_POST) && !empty($_POST)){
            $u = new User();
            $u->userUpdateProfile($_POST);
        }
    }

    public function activate(){
        if(isset($_POST) && !empty($_POST)){
            $u = new User();
            $u->userActivate($_POST);
        }
    }

    public function contact(){
        if($_SESSION['captcha_code'] == $_POST['captcha']){
            if(isset($_POST) && !empty($_POST)){
                $validator = new Gump('pt-br');
                $_POST = $validator->sanitize($_POST);

                $email_model = new EmailModel();
                $email_model = $email_model->getModel(7);

                $body = html_entity_decode($email_model['body']);
                $body = str_replace("[NAME]", $_POST['name'], $body);
                $body = str_replace("[EMAIL]", $_POST['email'], $body);
                $body = str_replace("[SUBJECT]", $_POST['subject'], $body);
                $body = str_replace("[IP]", $_SERVER['REMOTE_ADDR'], $body);
                $body = str_replace("[MESSAGE]", $_POST['message'], $body);
                $body = str_replace("[SITE_NAME]", $this->config['site_name'], $body);
                $body = str_replace("[SITE_URL]", BASE, $body);
                $body = str_replace("[LOGO]", '<a href="'.BASE.'"><img src="'.BASE_UPLOADS.'/'.$this->config['site_logo'].'" alt="'.$this->config['site_name'].'"></a>', $body);

                $mail = new Mail($email_model['subject'], $body, $this->config['site_email']);
                 
                $json['heading'] = "Sucesso";
                $json['text'] =  "Mensagem enviada com sucesso!";
                $json['icon'] = 'success';
                echo json_encode($json);

                unset($_SESSION['captcha_code']);
            }
        }else{
            $json['heading'] = "Erro";
            $json['text'] =  "O código captcha não confere!";
            $json['icon'] = 'danger';
            echo json_encode($json);
        }
    }

    public function recovery(){
        if(isset($_POST) && !empty($_POST)){
            $u = new User();
            $u->userRecovery($_POST);
        }
    }

    public function changepassword(){
        if(isset($_POST) && !empty($_POST)){
            $u = new User();
            $u->userChangePassword($_POST);
        }
    }

    public function register(){
        if(isset($_POST) && !empty($_POST)){
            $u = new User();
            $u->userRegister($_POST);
        }
    }

    public function address(){
        if(isset($_POST) && !empty($_POST)){
            $u = new User();
            $u->userUpdateAddress($_POST, $_SESSION['user_id']);
        }
    }

    public function commentadd(){
        if(isset($_POST) && !empty($_POST)){
            $blog = new ModBlog();
            $blog->addComment($_POST);
        }
    }

    public function commentreplay(){
        if(isset($_POST) && !empty($_POST)){
            $blog = new ModBlog();
            $blog->addCommentReplay($_POST);
        }
    }

}
?>