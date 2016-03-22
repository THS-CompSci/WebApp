<?php
$servername = "localhost";
$database = "dhp";
$userdb = 'users';
$passdb = 'passes';

$student = mysqli_real_escape_string($_POST["STUDENTID"]); #Make this equal 1st input

$conn = mysqli_connect($servername,"root","");
if (!$conn) {
    die(json_encode("connection error"));
}
mysqli_select_db($conn,'dhp');

$date=date("y-m-d");
$time=date("h:i:sa");

$sql = "SELECT `destination`,`teacher_id`, `date`  FROM ".$passdb." WHERE student_id = '".$student."'";
$ret=mysqli_query($conn,$sql);

$i=0;
while($row=$ret->fetch_assoc()){
    $array[$i]['destination'] = $row['destination'];
    $array[$i]['date'] = $row['date'];
    
    $sql="SELECT `first`,`last` FROM ".$userdb." WHERE username ='".$row['teacher_id']."'";
    $ret2=mysqli_query($conn,$sql);
    $row2=mysqli_fetch_array($ret2,MYSQLI_ASSOC);
    $array[$i]['teacher'] = $row2['first']." ".$row2['last'];
    $i++;
}

echo json_encode($array);
mysqli_close($conn);
?>
