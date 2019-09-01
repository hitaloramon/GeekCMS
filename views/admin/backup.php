<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<div class="page-wrapper">
    <div class="container-fluid">

        <div class="d-flex no-block m-b-15">
            <div><h3 class="text-themecolor">Backups</h3></div>
            <div class="ml-auto">
                <a class="nav-link right-side-toggle" href="javascript:void(0)"><i class="mdi mdi-help"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block m-b-15">
                            <div><h4 class="card-title"><span class="lstick"></span>Gerenciar Backups</h4></div>
                            <div class="ml-auto">
                                <a href="<?php echo BASE_ADMIN. '/backup/add';?>" class="btn waves-effect waves-light btn-rounded btn-outline-secondary">Gerar Backup</a>
                            </div>
                        </div>
                        
                        <div class="row m-t-20">
                            <?php 
                                $backup = scandir_by_mtime('backup');
                                $backup = array_reverse($backup);
                            ?>
                            <?php $i = 1; foreach ($backup as $b): ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="card">
                                        <div class="d-flex flex-row b-all">
                                            <div class="p-10 <?php echo ($i == 1)? 'bg-success' : 'bg-theme'; ?>"><h3 class="text-white box m-b-0"><i class="mdi mdi-database"></i></h3></div>
                                            <div class="align-self-center m-l-20">
                                                <h3 class="m-b-0 text-info">Backup <?php echo $i; ?></h3>
                                                <h6 class="m-b-0 text-muted"><?php echo date("d/m/Y H:i:s", filemtime('backup/' . $b));?></h6>
                                                <a href="#" onclick="restaure(this, '<?php echo BASE_ADMIN.'/backup/restore/'.$b; ?>');" class="text-muted">Restaurar</a> | <a href="#" onclick="deleteRedirect(`<?php echo BASE_ADMIN.'/backup/delete/'.$b; ?>`);" class="text-muted">Excluir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Ajuda <span><i class="mdi mdi-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body geek-help">
                    <h5>Backups</h5>
                    <p>O Backup mais recente é destacado com a cor verde.</p>
            </div>
        </div>

    </div>
</div>

<script>
function restaure(handler, url){
            $.confirm({
                title: 'Restaurar',
                content: 'Tem certeza que deseja restaurar esse backup?',
                type: 'blue',
                typeAnimated: true,
                icon: 'fa fa-warning',
                buttons: {
                    confirm: {
                        text: 'Sim',
                        btnClass: 'btn-blue',
                        action: function(){
                            $.ajax({
                                url: url,
                                type: "get",
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
                    close: {
                        text: 'Fechar'
                    }
                }
            });
        }
</script>