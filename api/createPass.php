<?php
include "config.php";

#No longer used here
//$servername = "localhost";
//$database = "dhp";
#username and password being used
$student = mysqli_real_escape_string($_POST["STUDENTID"]);
$teacher = mysqli_real_escape_string($_POST["TEACHERID"]);
$destination = mysqli_real_escape_string($_POST["DESTINATION"]);
$time = mysqli_real_escape_string($_POST["TIMEOFPASS"]);
$date = mysqli_real_escape_string($_POST["DATEOFPASS"]);

$datetime = $date." ".$time;
#EX:"2016-2-24 1:16:00";

/*$conn = mysqli_connect($servername,"root","");
if (!$conn) {
    die("connection error");
}
mysqli_select_db($conn,'dhp');
*/

$checkstudent = "SELECT `user_type` FROM ".$userDB." WHERE username = '".$student."'";
$ret = createQuery($checkstudent);
$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
if($row['user_type']!='student'){
    die("Invalid student ID :".$student);
}

$checkteacher = "SELECT `user_type` FROM ".$userDB." WHERE username = '".$teacher."'";
$ret = createQuery($checkteacher);
$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
if($row['user_type']!='teacher'){
    die("Invalid teacher ID :".$teacher);
}



$sql = "INSERT INTO ".$passDB." (`student_id`,`teacher_id`,`destination`,`date`)
        VALUES ('".$student."','".$teacher."','".$destination."','".$datetime."')";


//mysqli_query($conn,$sql);
createQuery($sql);

//mysqli_close($conn);

?>
