<?php
    session_start();
    define("_VALID_PHP", true);

    if(file_exists('config.php')){
        require 'config.php';
    }else{
        header("Location: install.php");
    }


    spl_autoload_register(function ($class){
        $dirs = ['models', 'core', 'libs', 'models/modules', 'models/widgets'];
        if(strpos($class, 'Controller') > -1){
            if(file_exists('controllers/'.$class.'.php')){
                require_once 'controllers/'.$class.'.php';
            }
        }else{
            foreach ($dirs as $dir) {
                if(file_exists($dir.'/'.$class.'.php')){
                    require_once $dir.'/'.$class.'.php';
                }
            }
        }
        
        require_once 'functions.php';
    });

    
    $core = new core();
    $core->run();
?>