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
$sql = "SELECT `user_type` FROM ".$userDB." WHERE username = '".$student."'";
$teacher=createQuery($sql);
$row = $teacher->fetch_assoc();
$isTeacher = $row['user_type']=="student";

if($isTeacher) {
    $sql = "SELECT `destination`,`teacher_id`, `date`  FROM ".$passDB." WHERE student_id = '" . $student . "'";
}
else {
    $sql = "SELECT `destination`,`student_id`, `date`  FROM ".$passDB." WHERE teacher_id = '" . $student . "'";
}
$ret=createQuery($sql);
//$row=mysqli_fetch_array($ret,MYSQLI_ASSOC);

$i=0;
while($row=$ret->fetch_assoc()){
    //echo $row['date'];
    //echo json_encode($ret->fetch_fields());
    $array[$i]['destination'] = $row['destination'];
    $array[$i]['date'] = $row['date'];

    if(!$isTeacher){
        $sql="SELECT `first`,`last` FROM ".$userDB." WHERE username ='".$row['student_id']."'";
    }
    else{
        $sql="SELECT `first`,`last` FROM ".$userDB." WHERE username ='".$row['teacher_id']."'";
    }
    $ret2=createQuery($sql);
    $row2=mysqli_fetch_array($ret2,MYSQLI_ASSOC);
    if($isTeacher){
        $array[$i]['teacher'] = $row2['first']." ".$row2['last'];
    }
    else{
        $array[$i]['student'] = $row2['first']." ".$row2['last'];
    }
    $i++;
}

echo json_encode($array);

//mysqli_close($conn);

?>