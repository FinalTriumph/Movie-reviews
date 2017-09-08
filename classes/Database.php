<?php

class Database {
    
    private static function connect() {
        
        /* Cloud9
        $host = '127.0.0.1';
        $dbname = 'c9';
        $username = 'finaltriumph';
        $password = '';
        */
        
        //Heroku
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $dbname = substr($url["path"], 1);
        //////////
        
        $pdo = new PDO("mysql:host=".$host.";dbname=".$dbname.";charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    
    public static function query($query, $params = array()) {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        
        if (explode(' ', $query)[0] == 'SELECT') {
            $data = $statement->fetchAll();
            return $data;
        }
    }
    
}

?>