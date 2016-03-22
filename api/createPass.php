<?php
$servername = "localhost";
$database = "dhp";
$userdb = 'users';
$passdb = 'passes'; 

$student = mysqli_real_escape_string($_POST["STUDENTID"]);
$teacher = mysqli_real_escape_string($_POST["TEACHERID"]);
$destination = mysqli_real_escape_string($_POST["DESTINATION"]);
$time = mysqli_real_escape_string($_POST["TIMEOFPASS"]);
$date = mysqli_real_escape_string($_POST["DATEOFPASS"]);

$datetime = $date." ".$time;
#EX:"2016-2-24 1:16:00";

$conn = mysqli_connect($servername,"root","");
if (!$conn) {
    die("connection error");
}
mysqli_select_db($conn,'dhp');

$checkstudent = "SELECT `user_type` FROM ".$userdb." WHERE username = '".$student."'";
$ret = mysqli_query($conn,$checkstudent);
$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
if($row['user_type']!='student'){
    die("Invalid student ID :".$student);
}

$checkteacher = "SELECT `user_type` FROM ".$userdb." WHERE username = '".$teacher."'";
$ret = mysqli_query($conn,$checkstudent);
$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
if($row['user_type']!='teacher'){
    die("Invalid teacher ID :".$teacher);
}

$sql = "INSERT INTO ".$passdb." (`student_id`,`teacher_id`,`destination`,`date`)
        VALUES ('".$student."','".$teacher."','".$destination."','".$datetime."')";
        
mysqli_query($conn,$sql);
mysqli_close($conn);
?>
