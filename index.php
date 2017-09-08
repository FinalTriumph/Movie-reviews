<?php

session_start();

function __autoload($class_name) {
    echo "Trying this class - ".$class_name."<br />";
    if (file_exists('./classes/'.$class_name.'.php')) {
        require_once './classes/'.$class_name.'.php';
    } else if (file_exists('./controllers/'.$class_name.'.php')) {
        require_once './controllers/'.$class_name.'.php';
    } else if (file_exists('./controllers/auth/'.$class_name.'.php')) {
        require_once './controllers/auth/'.$class_name.'.php';
    }
    echo "Finished this class - ".$class_name."<br />";
}

require_once('./routes/Routes.php');

?>