<?php

session_start();

function __autoload($class_name) {
    if (file_exists('./classes/'.$class_name.'.php')) {
        require_once './classes/'.$class_name.'.php';
        echo "required classes";
    } else if (file_exists('./controllers/'.$class_name.'.php')) {
        require_once './controllers/'.$class_name.'.php';
        echo "required controllers";
    } else if (file_exists('./controllers/auth/'.$class_name.'.php')) {
        require_once './controllers/auth/'.$class_name.'.php';
        echo "required controllers/auth";
    } else {
        echo "nothing required";
    }
}

echo "this is index page";

if (file_exists('./routes/Routes.php')) {
    require_once './routes/Routes.php';
    echo "routes required";
} else {
    echo "routes not required";
}

//require_once('./routes/Routes.php');

echo "and this is again index page";

?>