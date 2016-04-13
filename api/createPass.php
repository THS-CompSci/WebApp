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

$checkstudent = "SELECT isTeacher FROM ".$userDB." WHERE ID = '".$student."'";
$ret = createQuery($checkstudent);
$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
if($row['isTeacher']!='student'){
    die("Invalid student ID :".$student);
}

$checkteacher = "SELECT isTeacher FROM ".$userDB." WHERE ID = '".$teacher."'";
$ret = createQuery($checkteacher);
$row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
if($row['isTeacher']!='teacher'){
    die("Invalid teacher ID :".$teacher);
}



$sql = "INSERT INTO ".$passDB." (`ID`,`teacherName`,`dest`,`date`,`time`)
        VALUES ('".$student."','".$teacher."','".$destination."','".$date."','".$time."')";


//mysqli_query($conn,$sql);
createQuery($sql);

//mysqli_close($conn);

?>
