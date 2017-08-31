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
  <h1>Reviews</h1>
  <?php
  $reviews = Review::allReviews();
  foreach ($reviews as $review) {
    $user = Login::userinfo($review['user_id']);
    $reviewText = $review['review'];
    $wordCount = 50;
    if (count(explode(" ", $reviewText)) > $wordCount) {
      $exploded = explode(" ", $reviewText);
      $reviewText = "";
      for ($i = 0; $i < $wordCount; $i++) {
        $reviewText .= $exploded[$i]." "; 
      }
      $reviewText .= "...";
    }
    
    $charCount = 350;
    if (strlen($review['title']) > 15) {
      $charCount = 300;
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
    if ($review['poster'] === 'none') {
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
            <p1 class="pull-right stars_p"><img src="http://i.imgur.com/wHiJDFU.png" class="review_star_icon"> '.$review['stars'].'</p1><br />
          </div>
        </div>
        ';
    } else {
      echo '
        <div class="review_div review_div_with_poster">
          <div class="review_image">
            <img src="'.$review['poster'].'" class="review_poster_image"/>
          </div>
          <div class="review_text review_text_hidden">
            <h3>'.$review['title'].' ('.$review['year'].')</h3>
            <p1 class="pull-left"><em>'.$review['genre'].'</em></p1><br />
            <p1>'.$reviewText.'</p1><br />
          </div>
          <div class="review_user">
            <img src="'.$user['profileimg'].'" class="rev_auth_img pull-left" />
            <p1>'.$networkImage.' '.$user['username'].'</p1><br />
            <p1><small>'.$timeReady.'</small></p1>
            <p1 class="pull-right stars_p"><img src="http://i.imgur.com/wHiJDFU.png" class="review_star_icon"> '.$review['stars'].'</p1><br />
          </div>
        </div>
        ';
    }
  }
  ?>
  
<?php include('./views/Footer.php'); ?>
<script type="text/javascript">
  /* global $ */
  $('.review_div_with_poster').hover(function() {
    //$('.review_image', this).slideUp(500);
    $('.review_text_hidden', this).slideDown(500);
  }, function() {
    //$('.review_image', this).slideDown(500);
    $('.review_text_hidden', this).slideUp(500);
  });
</script>

</body>
</html>