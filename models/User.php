<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }
    class User extends model {

        public function verifyLogin(){
            if(!isset($_SESSION['user_group']) || ($_SESSION['user_group'] == 0 || $_SESSION['user_group'] == null)){
                header('Location: '.BASE_ADMIN.'/login');
                exit;
            }
        }
        

        public function loginCheck($array_data){
            $ip = $_SERVER['REMOTE_ADDR'];
            $result = $this->db->fetchAll("SELECT * FROM logs WHERE action = 'login_error' AND ip = '{$ip}' AND date > NOW() - INTERVAL 20 MINUTE ORDER BY id DESC LIMIT 6");

            if(count($result) >= 5){
                $json['heading'] = "Erro";
                $json['text'] =  "Houve muitas tentativas de logins inválidas. Você está bloqueado por 20 minutos!";
                $json['icon'] = 'danger';
                return json_encode($json);
                exit;
            }

            if(empty($array_data['password'])){
                unset($array_data['password']);
            }

            $validator = new Gump('pt-br');
            $array_data = $validator->sanitize($array_data);

            $rules = array(
                'email'    => 'required|valid_email',
                'password' => 'required'
            );
            
            $filters = array(
                'email' 	  => 'trim|sanitize_email',
                'password'	  => 'trim|sha1'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            $validator->set_field_name("email", "Email");
            $validator->set_field_name("password", "Senha");

            if($validated === true){

                // Protect
                $array_diff = array_diff_key($array_data, $filters);
                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }
                
                extract($array_data);
                $result = $this->db->fetchRow("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
                
                if($result > 0){

                    switch ($result['active']) {
                        case 'y':
                            $_SESSION['user_id'] = $result['id'];
                            $_SESSION['user_name'] = $result['fname'];
                            $_SESSION['user_avatar'] = $result['avatar'];
                            $_SESSION['user_group'] = $result['userlevel'];

                            $dataUpdate = array(
                                'lastip'    => $_SERVER['REMOTE_ADDR'],
                                'lastlogin' => date("Y-m-d H:i:s")
                            );

                            if(strtotime($result['mem_expire']) < strtotime(date("Y-m-d H:i:s"))){
                                $dataUpdate['mem_expire'] = '2000-01-01 00:00:00';
                                $dataUpdate['membership_id'] = 0;
                            }

                            $this->db->update('users', $dataUpdate, ['id = ?' => $result['id']]);

                            $json['heading'] = "Sucesso";
                            $json['text'] =  "Usuário logado com sucesso!";
                            $json['icon'] = 'success';
                            return json_encode($json);
                        break;
                        case 'n':
                            $json['heading'] = "Erro";
                            $json['text'] =  "Esse usuário está inativo e não pode acessar o sistema!";
                            $json['icon'] = 'danger';
                            return json_encode($json);
                        break;
                        case 't':
                            $json['heading'] = "Erro";
                            $json['text'] =  "Esse usuário está pendente ao processo de ativação. Verifique seu email para ativar sua conta";
                            $json['icon'] = 'danger';
                            return json_encode($json);
                        break;
                        case 'b':
                            $json['heading'] = "Erro";
                            $json['text'] =  "Esse usuário está banido e não pode acessar o sistema!";
                            $json['icon'] = 'danger';
                            return json_encode($json);
                        break;
                    }
                }else{
                    $logs = new Logs();
                    
                    $data_logs = array(
                        'action'        => 'login_error',
                        'description'   => "O usuário {$array_data['email']} informou os dados de login inválidos",
                        'type'          => 'system',
                        'level'         => 'warning',
                        'ip'            => $_SERVER['REMOTE_ADDR'],
                    );
                    
                    $logs->insert($data_logs);

                    $json['heading'] = "Erro";
                    $json['text'] =  "Login ou senha inválidos";
                    $json['icon'] = 'danger';
                    return json_encode($json);
                }
            }else{
                return $validator->get_readable_errors(true);
            }
        }


        public function getUser(int $id = null){
            $array = array();
            if($id == null){
                $array = $this->db->fetchAll("SELECT * FROM users");
            }else{
                $array = $this->db->fetchRow("SELECT * FROM users WHERE id = '$id'");
            }

            return ($array) ? $array : 0;
        }


        public function getAddress(int $id){
            return $this->db->fetchRow("SELECT * FROM users_address WHERE id_user = '$id'");
        }

        public function getUserDatatable(){
            $array = $this->db->fetchAll("SELECT u.id, u.email, u.fname, u.active, m.title, p.name FROM users AS u LEFT JOIN memberships AS m ON u.membership_id = m.id LEFT JOIN permissions_groups AS p ON u.userlevel = p.id");
            echo json_encode($array);
        }


        public function userInsert($array_data){

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'password'      => 'required|max_len,50|min_len,1',
                'fname'         => 'required',
                'lname'         => 'required',
                'email'         => 'required|valid_email',
                'userlevel'     => 'integer|max_len,1',
                'newsletter'    => 'integer|max_len,1',
                'membership_id' => 'integer|max_len,1',
                'active'        => 'max_len,1'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'password'      => 'trim|sha1',
                'fname'         => 'trim|sanitize_string',
                'lname'         => 'trim|sanitize_string',
                'email'         => 'trim|sanitize_string',
                'userlevel'     => 'trim|sanitize_numbers',
                'newsletter'    => 'trim|sanitize_numbers',
                'membership_id' => 'trim|sanitize_numbers',
                'active'        => 'trim|sanitize_string'
            );

            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                if($array_data['membership_id'] != 0){
                    $memberships = new Memberships();
                    $member = $memberships->getMembershipByID($array_data['membership_id']);
                    if($member['trial'] == true){
                        $array_data['trial_used'] = 1;
                    }
                    $array_data['mem_expire'] = calculateDays($member['period'], $member['days']);
                }

                $checkUser = $this->db->fetchRow("SELECT * FROM users WHERE email = '{$array_data['email']}'");

                if($checkUser == false){
                    $this->db->insert('users', $array_data);

                    $json['heading'] = "Sucesso";
                    $json['text'] =  "Usuário adicionado com sucesso!";
                    $json['icon'] = 'success';
                }else{
                    $json['heading'] = "Erro";
                    $json['text'] =  "Já existe um usuário com esse login ou email!";
                    $json['icon'] = 'danger';
                }
                
                echo json_encode($json);

            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Algumas informações são necessárias!";
                $json['icon'] = 'danger';
                $json['error'] = $validator->get_readable_errors(false);
                echo json_encode($json);
            }
        }

        public function userRegister($array_data){

            $validator = new Gump('pt-br');
            $password = $array_data['password'];

            if($array_data['password'] != $array_data['confirm_password']){
                $json['heading'] = "Erro";
                $json['text'] =  "A senha inserida não é igual a senha de configuração!";
                $json['icon'] = 'danger';
                echo json_encode($json);
                exit;
            }
    
            // Regras para validar os campos
            $rules = array(
                'password'          => 'required|max_len,50|min_len,1',
                'confirm_password'  => 'required|max_len,50|min_len,1',
                'fname'             => 'required',
                'lname'             => 'required',
                'email'             => 'required|valid_email'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'password'      => 'trim|sha1',
                'fname'         => 'trim|sanitize_string',
                'lname'         => 'trim|sanitize_string',
                'email'         => 'trim|sanitize_email',
                'active'        => 'trim|sanitize_string',
                'captcha'       => 'trim|sanitize_numbers',
                'mem_expire'    => 'trim|sanitize_numbers'
            );

            if($_SESSION['captcha_code'] != $array_data['captcha']){
                $json['heading'] = "Erro";
                $json['text'] =  "Código Captcha inválido";
                $json['icon'] = 'danger';
                echo json_encode($json);
                exit;
            }

            $validator->set_field_name("email", "Email");
            $validator->set_field_name("fname", "Nome");
            $validator->set_field_name("lname", "Sobrenome");
            $validator->set_field_name("password", "Senha");

            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);
            

            if($validated === true){

                $config = new Config();
                $config = $config->getConfig();

                if($config['reg_allowed'] != 1){
                    $json['heading'] = "Erro";
                    $json['text'] =  "O Administrador desativou novos cadastros!";
                    $json['icon'] = 'danger';
                    echo json_encode($json);
                    exit;
                }

                $checkUser = $this->db->fetchRow("SELECT id FROM users WHERE email = '{$array_data['email']}'");

                if($checkUser == false){
                    unset($array_data['confirm_password']);
                    unset($array_data['captcha']);

                    // Configura Plano de Acesso.
                    if($array_data['membership_id'] == 0){
                        $array_data['mem_expire'] = '2000-01-01 00:00:00';
                    }else{
                        $memberships = new Memberships();
                        $member = $memberships->getMembershipByID($array_data['membership_id']);
                        if($member['trial'] == true){
                            $array_data['trial_used'] = 1;
                        }
                        $array_data['mem_expire'] = calculateDays($member['period'], $member['days']);
                    }

                    $array_diff = array_diff_key($array_data, $filters);
                    foreach ($array_diff as $key => $value) {
                        $array_custom_value[$key] = $array_data[$key];
                        unset($array_data[$key]);
                    }

                    // Envio de Email
                    if($config['auto_verify'] == 1){
                        $array_data['active'] = 'y';

                        $email_model = new EmailModel();
                        $email_model = $email_model->getModel(6);

                        $body = html_entity_decode($email_model['body']);
                        $body = str_replace("[NAME]", $array_data['fname'], $body);
                        $body = str_replace("[PASSWORD]", $password, $body);
                        $body = str_replace("[SITE_NAME]", $config['site_name'], $body);
                        $body = str_replace("[SITE_URL]", BASE, $body);
                        $body = str_replace("[LOGO]", '<a href="'.BASE.'"><img src="'.BASE_UPLOADS.'/'.$config['site_logo'].'" alt="'.$config['site_name'].'"></a>', $body);

                        $mail = new Mail($email_model['subject'], $body, $array_data['email']);
                    
                    }else{
                        $array_data['active'] = 't';
                        $array_data['token'] = md5(uniqid(rand(), true));

                        $email_model = new EmailModel();
                        $email_model = $email_model->getModel(1);

                        $body = html_entity_decode($email_model['body']);
                        $body = str_replace("[NAME]", $array_data['fname'], $body);
                        $body = str_replace("[PASSWORD]", $password, $body);
                        $body = str_replace("[SITE_NAME]", $config['site_name'], $body);
                        $body = str_replace("[SITE_URL]", BASE, $body);
                        $body = str_replace("[TOKEN]", $array_data['token'], $body);
                        $body = str_replace("[INFO]", "".BASE."/{$config['page_activate']}/{$array_data['email']}/{$array_data['token']}", $body);
                        $body = str_replace("[LOGO]", '<a href="'.BASE.'"><img src="'.BASE_UPLOADS.'/'.$config['site_logo'].'" alt="'.$config['site_name'].'"></a>', $body);

                        $mail = new Mail($email_model['subject'], $body, $array_data['email']);
                    }

                    $lastid = $this->db->insert('users', $array_data);

                    if($config['notify_admin'] == 1){
                        $data = array(
                            'title'   => 'Novo Cadastro',
                            'msg'     => $array_data['fname']. ' se cadastrou no site.',
                            'icon'    => 'fas fa-user',
                            'color'   => 'warning',
                            'status'  => 1
                        );

                        $notification = new Notification();
                        $notification->insert($data);
                    }

                    foreach ($array_diff as $key => $value) {
                        $array_custom = array(
                            'id_user'      => $lastid,
                            'field_name'   => $key,
                            'field_value'  => $array_custom_value[$key]
                        );
                        
                        $this->db->insert('custom_fields_data', $array_custom);
                    }

                    $json['heading'] = "Sucesso";
                    $json['text'] =  "Usuário adicionado com sucesso!";
                    $json['icon'] = 'success';
                }else{
                    $json['heading'] = "Erro";
                    $json['text'] =  "Já existe um usuário com esse login ou email!";
                    $json['icon'] = 'danger';
                }
                
                echo json_encode($json);

            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Algumas informações são necessárias!";
                $json['icon'] = 'danger';
                $json['error'] = $validator->get_readable_errors(false);
                echo json_encode($json);
            }
        }

        

        public function userUpdateMembership($id_user, $membership_id){
            
            $array_data = array();

            $memberships = new Memberships();
            $member = $memberships->getMembershipByID($membership_id);
            if($member['trial'] == true){
                $array_data['trial_used'] = 1;
            }
            $array_data['mem_expire'] = calculateDays($member['period'], $member['days']);
            $array_data['membership_id'] = $membership_id;

            $this->db->update('users', $array_data, ["id = ?" => $id_user]);
        }


        public function userUpdate($array_data, $id){

            $validator = new Gump('pt-br');

            if(empty($array_data['password'])){
                unset($array_data['password']);
            }
    
            // Regras para validar os campos
            $rules = array(
                'password'      => 'max_len,50|min_len,1',
                'fname'         => 'required',
                'lname'         => 'required',
                'email'         => 'required|valid_email',
                'userlevel'     => 'integer|max_len,1',
                'membership_id' => 'integer|max_len,1',
                'active'        => 'max_len,1'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'password'      => 'trim|sha1',
                'fname'         => 'trim|sanitize_string',
                'lname'         => 'trim|sanitize_string',
                'email'         => 'trim|sanitize_email',
                'userlevel'     => 'trim|sanitize_numbers',
                'membership_id' => 'trim|sanitize_numbers',
                'mem_expire'    => 'trim|sanitize_numbers',
                'active'        => 'trim|sanitize_string'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){

                if($array_data['membership_id'] == 0){
                    $array_data['mem_expire'] = '2000-01-01 00:00:00';
                }

                if(isset($array_data['ext_membership']) && $array_data['ext_membership'] == 'on'){
                    $memberships = new Memberships();
                    $member = $memberships->getMembershipByID($array_data['membership_id']);
                    if($member['trial'] == true){
                        $array_data['trial_used'] = 1;
                    }
                    $array_data['mem_expire'] = calculateDays($member['period'], $member['days']);
                    unset($array_data['ext_membership']);
                }

                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    $array_custom = array(
                        'id_user'      => $id,
                        'field_name'   => $key,
                        'field_value'  => $array_data[$key]
                    );

                    $checkCustom = $this->db->fetchRow("SELECT id FROM custom_fields_data WHERE field_name = '{$key}' AND id_user = '{$id}'");

                    if($checkCustom == false){
                        $this->db->insert('custom_fields_data', $array_custom);
                    }else{
                        $this->db->update('custom_fields_data', $array_custom, ['id_user = ?' => $id, 'field_name = ?' => $key]);
                    }
                    
                    unset($array_data[$key]);
                }

                $this->db->update('users', $array_data, ['id = ?'=> $id]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Usuário atualizado com sucesso!";
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


        public function userActivate($array_data){
            $validator = new Gump('pt-br');
            // Regras para validar os campos
            $rules = array('email' => 'required|valid_email');
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'email'  => 'trim|sanitize_string',
                'token'  => 'trim|sanitize_string',
            );

            if($_SESSION['captcha_code'] != $array_data['captcha']){
                $json['heading'] = "Erro";
                $json['text'] =  "Código Captcha inválido";
                $json['icon'] = 'danger';
                echo json_encode($json);
                exit;
            }
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                
                $array_diff = array_diff_key($array_data, $filters);
                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $array = array(
                    'active'  => 'y',
                    'token'  => '0',
                );

                $checkCustom = $this->db->fetchRow("SELECT id FROM users WHERE email = '{$array_data['email']}' AND token = '{$array_data['token']}'");

                if($checkCustom == true){
                    $this->db->update('users', $array, ['token = ?' => $array_data['token'], 'email = ?' => $array_data['email']]);

                    $json['heading'] = "Sucesso";
                    $json['text'] =  "Usuário ativado com sucesso!";
                    $json['icon'] = 'success';
                    echo json_encode($json);
                }else{
                    $json['heading'] = "Erro";
                    $json['text'] =  "Token ou email inválido!";
                    $json['icon'] = 'danger';
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


        public function userChangePassword($array_data){

            if($array_data['password'] != $array_data['confirm_password']){
                $json['heading'] = "Erro";
                $json['text'] =  "As senhas informadas não são iguais.";
                $json['icon'] = 'danger';
                echo json_encode($json);
                exit;
            }

            if($_SESSION['captcha_code'] != $array_data['captcha']){
                $json['heading'] = "Erro";
                $json['text'] =  "Código Captcha inválido";
                $json['icon'] = 'danger';
                echo json_encode($json);
                exit;
            }
            

            $validator = new Gump('pt-br');
            // Regras para validar os campos
            $rules = array(
                'password'          => 'required|max_len,50|min_len,5',
                'confirm_password'  => 'required|max_len,50|min_len,5',
                'token'             => 'min_len,20'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'password'  => 'trim|sha1',
                'token'     => 'trim|sanitize_string',
            );

            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){
                
                $array_diff = array_diff_key($array_data, $filters);
                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $array = array(
                    'password' => $array_data['password'],
                    'token'    => '0'
                );

                $checkCustom = $this->db->fetchRow("SELECT id FROM users WHERE token = '{$array_data['token']}'");

                if($checkCustom == true){
                    $this->db->update('users', $array, ['token = ?' => $array_data['token']]);

                    $json['heading'] = "Sucesso";
                    $json['text'] =  "Senha alterada com sucesso!";
                    $json['icon'] = 'success';
                    echo json_encode($json);
                }else{
                    $json['heading'] = "Erro";
                    $json['text'] =  "Token inválido!";
                    $json['icon'] = 'danger';
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



        public function userUpdateAddress($array_data, $id){

            $validator = new Gump('pt-br');
    
            // Regras para validar os campos
            $rules = array(
                'postal_code'  => 'required|max_len,8|min_len,8',
                'phone_code'   => 'required|max_len,2|min_len,2',
                'phone'        => 'required|max_len,9',
                'street'       => 'required',
                'number'       => 'required',
                'complement'   => 'required',
                'district'     => 'required',
                'city'         => 'required',
                'state'        => 'required|max_len,2',
                'country'      => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'postal_code'  => 'trim|sanitize_numbers',
                'phone_code'   => 'trim|sanitize_numbers',
                'phone'        => 'trim|sanitize_numbers',
                'street'       => 'trim|sanitize_string',
                'number'       => 'trim|sanitize_string',
                'complement'   => 'trim|sanitize_string',
                'district'     => 'trim|sanitize_string',
                'city'         => 'trim|sanitize_string',
                'state'        => 'trim|sanitize_string',
                'country'      => 'trim|sanitize_string'
            );
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            if($validated === true){

                $array_diff = array_diff_key($array_data, $filters);
                foreach ($array_diff as $key => $value) {
                    unset($array_data[$key]);
                }

                $array_data['id_user'] = $id;
                $check = $this->db->fetchRow("SELECT id FROM users_address WHERE id_user = '{$id}'");
                
                if($check == false){
                    $this->db->insert('users_address', $array_data);
                }else{
                    $this->db->update('users_address', $array_data, ['id_user = ?'=> $id]);
                }

                $json['heading'] = "Sucesso";
                $json['text'] =  "Endereço atualizado com sucesso!";
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


        public function userUpdateProfile($array_data){

            if(!isset($_SESSION['user_id'])){
                exit;
            }

            $validator = new Gump('pt-br');

            if(empty($array_data['password'])){
                unset($array_data['password']);
            }
    
            // Regras para validar os campos
            $rules = array(
                'password'      => 'max_len,50|min_len,1',
                'fname'         => 'required',
                'lname'         => 'required',
                'email'         => 'required|valid_email',
                'newsletter'    => 'required|max_len,1',
                'birthday'      => 'required',
                'captcha'       => 'required'
            );
            
            // Regras para filtra e limpar os campos
            $filters = array(
                'password'      => 'trim|sha1',
                'fname'         => 'trim|sanitize_string',
                'lname'         => 'trim|sanitize_string',
                'email'         => 'trim|sanitize_string',
                'newsletter'    => 'trim|sanitize_numbers',
                'birthday'      => 'trim',
                'captcha'       => 'trim|sanitize_numbers'
            );

            if($_SESSION['captcha_code'] != $array_data['captcha']){
                $json['heading'] = "Erro";
                $json['text'] =  "Código Captcha inválido";
                $json['icon'] = 'danger';
                echo json_encode($json);
                exit;
            }
            
            $array_data = $validator->filter($array_data, $filters);
            $validated = $validator->validate($array_data, $rules);

            $validator->set_field_name("fname", "Nome");
            $validator->set_field_name("lname", "Sobrenome");
            $validator->set_field_name("password", "Senha");

            if($validated === true){

                $array_diff = array_diff_key($array_data, $filters);

                foreach ($array_diff as $key => $value) {
                    $array_custom = array(
                        'id_user'      => $_SESSION['user_id'],
                        'field_name'   => $key,
                        'field_value'  => $array_data[$key]
                    );

                    $checkCustom = $this->db->fetchRow("SELECT id FROM custom_fields_data WHERE field_name = '{$key}' AND id_user = '{$_SESSION['user_id']}'");

                    if($checkCustom == false){
                        $this->db->insert('custom_fields_data', $array_custom, ['id_user = ?'=> $_SESSION['user_id']]);
                    }else{
                        $this->db->update('custom_fields_data', $array_custom, ['id_user = ?' => $_SESSION['user_id'], 'field_name = ?' => $key]);
                    }
                    
                    unset($array_data[$key]);
                }

                unset($array_data['captcha']);
                
                $this->db->update('users', $array_data, ['id = ?'=> $_SESSION['user_id']]);

                $json['heading'] = "Sucesso";
                $json['text'] =  "Usuário atualizado com sucesso!";
                $json['icon'] = 'success';
                echo json_encode($json);

            }else{
                $json['heading'] = "Erro";
                $json['icon'] = 'danger';
                $json['text'] = $validator->get_readable_errors(false);
                echo json_encode($json);
            }
        }


        public function userRecovery($array_data){
            $array = $this->db->fetchRow("SELECT * FROM users WHERE email = '{$array_data['email']}'");

            if($array > 0){
                $validator = new Gump('pt-br');
                $array_data = $validator->sanitize($array_data);
    
                $rules = array('email'=> 'required|valid_email');
                $filters = array('email'=> 'trim|sanitize_string');

                $array_data = $validator->filter($array_data, $filters);
                $validated = $validator->validate($array_data, $rules);

                if($validated === true){
                    
                     $user = $this->db->fetchRow("SELECT fname, email FROM users WHERE email = '{$array_data['email']}'");

                    if($user == true){

                        $token = md5(uniqid(rand(), true));
                        $this->db->update('users', ["token" => $token], ['email = ?' => $array_data['email']]);
                        
                        $email_model = new EmailModel();
                        $email_model = $email_model->getModel(2);

                        $config = new Config();
                        $config = $config->getConfig();

                        $body = html_entity_decode($email_model['body']);
                        $body = str_replace("[NAME]", $user['fname'], $body);
                        $body = str_replace("[EMAIL]", $user['email'], $body);
                        $body = str_replace("[TOKEN]", $token, $body);
                        $body = str_replace("[SITE_NAME]", $config['site_name'], $body);
                        $body = str_replace("[SITE_URL]", BASE, $body);
                        $body = str_replace("[INFO]", "".BASE."/{$config['page_login']}/{$token}", $body);
                        $body = str_replace("[LOGO]", '<a href="'.BASE.'"><img src="'.BASE_UPLOADS.'/'.$config['site_logo'].'" alt="'.$config['site_name'].'"></a>', $body);

                        $mail = new Mail($email_model['subject'], $body, $array_data['email']);

                        $json['heading'] = "Sucesso";
                        $json['text'] =  "Foi enviado um email para atualizar sua senha!";
                        $json['icon'] = 'success';
                        echo json_encode($json);
                    }else{
                        $json['heading'] = "Erro";
                        $json['text'] =  "Não foi encontrado nenhum usuário com o email informado.";
                        $json['icon'] = 'danger';
                        echo json_encode($json);
                    }

                }else{
                    $json['heading'] = "Erro";
                    $json['text'] =  "Algumas informações são necessárias!";
                    $json['icon'] = 'danger';
                    $json['error'] = $validator->get_readable_errors(false);
                    echo json_encode($json);
                }
            }else{
                $json['heading'] = "Erro";
                $json['text'] =  "Nenhum usuário encontrado com o email informado.";
                $json['icon'] = 'danger';
                echo json_encode($json);
            }
        }
        


        public function userDelete($id){
            $id = (int)$id;
            if($id == $_SESSION['user_id']){
                $json['heading'] = "Erro";
                $json['text'] =  "Você não pode apagar esse usuário!";
                $json['icon'] = 'danger';
            }else{
                $this->db->delete('users', ['id = ?' => $id]);
    
                $json['heading'] = "Sucesso";
                $json['text'] =  "Usuário excluído com sucesso!";
                $json['icon'] = 'success';
            }
            echo json_encode($json);
        }


        public function userManageDelete($typeuser, $days){

            $now = date('Y-m-d H:i:s');
			$diff = intval($days);
            $expire = date("Y-m-d H:i:s", strtotime($now . -$diff . " days"));
            
            switch ($typeuser){
                case 'n':
                    $this->db->delete('users', ['lastlogin < ?' => $expire, 'active = ?' => 'n', 'userlevel = ?' => 0]);
                break;
                case 't':
                    $this->db->delete('users', ['active = ?' => 't', 'userlevel = ?' => 0]);
                break;
                case 'b':
                    $this->db->delete('users', ['active = ?' => 'b', 'userlevel = ?' => 0]);
                break;
            }

            $json['heading'] = "Sucesso";
            $json['text'] =  "Usuários removidos com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }


        public function getPending(){
            return $this->db->fetchOne("SELECT COUNT(id) as pending FROM users WHERE active = 't'");
        }

        public function getInactive(){
            return $this->db->fetchOne("SELECT COUNT(id) as inactive FROM users WHERE active = 'n'");
        }

        public function getBanned(){
            return $this->db->fetchOne("SELECT COUNT(id) as banned FROM users WHERE active = 'b'");
        }


        public function validateMembership($array = array()){
            $result = $this->db->fetchRow("SELECT membership_id, mem_expire FROM users WHERE id = '{$_SESSION['user_id']}' AND TO_DAYS(mem_expire) > TO_DAYS(NOW())");
            if(is_array($result)){
                if(in_array($result['membership_id'], $array)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function isAdmin(){
            return (isset($_SESSION['user_group']) && $_SESSION['user_group'] != 0) ? true : false ;
        }
        
        
    }

?>