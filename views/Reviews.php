<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Reviews | Movie Reviews</title>
  <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>

<style>
  <?php 
    include('./public/css/style.css'); 
  ?>
</style>

<body>
  <?php include('./views/Header.php'); ?>
  <h1>This is reviews route</h1>
  <?php
  $reviews = Review::allReviews();
  foreach ($reviews as $review) {
    $user = Login::userinfo($review['user_id']);
    $reviewText = $review['review'];
    $wordCount = 35;
    if (count(explode(" ", $reviewText)) > $wordCount) {
      $exploded = explode(" ", $reviewText);
      $reviewText = "";
      for ($i = 0; $i < $wordCount; $i++) {
        $reviewText .= $exploded[$i]." "; 
      }
      $reviewText .= "...";
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
    echo '
    <div class="review_div">
      <div class="review_text">
        <h3>'.$review['title'].' ('.$review['year'].')</h3>
        <p1 class="pull-left"><em>'.$review['genre'].'</em></p1><br />
        <p1>'.$reviewText.'</p1><br />
      </div>
      <div class="review_user">
        <img src="'.$user['profileimg'].'" class="rev_auth_img pull-left" />
        <p1>'.$networkImage.' '.$user['username'].'</p1><br />
        <p1><small>'.$timeReady.'</small></p1>
        <p1 class="pull-right">Stars: '.$review['stars'].'</p1><br />
      </div>
    </div>
    ';
  }
  ?>
  
<?php include('./views/Footer.php'); ?>

</body>
</html>