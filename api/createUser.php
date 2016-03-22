<?php
$servername = "localhost";
$database = "dhp";
$userdb = 'users';

$username = mysqli_real_escape_string($_POST["USERNAME"]);
$password = mysqli_real_escape_string($_POST["PASSWORD"]);
$first = mysqli_real_escape_string($_POST["FIRSTNAME"]);;
$last = mysqli_real_escape_string($_POST["LASTNAME"]);
$userType = mysqli_real_escape_string($_POST["USERTYPE"]);
$notes = mysqli_real_escape_string($_POST["NOTES"]);

#Check Connection
$conn = mysqli_connect($servername,"root","");
if (!$conn) {
    die("connection error");
}

$sql = "INSERT INTO ".$userdb." (`username`,`password`,`first`,`last`,`user_type`,`notes`)
        VALUES ('".$username."','".$password."','".$first."','".$last."','".$userType."','".$notes."')";
        
mysqli_select_db($conn,'dhp');
mysqli_query(  $conn,$sql );

echo json_encode(true);
mysqli_close($conn);
?>
