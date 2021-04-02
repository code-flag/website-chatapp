<?php
	require_once 'reg.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>User Sign Up</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<meta name="viewport" content='width=device-width, initial-scale=1'>
</head>
<body>
	<section>
		<div class="widget-main">
				<h4>
					User Registration. Please enter your details
				</h4> <hr>

			<form method="post" action="sign-up.php" enctype="multipart/form-data">
				
				<fieldset class="form-field">
					<div class="text-input">
						<input type="text" name="username" id="username"  placeholder="Username" required autocorrect=off autocapitalize=words />
						<span id="un_error"></span>
					</div>
					<div class="text-input">
						<input type="email" name="email" id="email" placeholder="Email" required autocorrect=off />
						<span id="e_error"></span>
					</div>
					<div class="text-input">
						<input type="password" name="password1" id="password1" placeholder="Password" required="*" autocorrect=off />
						<span id="pw_error" style="color: red;"><?=$pw_errors ?></span>
					</div class="text-input">
					<div class="text-input">
						<input type="password" name="password2" id="password2" placeholder="Re-enter the Password" required="*" autocorrect=off />
					</div>
					<div class="text-input">Upload profile pic
						<input type="file" name="picture" accept="image/*">
						<span style="color: red;"><?=$img_errors ?></span>
					</div>

					<div class="submit">
						<input type="Submit" name="chat-register" value="Sign Up" id="submit" />
					</div>

				</fieldset>
			</form>
		</div>
	</section>
</body>
</html>