<body>
	<a href='index.html'>Back</a>
	<br/>
</body>
<?php
	$localhost = "localhost";
	$username = "root";
	$password = "theroot123";
	$dbname = "progesh";
	
	$conn = mysqli_connect($localhost,$username,$password,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = $conn->prepare("select * from files");
	$sql->execute();
	$res = $sql->get_result();
	
	print("<h1>Uploaded Database Files");
	print("<table border = \"1\">");
	print("<tr><th>File Name</th></tr>");

	while($row = $res->fetch_assoc()) {
		print("<tr><td><a href='download.php?path=uploads/" . $row['title'] . "'>" . $row['title'] . "</a></td></tr>");
	}
	print("</table>");
?>
