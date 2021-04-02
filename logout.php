<?php
	
	session_start();

	if (isset($_SESSION['chat_id'])) {
		unset($_SESSION['chat_id']);
		unset($_SESSION['reciever_id']);
	}

	 header('Location: http://' . $_SERVER['HTTP_HOST'].'/Project/chatApp/sign-in.php', true);
        exit;

?>