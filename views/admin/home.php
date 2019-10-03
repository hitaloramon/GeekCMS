<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="d-flex no-block">
            <div><h3 class="text-themecolor">Painel de Controle</h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="assets/images/icon/visits.png" alt="Income" /></div>
                            <div class="align-self-center">
                                <h6 class="text-muted m-t-10 m-b-0">Visitas Únicas</h6>
                                <h2 class="m-t-0"><?php echo number_format_short($viewData['uniquevisits']); ?></h2></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="assets/images/icon/hits.png" alt="Income" /></div>
                            <div class="align-self-center">
                                <h6 class="text-muted m-t-10 m-b-0">Total de Cliques</h6>
                                <h2 class="m-t-0"><?php echo number_format_short($viewData['totalhits']); ?></h2></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="assets/images/icon/online.png" alt="Income" /></div>
                            <div class="align-self-center">
                                <h6 class="text-muted m-t-10 m-b-0">Online Agora</h6>
                                <h2 class="m-t-0"><?php echo number_format_short($viewData['online']); ?></h2></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="assets/images/icon/today.png" alt="Income" /></div>
                            <div class="align-self-center">
                                <h6 class="text-muted m-t-10 m-b-0">Visitas Hoje</h6>
                                <h2 class="m-t-0"><?php echo number_format_short($viewData['today']); ?></h2></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Visitantes Online</h4>
                            </div>
                            <div class="ml-auto">
                                <div class="card-actions">
                                    <a href="#" onclick="clearStats();" class="m-r-10" data-position="left" data-toggle="tooltip" data-placement="left" data-original-title="Limpar Todas as Estatísticas"><i class="mdi mdi-chart-bar"></i></a>
                                    <a href="#" class="btn-minimize"data-position="left" data-toggle="tooltip" data-placement="left" data-original-title="Expandir" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                </div>
                            </div>
                        </div>
                        <canvas id="statistics" width="400" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div id="toolbar">
                                <h4 class="card-title"><span class="lstick"></span>Estatísticas de Visitas</h4>
                            </div>
                            <div class="table-responsive p-10">
                                <table id="table" data-toggle="table" data-url="<?php echo BASE_ADMIN;?>/stats/datatable" data-show-refresh="true" data-auto-refresh="true" data-auto-refresh-interval="30" data-show-columns="true" data-toolbar="#toolbar" data-advanced-search="true" data-pagination="true" data-mobile-responsive="true" data-search="true" class="table display table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th data-field="ip" data-sortable="true" data-align="center">IP</th>
                                            <th data-field="device" data-sortable="true" data-align="center">Dispositivo</th>
                                            <th data-field="os" data-sortable="true" data-align="center">Sistema Operacional</th>
                                            <th data-field="country" data-sortable="true" data-align="center">País</th>
                                            <th data-field="region" data-sortable="true" data-align="center">Região</th>
                                            <th data-field="city" data-sortable="true" data-align="center">Cidade</th>
                                            <th data-field="reference" data-sortable="true" data-align="center" data-formatter="linkFormatter">Origem</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div> <!--table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card" style="min-height: 95%;">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick"></span>Navegadores</h4>
                        <?php if(empty($viewData['browser'])): ?>
                            <div class="browser-empty">
                                <div class="text-center"><i class="fab fa-chrome browser-icon"></i></div>
                                <div class="text-center"><h4>Não há dados para exibir.<h4></div>
                            </div>
                        <?php endif; ?>
                        <table class="table browser m-t-15 no-border">
                            <tbody>
                                <?php foreach ($viewData['browser'] as $b): ?>
                                    <tr>
                                        <td style="width:40px"><img src="<?php echo BASE; ?>/assets/images/browser/<?php echo strtolower($b['browser']); ?>.png" alt=logo /></td>
                                        <td><?php echo $b['browser']; ?><br><small class="text-muted"><?php echo number_format_short($b['total']); ?> Acessos</small></td>
                                        <td class="text-right"><?php echo $b['percentage']; ?>%</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card" style="min-height: 95%;">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick"></span>Dispositivos</h4>
                        <canvas id="device_stats" height="150"> </canvas>
                        <hr>
                        <table class="table browser m-t-30 no-border">
                            <tbody>
                                <tr>
                                    <td style="width:40px"><img src="<?php echo BASE; ?>/assets/images/device/desktop.png" alt=logo /></td>
                                    <td>Desktop<br><small class="text-muted"><?php echo (isset($viewData['device'][0])) ? $viewData['device'][0]['total'] : '0' ; ?> Acessos</small></td>
                                    <td class="text-right"><?php echo (isset($viewData['device'][0])) ? $viewData['device'][0]['percentage'] : '0' ; ?>%</td>
                                </tr>
                                <tr>
                                    <td style="width:40px"><img src="<?php echo BASE; ?>/assets/images/device/mobile.png" alt=logo /></td>
                                    <td>Mobile<br><small class="text-muted"><?php echo (isset($viewData['device'][1])) ? $viewData['device'][1]['total'] : '0' ; ?> Acessos</small></td>
                                    <td class="text-right"><?php echo (isset($viewData['device'][1])) ? $viewData['device'][1]['percentage'] : '0' ; ?>%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body geek-help">
                    <h5>Estatísticas</h5>
                    <p>Todas as estatísticas são baseadas no ano atual, portanto dados de anos anteriores não são incluidos caso exista no banco de dados</p>
                    <hr>
                    <h5>Online Agora</h5>
                    <p>O sistema mostra os usuários online que entraram no seu website nos últimos 5 minutos.</p>
                    <hr>
                    <h5>Gráficos</h5>
                    <p>Você pode clicar nas legendas do gráfico para filtrar resultados especifícos.</p>
                </div>
            </div>
        </div>
        
    </div>
