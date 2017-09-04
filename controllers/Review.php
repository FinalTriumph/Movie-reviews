<?php

class Review extends Controller {
    
    public static function allReviews() {
        $reviews = Database::query('SELECT * FROM reviews ORDER BY created_at DESC');
        return $reviews;
    }
    
    public static function oneReview() {
        if (!isset($_GET['id'])) {
            header("location: /reviews");
        } else {
            echo 'this is route to one review with id = '.$_GET['id'];
        }
    }
    public static function myReviews() {
        if (Login::isLoggedin()) {
            $user_id = Login::isLoggedin();
            $reviews = Database::query('SELECT * FROM reviews WHERE user_id=:userid ORDER BY created_at DESC', array(':userid'=>$user_id));
            return $reviews;
        } else {
            header("location: /");
        }
    }
    
    public static function add() {
        if (Login::isLoggedin()) {
            require_once("./views/Add_review.php");
        } else {
            header("location: /");
        }
    }
    
    public static function store() {
        if (Login::isLoggedin()) {
            if (!isset($_POST['nocsrf'])) {
                die("INVALID TOKEN");
            }
            if ($_POST['nocsrf'] !== $_SESSION['token']) {
                die("INVALID TOKEN");
            }
            $user_id = Login::isLoggedin();
            $poster_url = 'none';
            
            //'https://www.themoviedb.org/' API
            //https://stackoverflow.com/questions/18280194/using-themoviedb-to-display-image-poster-with-php
            $ca = curl_init();
            curl_setopt($ca, CURLOPT_URL, "http://api.themoviedb.org/3/configuration?api_key=".getenv('HTTP_TMDB_API_KEY'));
            curl_setopt($ca, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ca, CURLOPT_HEADER, FALSE);
            curl_setopt($ca, CURLOPT_HTTPHEADER, array("Accept: application/json"));
            $response = curl_exec($ca);
            curl_close($ca);
            $config = json_decode($response, true);
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://api.themoviedb.org/3/search/movie?query=".$_POST['title']."&year=".$_POST['year']."&api_key=".getenv('HTTP_TMDB_API_KEY'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
            $response = curl_exec($ch);
            curl_close($ch);
            $result = json_decode($response, true);
            
            if ($result['results'][0]['poster_path']) {
                $poster_url = $config['images']['base_url'].$config['images']['poster_sizes'][3].$result['results'][0]['poster_path'];
            }
            /////////////////////////////////////////////////
            
            Database::query('INSERT INTO reviews VALUES(\'\', :userid, :title, :year, :genre, :stars, :review, NOW(), :poster)', array(':userid'=>$user_id, ':title'=>htmlspecialchars($_POST['title']), ':year'=>$_POST['year'], ':genre'=>$_POST['genre'], ':stars'=>$_POST['stars'], ':review'=>htmlspecialchars($_POST['review']), ':poster'=>$poster_url));
            
            session_unset();
            header('location: my-reviews');
        } else {
            header("location: /");
        }
    }
    
    public static function edit() {
        if (Login::isLoggedin()) {
            if (!isset($_POST['nocsrf'])) {
                die("INVALID TOKEN");
            }
            if ($_POST['nocsrf'] !== $_SESSION['token']) {
                die("INVALID TOKEN");
            }
            if ($_POST['reviewid']) {
                $review = Database::query('SELECT * FROM reviews WHERE id=:id', array(':id'=>$_POST['reviewid']))[0];
                $user_id = Login::isLoggedIn();
                if ($review['user_id'] !== $user_id) {
                    die('Unauthorized Page');
                }
            }
            session_unset();
            require_once("./views/Edit-review.php");
        } else {
            header("location: /");
        }
    }
    
    public static function update() {
        if (Login::isLoggedin()) {
            if (!isset($_POST['nocsrf'])) {
                die("INVALID TOKEN");
            }
        
            if ($_POST['nocsrf'] !== $_SESSION['token']) {
                die("INVALID TOKEN");
            }
            
            if ($_POST['reviewid']) {
                $review = Database::query('SELECT * FROM reviews WHERE id=:id', array(':id'=>$_POST['reviewid']))[0];
                $user_id = Login::isLoggedIn();
                if ($review['user_id'] !== $user_id) {
                    die('Unauthorized Page');
                }
                $poster_url = $review['poster'];
                
                if ($review['title'] !== $_POST['title'] || $review['year'] !== $_POST['year']) {
                    //'https://www.themoviedb.org/' API
                    //https://stackoverflow.com/questions/18280194/using-themoviedb-to-display-image-poster-with-php
                    $ca = curl_init();
                    curl_setopt($ca, CURLOPT_URL, "http://api.themoviedb.org/3/configuration?api_key=".getenv('HTTP_TMDB_API_KEY'));
                    curl_setopt($ca, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ca, CURLOPT_HEADER, FALSE);
                    curl_setopt($ca, CURLOPT_HTTPHEADER, array("Accept: application/json"));
                    $response = curl_exec($ca);
                    curl_close($ca);
                    $config = json_decode($response, true);
                    
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "http://api.themoviedb.org/3/search/movie?query=".$_POST['title']."&year=".$_POST['year']."&api_key=".getenv('HTTP_TMDB_API_KEY'));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $result = json_decode($response, true);
                    
                    if ($result['results'][0]['poster_path']) {
                        $poster_url = $config['images']['base_url'].$config['images']['poster_sizes'][3].$result['results'][0]['poster_path'];
                    } else {
                        $poster_url = 'none';
                    }
                    /////////////////////////////////////////////////
                }
                
                Database::query('UPDATE reviews SET title=:title, year=:year, genre=:genre, stars=:stars, review=:review, poster=:poster WHERE id=:id', array(':title'=>htmlspecialchars($_POST['title']), ':year'=>$_POST['year'], ':genre'=>$_POST['genre'], ':stars'=>$_POST['stars'], ':review'=>htmlspecialchars($_POST['review']), ':id'=>$_POST['reviewid'], ':poster'=>$poster_url));
            }
            session_unset();
            header('location: my-reviews');
        } else {
            header("location: /");
        }
    }
    
    public static function deleteReview() {
        echo 'This is delete route';
        if (Login::isLoggedin()) {
            if (!isset($_POST['nocsrf'])) {
                die("INVALID TOKEN");
            }
        
            if ($_POST['nocsrf'] !== $_SESSION['token']) {
                die("INVALID TOKEN");
            }
            
            if ($_POST['reviewid']) {
                $review = Database::query('SELECT * FROM reviews WHERE id=:id', array(':id'=>$_POST['reviewid']))[0];
                $user_id = Login::isLoggedIn();
                if ($review['user_id'] !== $user_id) {
                    die('Unauthorized Page');
                }
                Database::query('DELETE FROM reviews WHERE id=:id', array(':id'=>$_POST['reviewid']));
            }
            session_unset();
            header('location: my-reviews');
        } else {
            header("location: /");
        }
    }
}

?>