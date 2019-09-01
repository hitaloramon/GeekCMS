<?php
 if (!defined("_VALID_PHP")){
	 die('Acesso direto negado');
 }
?>
<?php switch($viewData['action']): ?>
<?php case 'view': ?>
    <?php require_once 'views/admin/modules/'.$module.'/main_admin.php'; ?>
<?php break; ?>
<?php case 'edit': ?>
<div class="page-wrapper">

    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-12 align-self-center">
                <h3 class="text-themecolor">Módulos</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block">
                            <div>
                                <h4 class="card-title"><span class="lstick"></span>Editar Módulo</h4>
                            </div>
                        </div>

                        <form action="#" method="post" id="form-geek">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Título do Módulo</label>
                                        <input type="text" id="title" name="title" required class="form-control">
                                        <small class="form-control-feedback" id="title-feedback"></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Descrição</label>
                                        <input type="text" id="slug" name="slug" required class="form-control">
                                        <small class="form-control-feedback" id="slug-feedback"></small>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- .right-sidebar -->

    </div>
</div>
<?php break; ?>
<?php default: ?>
<div class="page-wrapper">
    <div class="container-fluid">

        <div class="d-flex no-block">
            <div><h3 class="text-themecolor">Módulos</h3></div>
            <div class="ml-auto m-b-15">
                <input type="text" class="form-control" placeholder="Pesquisar" data-search>
            </div>
        </div>

        <div class="filtr-container">
            <?php foreach ($modules as $m): ?>
                <div class="col-auto filtr-item" data-category="1" data-sort="<?php echo $m['title']; ?>">
                    <a href="<?php echo BASE_ADMIN.'/module/view/'.$m['modalias']; ?>">
                        <img class="img-responsive" src="<?php echo BASE.'/views/admin/modules/'.$m['modalias'].'/thumb.svg';?>" alt="<?php echo $m['title']; ?>">
                    </a>
                    <div class="text-center m-t-10 m-b-20"><?php echo $m['title']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- .right-sidebar -->
    </div>
</div>
<?php endswitch;?>


<script>
function actionFormatter(value, row) {
   return '<a href="module/edit/'+row['id']+'" data-toggle="tooltip" data-original-title="Editar"> <i class="mdi mdi-pencil m-r-10"></i></a><a href="module/view/'+row['modalias']+'" data-toggle="tooltip" data-original-title="Visualizar"> <i class="mdi mdi-eye m-r-10"></i></a>';
}
</script>