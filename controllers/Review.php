<?php

class Review extends Controller {
    
    public static function add() {
        if (Login::isLoggedin()) {
            require_once("./views/Add_review.php");
        } else {
            header("location: /");
        }
    }
}

?>