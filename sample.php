<?php
$date=date("m-d-Y");
//die();

	//echo "https://app.salestrip.in/api/klm/doctor?dateStamp=$date";
//die();
   // exit('hazaa');
   
$servername = "localhost";
$username = "root";
$password = "";
$db="klm";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);
$sql="SELECT * FROM samplerecord WHERE status=0";
// Check connection

$conn->close();
?> 
