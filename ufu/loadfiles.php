<body>
	<a href='index.html'>Back</a>
	<br/>
</body>
<?php
	$localhost = "localhost";
	$username = "";
	$password = "";
	$dbname = "progesh";
	
	$conn = mysqli_connect($localhost,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = $conn->prepare("select * from files");
	$sql->execute();
	$res = $sql->get_result();

	print("<table>");
	while($row = $res->fetch_assoc()) {
		print("<tr><td><a href='download.php?path=uploads/" . $row['title'] . "'>" . $row['title'] . "</a></td></tr>");
	}
?>
