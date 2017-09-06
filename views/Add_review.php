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
  <title>New Review | Movie Reviews</title>
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
  <form action="store-review" method="post" id="new_review_form">
    <h2>New Movie Review</h2>
    <div class="title_inline">
      <p1>Title:</p1><br />
      <input type="text" name="title" placeholder="Title ..." required/><br />
      <p1>Genre:</p1><br />
      <select name="genre" required>
        <option disabled selected value>Select genre ...</option>
        <option value="Action">Action</option>
        <option value="Adventure">Adventure</option>
        <option value="Animation">Animation</option>
        <option value="Biography">Biography</option>
        <option value="Comedy">Comedy</option>
        <option value="Crime">Crime</option>
        <option value="Documentary">Documentary</option>
        <option value="Drama">Drama</option>
        <option value="Family">Family</option>
        <option value="Fantasy">Fantasy</option>
        <option value="History">History</option>
        <option value="Horror">Horror</option>
        <option value="Musical">Musical</option>
        <option value="Mystery">Mystery</option>
        <option value="Romance">Romance</option>
        <option value="Sci-Fi">Sci-Fi</option>
        <option value="Sport">Sport</option>
        <option value="Thriller">Thriller</option>
        <option value="War">War</option>
        <option value="Western">Western</option>
      </select>
      <button id="remove_genre">-</button>
      <button id="add_genre">+</button>
    </div>
    <div class="year_inline">
      <p1>Year:</p1><br />
      <input type="number" min="1800" max="2050" name="year" value="2017" required/><br />
      <p1>Stars:</p1><br />
      <select name="stars" required>
        <option disabled selected value>Select stars ...</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select>
    </div>
    <br />
    <p1>Review:</p1><br />
    <textarea name="review" placeholder="Review ..." rows="7" required/></textarea>
    <br />
    <input type="hidden" name="nocsrf" value="<?php echo $_SESSION['token']; ?>">
    <input type="submit" value="Add Review" class="submit_review_btn">
  </form>
  
<?php include('./views/Footer.php'); ?>  
  
</body>
</html>