<body>
	<a href="loadfiles.php">View Files</a>
	<br/>
	<a href='index.html'>Back</a>
	<br/>
</body>

<?php
	/*
	$maxSize = 100;
	$minSize = 1;

	$file = $_FILES["file"]["name"];
	$ext = pathinfo($file, PATHINFO_EXTENSION);

	if ($ext == 'php') {
		print('File type not allowed!');
	}
	else if ($_FILES['file']['size'] > $maxSize || $_FILES['file']['size'] < $minSize) {
		print('File size exceeds limit!');
	}
	else {
	*/
		$localhost = "localhost";
		$username = "root";
		$password = "theroot123";
		$dbname = "progesh";
		
		$conn = mysqli_connect($localhost,$username,$password,$dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$tmp = $_FILES["file"]["tmp_name"];
		$title = $_FILES["file"]["name"];

		$path = "./" . basename($title);
		//$path = "uploads/" . basename($title);

		move_uploaded_file($tmp,$path);
		$contents = file_get_contents($path);
		$sql = "insert into files (file,title,path) values ('$contents','$title','$path')";

		if ($conn->query($sql) === TRUE) {
			   print("Upload successful");
		}
		else {
			   print("Error " . $sql . "<br>" . $conn->error);
		}
	//}
?>
