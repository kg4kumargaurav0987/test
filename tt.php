 <?php
$servername = "localhost";
$username = "root";
$password = "";
$db='klm';

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$sql = "SELECT *, GROUP_CONCAT(mr_id SEPARATOR ',') AS grouped_ids FROM doc_mr_relation GROUP BY `doctor_id`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  $gp=$row['grouped_ids'];
	  $sql1 = "UPDATE doctors SET linked_employee='$gp' WHERE doctor_id=".$row['doctor_id'];
	  if ($conn->query($sql1) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
} 
}
} else {
  echo "0 results";
}
 
//$conn->close();
?> 