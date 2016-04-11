<?php
include "config.php";

$username = mysqli_real_escape_string($_POST["ID"]);

$sql="SELECT `first`,`last` FROM ".$userDB." WHERE username ='".$username."'";
$ret = createQuery($sql);
$row = $ret->fetch_assoc();
$name = $row['first']." ".$row['last'];

echo json_encode($name);

?>
