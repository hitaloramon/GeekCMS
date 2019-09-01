<?php
    if (!defined("_VALID_PHP")){
        die('Acesso Direto Negado');
    }
?>
<?php
    Asset::add('style', [
        'name' => 'full_calendar',
        'url'  => ''.BASE.'/assets/plugins/calendar/fullcalendar.min.css',
    ]);

    Asset::add('script', [
        'name'    => 'full_calendar',
        'url'  => ''.BASE.'/assets/plugins/calendar/fullcalendar.min.js',
        'footer'  => true
    ]);

    Asset::add('script', [
        'name'    => 'full_calendar_locale',
        'url'  => ''.BASE.'/assets/plugins/calendar/locale-all.js',
        'footer'  => true
    ]);

    $events = new ModEvents();
    $permission->hasPermission('mod/events', 'view');
    switch ($mod_action) {
        case 'save':
            if(isset($_POST) && !empty($_POST)){
                if(empty($_POST['id'])){
                    $permission->hasPermission('mod/events', 'add');
                    $events->insert($_POST);
                }else{
                    $permission->hasPermission('mod/events', 'edit');
                    $events->update($_POST);
                }
            }
            exit;
        break;
        case 'delete':
            $permission->hasPermission('mod/events', 'delete');
            $events->delete($_POST['id']);
            exit;
        break;
        case 'datatable':
            echo json_encode($events->getEvents());
            exit;
        break;
    }
?>