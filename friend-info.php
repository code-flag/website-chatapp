<?php
		require_once('connection.php');
		
					$online_status = 0;

		if (isset($_POST['message'])) {
		$reciever_id = $_POST['reciever_id'];

			$sql = "SELECT  username,email, picture FROM wp_uusers WHERE id = '$reciever_id'";
				$result = $con->query($sql);
		

			if ($result) 
			{
						    // output data of each row
				while($row = $result->fetch_assoc()) {
					$picture = $row['picture'];
					$username = $row['username'];
					$email = $row['email'];

					$sql = "SELECT * FROM wp_ulogin WHERE user_id = '$reciever_id' ";
					$res = $con->query($sql);
					if ($res->num_rows > 0) {
						# code...
						$row2 = $res->fetch_assoc();
						$online_status = $row2['status'];
					}

					$message = displayFriendInfo($email, $picture, $username, $online_status);
					echo "$message";												
									
				}

			} 
		
		}

		function displayFriendInfo($email, $picture, $username, $online_status)
		{
			if ($online_status == 1) {
				$status = 'fa-toggle-on';
				$color = 'color: #12aa24;';
			}
			else
			{
				$status = 'fa-toggle-off';
				$color = 'color: #ddd;';
			}
			$msg ='
					<div style=" display: flex: overflow: hidden;align-items: center; padding: 10px; margin-top: 10px; font-size: 18px;">

						<img src="data:image/jpg;base64,'.base64_encode($picture).'" alt="assets/img/profile-pic.jpg" style="width: 100px; height:100px; border-radius:50%; vertical-align: middle;"/> 


					<h3>'.$username.'<br> '.$email.' </h3> 
					<div style=" text-align: left; color: #555;">
					<span> <i class="fa fa-dot-circle-o" style="'.$color.'"> </i> Active Status <i class="fa '.$status.'" style="'.$color.'"> </i> </span>
					<br>
					 
			</div>

				';

				return $msg;
		}
			

		
?>