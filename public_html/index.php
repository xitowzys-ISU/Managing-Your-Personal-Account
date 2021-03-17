<?php

require 'lib/Dev.php';
require 'config/config.php';

spl_autoload_register(function ($class){
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path))
    {
        require $path;
    }
});

$controller = new ControllerBank();

$controller->bankAction();