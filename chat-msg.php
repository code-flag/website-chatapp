<?php
require_once('connection.php');
session_start();

// update the message status to read by setting status to 1
function updateMsgStatus($sender, $reciever)
{
	GLOBAL $con;
	$sql = "UPDATE wp_umessages SET status=1 WHERE reciever_id= '$sender' AND sender_id='$reciever' AND status=0 ";
	$res = mysqli_query($con, $sql);
}

	$attachment_status = $message = " ";

	$sender_id = $_SESSION['chat_id'];

	if (isset($_POST['message'])) {
		$reciever_id = $_POST['reciever_id'];
		

		if (isset($_POST['reply']) && !empty($_POST['reply'])) {
			$message = $_POST['reply'];
			$a_status = 0;
				$time = time();
				$sql = "INSERT INTO  wp_umessages ( sender_id,reciever_id, message,attachment_status,status,time ) VALUES ('$sender_id', '$reciever_id', '$message', '$a_status',0,'$time') ";
				$res = mysqli_query($con, $sql);
				if ($res) {
					//echo "doneeeee";
				}
			
		}
	}
	else
	{
		$id = 1;
	}


	$i=0;
	//select from database where sender email equal to current user which will represent reply to the wp_umessages message
	$sql = "SELECT * FROM wp_umessages WHERE reciever_id='$reciever_id' and sender_id = '$sender_id'";
	//send the query 1
	$res = mysqli_query($con, $sql);
	$total_msg = mysqli_num_rows($res); // get the total message number in datatbase with this query valid
	//send query 1

	//select from database where sender email is equal to current wp_umessages email
	$sql2 = "SELECT * FROM wp_umessages WHERE reciever_id='$sender_id' and sender_id = '$reciever_id'";
	$res1 = mysqli_query($con, $sql2);
	$total_msg1 = mysqli_num_rows($res1);

	//instantiate all the variable to hold the db output data
	$tm = $tm1 = $message = $message1 = $attachment = $attachment1 = "none";
	//get the sum of the total sent and recieve message
	$total = $total_msg + $total_msg1 ; 


		 	updateMsgStatus($sender_id, $reciever_id); // change status to read


	//get all the query 1 data and concatenate with ":" into a single variable for later seperation into array
	for ($i=0; $i < $total_msg; $i++) { 
		$row = mysqli_fetch_array($res) ;
		 // get a
		$tm = $tm.':'.$row['time'];
		$message = $message.':'.$row['message'];
		$attachment = $attachment.':'.$row['attachment_status'];
	}
	//get all the query 2 data and concatenate with ":" into a single variable for later seperation into array
	
		 for ($i=0; $i < $total_msg1 ; $i++) { 
		 	$row1 = mysqli_fetch_array($res1);
		 	// get the time of 
		 	$tm1 = $tm1.':'.$row1['time'];
			$message1 = $message1.':'.$row1['message'];
			$attachment1 = $attachment1.':'.$row1['attachment_status'];
		 }
		
		//split the data in each varaible abobe into array, using the limiter ":" and "***" as entered previously
		 if ($total_msg != 0) { // to avoid error while no message in query 1 db check if message is not = 0

		 	$tm_arr = explode(":", $tm);  // sender message delivery time in array
			$message_arr = explode(":", $message);   //sender message  in array
			$attachment_arr = explode(":", $attachment); // sender attachment if any in array

		 }
		 //split the data in each varaible abobe into array, using the limiter ":" and "***" as entered previously
		 if ($total_msg1 != 0) { // to avoid error while no message in query 2 db check if message is not = 0
		 	$tm1_arr = explode(":", $tm1); //reciever message delivery time in array
			$message1_arr = explode(":", $message1);  //reciever message  in array
			$attachment1_arr = explode(":", $attachment1);  // reciever attachment if any in array

		 }
		
		
		$k = 1; $n = 1; // $k is sender message counter $n reciever message counter
		for ($i=1; $i <= $total ; $i++) { 
			//check for the message time and display the message accordingly
			if ($total_msg != 0 AND $total_msg1 != 0 ) { 
			//if reciever message is newer display sender message first
				if ( $n < $total_msg+1  &&  $k < $total_msg1+1  && $tm1_arr[$k] > $tm_arr[$n]) {
					sender($attachment_arr[$n], $message_arr[$n], $sender_id, $tm_arr[$n]);
				    $n = $n + 1;
				}
			//if sender message is newer display reciever message first
				else if ( $k < $total_msg1+1 && $n < $total_msg+1 && $tm_arr[$n] > $tm1_arr[$k] )
				{
					reciever($attachment1_arr[$k], $message1_arr[$k], $reciever_id, $tm1_arr[$k]);
					$k = $k + 1;
				}

				//if sender message is older display the sender menssage
				else if ( $total_msg < $n && $total_msg1 < $k+1 && $tm1_arr[$k] > $tm_arr[$n-1] )  
				{
					reciever($attachment1_arr[$k], $message1_arr[$k], $reciever_id, $tm_arr[$k]);
					$k = $k + 1;
					
				}
				//if sender message is older display the sender menssage
				else if ($total_msg1 < $k && $n < $total_msg+1 && $tm_arr[$n] > $tm1_arr[$k-1]) 
				{
					sender($attachment_arr[$n], $message_arr[$n], $sender_id, $tm_arr[$n]);
				    $n = $n + 1;
				}
				
			}
			// if one query return zero message
			else if($total_msg != 0 AND $total_msg1 == 0 )
			{
				sender($attachment_arr[$n], $message_arr[$n], $sender_id, $tm_arr[$n]);
				$n++;
			}
			else if($total_msg == 0 AND $total_msg1 != 0 )
			{
				reciever($attachment1_arr[$k], $message1_arr[$k], $reciever_id, $tm1_arr[$k]);
				$k++;
			}

	}

	//$msg_arr = explode(":", $message);
		
		
	
