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
  
  ?>
  <div id="genres" class="pull-left">
    <div class="genres_options">
      <a href="genre?genre=Action"><button>Action</button></a>
      <a href="genre?genre=Adventure"><button>Adventure</button></a>
      <a href="genre?genre=Animation"><button>Animation</button></a>
      <a href="genre?genre=Biography"><button>Biography</button></a>
      <a href="genre?genre=Comedy"><button>Comedy</button></a>
      <a href="genre?genre=Crime"><button>Crime</button></a>
      <a href="genre?genre=Documentary"><button>Documentary</button></a>
      <a href="genre?genre=Drama"><button>Drama</button></a>
      <a href="genre?genre=Family"><button>Family</button></a>
      <a href="genre?genre=Fantasy"><button>Fantasy</button></a>
      <a href="genre?genre=History"><button>History</button></a>
      <a href="genre?genre=Horror"><button>Horror</button></a>
      <a href="genre?genre=Musical"><button>Musical</button></a>
      <a href="genre?genre=Mystery"><button>Mystery</button></a>
      <a href="genre?genre=Romance"><button>Romance</button></a>
      <a href="genre?genre=Sci-Fi"><button>Sci-Fi</button></a>
      <a href="genre?genre=Sport"><button>Sport</button></a>
      <a href="genre?genre=Thriller"><button>Thriller</button></a>
      <a href="genre?genre=War"><button>War</button></a>
      <a href="genre?genre=Western"><button>Western</button></a>
    </div>
    <div class="genres_toggle">
      <p1>Genres</p1>
    </div>
  </div>
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
            <a href="#"><h3>'.$review['title'].' ('.$review['year'].')</h3></a>
            <a href="genre?genre='.$review['genre'].'"><p1 class="pull-left"><em>'.$review['genre'].'</em></p1></a><br />
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
  ?>
  
<?php include('./views/Footer.php'); ?>
<script type="text/javascript">
  /* global $ */
  $('.review_div').hover(function() {
    $('.review_text_hidden', this).slideDown(500);
  }, function() {
    $('.review_text_hidden', this).slideUp(500);
  });
</script>

</body>
</html>