<?php

    include_once "classes/Database.class.php";

    spl_autoload_register(function($classes){
        require_once 'classes/'.$classes.'.class.php';
    });

?>