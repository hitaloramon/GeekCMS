<?php 
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }
?>
<div class="page-wrapper">
    <div class="container-fluid">

        <div class="d-flex no-block m-b-15">
            <div><h3 class="text-themecolor">Lixeira</h3></div>
            <div class="ml-auto">
                <a class="btn waves-effect waves-light btn-rounded btn-outline-secondary" href="<?php echo BASE_ADMIN; ?>/trash/clean">Esvaziar Lixeira</a>
            </div>
        </div>

        <?php if($trash_pages == 0 && $trash_users == 0): ?>
        <div class="alert alert-warning alert-rounded"><i class="mdi mdi-alert"></i> A Lixeira está vazia.</div>
        <?php endif; ?>
        <div class="row">
        <?php if(is_array($trash_pages)): ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick"></span>Páginas</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Criado</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($trash_pages as $t): ?>
                                    <?php $json = json_decode($t['dataset'], true); ?>
                                    <tr>
                                        <td><?php echo $json['title']; ?></td>
                                        <td width="100px"><?php echo date('d/m/Y', strtotime($t['created'])); ?></td>
                                        <td width="50px">
                                            <a href="#" class="text-info" onclick="msgInfo(this, 'Restaurar', 'Tem certeza que deseja restaurar esse item?', 'blue', '<?php echo BASE_ADMIN; ?>/trash/restore/<?php echo $t['id']; ?>');" data-position="left" data-toggle="tooltip" data-placement="left" data-original-title="Restaurar"><i class="mdi mdi-backup-restore"></i></a> | 
                                            <a href="#" class="text-danger" onclick="deleteInfo(this, '<?php echo BASE_ADMIN; ?>/trash/delete/<?php echo $t['id']; ?>');" data-position="left" data-toggle="tooltip" data-placement="left" data-original-title="Excluir"> <i class="mdi mdi-trash-can"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(is_array($trash_users)): ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="lstick"></span>Usuários</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Criado</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($trash_users as $t): ?>
                                    <?php $json = json_decode($t['dataset'], true); ?>
                                    <tr>
                                        <td><?php echo $json['fname']; ?></td>
                                        <td width="100px"><?php echo date('d/m/Y', strtotime($t['created'])); ?></td>
                                        <td width="50px">
                                            <a href="#" class="text-info" onclick="msgInfo(this, 'Restaurar', 'Tem certeza que deseja restaurar esse item?', 'blue', '<?php echo BASE_ADMIN; ?>/trash/restore/<?php echo $t['id']; ?>');" data-position="left" data-toggle="tooltip" data-placement="left" data-original-title="Restaurar"><i class="mdi mdi-backup-restore"></i></a> | 
                                            <a href="#" class="text-danger" onclick="deleteInfo(this, '<?php echo BASE_ADMIN; ?>/trash/delete/<?php echo $t['id']; ?>');" data-position="left" data-toggle="tooltip" data-placement="left" data-original-title="Excluir"> <i class="mdi mdi-trash-can"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>

        <!-- Lateral -->

    </div>
</div>