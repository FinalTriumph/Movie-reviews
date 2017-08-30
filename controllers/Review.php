<?php

class Review extends Controller {
    
    public static function allReviews() {
        $reviews = Database::query('SELECT * FROM reviews ORDER BY created_at DESC');
        return $reviews;
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
            Database::query('INSERT INTO reviews VALUES(\'\', :userid, :title, :year, :genre, :stars, :review, NOW())', array(':userid'=>$user_id, ':title'=>htmlspecialchars($_POST['title']), ':year'=>$_POST['year'], ':genre'=>$_POST['genre'], ':stars'=>$_POST['stars'], ':review'=>htmlspecialchars($_POST['review'])));
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
                Database::query('UPDATE reviews SET title=:title, year=:year, genre=:genre, stars=:stars, review=:review WHERE id=:id', array(':title'=>htmlspecialchars($_POST['title']), ':year'=>$_POST['year'], ':genre'=>$_POST['genre'], ':stars'=>$_POST['stars'], ':review'=>htmlspecialchars($_POST['review']), ':id'=>$_POST['reviewid']));
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