<?php

class My_reviews extends Controller {
    
    public static function createMyReviewsView() {
        if (Login::isLoggedin()) {
            require_once("./views/My_reviews.php");
        } else {
            header("location: /");
        }
        
        
    }
    
}

?>