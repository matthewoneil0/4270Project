<!DOCTYPE html>
<html>
<head>
	<title>File Search</title>
</head>
<body>
	<h1>Welcome to Database File Lookup!</h1>
	<?php
        $input = $_POST['file_name'];
        if($input != NULL){
            print("<p>Searching for: ".$input."</p>");
            
            // Create connection
            $localhost = "localhost";
            $username = "root";
            $password = "theroot123";
            $dbname = "progesh";
            
            $conn = new mysqli($localhost, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            //"select \"".$input."\" from files";
            //$sql = "select * from files where title = \"".$input."\"";
            //"select * from files where title = '".$input."'";
            $sql = "SELECT * FROM files WHERE title = '$input'";
            $result = mysqli_query($conn, $sql);

            //Check for results, if found, print
            if (mysqli_num_rows($result) > 0){
                $result_array = array();
                while($row = mysqli_fetch_assoc($result)){
                    $result_array[] = $row;
                }
                $sql_prep = $conn->prepare($sql);
                $sql_prep->execute();
                $res = $sql_prep->get_result();
                
                
                print("<table border = \"1\">");
                print("<tr><th>File Name</th></tr>");

                while($row = $res->fetch_assoc()) {
                    print("<tr><td>" . $row['title'] . "</td></tr>");
                }
                print("</table>");
                $num_results = mysqli_num_rows($result);
                print("<p>Match found!</p>");
                print("<p>There are ".$num_results." matches for this file in the database.</p>");
            }
            else{
                print("<p>No match found</p>");
            }
            print("sql statement: ".$sql."\n");
            mysqli_close($conn);
        }
	?>
	<form method = "post" action = "search.php">
        <p>File name: 
            <input type = "text" name = "file_name" size=1500>
        </p>
        <p>
		<input type = "submit" value = "Search Again"> 
		<input type = "reset"  value = "Clear">
        </p>
	</form>
</body>
</html>