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

Route::set('google-login', function() {
    Google::login();
});

Route::set('google-callback', function() {
    Google::getCredentials();
});

Route::set('twitter-logout', function() {
    Logout::logoutUser();
});

Route::set('add-review', function() {
    Review::add();
});

Route::set('store-review', function() {
    Review::store();
});

Route::set('edit-review', function() {
    Review::edit();
});

Route::set('update-review', function() {
    Review::update();
});

Route::set('delete-review', function() {
    Review::deleteReview();
});

?>