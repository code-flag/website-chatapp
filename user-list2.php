<?php
		require_once('connection.php');
		$id = $_SESSION['chat_id'];
		$count = 0;

			$sql = "SELECT id, username, picture FROM wp_uusers";
				$result = $con->query($sql);

				$online_status = 0;

		if ($result->num_rows > 0) 
		{
					    // output data of each row
			while($row = $result->fetch_assoc()) {
				$picture = $row['picture'];
				$username = $row['username'];
				$id = $row['id'];

				$sql = "SELECT * FROM wp_ulogin WHERE user_id = '$id' ";
				$res = $con->query($sql);
				if ($res->num_rows > 0) {
					# code...
					$row2 = $res->fetch_assoc();
					$online_status = $row2['status'];
				}
				
				$count += 1;									
				$message = displayflist( $id, $picture, $username, $online_status );
				echo "$message";												
								
			}

		} else {
			  echo "0 results";
		}
		
			
	

function displayflist($id, $picture, $username, $online_status )
{
	if ($online_status == 0) {
			$msg = '<li class="friend-id" id="'.$id.'" >
							
							<div style=" background-color:#bcdddac2; font-size: 30px; display: flex; align-items:center; margin: 0px; padding: 5px; border-radius:10px 10px 0px 10px; border: 1px solid #eee;">  
									<a href="#">								
								<img src="data:image/jpg;base64,'.base64_encode($picture).'"alt="pic" style="width: 40px; height:40px; border-radius:50%; vertical-align: middle;"/> 

																	
						<div title="'.$username.'">
								<h5 style="display: flex;margin:0px;">'.$username.'</h5>
						</div>													
							</a>										
						</div>
							
					</li>';
	}
	else
	{
			$msg = '<li class="friend-id" id="'.$id.'" >
							
							<div style="font-size: 30px;">  
											<a href="#">						
								<img src="data:image/jpg;base64,'.base64_encode($picture).'"alt="pic" style="width: 40px; height:40px; border-radius:50%; vertical-align: middle;"/> 

																	
						<div title="'.$username.'">
								<h5 style="display: flex;margin:0px;">'.$username.'</h5>
						</div>													
									</a>								
						</div>
							
					</li>';
	}
	return $msg;
}
?>