<?php
	$server = "localhost";
	$username = "root";
	$password = "thscompsci";
	$database = "DHP";

	$connect = new mysqli($server,$username,$password,$database) or die("Failed to connect to the server");
	$sql = "SELECT * FROM passes WHERE studentName = '$_GET[student_name]'";
	$result = mysqli_query($connect,$sql);

	if (!$result){
		die ("The SQL command was not processed correctly");
	}
	else if (mysqli_num_rows($result) == 0){
		die ("No results were found");
	}
	else{
		while($row = mysqli_fetch_array($result)){
			echo json_encode($row);
		}
	}

	mysqli_close($connect);
?>
