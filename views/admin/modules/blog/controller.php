<?php
    if (!defined("_VALID_PHP")){
        die('Acesso Direto Negado');
    }
?>
<?php
    $blog = new ModBlog();
    //$permission->hasPermission('mod/events', 'view');
    switch ($mod_action) {
        case 'addcat':
            if(isset($_POST) && !empty($_POST)){
                $blog->addCategory($_POST);
                exit;
            }
        break;
        case 'editcat':
            if(isset($_POST) && !empty($_POST)){
                $blog->updateCategory($_POST, $mod_id);
                exit;
            }
            $data['category'] = $blog->getCategories($mod_id);
        break;
        case 'deletecat':
            $blog->deleteCategory($mod_id);
            header('Location: '.BASE_ADMIN.'/module/view/blog/addcat');
            exit;
        break;
        case 'addpost':
            if(isset($_POST) && !empty($_POST)){
                $blog->insert($_POST);
                exit;
            }
            $data['category'] = $blog->getCategories();
        break;
        case 'editpost':
            if(isset($_POST) && !empty($_POST)){
                $blog->update($_POST, $mod_id);
                exit;
            }
            $data['blog'] = $blog->getPostByID($mod_id);
            $data['category'] = $blog->getCategories();
        break;
        case 'delete':
            //$permission->hasPermission('mod/events', 'delete');
            $blog->delete($mod_id);
            exit;
        break;
        case 'deletecomment':
            //$permission->hasPermission('mod/events', 'delete');
            $blog->deleteComment($mod_id);
            exit;
        break;
        case 'approvecomment':
            //$permission->hasPermission('mod/events', 'delete');
            $blog->approveComment($mod_id);
            exit;
        break;
        case 'commentsdata':
            echo json_encode($blog->commentsDataTable());
            exit;
        break;
        case 'datatable':
            echo json_encode($blog->blogDataTable());
            exit;
        break;
    }
?>