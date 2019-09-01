<?php
    if (!defined("_VALID_PHP")){
        die('Acesso Direto Negado');
    }
?>
<?php
    $rss = new ModRss();
    $permission->hasPermission('mod/rss', 'view');
    switch ($mod_action) {
        case 'add':
            $permission->hasPermission('mod/rss', 'add');
            if(isset($_POST) && !empty($_POST)){
                $rss->insert($_POST);
                exit;
            }
        break;
        case 'edit':
            $permission->hasPermission('mod/rss', 'edit');
            $data['rss'] = $rss->getRss($mod_id);
            if(isset($_POST) && !empty($_POST)){
                $rss->update($_POST, $mod_id);
                exit;
            }
        break;
        case 'delete':
            $permission->hasPermission('mod/rss', 'delete');
            $rss->delete($mod_id);
            exit;
        break;
        case 'datatable':
            echo json_encode($rss->getRss());
            exit;
        break;
    }
?>