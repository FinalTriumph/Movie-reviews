<?php

session_start();

require('vendor/autoload.php');

function __autoload($class_name) {
    if (file_exists('./classes/'.$class_name.'.php')) {
        require_once './classes/'.$class_name.'.php';
        echo "required classes <br />";
    }
    
    if (file_exists('./controllers/'.$class_name.'.php')) {
        require_once './controllers/'.$class_name.'.php';
        echo "required controllers <br />";
    }
    
    if (file_exists('./controllers/auth/'.$class_name.'.php')) {
        require_once './controllers/auth/'.$class_name.'.php';
        echo "required controllers/auth <br />";
    }
}

echo "this is index page <br />";

require_once('./routes/Routes.php');

echo "and this is again index page";

?>