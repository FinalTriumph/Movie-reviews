<?php

session_start();

/*Worked on Cloud9, but couldn't get it to work on Heroku and it doesn't seem so important right now
function __autoload($class_name) {
    if (file_exists('./classes/'.$class_name.'.php')) {
        require_once './classes/'.$class_name.'.php';
    } else if (file_exists('./controllers/'.$class_name.'.php')) {
        require_once './controllers/'.$class_name.'.php';
    } else if (file_exists('./controllers/auth/'.$class_name.'.php')) {
        require_once './controllers/auth/'.$class_name.'.php';
    }
}
*/

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

require_once('./routes/Routes.php');

?>