<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Mail extends controller{

        public function __construct($subject, $body, $recipient){
            parent::__construct();
            require_once('libs/mailer/PHPMailerAutoload.php');
            $mail = new PHPMailer();

            try {
                $mail->SMTPDebug = 1;
                $mail->CharSet = "UTF-8";

                if($this->config['site_mailer'] == 'SMTP') {
                    $mail->isSMTP();
                }else {
                    $mail->isMail();
                }

                //Server settings
                $mail->Host       = $this->config['smtp_host'];
                $mail->Username   = $this->config['smtp_user'];
                $mail->Password   = $this->config['smtp_pass'];
                $mail->Port       = $this->config['smtp_port'];
                $mail->SMTPAuth   = $this->config['smtp_auth'];
                $mail->SMTPSecure = $this->config['smtp_secure'];

                 //Recipients
                $mail->setFrom("{$this->config['site_email']}", "{$this->config['site_name']}");
                $mail->addAddress("{$recipient}");
                $mail->addReplyTo($this->config['site_email']);
                
                // Content
                $mail->isHTML(true);
                $mail->Subject = "{$subject}";
                $mail->Body = "{$body}";
                
                if (!$mail->send()) {
                    $msg = 'Erro ao enviar! Tente novamente mais tarde';
                } else {
                    $msg = 'Mensagem Enviada';
                }

            } catch (Exception $e) {
                echo "A mensagem não pôde ser enviada. Erro do Mailer: {$mail->ErrorInfo}";
            }
        }

    }
?>