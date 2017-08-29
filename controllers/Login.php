<?php

class Login {
    
    public static function isLoggedIn() {
    
    if (isset($_COOKIE['SNID'])) {
        if (Database::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))) {
            $user_id = Database::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
            
            if (isset($_COOKIE['SNID_'])) {
                return $user_id;
            } else {
                $cstrong = true;
                $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                
                Database::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
                Database::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));/////
                
                setcookie('SNID', $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE); //change second NULL to TRUE if only https
                setcookie('SNID_', '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                
                return $user_id;
            }
        }
    }
    
    return false;
    }
    
    public static function userInfo($user_id) {
        $user_info = Database::query('SELECT * FROM users WHERE id=:id', array(':id'=>$user_id))[0];
        return $user_info;
    }
}

?>