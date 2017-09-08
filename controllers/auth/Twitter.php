<?php

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter extends Controller {
    
    public static function login() {
        
        require "vendor/autoload.php";
        
        $consumer_key = getenv('HTTP_CONSUMER_KEY');
        $consumer_secret = getenv('HTTP_CONSUMER_SECRET');
        $oauth_callback = getenv('HTTP_OAUTH_CALLBACK');
        
        $connection = new TwitterOAuth($consumer_key, $consumer_secret);
        
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $oauth_callback));
        
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        
        $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        
        header("location: ".$url);
        
    }
    
    public static function getCredentials() {
        
        require 'vendor/autoload.php';
        
        $consumer_key = getenv('HTTP_CONSUMER_KEY');
        $consumer_secret = getenv('HTTP_CONSUMER_SECRET');
        $oauth_callback = getenv('HTTP_OAUTH_CALLBACK');
        
        $request_token = [];
        $request_token['oauth_token'] = $_SESSION['oauth_token'];
        $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
        
        if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
            die('Authorization token error');
        }
        
        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $request_token['oauth_token'], $request_token['oauth_token_secret']);
        
        try {
            $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);
        } catch (Abraham\TwitterOAuth\TwitterOAuthException $e){
            header("location: /");
        }
        
        $getUser = new TwitterOAuth($consumer_key, $consumer_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        
        $user = $getUser->get("account/verify_credentials");
        
        $id = $user->id;
        $name = $user->name;
        $picture = $user->profile_image_url_https;
        
        if (!Database::query('SELECT * FROM users WHERE id=:id', array(':id' => $id))) {
            Database::query('INSERT INTO users VALUES (:id, "Twitter", :username, :profileimg)', array(':id' => $id, ':username' => $name, ':profileimg' => $picture));
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