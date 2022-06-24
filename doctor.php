<?php
$date=date("m-d-Y");
//die();
$ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://app.salestrip.in/api/klm/doctor?dateStamp=$date");
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
	//echo "https://app.salestrip.in/api/klm/doctor?dateStamp=$date";
//die();
   // exit('hazaa');
   
$servername = "localhost";
$username = "root";
$password = "";
$db="klm";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);
foreach($result as $emp){
//	echo"<pre>";
//   print_r($emp); // data should be here
//	echo"</pre>";
    $sql="SELECT doctor_id FROM doctors WHERE doctor_id=".$emp['doctor_id'];
    $res=$conn->query($sql);
    if( $res->num_rows>0){
        echo "NOT";
    }
    else{
        $ins='INSERT INTO `doctors`( `doctor_id`, `name`, `type`, `doctor_code`, `headquarter`, `route`,  `kyc`, `user_kyc`,  `entry_date`, `update_date`, `delete_date`, `status`)
          VALUES ("'.$emp['doctor_id'].'","'.$emp['name'].'","'.$emp['speciality'].'","'.$emp['code'].'","'.$emp['headquarters'].'","'.$emp['route_name'].'","0","0","'.$emp['entry_date'].'","'.$emp['update_date'].'","'.$emp['delete_date'].'","'.$emp['is_active'].'")';
        $res1=$conn->query($ins);
        if($res)
        {
            echo "Inserted";
        }
        else{
            echo "NOT";
        }
    }
	//die();
}
// Check connection

$conn->close();
?> 
