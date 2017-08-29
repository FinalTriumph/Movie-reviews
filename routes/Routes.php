<?php

Route::set('index.php', function() {
    Index::CreateView('Index');
});

Route::set('reviews', function() {
    Reviews::CreateView('Reviews');
    //About::test();
});

Route::set('twitter-login', function() {
    Twitter::login();
});

Route::set('twitter-oauth-callback', function() {
    Twitter::getCredentials();
});

Route::set('twitter-logout', function() {
    Logout::logoutUser();
});

?>