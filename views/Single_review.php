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
	<title><?php echo $review['title']." (".$review['year'].")"; ?> | Movie Reviews</title>
	<link rel="icon" href="https://i.imgur.com/KFGajXy.png" />
	<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>

<style>
	<?php
		include('./public/css/style.css');
	?>
</style>

<body>
<div id="content" class="content_with_genres">
	<?php 
	include('./views/Header.php');
	?>
	<div id="confirm_popup">
	  	<div id="confirm_delete">
			<p1>Are you sure you want to delete this review?</p1><br />
			<button id="yes_delete_btn">Yes</button>
			<button id="cancel_delete_btn">Cancel</button>
	  	</div>
	</div>
	<div id="genres" class="pull-left">
		<div class="genres_options">
			<a href="genre?genre=Action"><button>Action</button></a>
			<a href="genre?genre=Adventure"><button>Adventure</button></a>
			<a href="genre?genre=Animation"><button>Animation</button></a>
			<a href="genre?genre=Biography"><button>Biography</button></a>
			<a href="genre?genre=Comedy"><button>Comedy</button></a>
			<a href="genre?genre=Crime"><button>Crime</button></a>
			<a href="genre?genre=Documentary"><button>Documentary</button></a>
			<a href="genre?genre=Drama"><button>Drama</button></a>
			<a href="genre?genre=Family"><button>Family</button></a>
			<a href="genre?genre=Fantasy"><button>Fantasy</button></a>
			<a href="genre?genre=History"><button>History</button></a>
			<a href="genre?genre=Horror"><button>Horror</button></a>
			<a href="genre?genre=Music"><button>Music</button></a>
			<a href="genre?genre=Mystery"><button>Mystery</button></a>
			<a href="genre?genre=Romance"><button>Romance</button></a>
			<a href="genre?genre=Sci-Fi"><button>Sci-Fi</button></a>
			<a href="genre?genre=Sport"><button>Sport</button></a>
			<a href="genre?genre=Thriller"><button>Thriller</button></a>
			<a href="genre?genre=War"><button>War</button></a>
			<a href="genre?genre=Western"><button>Western</button></a>
		</div>
		<div class="genres_toggle">
			<p1>Genres</p1>
		</div>
	</div>
	
	<?php
	
	$poster_link;
	if ($review['poster'] === 'none') {
		$poster_link = 'https://i.imgur.com/8QjQ7zW.jpg';
	} else {
		$poster_link = $review['poster'];
	}
	$networkImage;
	switch($user['network']) {
		case 'Twitter': $networkImage = '<img src="http://i.imgur.com/jIKZ8DZ.png" class="rev_div_icon">';
		break;
		case 'Facebook': $networkImage = '<img src="http://i.imgur.com/IBfrj3q.png" class="rev_div_icon">';
		break;
		case 'Google': $networkImage = '<img src="http://i.imgur.com/9nSmOm5.png" class="rev_div_icon">';
		break;
		default: $networkImage = "";
	}
	$time = strtotime($review['created_at']);
	$timeReady = date("F d, Y", $time);
	
	echo '<div class="single_review_div">
			<img src="'.$poster_link.'" class="pull-right single_post_poster" />
			<a href="search?search='.$review['title'].'"><h2>'.$review['title'].' ('.$review['year'].')</h2></a>';
		
	if (count(explode(", ", $review['genre'])) > 1) {
		$genres = explode(", ", $review['genre']);
		foreach($genres as $genre) {
			echo '<a href="genre?genre='.$genre.'"><p1><em>'.$genre.'</em></p1></a>';
			if ($genre !== end($genres)) {
				echo '<p1><em class="genre_seperetaor">|</em></p1>';
			}
		}
	} else {
		echo '<a href="genre?genre='.$review['genre'].'"><p1><em>'.$review['genre'].'</em></p1></a>';
	}
	
	$readyText = nl2br($review['review']);
	
	echo '<br />
	<div class="single_review_text">
		<p1>'.$readyText.'</p1>
	</div>
	<div class="single_review_user_info">
		<hr class="single_post_hr"/>
		<img src="'.$user['profileimg'].'" class="rev_auth_img pull-left" />
		<a href="user?id='.$user['id'].'"><p1>'.$networkImage.' '.$user['username'].'</p1></a>
		<p1 class="pull-right stars_p"><img src="http://i.imgur.com/wHiJDFU.png" class="review_star_icon"> '.$review['stars'].'</p1><br />
		<p1><small>'.$timeReady.'</small></p1>';
	if (Login::isLoggedin() && Login::isLoggedin() === $review['user_id']) {
		echo '<hr id="sp_inv_hr"/>
			<div class="single_review_buttons">
				<div class="sp_edit_review_form">
					<a href="edit-review?id='.$review['id'].'"><button class="sp_edit_btn">Edit</button></a>
				</div>
				<form action="delete-review" method="POST" class="sp_delete_review_form" id="delete'.$review['id'].'">
					<input type="hidden" name="reviewid" value="'.$review['id'].'" />
					<input type="hidden" name="nocsrf" value="'.$_SESSION['token'].'" />
					<input type="button" value="Delete" class="sp_delete_btn" data-id="'.$review['id'].'" />
				</form>
			</div>
		</div>
	</div>';
	
	} else {
		echo '</div></div>';
	}
  	
  	?>
</div>

<?php include('./views/Footer.php'); ?>
	
<script type="text/javascript">
/* global $ */
	$('#header_search_div').show();
</script>

</body>
</html>