<?php
include "config.php";

$username = mysqli_real_escape_string($_POST["ID"]);

$sql="SELECT `name` FROM ".$userDB." WHERE ID ='".$username."'";
$ret = createQuery($sql);
$row = $ret->fetch_assoc();
$name = $row['name'];

echo json_encode($name);

?>
