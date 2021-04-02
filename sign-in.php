<?php

	require_once 'auth.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Sign in</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<meta name="viewport" content='width=device-width, initial-scale=1'>
</head>
<body>
	<section>
		<div class="widget-main">
			<h4>
					Login Page
				</h4> <hr>

			<form method="Post" action="sign-in.php">
				
					<fieldset class="form-field">
					<div class="text-input">
						<input type="email" name="email" id="email" placeholder="type your email" required autocorrect=off autocapitalize=word />
						<span id="un_error"></span>
					</div>
					
					<div class="text-input">
						<input type="password" name="password" id="password" placeholder="Password" required="*" autocorrect=off />
						<span id="pw_error" style="color: red;"><?=$errors ?></span>
					</div>

					<div class="submit">
						<input type="Submit" name="chat_login" value="login" id="submit" />
					</div>
					
					</fieldset>
			
			</form>
		</div>
		</div>
	</section>
</body>
</html>