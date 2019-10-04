<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
    <div class="d-flex no-block">
        <div><h3 class="text-themecolor">Financeiro</h3></div>
        <div class="ml-auto">
            <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="<?php echo BASE; ?>/assets/images/icon/transaction_paid.svg" width="50px" height="50px" alt="Income" /></div>
                        <div class="align-self-center">
                            <h6 class="text-muted m-t-10 m-b-0">Transações Pagas</h6>
                            <h2 class="m-t-0"><?php echo $viewData['paid']; ?></h2></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="<?php echo BASE; ?>/assets/images/icon/transaction_pendent.svg" width="50px" height="50px" alt="Income" /></div>
                        <div class="align-self-center">
                            <h6 class="text-muted m-t-10 m-b-0">Transações Pendentes</h6>
                            <h2 class="m-t-0"><?php echo $viewData['pending']; ?></h2></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="<?php echo BASE; ?>/assets/images/icon/receive_today.svg" width="50px" height="50px" alt="Income" /></div>
                        <div class="align-self-center">
                            <h6 class="text-muted m-t-10 m-b-0">Recebido Hoje</h6>
                            <h2 class="m-t-0"><?php echo $this->config['cur_symbol']; ?> <?php echo ($viewData['today'] != '') ? $viewData['today'] : '0.00' ; ?></h2></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="<?php echo BASE; ?>/assets/images/icon/receive_total.svg" width="50px" height="50px" alt="Income" /></div>
                        <div class="align-self-center">
                            <h6 class="text-muted m-t-10 m-b-0">Total Recebido</h6>
                            <h2 class="m-t-0"><?php echo $this->config['cur_symbol']; ?> <?php echo ($viewData['total'] != '') ? $viewData['total'] : '0.00' ; ?></h2></div>
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
                            <h4 class="card-title"><span class="lstick"></span>Todas as Transações</h4>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="table-responsive p-10">
                            <div id="toolbar">
                                <select class="form-control">
                                    <option value="all">Exportar Todos</option>
                                    <option value="selected">Exportar Selecionados</option>
                                </select>
                            </div>
                            <table id="table" data-toggle="table" data-url="<?php echo BASE_ADMIN;?>/financial/datatable" data-show-refresh="true" data-show-columns="true" data-toolbar="#toolbar" data-advanced-search="true" data-show-export="true" data-pagination="true" data-mobile-responsive="true" data-search="true" class="table display table-hover w-100">
                                <thead>
                                    <tr>
                                        <th data-checkbox="true"></th>
                                        <th data-field="id_transaction" data-sortable="true">ID</th>
                                        <th data-field="txn_id" data-sortable="true" data-visible="false">Transação</th>
                                        <th data-field="fname" data-sortable="true">Usuário</th>
                                        <th data-field="tax" data-sortable="true" data-visible="false" data-formatter="moneyFormatter">Taxa</th>
                                        <th data-field="received" data-sortable="true" data-formatter="moneyFormatter">Recebido</th>
                                        <th data-field="total" data-sortable="true" data-visible="false" data-formatter="moneyFormatter">Total</th>
                                        <th data-field="type_payment" data-sortable="true" data-align="center" data-visible="false">Meio Pag.</th>
                                        <th data-field="created" data-sortable="true" data-align="center" data-formatter="dateFormatter">Criado</th>
                                        <th data-field="pp" data-sortable="true" data-align="center" data-formatter="proccessFormatter">Processador</th>
                                        <th data-field="status" data-sortable="true" data-align="center" data-formatter="statusFormatter">Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div> <!--table -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

<script>

function moneyFormatter(value, row){
    return '<?php echo $this->config['cur_symbol']; ?> ' + value;
}

function proccessFormatter(value, row) {
    return '<img src="<?php echo BASE; ?>/assets/images/gateway/'+value+'.svg" width="85px" alt="'+value+'" />';
}


function dateFormatter(value, row) {
   return mysqlDate(value);
}

function statusFormatter(value, row) {
    console.log(value);
  switch(value) {
      case '1':
          return '<span class="label label-warning label-rounded">Aguardando Pag.</span>';
      break;
      case '2':
          return '<span class="label label-warning label-rounded">Em Análise</span>';
      break;
      case '3':
          return '<span class="label label-success label-rounded">Aprovado</span>';
      break;
      case '4':
          return '<span class="label label-inverse label-rounded">Devolvido</span>';
      break;
      case '5':
          return '<span class="label label-danger label-rounded">Cancelado</span>';
      break;
      case '6':
          return '<span class="label label-warning label-rounded">Disputa</span>';
      break;
  }
}
</script>