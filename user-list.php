<?php
		require_once('connection.php');
		$id = $_SESSION['chat_id'];
		//select an
		$uid = $utim = $umsg = $ustatus = $online_status = $picture = $username =array(0); 

		$ucount = 0; $upcount = $countfm = $s_count = 0;  $idcount=1; 

		$sql = "SELECT * FROM wp_umessages WHERE sender_id = '$id' OR reciever_id = '$id' ";
		$res = mysqli_query($con, $sql);
		$count = mysqli_num_rows($res);

		

	if ($count>=1) 
	{
		while ($row = mysqli_fetch_array($res)) 
		{
			$sender_id = $row['sender_id'];
			$reciever_id = $row['reciever_id'];

	 		if ($sender_id == $id) {
	 			$friend_id = $reciever_id;
	 		}
	 		elseif ($reciever_id == $id) {
	 			$friend_id = $sender_id;
	 		}
	 		

	 		/** check how many time friend message appear and choose the last one 
	 		  @checkIdContainer check if the user have not been checked, before running the loop again to avoid repeatition and waste of time
	 		*/
	 		if(checkIdContainer($idcount, $friend_id) ) 
	 		{
	 			$sql = "SELECT * FROM wp_umessages WHERE (sender_id = '$id' And reciever_id = '$friend_id') OR (sender_id = '$friend_id' And reciever_id = '$id') ";
					$result = mysqli_query($con, $sql);
					$countfm = mysqli_num_rows($result);
					 while ($rowfm = mysqli_fetch_array($result)) 
					 {
					 	$upcount += 1;
						if($upcount == $countfm)
					 	{
					 		$tim = $rowfm['time'];
					 		$msg = $rowfm['message'];
					 		$status = $rowfm['status'];
					 		if ($status == 0) {
					 			# code...
					 			$s_count += 1;
					 		}
					 	//save last message and time to array for quick reference later
					 		$uid[$idcount] = $friend_id;
					 		$utim[$idcount] = $tim;
					 		$umsg[$idcount] = $msg;
					 		$ustatus[$idcount] = $status;
					 		


					 		$sql = "SELECT * FROM wp_ulogin WHERE user_id = '$friend_id' ";
							$res2 = mysqli_query($con, $sql);
							$row2 = mysqli_fetch_array($res2);
							if ($row2) {
								
								$online_status[$idcount] = $row2['status'];
							}
							else{$online_status[$idcount] = 0;}
							

								// get friend pic and name
							$sql = "SELECT * FROM wp_uusers WHERE id = '$friend_id' ";
							$res3 = mysqli_query($con, $sql);
						
							$row3 = mysqli_fetch_array($res3);
							$picture[$idcount] = $row3['picture'];
							$username[$idcount] = $row3['username'];

							$idcount += 1;
					 		$upcount = 0;
					 	}
					 	

					 }
	 		}

		}
		//  show number of unread messages
		echo '<b style="background: #ff3366; color:#fff; border-radius: 50%; padding: 5px;">'.$s_count .'</b>';
// sort and display message acoording to arriver time.
		sortMsgTime($idcount);

	}
	else {
		echo "<fieldset class='form-field'><img src='assets/emojis/5.gif' width=20px> you have no message</fieldset>";
	}

	

	function checkIdContainer($idcount, $id)
	{
		GLOBAL $uid;
		$valid = 0;

		for($i =0; $i < $idcount; $i++)
		{
			if($uid[$i] == $id)
			{
				$valid = 1;
			}


		}

		if ($valid != 1) {
			return true;
		}
		return false;
	}
	function sortMsgTime($idcount)
	{
		GLOBAL $uid ;GLOBAL $utim ;GLOBAL $ustatus ; GLOBAL $umsg ;GLOBAL $online_status ;GLOBAL $picture ;GLOBAL $username;
		$idx=0; $tmp=0;

		for ($i=1; $i < $idcount ; $i++) { 

			for ($j=1; $j < $idcount ; $j++) {  //compare 1 with others and save the last biggest
													//time number
				if($utim[$j] > $tmp)
				{
					$tmp = $utim[$j] ;
					$idx = $j;           //save the index of the newest message time for display 


				}
			}

			//display at  $idx

				// check if message is read or unread 
			
			if($ustatus[$idx] == 0)
			{
																		
				$message = displayMsg($umsg[$idx], 0, $uid[$idx], $picture[$idx], $username[$idx], $online_status[$idx], $utim[$idx] );
				echo "$message";													
			}
			else
			{
				$message = displayMsg($umsg[$idx], 1, $uid[$idx], $picture[$idx], $username[$idx], $online_status[$idx], $utim[$idx] );
				echo "$message";
																			
			}
			//@ $utim[$idx] =0; change this index value to 0;

			$utim[$idx] = 0;
			$tmp = 0; //temp need to be zero again in order to compare others
		}

		
		
	}

function displayMsg($message,$status, $sender_id, $picture, $username, $online_status, $tim )
{

	$message = substr($message,0, 30);
	$message = $message."...";
	$online = "color: #11ab24;";
	$offline = "color: #fff;";
	$tim = date('M d H:i', $tim);

	if($online_status == 0)
		{
			$presence ='<i class="fa fa-circle" style="'.$offline.' padding: 5px;"></i>';
		}
			else
			{
				$presence ='<i class="fa fa-circle" style="'.$online.' padding: 5px;"></i>';
			}



	if ($status == 0) {
			$msg = '<li class="friend-id2" id="'.$sender_id.'" >
						<div style=" background-color:#99dd8a80; display: flex; align-items:center; margin: 0px; padding: 5px; border-radius:10px 10px 0px 10px; border: 1px solid #eee;">  
								<a href="#">									
								<img src="data:image/jpg;base64,'.base64_encode($picture).'"alt="pic" style="width: 40px; height:40px; border-radius:50%; vertical-align: middle;"/> 

								'.$presence.'
																	
						<div title="'.$username.'">
								<h5 style="display: flex;margin:0px;">'.$username.'</h5>
								</a>

								<span>'.$message.'</span>

								<span>'.$tim.'</span>

								<i class="fa fa-envelope"></i>
						</div>													
																	
			</div>
			</li>';
	}
	else
	{
		
			$msg = '<li class="friend-id2" id="'.$sender_id.'" >
						<div style="display: flex; align-items:center; margin: 0px; padding: 5px; border-radius:10px 10px 0px 10px; border: 1px solid #eee;">  
										<a href="#">				
								<img src="data:image/jpg;base64,'.base64_encode($picture).'"alt="pic" style="width: 40px; height:40px; border-radius:50%; vertical-align: middle;"/> 

								'.$presence.'

						<div title="'.$username.'">
								<h5 style="display: flex;margin:0px;">'.$username.'</h5>
								<span>'.$message.'</span>
									</a>
								<span>'.$tim.'</span>

								<i class="fa fa-envelope"></i>
						</div>													
																	
			</div>
			</li>';
	}
	return $msg;
}
?>