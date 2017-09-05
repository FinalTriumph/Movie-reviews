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
    <title>Edit Review | Movie Reviews</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>

<style>
    <?php
    include('./public/css/style.css');
    ?>
</style>

<body>
    <?php 
    include('./views/Header.php');
    
    $poster_link;
    if ($review['poster'] === 'none') {
        $poster_link = 'https://i.imgur.com/rfUi6ZR.jpg';
    } else {
        $poster_link = $review['poster'];
    }
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
    $time = strtotime($review['created_at']);
    $timeReady = date("F d, Y", $time);
    
    echo '
    <div class="single_review_div">
        <img src="'.$poster_link.'" class="pull-right single_post_poster" />
        <a href="#"><h2>'.$review['title'].' ('.$review['year'].')</h2></a>
        <a href="genre?genre='.$review['genre'].'"><p1><em>'.$review['genre'].'</em></p1></a><br />
        <div class="single_review_text">
            <p1>'.$review['review'].'</p1>
        </div>
        <div class="single_review_user_info">
            <hr class="single_post_hr"/>
            <img src="'.$user['profileimg'].'" class="rev_auth_img pull-left" />
            <a href="user?id='.$user['id'].'"><p1>'.$networkImage.' '.$user['username'].'</p1></a>
            <p1 class="pull-right stars_p"><img src="http://i.imgur.com/wHiJDFU.png" class="review_star_icon"> '.$review['stars'].'</p1><br />
            <p1><small>'.$timeReady.'</small></p1>
        ';
    if (Login::isLoggedin() && Login::isLoggedin() === $review['user_id']) {
        echo '
            <div class="single_review_buttons">
              <div class="sp_edit_review_form">
                <a href="edit-review?id='.$review['id'].'"><button class="sp_edit_btn">Edit</button></a>
              </div>
              <form action="delete-review" method="POST" class="sp_delete_review_form">
                <input type="hidden" name="reviewid" value="'.$review['id'].'" />
                <input type="hidden" name="nocsrf" value="'.$_SESSION['token'].'" />
                <input type="submit" onclick="return confirm(\'Are you sure you want to delete this review?\')" value="Delete" class="sp_delete_btn" />
              </form>
            </div>
        </div>
    </div>';
        
    } else {
        echo '
        </div>
    </div>';
    }
    include('./views/Footer.php'); ?>
    
</body>
</html>