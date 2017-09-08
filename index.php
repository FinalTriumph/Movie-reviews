<?php

session_start();

//Worked on Cloud9, but didn't on Heroku
function __autoload($class_name) {
    echo "This is class - ".$class_name."<br />";
    if (file_exists('./classes/'.$class_name.'.php')) {
        echo "trying to require - ".$class_name."<br />";
        require_once('./classes/'.$class_name.'.php');
        echo "required - ".$class_name."<br />";
    } else if (file_exists('./controllers/'.$class_name.'.php')) {
        echo "trying to require - ".$class_name."<br />";
        require_once('./controllers/'.$class_name.'.php');
        echo "required - ".$class_name."<br />";
    } else if (file_exists('./controllers/auth/'.$class_name.'.php')) {
        echo "trying to require - ".$class_name."<br />";
        require_once('./controllers/auth/'.$class_name.'.php');
        echo "required - ".$class_name."<br />";
    } else {
        echo "not exists - ".$class_name."<br />";
    }
}

//spl_autoload_register('__autoload');

/*function my_autoloader($class_name) {
    if (file_exists('./classes/'.$class_name.'.php')) {
        require_once('./classes/'.$class_name.'.php');
    } else if (file_exists('./controllers/'.$class_name.'.php')) {
        require_once('./controllers/'.$class_name.'.php');
    } else if (file_exists('./controllers/auth/'.$class_name.'.php')) {
        require_once('./controllers/auth/'.$class_name.'.php');
    }
}

spl_autoload_register('my_autoloader');

if(function_exists('__autoload')) {
    spl_autoload_register('__autoload');
}*/

/*
//classes
require_once('./classes/Database.php');
require_once('./classes/Route.php');

//controllers
require_once('./controllers/Controller.php');
require_once('./controllers/Index.php');
require_once('./controllers/Login.php');
require_once('./controllers/Logout.php');
require_once('./controllers/My_reviews.php');
require_once('./controllers/Review.php');
require_once('./controllers/Reviews.php');
require_once('./controllers/User.php');

//controllers/auth
require_once('./controllers/auth/Facebook.php');
require_once('./controllers/auth/Google.php');
require_once('./controllers/auth/Twitter.php');
*/
if (file_exists('./classes/Database.php')) {
    echo "trying to require Database <br />";
    require_once('./classes/Database.php');
    echo "required Database <br />";
} else {
    echo "Database not found <br />";
}

if (file_exists('./controllers/Controller.php')) {
    echo "trying to require Controller";
    require_once('./controllers/Controller.php');
    echo "required Controller <br />";
} else {
    echo "Controller not found <br />";
}

if (file_exists('./controllers/auth/Facebook.php')) {
    echo "trying to require Facebook <br />";
    require_once('./controllers/auth/Facebook.php');
    echo "required Facebook <br />";
} else {
    echo "Facebook not found <br />";
}

require_once('./routes/Routes.php');

?>