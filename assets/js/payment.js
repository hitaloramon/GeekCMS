var SITE_URL = localStorage.getItem('SITEURL');

function addScript(baseurl, filename) {
    if (!document.getElementsByTagName('body')[0].innerHTML.toString().includes(filename + ".js")) {
        var node = document.createElement('script');
        node.src = baseurl + filename + '.js';
        node.id = filename + '_script';
        document.getElementsByTagName('body')[0].appendChild(node);
    }else{
        $("#" + filename + '_script').remove();
        var node = document.createElement('script');
        node.src = baseurl + filename + '.js';
        node.id = filename + '_script';
        document.getElementsByTagName('body')[0].appendChild(node);
    }
}

function removeSpace(str){
    return str.replace(/\s+/g, '');
}

function membershipBuy(id){
    $("#resume_buy").fadeIn();
    $.ajax({
        url: SITE_URL + '/membership/get/'+id,
        type: "get",
        success: function (response) {
            response = JSON.parse(response);
            $('#member_title').html(response.title);
            $('#member_price').html(response.price);
            $('#member_period').html(response.days + ' ' +response.period_text);
            $('#member_expired').html(response.expired);
            $('#member_description').html(response.description);
            $('#member_title').html(response.title);
            $('body,html').animate({ scrollTop: 0 }, 500);
        }
    });
}

function gateway(value){
    switch (value) {
        case 'offline':
            $('#methodPayment').hide();
            $('#creditcard').hide();
            $('#boleto').hide();
            $('#offline').show();
        break;
        case 'pagseguro':
            $('#methodPayment').hide();
            $('#creditcard').hide();
            $('#offline').hide();
            $('#boleto').hide();
            pagseguro_init();
        break;
        case 'mercadopago':
            $('#methodPayment').hide();
            $('#creditcard').hide();
            $('#offline').hide();
            $('#boleto').hide();
            mercadopago_init();
            break;
        case '':
            $('#methodPayment').hide();
            $('#creditcard').hide();
            $('#offline').hide();
            $('#boleto').hide();
        break;
    }
}

function methodPayment(value) {
    switch (value) {
        case 'boleto':
            $('#creditcard').hide();
            $('#offline').hide();
            $('#boleto').fadeIn();
        break;
        case 'creditcard':
            $('#offline').hide();
            $('#boleto').hide();
            $('#creditcard').fadeIn();
        break;
        case '':
            $('#creditcard').hide();
            $('#offline').hide();
            $('#boleto').hide();
        break;
    }
}

function pagseguro_init(){
    addScript('https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/', 'pagseguro.directpayment');
    addScript(SITE_URL + '/assets/js/gateway/', 'pagseguro');
}

function mercadopago_init(){
    addScript(SITE_URL + '/assets/js/gateway/', 'mercadopago');
}