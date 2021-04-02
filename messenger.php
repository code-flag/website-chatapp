<?php
	// define("WP_USE_THEMES", false);
	// require ('../../wordpress/wp-load.php');
	require_once('connection.php');
	// global $current_user;
	// $current_user= wp_get_current_user();
	// var_dump($current_user);
	// echo "hey! name ".$current_user->user_login;
	// echo "<br>";
	// echo "hey email ".$current_user->user_email;
	// echo "hey! id ".$current_user->ID;


	session_start();
	if (!isset($_SESSION['chat_id'])) {
		 header('Location: http://' . $_SERVER['HTTP_HOST'].'/Project/chatApp/sign-in.php', true);
        exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ChatPeer</title>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<meta name="viewport" content='width=device-width, initial-scale=1'>
</head>
<body id="bodyId">
	<section class="container">
		
		<div class="chat-div" style="display: none">
		<?php
			require_once 'chatting-page.php';
		?>
		</div>
		<div class="friend-div">
			<?php
				require_once 'friend-list.php';
			?>
		</div>
	</section>
	 
<script src="assets/js/jquery-3.4.1.js"></script>
<script src="assets/js/tab-control.js"></script>
<script src="assets/js/search-bar.js"></script>
<script src="assets/js/messaging.js"></script>
		
		<script type="text/javascript">
		
	
	</script>

</body>
</html>