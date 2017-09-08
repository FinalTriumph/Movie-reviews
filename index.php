<?php

session_start();

function __autoload($class_name) {
    if (file_exists('./classes/'.$class_name.'.php')) {
        require_once './classes/'.$class_name.'.php';
        echo "required classes <br />";
    } else if (file_exists('./controllers/'.$class_name.'.php')) {
        require_once './controllers/'.$class_name.'.php';
        echo "required controllers <br />";
    } else if (file_exists('./controllers/auth/'.$class_name.'.php')) {
        require_once './controllers/auth/'.$class_name.'.php';
        echo "required controllers/auth <br />";
    } else {
        echo "nothing required <br />";
    }
}

echo "this is index page<br />";

if (file_exists('./routes/Routes.php')) {
    require_once './routes/Routes.php';
    echo "routes required <br />";
} else {
    echo "routes not required <br />";
}

//require_once('./routes/Routes.php');

echo "and this is again index page";

?>