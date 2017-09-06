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
  <?php 
  
  include('./views/Header.php');
  
  $networkImage;
    switch($user['network']) {
        case 'Twitter': $networkImage = '<img src="http://i.imgur.com/jIKZ8DZ.png" id="user_profile_network">';
        break;
        case 'Facebook': $networkImage = '<img src="http://i.imgur.com/IBfrj3q.png" id="user_profile_network">';
        break;
        case 'Google': $networkImage = '<img src="http://i.imgur.com/9nSmOm5.png" id="user_profile_network">';
        break;
        default: $networkImage = "";
    }
  
  echo '<h3 id="user_profile_username"><img src="'.$user['profileimg'].'" id="user_profile_img" />'.$networkImage.' '.$user['username'];
  if (count($reviews)) {
      if (count($reviews) === 1) {
          echo ' <span id="review-count">('.count($reviews).' review)</span>';
      } else {
          echo ' <span id="review-count">('.count($reviews).' reviews)</span>';
      }
      
  }
  echo '</h3><hr id="user_profile_hr"/>';
  
  if (count($reviews)) {
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
        echo '<div class="review_div">';
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
                
                echo '<br />
                <a href="review?id='.$review['id'].'"><p1>'.$reviewText.'</p1></a><br />
              </div>
              <div class="review_user">
                <img src="'.$user['profileimg'].'" class="rev_auth_img pull-left" />
                <a href="user?id='.$user['id'].'"><p1>'.$networkImage.' '.$user['username'].'</p1></a><br />
                <p1><small>'.$timeReady.'</small></p1>
                <p1 class="pull-right stars_p"><img src="http://i.imgur.com/wHiJDFU.png" class="review_star_icon"> '.$review['stars'].'</p1><br />
              </div>
            </div>';
      }
  } else {
      echo "<h3 id='user_no_reviews'>This user haven't added any reviews.</h3>";
  }
  ?>
  
<?php include('./views/Footer.php'); ?>

</body>
</html>