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
    <?php include('./views/Header.php'); ?>
    <?php
    $user = Login::userinfo($review['user_id']);
    
    echo '
        <form action="update-review" method="post" id="new_review_form">
            <h2>Edit Review</h2>
            <div class="title_inline">
                <p1>Title:</p1><br />
                <input type="text" name="title" placeholder="Title ..." value ="'.$review['title'].'" required /><br />
                <p1>Genre:</p1><br />
                <select name="genre" required>';
                $genres = array('Action', 'Adventure', 'Animation', 'Biography', 'Comedy', 'Crime', 'Documentary', 'Drama', 'Family', 'Fantasy', 'History', 'Horror', 'Musical', 'Mystery', 'Romance', 'Sci-Fi', 'Sport', 'Thriller', 'War', 'Western'); 
                for ($i = 0; $i < count($genres); $i++) {
                    if ($genres[$i] == $review['genre']) {
                        echo '<option selected value="'.$review['genre'].'">'.$review['genre'].'</option>';
                    } else {
                        echo '<option value="'.$genres[$i].'">'.$genres[$i].'</option>';
                    }
                }
                
                echo '
                </select>
            </div>
            <div class="year_inline">
                <p1>Year:</p1><br />
                <input type="number" min="1800" max="2050" name="year" value="'.$review['year'].'" required /><br />
                <p1>Stars:</p1><br />
                <select name="stars" required>';
                for ($i = 1; $i <= 10; $i++) {
                    if ($review['stars'] == $i) {
                        echo '<option selected value="'.$i.'">'.$i.'</option>';
                    } else {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                    
                }
                echo '
                </select>
            </div>
            <br />
            <p1>Review:</p1><br />
            <textarea name="review" placeholder="Review ..." rows="7" required/>'.$review['review'].'</textarea>
            <br />
            <input type="hidden" name="reviewid" value="'.$review['id'].'" />
            <input type="hidden" name="nocsrf" value="'.$_SESSION['token'].'" />
            <input type="submit" value="Update" class="submit_review_btn" />
        </form>
    ';
    ?>
    
<?php include('./views/Footer.php'); ?>
    
</body>
</html>