</div>
<script>
function linkFormatter(value, row) {
   return '<a href="'+row['reference']+'" target="_blank" data-toggle="tooltip" data-placement="top" title="'+row['reference']+'" data-original-title="'+row['reference']+'"> Link</a>';
}
window.onload = function() {
    var ctx = document.getElementById("statistics").getContext('2d');
    var myChart = new Chart(ctx, {
        responsive: true,
        type: 'bar',
        data: {
            labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
            datasets: [{
                label: 'Total de Cliques',
                data: <?php echo $viewData['statsHits']; ?>,
                backgroundColor: 'rgba(100, 200, 255, 0.2)',
                borderColor:'#1e88e5',
                borderWidth: 1
            },
            {
                label: 'Visitas Únicas',
                data: <?php echo $viewData['statsVisits']; ?>,
                backgroundColor: 'rgba(5, 215, 150, 0.3)',
                borderColor:'#06d79c',
                borderWidth: 1
            }]
        }
    });
    var ctx2 = document.getElementById("device_stats").getContext('2d');
    var myDoughnutChart = new Chart(ctx2, {
        type: 'doughnut',
        data: data = {
            datasets: [{
                data: [<?php echo (isset($viewData['device'][0])) ? $viewData['device'][0]['total'] : '0' ; ?>, <?php echo (isset($viewData['device'][1])) ? $viewData['device'][1]['total'] : '0' ; ?>],
                backgroundColor: [
                    'rgba(100, 200, 255, 0.2)',
                    'rgba(5, 215, 150, 0.3)'
                ],
                borderColor: [
                    '#1e88e5',
                    '#06d79c'
                ],
                borderWidth: 1
            }],
            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Desktop',
                'Mobile'
            ]
        },
    });
}
function clearStats(){
    $.confirm({
        title: 'Estatísticas',
        content: 'Deseja apagar todas as estatísticas?',
        type: 'red',
        typeAnimated: true,
        icon: 'fa fa-warning',
        columnClass: 'col-md-6',
        buttons: {
            confirm: {
                text: 'Apagar',
                action: function(){
                    $.ajax({
                        type: 'post',
                        url: "stats/clear",
                        success: function (response) {
                            response = JSON.parse(response);
                            $.toast({
                                heading: ''+response.heading+'',
                                text: ''+response.text+'',
                                position: 'bottom-right',
                                icon: ''+response.icon+'',
                                hideAfter: 3000, 
                                stack: 6
                            });
                        }
                    });
                }
            },
            cancel: {
                text: 'Cancelar',
                action: function(){
                    //$.alert('Cancelar');
                }
            }
        }
    });
}
</script>