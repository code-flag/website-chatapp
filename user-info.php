<?php
		$id = $_SESSION['chat_id'];

					$online_status = 0;

		$sql = "SELECT * FROM wp_uusers WHERE id = '$id'";
				$result = mysqli_query($con, $sql);
		

		if ($result) 
		{
					    // output data of each row
			while($row = $result->fetch_assoc()) {
				$picture = $row['picture'];
				$username = $row['username'];
				$email = $row['email'];

				$sql = "SELECT * FROM wp_ulogin WHERE user_id = '$id' ";
				$res = $con->query($sql);
				if ($res->num_rows > 0) {
					# code...
					$row2 = $res->fetch_assoc();
					$online_status = $row2['status'];
				}

				$message = displayUserInfo( $email, $picture, $username, $online_status );
				echo "$message";												
								
			}

		} 

		function displayUserInfo($email, $picture, $username, $online_status)
		{
			$msg ='
					<div style=" display: flex: overflow: hidden;align-items: center; padding: 10px; margin-top: 10px; font-size: 18px;">

						<img src="data:image/jpg;base64,'.base64_encode($picture).'" alt="assets/img/profile-pic.jpg" style="width: 100px; height:100px; border-radius:50%; vertical-align: middle;"/> 


					<h3>'.$username.'<br> '.$email.' </h3> 
					<div style=" text-align: left; color: #555;">
					<span> <i class="fa fa-dot-circle-o" style="color: #12aa24;"> </i> Active Status <i class="fa fa-toggle-on" style="color: #12aa24;"> </i> </span>
					<br>
					<span><i class="fa fa-comments"></i> Message request<br> ...</span>  
						<hr>
						<span>Preference</span>
						<hr>
					<span> <i class="fa fa-bell"></i> Notification & Sound 
						<span style="border-radius: 50%; padding: 5px; background-color: #12aa24; color:#fff"> on </span> 
					<br>
					<span><i class="fa fa-group"></i> People</span>  
					<hr>
						<span> Account & Support</span>
						<hr>
					<span> <a href="logout.php" style="text-decoration: none"><i class="fa fa-power-off"></i> Logout </a></span> <br>
					<span> <a href="index.php" ><i class="fa fa-plane"></i> Leave Chat Page</a></span> <br>
					<span> <a href="contact.php"><i class="fa fa-exclamation-triangle"></i> Report a problem </a></span> 
			</div>

				';

				return $msg;
		}
?>