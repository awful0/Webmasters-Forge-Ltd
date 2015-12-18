<?php

function __autoload($class){

    $classP = explode('\\', $class);
    $classP[0] = __DIR__;
    $path = implode(DIRECTORY_SEPARATOR, $classP) . '.php';
    
    if(file_exists($path)){
        require $path;
    }
}