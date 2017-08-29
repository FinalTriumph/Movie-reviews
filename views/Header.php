<div id="header">
    <a href="/">This is header</p1>
    <a href="reviews">Reviews</a>
    <?php if (Login::isLoggedin()) {
        $user_id = Login::isLoggedin();
        $user_info = Login::userInfo($user_id);
        
        echo "<img src='".$user_info['profileimg']."' /><p1>".$user_info['username']."</p1>
        <a href='twitter-logout'>Logout</a>";
    } else {
        ?>
        <a href="twitter-login">Sign in with Twitter</a>
        <?php
    }
    ?>
</div>