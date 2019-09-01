<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Notificações</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Gerenciar Notificações</h4>
                            </div>
                        </div>
                        <div id="toolbar">
                            <button onclick="deleteAll()" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Apagar Selecionados</button>
                        </div>
                        <table id="table" 
                                data-toggle="table" 
                                data-url="<?php echo BASE_ADMIN;?>/notification/datatable" 
                                data-show-refresh="true"
                                data-show-columns="true"
                                data-toolbar="#toolbar"
                                data-advanced-search="true"
                                data-pagination="true"
                                data-mobile-responsive="true"
                                data-search="true"
                                class="table display table-hover w-100">
                            <thead>
                                <tr>
                                    <th data-checkbox="true"></th>
                                    <th data-field="icon" data-formatter="iconFormatter" data-width="10px"></th>
                                    <th data-field="title" data-sortable="true" data-align="center" data-formatter="titleFormatter" data-width="250px">Título</th>
                                    <th data-field="date" data-sortable="true" data-align="center" data-width="180px">Data</th>
                                    <th data-field="msg" data-sortable="true">Mensagem</th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <!-- Lateral -->

    </div>
</div>

<script>
    function deleteAll(){
        var obj = $('#table').bootstrapTable('getAllSelections'); 
        var data = [];

        for (var prop in obj) {
            data.push(obj[prop].id);
        }

        var SITE_URL = localStorage.getItem('SITEURL');

        $.ajax({
            url: SITE_URL + '/admin/notification/deleteall',
            type: "post",
            data: {data: data},
            success: function (response) {
                $('#table').bootstrapTable('remove', {field: 'id', values: data})
            }
        });
    }

    function iconFormatter(value, row){
        if(row.link === "" ){
            return '<span class="round round-'+row.color+'"><i class="'+row.icon+'"></i></span>';
        }else{
            return '<a href="<?php echo BASE_ADMIN; ?>/'+row.link+'"><span class="round round-'+row.color+'"><i class="'+row.icon+'"></i></span></a>';
        }
    }

    function titleFormatter(value, row){
        return '<h6>'+row.title+'</h6><small class="text-muted">'+row.date+'</small>';
    }

</script>