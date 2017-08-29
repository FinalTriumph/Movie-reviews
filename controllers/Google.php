<?php

class Google extends Controller {
    
    
    public static function login() {
        
        require "vendor/autoload.php";
        
        $client = new Google_Client();
        $client->setAuthConfig('./client_secrets.json');
        $client->addScope("email");
        $client->addScope("profile");
        
        $authUrl = $client->createAuthUrl();
        
        header("location: ".$authUrl);
    }
    
    public static function getCredentials() {
        require 'vendor/autoload.php';
        
        $client = new Google_Client();
        $client->setAuthConfig('./client_secrets.json');
        $client->addScope("email");
        $client->addScope("profile");
        
        $client->authenticate($_GET['code']);
        
        $service = new Google_Service_Oauth2($client);
        
        $user = $service->userinfo->get();
        
        $id = $user->id;
        $name = $user->name;
        $picture = $user->picture;
        
        if (!Database::query('SELECT * FROM users WHERE id=:id', array(':id' => $id))) {
            Database::query('INSERT INTO users VALUES (:id, "Google", :username, :profileimg)', array(':id' => $id, ':username' => $name, ':profileimg' => $picture));
        } else {
            Database::query('UPDATE users SET username=:username, profileimg=:profileimg WHERE id=:id', array(':id' => $id, ':username' => $name, ':profileimg' => $picture));
        }
        
        $cstrong = true;
        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
        
        Database::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$id));
            setcookie('SNID', $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE); //change second NULL to TRUE if only https
            setcookie('SNID_', '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
            
        header("location: /reviews");
    }
}

?>