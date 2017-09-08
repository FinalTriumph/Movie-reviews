<?php

if (!isset($_SESSION['token'])) {
    $cstrong = true;
    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
    $_SESSION['token'] = $token;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Reviews | Movie Reviews</title>
    <link rel="icon" href="https://i.imgur.com/KFGajXy.png" />
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="public/css/style.css" />
</head>

<style>
    <?php 
        include('./public/css/style.css'); 
    ?>
</style>

<body>
<div id="content">
    <?php include('./views/Header.php');?>
    <div id="confirm_popup">
        <div id="confirm_delete">
            <p1>Are you sure you want to delete this review?</p1><br />
            <button id="yes_delete_btn">Yes</button>
            <button id="cancel_delete_btn">Cancel</button>
        </div>
    </div>
    <?php
    $reviews = Review::myReviews();
    
    if (count($reviews)) {
        echo '<a href="add-review"><button class="add_new_review_btn">Add New Review</button></a>
        <br />';
    } else {
        echo '<a href="add-review"><button class="add_new_review_btn add_first_review_btn">Add First Review</button></a>
        <br />';
    }
  
  
  
    $user_id = Login::isLoggedin();
    $user = Login::userinfo($user_id);
    foreach ($reviews as $review) {
        $reviewText = $review['review'];
        $wordCount = 45;
        if (count(explode(" ", $reviewText)) > $wordCount) {
            $exploded = explode(" ", $reviewText);
            $reviewText = "";
            for ($i = 0; $i < $wordCount; $i++) {
                $reviewText .= $exploded[$i]." "; 
            }
            $reviewText .= "...";
        }
    
        $charCount = 320;
        if (strlen($review['title']) > 15) {
            $charCount = 270;
        }
    
        if (strlen($reviewText) > $charCount) {
            $reviewText = substr($reviewText, 0, $charCount);
            $reviewText .= " ...";
        }
    
        $time = strtotime($review['created_at']);
        $timeReady = date("F d, Y", $time);
    
        $networkImage;
        switch($user['network']) {
            case 'Twitter': $networkImage = '<img src="http://i.imgur.com/jIKZ8DZ.png" class="rev_div_icon">';
            break;
            case 'Facebook': $networkImage = '<img src="http://i.imgur.com/IBfrj3q.png" class="rev_div_icon">';
            break;
            case 'Google': $networkImage = '<img src="http://i.imgur.com/9nSmOm5.png" class="rev_div_icon">';
            break;
            default: $networkImage = "";
        }
        echo '<div class="review_div my_review_div">';
        if ($review['poster'] === 'none') {
            echo '<div class="review_image review_default_image">
                    <h2>'.$review['title'].'<br />('.$review['year'].')</h2>
                </div>';
        } else {
            echo '<div class="review_image">
                  <img src="'.$review['poster'].'" class="review_poster_image"/>
                </div>';
        }
        echo '<div class="review_text review_text_hidden">
                <a href="search?search='.$review['title'].'"><h3>'.$review['title'].' ('.$review['year'].')</h3></a>';
                
            if (count(explode(", ", $review['genre'])) > 1) {
                $genres = explode(", ", $review['genre']);
                foreach($genres as $genre) {
                    echo '<a href="genre?genre='.$genre.'"><p1><em>'.$genre.'</em></p1></a>';
                    if ($genre !== end($genres)) {
                        echo '<p1><em class="genre_seperetaor">|</em></p1>';
                    }
                }
            } else {
                echo '<a href="genre?genre='.$review['genre'].'"><p1><em>'.$review['genre'].'</em></p1></a>';
            }
            
            echo'<br />
                <a href="review?id='.$review['id'].'"><p1>'.$reviewText.'</p1></a><br />
            </div>
            <div class="review_user">
                <p1><small>'.$timeReady.'</small></p1>
                <p1 class="pull-right stars_p"><img src="http://i.imgur.com/wHiJDFU.png" class="review_star_icon"> '.$review['stars'].'</p1><br />
                <div class="my_review_buttons">
                    <div class="edit_review_form">
                        <a href="edit-review?id='.$review['id'].'"><button class="edit_btn">Edit</button></a>
                    </div>
                    <form action="delete-review" method="POST" class="delete_review_form" id="delete'.$review['id'].'">
                        <input type="hidden" name="reviewid" value="'.$review['id'].'" />
                        <input type="hidden" name="nocsrf" value="'.$_SESSION['token'].'" />
                        <input type="button" value="Delete" class="delete_btn" data-id="'.$review['id'].'" />
                    </form>
                </div>
            </div>
        </div>';
    }
    
    ?>
</div>

<?php include('./views/Footer.php'); ?>

</body>
</html>