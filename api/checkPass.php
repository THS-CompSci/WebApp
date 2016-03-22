<?php
$servername = "localhost";
$database = "dhp";
$passdb = 'passes';

$student = mysqli_real_escape_string($_POST["STUDENTID"]); #Make this equal 1st input

$conn = mysqli_connect($servername,"root","");
if (!$conn) {
    die(json_encode("connection error"));
}
mysqli_select_db($conn,'dhp');
$date=date("y-m-d");
$time=date("h:i:sa");

$sql = "SELECT `destination`,`teacher_id` FROM ".$passdb." WHERE student_id = '".$student."' AND date > '20".$date." ".$time."'";
$ret=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($ret,MYSQLI_ASSOC);

if($row==null){
    echo "no pass";
}
else{
    echo "Destination: ".json_encode($row['destination'])."\nTeacher:".json_encode($row['teacher_id']);
}

mysqli_close($conn);
?>
