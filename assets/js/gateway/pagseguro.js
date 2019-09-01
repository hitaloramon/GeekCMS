$('.preloader').show().fadeIn();

$.post(SITE_URL + '/gateway/pagseguro/session', "", function (session) {
    PagSeguroDirectPayment.setSessionId(session);
    PagSeguroDirectPayment.getPaymentMethods({
        amount: $("#member_price").html(),
        success: function (response) {
            var methodPayment = '<option value="">Método de Pagamento</option>';
            $.each(response.paymentMethods, function (i, obj) {
                if (obj.name == "BOLETO") {
                    methodPayment += '<option value="boleto">Boleto</option>';
                }

                if (obj.name == "CREDIT_CARD") {
                    methodPayment += '<option value="creditcard">Cartão de Crédito</option>';
                }
            });

            $("#methodPayment").html(methodPayment);
            $('#methodPayment').show().fadeIn();
            $('.preloader').hide().fadeOut();
        },
        error: function (response) {
            console.log('ERRO');
            $('#methodPayment').show().fadeIn();
            $('.preloader').hide();
        },
    });
});


$("#form-boleto").submit(function (e) {
    if ($("#gateway").val() == 'pagseguro') {
        e.preventDefault();
        $('#btn_boleto').prop("disabled", true);
        PagSeguroDirectPayment.onSenderHashReady(function (response) {
            if (response.status == 'error') {
                console.log(response.message);
                return false;
            } else {
                var data = {
                    doc: $('#doc_boleto').val(),
                    senderHash: response.senderHash
                }

                $.post(SITE_URL + '/gateway/pagseguro/checkoutboleto', data, function (response) {
                    response = JSON.parse(response);
                    if (response.error) {
                        console.log(response.error);
                    } else {
                        $('#msg').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.success + '</div>');
                        window.open(response.link[0], '_blank');
                    }
                });
            }
        });
    }
});


$("#form-creditcard").submit(function (e) {
    if ($("#gateway").val() == 'pagseguro') {
        e.preventDefault();

        $('#btn_creditcard').prop("disabled", true);
        var expiration = removeSpace($("#expiry").val()).split("/");

        if (expiration[1].length == 2) {
            expiration[1] = '20' + expiration[1];
        }

        PagSeguroDirectPayment.onSenderHashReady(function (hash) {
            if (hash.status == 'error') {
                console.log(hash.message);
                return false;
            } else {
                var hash = hash.senderHash;
                PagSeguroDirectPayment.createCardToken({
                    cardNumber: removeSpace($("#cardnumber").val()), // Número do cartão de crédito
                    brand: $("#cardband").val(), // Bandeira do cartão
                    cvv: removeSpace($("#cvv").val()), // CVV do cartão
                    expirationMonth: expiration[0], // Mês da expiração do cartão
                    expirationYear: expiration[1], // Ano da expiração do cartão, são necessários os 4 dígitos.
                    success: function (token) {
                        // Retorna o cartão tokenizado.
                        var data = {
                            name: $('#name').val(),
                            doc: $('#doc').val(),
                            installment: $('#qntInstallment').val(),
                            installmentvalue: $('#qntInstallment').find(':selected').attr('data-installment'),
                            token: token.card.token,
                            senderHash: hash
                        }

                        $.post(SITE_URL + '/gateway/pagseguro/checkoutcreditcard', data, function (response) {
                            response = JSON.parse(response);
                            if (response.error) {
                                console.log(response.error);
                            } else {
                                $('#msg').html('<div class="alert alert-success alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.success + '</div>');
                            }
                        });
                    },
                    error: function (response) {
                        // Callback para chamadas que falharam.
                        $('#msg').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Ocorreu um erro ao realizar essa operação</div>');
                    }
                });
            }
        });
    }
});

// Recuperar Parcelamento
function installment(band) {
    PagSeguroDirectPayment.getInstallments({
        amount: $("#member_price").html(), // Valor
        //maxInstallmentNoInterest: 2, // //Quantidade de parcelas sem juros
        brand: band,
        success: function (response) {
            // Retorna as opções de parcelamento disponíveis
            $('#qntInstallment').html('<option value="">Parcelamento</option>');
            $.each(response.installments, function (ia, obja) {
                $.each(obja, function (ib, objb) {
                    //Converter o preço para o formato real com JavaScript
                    var valorParcela = objb.installmentAmount.toFixed(2).replace(".", ",");
                    //Apresentar quantidade de parcelas e o valor das parcelas para o usuário no campo SELECT
                    $('#qntInstallment').show().append("<option value='" + objb.quantity + "' data-installment='" + objb.installmentAmount.toFixed(2) + "'>" + objb.quantity + " parcelas de R$ " + valorParcela + " " + (objb.interestFree ? "(Sem Juros)" : "(Com Juros)") + "</option>");
                });
            });
        },
        error: function (response) {
            // callback para chamadas que falharam.
        },
        complete: function (response) {
            // Callback para todas chamadas.
        }
    });
}


//Receber os dados do formulário, usando o evento "keyup" para receber sempre que tiver alguma alteração no campo do formulário
$('#cardnumber').on('keyup', function () {
    //Receber o número do cartão digitado pelo usuário
    var numCartao = $(this).val();

    //Validar o cartão quando o usuário digitar 6 digitos do cartão
    if (numCartao.length == 7) {
        //Instanciar a API do PagSeguro para validar o cartão
        PagSeguroDirectPayment.getBrand({
            cardBin: numCartao.replace(/\s+/g, ''), // Tira o Espaço
            success: function (response) {
                $('#cardband').val(response.brand.name);
                installment(response.brand.name);
            },
            error: function (response) {
                //Mensagem de erro
                $('#msg').html('<div class="alert alert-danger alert-dismissable fadeIn"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Cartão Inválido</div>');
            }
        });
    }
});