function sender($attachment, $message, $sender_id, $time)
{


	if($attachment == 0){
	 $message = retMsg($message, 0, $sender_id, $time);
	  echo "$message"; 
	}
	  else{
	   $message = retMsg($message, 1, $sender_id, $time); 
	   echo "$message"; 
	}
}

function reciever($attachment1, $message1, $reciever_id, $time)
{
	if($attachment1 == 0){
	 $message1 = retMsg($message1, 0, $reciever_id, $time);
	  echo "$message1";
	   }
	   else{ 
	   	$message1 = retMsg($message1, 1, $reciever_id, $time);
	   	 echo "$message1";
	   	  } 
}




function retMsg($msg, $attachment = 0, $id, $time)
{

	GLOBAL $con; GLOBAL $sender_id;
		$sql = "SELECT * FROM wp_uusers WHERE id='$id'";
		//send the query 1
		$res = mysqli_query($con, $sql);

		$row = mysqli_fetch_array($res);

		$picture = $row['picture'];
		$username = $row['username'];


	if ($attachment == 0) {

			
					if ($id == $sender_id) {

						// $msg = ' <div class="message-line reply" style"background:#99dd8a80; display: flex; align-items:center; margin: 0px; padding: 5px; border-radius:10px 10px 0px 10px; border: 1px solid #eee; float:right;">
						// <span>
						// <img src="data:image/jpg;base64,'.base64_encode($picture).'"alt="pic" style="width:40px; height:40px; border-radius:50%;"/>
						// '.$msg.'</span>
						// </div>';

						$msg = '
						<div style=" background-color:#99ddfa80;  display: block; margin: 1px; padding: 5px; align-items:center; border-radius:10px 10px 0px 10px; border: 1px solid #eee; right:0; margin-left:40%; max-width: 50%;">  
								<a href="#" style="color: #000; text-decoration: none; text-align:right;">									
								<img src="data:image/jpg;base64,'.base64_encode($picture).'"alt="pic" style="width: 20px; height:20px; border-radius:50%; vertical-align: middle; float: right"/> 

								<div><i>'.$msg.'</i></div>

						</div>';
					}
					else
					{
						$msg = '
						<div style=" background-color:#99ddfa80;  display: block; margin: 15px; padding: 5px; align-items:center; border-radius:10px 10px 0px 10px; border: 1px solid #eee; left:0; margin-right:40%; max-width: 50%;">  
								<a href="#" style="color: #000; text-decoration: none; text-align:left; padding:20px">									
								<img src="data:image/jpg;base64,'.base64_encode($picture).'"alt="pic" style="width: 20px; height:20px; border-radius:50%; vertical-align: middle; float: left"/> 

								<div><i >'.$msg.'</i></div>

						</div>';
					}
	}

	else if($attachment == 1 )
	{

		$sql = "SELECT * FROM wp_uuploadfiles WHERE user_id = '$id' and time='$time'";
		//send the query 1
		$res = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($res);

		 $msg = ' <div class="message-line reply" style"background-color:#99dd8a80; display: flex; align-items:center; margin: 0px; padding: 5px; border-radius:10px 10px 0px 10px; border: 1px solid #eee;">
					<span>
					<img src="data:image/jpg;base64,'.base64_encode($picture).'"alt="pic" style="width:40px; height:40px; border-radius:50%;"/>
					</span>'.$msg.'
					</div>';
	
	}
	else
	{
	}
	return $msg;
}

		

?>