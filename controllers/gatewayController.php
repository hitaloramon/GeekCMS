<?php
class gatewayController extends controller{

    public function index(){
       die('Acesso negado');
    }

    public function pagseguro($action = null){

        $gateway = new Gateways;
        $gateway = $gateway->getGateway('pagseguro');
        
        $auth['email'] = $gateway['info1'];
        $auth['token'] = $gateway['info2'];

        $auth = http_build_query($auth);

        if ($gateway['sandbox']) {
            define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");
        } else {
            define("URL_PAGSEGURO", "https://ws.pagseguro.uol.com.br/v2/");
        }

        switch ($action):
            case 'session':
               // ini_set('display_errors', 'Off');

                $curl = curl_init();
                
                curl_setopt_array(
                    $curl, array(
                        CURLOPT_URL => URL_PAGSEGURO.'sessions?'.$auth,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_POST => true,
                        CURLOPT_HTTPHEADER => array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8")
                    )
                );

                $response = curl_exec($curl);
                curl_close($curl);
                $xml = simplexml_load_string($response);
                echo $xml->id;
            break;
            case 'checkoutboleto':

                $user = new User();
                $user_data = $user->getUser($_SESSION['user_id']);
                $user_address = $user->getAddress($_SESSION['user_id']); 

                $member = new Memberships();
                $member = $member->getMembershipByID($_SESSION['buy_membership_id']);

                $data['paymentMode'] = 'default';
                $data['paymentMethod']  = 'boleto';
                $data['currency'] = $this->config['currency'];
                $data['itemId1'] = '0001';
                $data['itemDescription1'] = $member['description'];
                $data['itemAmount1'] =  $member['price'];
                $data['itemQuantity1'] = 1;
                $data['notificationURL'] = BASE.'/gateway/pagseguro/notification';
                $data['reference'] = $user_data['id'].'MEMBER'.$member['id'];
                $data['senderName'] = $user_data['fname'] .' '.$user_data['lname'];
                $data['senderCPF'] = $_POST['doc'];
                $data['senderAreaCode'] = $user_address['phone_code'];
                $data['senderPhone'] = $user_address['phone'];
                $data['senderEmail'] = $user_data['email'];
                $data['senderHash'] = $_POST['senderHash'];
                $data['shippingAddressRequired'] = false;

                $data = http_build_query($data);
            
                $curl = curl_init();
                curl_setopt_array(
                    $curl, array(
                        CURLOPT_URL => URL_PAGSEGURO.'transactions?'.$auth,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => 'UTF-8',
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_POST => true,
                        CURLOPT_HTTPHEADER => array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"),
                        CURLOPT_POSTFIELDS => $data
                    )
                );

                $response = curl_exec($curl);
                curl_close($curl);

                try {
                    $xml = simplexml_load_string($response);
                    if(count($xml->error) > 0): 
                        $json['error'] = 'Ocorreu um erro. Verifique se as informações estão corretas e tente novamente';
                    else:
                        $data = array(
                            "txn_id"        => $xml->code,
                            "membership_id" => $member['id'],
                            "user_id"       => $user_data['id'],
                            "received"      => $xml->netAmount,
                            "tax"           => $xml->feeAmount,
                            "discount"      => $xml->discountAmount,
                            "total"         => $xml->grossAmount,
                            "currency"      => $this->config['currency'],
                            "type_payment"  => 'Boleto',
                            "pp"            => "pagseguro",
                            "ip"            => $_SERVER['REMOTE_ADDR'],
                            "type"          => 'member',
                            "status"        => $xml->status,
                        );

                        $transactions = new Transactions();
                        $transactions->insert($data);

                        $json['link'] = $xml->paymentLink;
                        $json['success'] = 'Transação Efetuada com sucesso. Fique atento a data de vencimento do seu Boleto. <a href="'.$xml->paymentLink.'" target="_blank" rel="noopener noreferrer"> Clique Aqui </a> para Imprimir seu Boleto';
                    endif;
                }catch (Exception $e) {
                    $json['error'] = 'Ocorreu um erro. Verifique se as informações estão corretas e tente novamente. Caso o problema persista, entre em contato com o Administrador.';
                }

                echo json_encode($json);

            break;
            case 'checkoutcreditcard':
                $user = new User();
                $user_data = $user->getUser($_SESSION['user_id']);
                $user_address = $user->getAddress($_SESSION['user_id']); 

                $member = new Memberships();
                $member = $member->getMembershipByID($_SESSION['buy_membership_id']);

                $data['paymentMode'] = 'default';
                $data['paymentMethod']  = 'creditCard';
                $data['currency'] = $this->config['currency'];
                $data['itemId1'] = '0001';
                $data['itemDescription1'] = $member['description'];
                $data['itemAmount1'] = $member['price'];
                $data['itemQuantity1'] = 1;
                $data['notificationURL'] = BASE.'/gateway/pagseguro/notification';
                $data['reference'] = $user_data['id'].'MEMBER'.$member['id'];
                $data['senderName'] = $user_data['fname'] .' '.$user_data['lname'];
                $data['senderCPF'] = $_POST['doc'];
                $data['senderAreaCode'] = $user_address['phone_code'];
                $data['senderPhone'] = $user_address['phone'];
                $data['senderEmail'] =  $user_data['email'];
                $data['senderHash'] = $_POST['senderHash'];
                $data['creditCardToken'] = $_POST['token'];
                $data['shippingAddressRequired'] = false;
                $data['installmentQuantity'] = $_POST['installment'];
                $data['installmentValue'] = $_POST['installmentvalue'];
                $data['creditCardHolderName'] = $_POST['name'];
                $data['creditCardHolderCPF'] = $_POST['doc'];
                $data['billingAddressStreet'] = $user_address['street'];
                $data['billingAddressNumber'] = $user_address['number'];
                $data['billingAddressDistrict'] = $user_address['district'];
                $data['billingAddressCity'] = $user_address['city'];
                $data['billingAddressState'] = $user_address['state'];
                $data['billingAddressCountry'] = 'BRA';
                $data['billingAddressPostalCode'] = $user_address['postal_code'];
                $data['billingAddressComplement'] = $user_address['complement'];

                $data = http_build_query($data);
            
                $curl = curl_init();

                curl_setopt_array(
                    $curl, array(
                        CURLOPT_URL => URL_PAGSEGURO.'transactions?'.$auth,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => 'UTF-8',
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_POST => true,
                        CURLOPT_HTTPHEADER => array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"),
                        CURLOPT_POSTFIELDS => $data
                    )
                );

                $response = curl_exec($curl);
                curl_close($curl);

                try {
                   $xml = simplexml_load_string($response);
                    if(count($xml->error) > 0): 
                        $json['error'] = 'Ocorreu um erro. Verifique se as informações estão corretas e tente novamente';
                    else:
                        $data = array(
                            "txn_id"        => $xml->code,
                            "membership_id" => $member['id'],
                            "user_id"       => $user_data['id'],
                            "received"      => $xml->netAmount,
                            "tax"           => $xml->feeAmount,
                            "discount"      => $xml->discountAmount,
                            "total"         => $xml->grossAmount,
                            "currency"      => $this->config['currency'],
                            "type_payment"  => 'Cartão de Crédito',
                            "pp"            => "pagseguro",
                            "ip"            => $_SERVER['REMOTE_ADDR'],
                            "type"          => 'member',
                            "status"        => $xml->status,
                        );

                        $transactions = new Transactions();
                        $transactions->insert($data);

                        $json['success'] = 'Transação Efetuada com sucesso.';
                    endif;
                } catch (Exception $e) {
                    $json['error'] = 'Ocorreu um erro. Verifique se as informações estão corretas e tente novamente. Caso o problema persista, entre em contato com o Administrador.';
                }

                echo json_encode($json);
            break;
            case 'notification':

                if(isset($_POST['notificationCode'])){

                    $curl = curl_init();
                    curl_setopt_array(
                        $curl, array(
                            CURLOPT_URL => URL_PAGSEGURO.'transactions/notifications/'.$_POST['notificationCode'].'?'.$auth,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => 'UTF-8',
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_HTTPHEADER => array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8")
                        )
                    );

                    $response = curl_exec($curl);
                    curl_close($curl);

                    try {
                        $xml = simplexml_load_string($response);
                        $transactions = new Transactions();

                        if(count($xml->error) > 0): 
                            echo 'Ocorreu um erro.';
                        else:
                            $notify = explode(',', $this->config['transaction_notify']);

                            switch ($xml->status) {
                                case '1': // Aguardando Pagamento
                                    $transactions->update(["status" => 1], $xml->code);

                                    if(in_array("1", $notify) == true){
                                        $data = array(
                                            'title'   => 'Transação Efetuada',
                                            'msg'     => 'A transação de número '.$xml->code.' foi criada e está aguardando pagamento.',
                                            'icon'    => 'fas fa-search-dollar',
                                            'color'   => 'warning',
                                            'status'  => 1
                                        );

                                        $notification = new Notification();
                                        $notification->insert($data);
                                    }
                                break;
                                case '2': // Em Análise
                                   $transactions->update(["status" => 2], $xml->code);

                                    if(in_array("2", $notify) == true){
                                        $data = array(
                                            'title'   => 'Transação em Análise',
                                            'msg'     => 'A transação de número '.$xml->code.' foi está em Análise.',
                                            'icon'    => 'fas fa-search-dollar',
                                            'color'   => 'warning',
                                            'status'  => 1
                                        );

                                        $notification = new Notification();
                                        $notification->insert($data);
                                    }
                                break;
                                case '3': // Pago
                                    $transactions->update(["status" => 3], $xml->code);
                                    $transactions = $transactions->getTransaction($xml->code);
                                    
                                    if($transactions['type'] == 'member'){
                                        $user = new User();
                                        $user->userUpdateMembership($transactions['user_id'], $transactions['membership_id']);
                                    }

                                    if(in_array("3", $notify) == true){
                                        $data = array(
                                            'title'   => 'Transação em Efetuada',
                                            'msg'     => 'A transação de número '.$xml->code.' foi paga.',
                                            'icon'    => 'fas fa-dollar-sign',
                                            'color'   => 'success',
                                            'status'  => 1
                                        );

                                        $notification = new Notification();
                                        $notification->insert($data);
                                    }
                                break;
                                case '5': // Disputa
                                    $transactions->update(["status" => 6], $xml->code);

                                    if(in_array("6", $notify) == true){
                                        $data = array(
                                            'title'   => 'Transação em Disputa',
                                            'msg'     => 'Foi aberta uma disputa para transação de número: '. $xml->code,
                                            'icon'    => 'fas fa-comments-dollar',
                                            'color'   => 'warning',
                                            'status'  => 1
                                        );

                                        $notification = new Notification();
                                        $notification->insert($data);
                                    }
                                break;
                                case '6': // Devolvido
                                    $transactions->update(["status" => 4], $xml->code);

                                    if(in_array("4", $notify) == true){
                                        $data = array(
                                            'title'   => 'Transação Estornada',
                                            'msg'     => 'A transação de número '.$xml->code.' foi estornada para o comprador.',
                                            'icon'    => 'fas fa-hand-holding-usd',
                                            'color'   => 'danger',
                                            'status'  => 1
                                        );

                                        $notification = new Notification();
                                        $notification->insert($data);
                                    }
                                break;
                                case '7': // Cancelado
                                    $transactions->update(["status" => 5], $xml->code);

                                    if(in_array("5", $notify) == true){
                                        $data = array(
                                            'title'   => 'Transação Cancelada',
                                            'msg'     => 'A transação de número '.$xml->code.' foi cancelada.',
                                            'icon'    => 'fas fa-dollar-sign',
                                            'color'   => 'danger',
                                            'status'  => 1
                                        );

                                        $notification = new Notification();
                                        $notification->insert($data);
                                    }
                                break;
                            }
                        endif;
                    } catch (Exception $e) {
                        echo 'Ocorreu um erro.';
                    }
                }
            break;
        endswitch;
    }

}
?>