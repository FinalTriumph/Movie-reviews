<div id="header">
    <a href="/" class="pull-left">Movie Reviews</a>
    <div id="header_search_div" class="pull-left">
        <input type="text" name="search" id="search_term" placeholder="Search by title ..." />
        <button id="search_btn"><img src="https://i.imgur.com/VVVVBvq.png" /></button>
    </div>
    <a href="reviews">Reviews</a>
    <?php if (Login::isLoggedin()) {
        $user_id = Login::isLoggedin();
        $user_info = Login::userInfo($user_id);
        
        echo "<a href='my-reviews'>My Reviews</a>";
        
        $networkImage;
        switch($user_info['network']) {
            case 'Twitter': $networkImage = '<img src="http://i.imgur.com/jIKZ8DZ.png" class="signed_in_icon">';
            break;
            case 'Facebook': $networkImage = '<img src="http://i.imgur.com/IBfrj3q.png" class="signed_in_icon">';
            break;
            case 'Google': $networkImage = '<img src="http://i.imgur.com/9nSmOm5.png" class="signed_in_icon">';
            break;
            default: $networkImage = "";
        }
        
        echo "<div id='profile_options'>
                <img src='".$user_info['profileimg']."' id='header_user_img'/>
                <p1>".$networkImage." ".$user_info['username']." 
                    <span id='header_arrow_span'>
                        <img src='http://i.imgur.com/bFeYehs.png' class='header_arrow'>
                    </span>
                </p1>
            </div>
        <div id='profile_options_dropdown'>
            <a href='add-review'>New Review</a>
            <a href='twitter-logout'>Logout</a>
        </div>";
    } else {
        ?>
        <div id='profile_options'>
            <p1>Sign in with 
                <img src="http://i.imgur.com/jIKZ8DZ.png" class="header_sign_in_icon"> | 
                <img src="http://i.imgur.com/IBfrj3q.png" class="header_sign_in_icon"> | 
                <img src="http://i.imgur.com/9nSmOm5.png" class="header_sign_in_icon"> 
                <span id='header_arrow_span'>
                    <img src='http://i.imgur.com/bFeYehs.png' class='header_arrow'>
                </span>
            </p1>
            <div id='profile_options_dropdown'>
                <a href="twitter-login"><img src="http://i.imgur.com/jIKZ8DZ.png" class="sign_in_icon"> Sign in with Twitter</a> 
                <a href="facebook-login"><img src="http://i.imgur.com/IBfrj3q.png" class="sign_in_icon"> Sign in with Facebook</a>
                <a href="google-login"><img src="http://i.imgur.com/9nSmOm5.png" class="sign_in_icon"> Sign in with Google</a>
            </div>
        </div>
        <?php
    }
    ?>
</div>