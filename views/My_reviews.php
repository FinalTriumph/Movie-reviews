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
  <h1>This is MY reviews route</h1>
  <a href="/add-review">Add new review</a>
  <br />
  <?php
  $reviews = Review::myReviews();
  $user_id = Login::isLoggedin();
  $user = Login::userinfo($user_id);
  foreach ($reviews as $review) {
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
    <div class="review_div my_review_div">
      <div class="my_review_text">
        <h3>'.$review['title'].' ('.$review['year'].')</h3>
        <p1 class="pull-left"><em>'.$review['genre'].'</em></p1><br />
        <p1>'.$reviewText.'</p1><br />
      </div>
      <div class="my_review_user">
        <img src="'.$user['profileimg'].'" class="rev_auth_img pull-left" />
        <p1>'.$user['username'].' ('.$user['network'].')</p1>
        <p1><small>'.$review['created_at'].'</small></p1>
        <p1 class="pull-right">Stars: '.$review['stars'].'</p1><br />
      </div>
      <div class="my_review_buttons">
        <form action="edit-review" method="POST">
          <input type="hidden" name="reviewid" value="'.$review['id'].'">
          <input type="hidden" name="nocsrf" value="'.$_SESSION['token'].'">
          <input type="Submit" value="Edit">
        </form>
        <form action="delete-review" method="POST">
          <input type="hidden" name="reviewid" value="'.$review['id'].'">
          <input type="hidden" name="nocsrf" value="'.$_SESSION['token'].'">
          <input type="submit" onclick="return confirm(\'Are you sure you want to delete this review?\')" value="Delete">
        </form>
      </div>
    </div>
    ';
  }
  ?>

<?php include('./views/Footer.php'); ?>

<script type="text/javascript">

</script>

</body>
</html>