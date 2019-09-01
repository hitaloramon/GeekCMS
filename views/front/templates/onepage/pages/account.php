<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>
<?php
  $memberships = new Memberships();
  $membership_array = $memberships->getMemberships(true);

  $gateways = new Gateways(); 
  $gateways = $gateways->getGatewayActive();

  $result = explode('/', $_SERVER['PATH_INFO']);
?>

<script src="<?php echo BASE; ?>/assets/plugins/creditcard/card.js"></script>

<div id="resume_buy" class="card" style="display:none">
    <h4>Pagamento</h4>
    <table class="table table-bordered">
        <thead>
            <tr class="table-active">
                <th colspan="2">Resumo de Compra</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Título do Plano:</th>
                <td id="member_title"></td>
            </tr>
            <tr>
                <th>Preço:</th>
                <td><?php echo $this->config['cur_symbol']; ?> <span id="member_price">0,00</span>
                    <?php echo $this->config['currency']; ?></td>
            </tr>
            <tr>
                <th>Período do Plano:</th>
                <td id="member_period">0</td>
            </tr>
            <tr>
                <th>Válido até:</th>
                <td id="member_expired">--/--</td>
            </tr>
            <tr>
                <th>Descrição do Plano:</th>
                <td id="member_description">Assinatura Válida por 1 Mês</td>
            </tr>
        </tbody>
    </table>

    <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])): ?>
    <?php $user = new User(); $address = $user->getAddress($_SESSION['user_id']); ?>

    <?php if($address == false): ?>
    <div class="alert alert-warning m-t-20 m-b-20" role="alert">
        Você precisa adicionar informações de endereço antes de prosseguir. <a
            href="<?php echo BASE.'/'.$this->config['page_profile']; ?>">Clique Aqui</a> para atualizar suas Informações
        de Endereço.
    </div>
    <?php else: ?>
    <select class="custom-select col-12" id="gateway" onchange="gateway(this.value);">
        <option value="">Escolha uma forma de pagamento</option>
        <?php foreach ($gateways as $gateway): ?>
        <option value="<?php echo $gateway['dir']; ?>"><?php echo $gateway['displayname']; ?></option>
        <?php endforeach; ?>
    </select>
    <select class="custom-select col-12 m-t-10" id="methodPayment" onchange="methodPayment(this.value);"
        style="display:none">
        <option value="">Escolha um método de pagamento</option>
    </select>
    <?php endif; ?>

    <?php else: ?>
    <div class="alert alert-warning m-t-20 m-b-20" role="alert">
        Você precisa está logado para selecionar e prosseguir com o pagamento. <a
            href="<?php echo BASE.'/'.$this->config['page_login']; ?>">Clique Aqui</a> para ir para página de login.
    </div>
    <?php endif; ?>

    <div id="creditcard" class="m-t-40 p-20 card card-shadow" style="display:none">
        <form action="#" method="post" id="form-creditcard">
            <div class="row">
                <div class="col-md-6 m-t-40">
                    <div class='card-wrapper m-t-40'></div>
                </div>
                <div class="row col-md-6 m-t-40">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="control-label">Nome do Títular:</label>
                            <input type="text" id="name" name="name" required class="form-control">
                            <small class="form-control-feedback" id="name-feedback"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Número do Cartão</label>
                            <input type="text" id="cardnumber" data-checkout="cardnumber" required class="form-control"
                                onselectstart="return false" onCopy="return false" onCut="return false"
                                onDrag="return false" onDrop="return false" autocomplete="off" />
                            <small class="form-control-feedback" id="cardnumber-feedback"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="control-label">CPF:</label>
                            <input type="text" id="doc" name="doc" required class="form-control" maxlength="11">
                            <small class="form-control-feedback" id="doc-feedback"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Data de Expiração</label>
                            <input type="text" id="expiry" data-checkout="expiry" required class="form-control"
                                onselectstart="return false" onCopy="return false" onCut="return false"
                                onDrag="return false" onDrop="return false" autocomplete="off" />
                            <small class="form-control-feedback" id="expiry-feedback"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Código de Segurança</label>
                            <input type="text" id="cvv" data-checkout="cvv" required class="form-control"
                                onselectstart="return false" onCopy="return false" onCut="return false"
                                onDrag="return false" onDrop="return false" autocomplete="off" />
                            <small class="form-control-feedback" id="cvv-feedback"></small>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <select class="custom-select col-12 m-t-10" id="qntInstallment" required>
                            <option value="">Parcelamento</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body text-center">
                        <button type="submit" id="btn_creditcard" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Finalizar Compra</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="boleto" class="m-t-40 p-20 card card-shadow" style="display:none">
        <form id="form-boleto" action="">
            <div class="row">
                <div class="col-md-6 text-center m-t-40"><i class="fa fa-barcode" style="font-size:200px"></i></div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="control-label">CPF:</label>
                                <input type="text" id="doc_boleto" required class="form-control">
                                <small class="form-control-feedback" id="doc-feedback"></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card-body text-center">
                            <button type="submit" id="btn_boleto"
                                class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Finalizar
                                Compra</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="offline" class="m-t-40 p-20 card card-shadow" style="display:none">
        <h4 class="m-b-20">Instruções de Pagamento: </h4>
        <pre><?php echo $gateways[0]['info1']; ?></pre>
    </div>

    <div id="msg"></div>
</div>

<div class="card">
    <div id="memberships">
        <h4>Planos de Acesso</h4>
        <hr>
        <?php if(empty($membership_array)): ?>
        <div class="alert alert-warning" role="alert">
            Não existe nenhum Plano de Acesso disponível para compra.
        </div>
        <?php endif; ?>
        <div class="row">
            <?php foreach ($membership_array as $m): ?>
            <div class="col-md m-t-20">
                <div class="card text-center card-shadow">
                    <div class="card-body font-14">
                        <?php if(!empty($m['img'])): ?>
                        <img src="<?php echo BASE_UPLOADS ?>/<?php echo $m['img']; ?>" class="m-b-30" />
                        <?php endif; ?>
                        <h4 class="text-primary"><?php echo $m['title']; ?></h4>
                        <div class="pricing">
                            <sup><?php echo $this->config['cur_symbol']; ?></sup>
                            <span class="display-5"><?php echo str_replace('.', ',', $m['price']); ?></span>
                        </div>
                        <div>Válido por: <?php echo $m['days']; ?>
                            <?php echo periodText($m['period'], ($m['days'] > 1) ? true : false) ;?></div>
                        <div class="text-center m-t-20 m-b-40">
                            <?php echo $m['description']; ?>
                        </div>
                        <div class="bottom-btn">
                            <a class="btn btn-outline-primary btn-rounded buy"
                                onclick="membershipBuy('<?php echo $m['id']; ?>');">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script>
var card = new Card({
    form: 'form',
    container: '.card-wrapper',
    width: 400,
    formSelectors: {
        nameInput: 'input[id="name"]',
        numberInput: 'input[id="cardnumber"]',
        expiryInput: 'input[id="expiry"]',
        cvcInput: 'input[id="cvv"]',
    },
    placeholders: {
        name: 'Nome',
    },
    messages: {
        validDate: 'valid\nthru',
        monthYear: 'mm/yy'
    }
});

$(document).ready(function() {
    $('#doc').mask('00000000000');
    $('#doc_boleto').mask('00000000000');
});
</script>