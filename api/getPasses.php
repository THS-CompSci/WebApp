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
$sql = "SELECT `teacher` FROM ".$userDB." WHERE ID = '".$student."'";
$teacher=createQuery($sql);
$row = $teacher->fetch_assoc();
$isTeacher = $row['teacher']==false;

if($isTeacher) {
    $sql = "SELECT `dest`,`teacherName`, `date`  FROM ".$passDB." WHERE ID = '" . $student . "'";
}
else {
    $sql = "SELECT `dest`,`ID`, `date`  FROM ".$passDB." WHERE teacherName = '" . $student . "'";
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
        $sql="SELECT `name` FROM ".$userDB." WHERE ID ='".$row['student_id']."'";
    }
    else{
        $sql="SELECT `name` FROM ".$userDB." WHERE ID ='".$row['teacher_id']."'";
    }
    $ret2=createQuery($sql);
    $row2=mysqli_fetch_array($ret2,MYSQLI_ASSOC);
    if($isTeacher){
        $array[$i]['teacher'] = $row2['name'];
    }
    else{
        $array[$i]['student'] = $row2['name'];
    }
    $i++;
}

echo json_encode($array);

//mysqli_close($conn);

?>
