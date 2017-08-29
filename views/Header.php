<div id="header">
    <a href="/">Link to Welcome</a> | 
    <a href="reviews">Reviews</a> | 
    <?php if (Login::isLoggedin()) {
        $user_id = Login::isLoggedin();
        $user_info = Login::userInfo($user_id);
        
        echo "<a href='my-reviews'>My Reviews</a> | ";
        
        echo "<img src='".$user_info['profileimg']."' /><p1>".$user_info['username']." (".$user_info['network'].")</p1>
        <a href='twitter-logout'>Logout</a>";
    } else {
        ?>
        <a href="twitter-login">Sign in with Twitter</a> | 
        <a href="facebook-login">Sign in with Facebook</a> |
        <a href="google-login">Sign in with Google</a>
        <?php
    }
    ?>
</div>