<?php 
session_start();
session_regenerate_id();
spl_autoload_register('autoload');
function autoload($class_name){
    $array_path = array(
        "helpers/",
        "controllers/",
        "models/",
        "database/",
    );
    $parts = explode('\\',$class_name);
    $name = array_pop($parts);
    foreach($array_path as $path){
        $file = sprintf($path.'%s.php',$name);
        if(is_file($file)){
            require_once $file;
        }
    }
}