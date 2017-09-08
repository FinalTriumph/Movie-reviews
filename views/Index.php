<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Movie Reviews</title>
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
    <?php include('./views/Header.php'); ?>
    <div id="welcome_div">
        <h2><img src="https://i.imgur.com/KFGajXy.png" id="welcome_mr_img"/>Movie Reviews</h2>
        <hr class="welcome_hr"/>
        <p class="left_m">This application was made as a part of PHP/MySQL programming practice.</p>
        <div id="welcome_unauth">
            <p class="b_t">All users can:</p>
            <p class="left_m">- Sign in with Twitter.</p>
            <p class="left_m">- Sign in with Facebook.</p>
            <p class="left_m">- Sign in with Google.</p>
            <p class="left_m">- Browse through all reviews.</p>
            <p class="left_m">- View reviews by genre.</p>
            <p class="left_m">- Search reviews by movie title.</p>
            <p class="left_m">- View single review.</p>
            <p class="left_m">- View user profiles (added reviews).</p>
        </div>
        <div id="welcome_auth">
            <p class="b_t">Authenticated users can:</p>
            <p class="left_m">- Add new reviews (with movie title, year, genre (1-3 genres), review text, stars (1-10).</p>
            <p class="left_m">- View added reviews.</p>
            <p class="left_m">- Edit added reviews.</p>
            <p class="left_m">- Delete added reviews.</p>
            <p class="left_m">Application is using <a href="https://www.themoviedb.org/documentation/api" target="_blank">TMDb API</a> to find movie posters by movie title and year (if poster can't be found, defaut image is added).</p>
        </div>
        <hr class="welcome_hr"/>
        <p class="left_m">If any errors spotted, feel free to <a href="http://finaltriumph.tk/" target="_blank">contact me</a> and let me know.</p>
        <p class="left_m">Made by <a href="http://finaltriumph.tk/" target="_blank">FinalTriumph</a>, 2017</p>
    </div>
</div>

<?php include('./views/Footer.php'); ?>

</body>
</html>