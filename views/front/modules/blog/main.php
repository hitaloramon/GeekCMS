<?php

    $url = explode('index.php', $_SERVER['PHP_SELF']);
    $url = explode('/', $url[1]);
    array_shift($url);
    array_shift($url);

    $blog = new ModBlog();
    if(isset($url[0])){
        switch($url[0]):
            case 'visualizar':
                include 'template/view.php';
            break;
            case 'categoria':
                include 'template/category.php';
            break;
            case 'pagina':
                include 'template/last.php';
            break;
            case 'pesquisa':
                include 'template/search.php';
            break;
            default:
                include 'template/last.php';
            break;
        endswitch;
    }else{
        include 'template/last.php';
    }

?>