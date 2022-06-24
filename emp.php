<?php
$date=date("m-d-Y");
$ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://app.salestrip.in/api/klm/employee?dateStamp=$date");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
  curl_setopt($ch, CURLOPT_POST, true);
 // curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  


  $headers = array();
  $headers[] = "Content-Type: application/json";
  $headers[]='Authorization:Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJzdXBlciIsImVtcElkIjoiMSIsImZ1bGxOYW1lIjoiU3VwZXIgVXNlciAoc3VwZXIpIiwiY29tcENvZGUiOiJLTE0iLCJpbmR1c3RyeVR5cGUiOiJQSEFSTUEiLCJyb2xlVHlwZSI6IkFEIiwicGFyZW50VXNlcklkIjoiMCIsImNvbXBhbnlOYW1lIjoiS0xNIExhYm9yYXRvcmllcyBQdnQuIEx0ZC4iLCJzdGF0ZUlkIjoiMSIsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6NTM2NDciLCJhdWQiOiI0MTRlMTkyN2EzODg0ZjY4YWJjNzlmNzI4MzgzN2ZkMSIsImV4cCI6MTk5Mjk1NDY3NCwibmJmIjoxNjQ3MzU0Njc0fQ.vS0LKrkaRo7aBmET5I66tdJTfaZDTZUd4HKv-qAgR-k';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  $result = json_decode(curl_exec($ch), TRUE);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close ($ch);
	
   // exit('hazaa');
   
$servername = "localhost";
$username = "root";
$password = "";
$db="klm";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);
foreach($result as $emp){
	//echo"<pre>";
   // print_r($emp); // data should be here
	//echo"</pre>";
	if($emp['status']=='N')
	{
		$sql="UPDATE users SET status='0' WHERE empcode=".$emp['mr_id'];
		$conn->query($sql);
	}
	elseif($emp['status']=='Y'){
		$sql="SELECT id FROM users WHERE empcode=".$emp['mr_id'];
		$res=$conn->query($sql);
		if ($res->num_rows > 0) {
			$sl='UPDATE `users` SET `name`="'.$emp['name'].'",`email`="'.$emp['email'].'",`mobile`="'.$emp['mobile'].'",`hqname`="'.$emp['headquarters'].'",`division`="'.$emp['division_name'].'",`updated_at`=NOW(),`entry_date`="'.$emp['entry_date'].'",`update_date`="'.$emp['update_date'].'",`delete_date`="'.$emp['delete_date'].'" WHERE empcode='.$emp['mr_id'];
			$conn->query($sl);
			
		}
		else{
			$sl='INSERT INTO `users`( `empcode`, `name`, `email`, `password`, `mobile`, `hqname`, `division`, `reportmngr`, `created_at`, `status`, `role`, `entry_date`, `update_date`, `delete_date`) VALUES ("'.$emp['mr_id'].'","'.$emp['name'].'","'.$emp['email'].'","$2y$10$40lQm5lnWgtElBwnko7ASuUr.Obu2CI.hPecZ8ZciGsYKkXw2Kf3.","'.$emp['mobile'].'","'.$emp['headquarters'].'","'.$emp['division_name'].'","'.$emp['supervisor_id'].'",NOW(),"1","'.$emp['hierarchy'].'","'.$emp['entry_date'].'","'.$emp['update_date'].'","'.$emp['delete_date'].'")';
			$conn->query($sl);
		}
	}
	
}
// Check connection

$conn->close();
?> 
