<?php
include "config.php";


#No longer used
//$servername = "localhost";
//$database = "dhp";
#values being implemented
$username = mysqli_real_escape_string($_POST["USERNAME"]);
$password = mysqli_real_escape_string($_POST["PASSWORD"]);
//$first = mysqli_real_escape_string($_POST["FIRSTNAME"]);;
//$last = mysqli_real_escape_string($_POST["LASTNAME"]);
$name = $_POST["NAME"];
$userType = mysqli_real_escape_string($_POST["USERTYPE"]);
$notes = mysqli_real_escape_string($_POST["NOTES"]);

#Check Connection OUTDATED
/*$conn = mysqli_connect($servername,"root","");
if (!$conn) {
    die("connection error");
}
*/

$sql ="INSERT INTO ".$userDB." (`ID`,`password`,`name`,`teacher`)
       VALUES ('".$username."','".$password."','".$name."','".$userType."')";

//mysqli_select_db($conn,'dhp');
//mysqli_query(  $conn,$sql );
createQuery($sql);

echo json_encode(true);

//mysqli_close($conn);
?>
