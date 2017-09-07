<?php

class Logout extends Controller {
    
    public static function logoutUser() {
        if (!Login::isLoggedIn()) {
            die("Not logged in");
        }
        
        if (isset($_COOKIE['SNID'])) {
            Database::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
        }
        setcookie('SNID', '1', time()-3600);
        setcookie('SNID_', '1', time()-3600);
        
        header("location: /reviews");
    }
    
}

?>