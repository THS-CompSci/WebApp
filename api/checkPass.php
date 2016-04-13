<?php
include "config.php";
#No longer used
//$servername = "localhost";
//$database = "dhp";

$student = mysqli_real_escape_string($_POST["STUDENTID"]); #Make this equal 1st input

/*$conn = mysqli_connect($servername,"root","");
if (!$conn) {
    die(json_encode("connection error"));
}
mysqli_select_db($conn,'dhp');*/


$date=date("y-m-d");
$time=date("h:i:sa");
//echo $date." ".$time;

$sql = "SELECT `dest`,`teacherName` FROM ".$passDB." WHERE studentID = '".$student."' AND date > '20".$date." ".$time."'";
$ret=createQuery($sql);
$row=mysqli_fetch_array($ret,MYSQLI_ASSOC);

if($row==null){
    echo "no pass";
}
else{
    echo "Destination: ".json_encode($row['dest'])."\nTeacher:".json_encode($row['teacherName']);
}

//mysqli_close($conn);

?>
