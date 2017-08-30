<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Reviews</title>
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
    $wordCount = 30;
    if (count(explode(" ", $reviewText)) > $wordCount) {
      $exploded = explode(" ", $reviewText);
      $reviewText = "";
      for ($i = 0; $i < $wordCount; $i++) {
        $reviewText .= $exploded[$i]." "; 
      }
      $reviewText .= "...";
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
        <p1>'.$user['username'].' ('.$user['network'].')</p1>
        <p1><small>'.$review['created_at'].'</small></p1>
        <p1 class="pull-right">Stars: '.$review['stars'].'</p1><br />
      </div>
    </div>
    ';
  }
  ?>
  
<?php include('./views/Footer.php'); ?>

</body>
</html>