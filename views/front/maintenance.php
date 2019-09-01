<?php
 if (!defined("_VALID_PHP")){
   die('Acesso Direto Negado');
 }
?>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $config['site_name']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <style>
        body{
            font-family: "Lato", "Open Sans", Helvetica, Arial, sans-serif;
            background-color: #0854a5;
            user-select: none;
            color: #FFF;
            margin: 0px;
        }
        #counter{
            background-color: rgba(0, 0, 0, 0.20);
            height: 160px;
        }
        .countdown-holding span {
            color: #888;
        }
        .countdown-row {
            clear: both;
            width: 100%;
            padding: 0px 2px;
            text-align: center;
        }
        .countdown-show1 .countdown-section {
            width: 98%;
        }
        .countdown-show2 .countdown-section {
            width: 48%;
        }
        .countdown-show3 .countdown-section {
            width: 32.5%;
        }
        .countdown-show4 .countdown-section {
            width: 24.5%;
        }
        .countdown-show5 .countdown-section {
            width: 19.5%;
        }
        .countdown-show6 .countdown-section {
            width: 16.25%;
        }
        .countdown-show7 .countdown-section {
            width: 14%;
        }
        .countdown-section {
            position: relative;
            display: block;
            float: left;
            font-size: 75%;
            text-align: center;
        }
        .countdown-section:after {
            content: "";
            position: absolute;
            width: 3px;
            height: 45%;
            margin-top: 18%;
            top: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.5);
        }
        .countdown-section:last-child:after {
            display: none;
        }
        .countdown-amount {
            color: #FFF;
            font-weight: 200;
            font-size: 90px;
        }
        .countdown-period {
            display: block;
            color: #FFF;
            font-weight: 200;
            font-size: 24px;
        }
        .countdown-descr {
            display: block;
            width: 100%;
        }
        .msg{
            font-size: 25px;
            padding-top: 50px;
        }

        @-webkit-keyframes scrollBad {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 0 -320px;
            }
            }
            @keyframes scrollBad {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 0 -320px;
            }
        }
        @-webkit-keyframes scrollGood {
            0% {
                -webkit-transform: translate3d(0, 0, 0);
                        transform: translate3d(0, 0, 0);
            }
            100% {
                -webkit-transform: translate3d(0, -320px, 0);
                        transform: translate3d(0, -320px, 0);
            }
            }
            @keyframes scrollGood {
            0% {
                -webkit-transform: translate3d(0, 0, 0);
                        transform: translate3d(0, 0, 0);
            }
            100% {
                -webkit-transform: translate3d(0, -320px, 0);
                        transform: translate3d(0, -320px, 0);
            }
        }
        .pen {
            background-color: blue;
            position: absolute;
            top: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
        }

        .panel {
            height: 100%;
            position: absolute;
            width: 100%;
        }

        .top {
            background-color: #0854a5;
            background-image: url(assets/images/background/maintenance.svg);
            background-position: center center;
            background-size: 500px;
            -webkit-animation: scrollBad 10s linear infinite;
            animation: scrollBad 10s linear infinite;
        }
    </style>
</head>

<body>

<section class="pen">
<div class="panel top">
<div id="main" style="text-align:center;">
    <div style="margin-top: 15%;">
        <div>
            <p style="font-size:60px;"><?php echo $config['site_name']; ?></p>
            <div id="counter"></div>
            <p class="msg"><?php echo $config['maintenance_msg']; ?></p>
        </div>
    </div>
</div>
</div>
</section>

<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/countdown/jquery.plugin.min.js"></script>
<script src="assets/plugins/countdown/jquery.countdown.min.js"></script>

<!--  Page JS  -->
<script type="text/javascript">
    jQuery(document).ready(function () {
        // Init Countdown
        var newYear = new Date();

        newYear = new Date(2016, 8, 0, 30, 11, 30, 0, 0);
        var n = newYear.getTimezoneOffset();

        $.countdown.regionalOptions['pt-BR'] = {
            labels: ['Anos', 'Meses', 'Semanas', 'Dias', 'Horas', 'Minutos', 'Segundos'],
            labels1: ['Ano', 'Mês', 'Semana', 'Dia', 'Hora', 'Minuto', 'Segundo'],
            compactLabels: ['a', 'm', 's', 'd'],
            whichLabels: null,
            digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
            timeSeparator: ':',
            isRTL: false
        };

	    $.countdown.setDefaults($.countdown.regionalOptions['pt-BR']);

        <?php $date = explode("-", $config['maintenance_date']); ?>
        <?php $hour = explode(":", $config['maintenance_hour']); ?>

        $('#counter').countdown({
            until: $.countdown.UTCDate(-480, <?php echo $date[0]; ?>, <?php echo $date[1] - 1; ?>, <?php echo $date[2]; ?>, <?php echo $hour[0]; ?>, <?php echo $hour[1]; ?>, 0, 0)
        });

    });
</script>

</body>
</html>
