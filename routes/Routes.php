<?php

Route::set('index.php', function() {
    Index::CreateView('Index');
});

Route::set('reviews', function() {
    Reviews::CreateView('Reviews');
});

Route::set('my-reviews', function() {
    My_reviews::createMyReviewsView();
});

Route::set('twitter-login', function() {
    Twitter::login();
});

Route::set('twitter-oauth-callback', function() {
    Twitter::getCredentials();
});

Route::set('facebook-login', function() {
    Facebook::login();
});

Route::set('fb-callback', function() {
    Facebook::getCredentials();
});

Route::set('twitter-logout', function() {
    Logout::logoutUser();
});

?>