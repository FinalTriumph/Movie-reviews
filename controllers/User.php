<?php

class User extends Controller {
    
    public static function showProfile() {
        if (!isset($_GET['id'])) {
            header("location: /reviews");
        } else {
            $reviews = Database::query('SELECT * FROM reviews WHERE user_id=:userid ORDER BY created_at DESC', array(':userid'=>$_GET['id']));
            $user = Login::userInfo($_GET['id']);
            require_once("./views/User_profile.php");
        }
    }
    
}

?>