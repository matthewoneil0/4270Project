<!DOCTYPE html>
<html>
<head>
	<title>File Search</title>
</head>
<body>
	<h1>Welcome to Database File Lookup!</h1>
	<?php
        require("../config/helper.php");
        $input = $_POST['file_name'];
        if($input){
            $input = validate_input($input);
            print("<p>Searching for: ".$input."</p>");
            
            // Create connection
            $localhost = "localhost";
            $username = "root";
            $password = "theroot123";
            $dbname = "progesh";
            
            $conn = mysqli_connect($localhost, $username, $password, $dbname);
            if (!$conn) {
                die("Connection failed: " . $conn->connect_error);
            }
            else{
                $sql = "SELECT * FROM files WHERE file_id = $input";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $fields_num = mysqli_num_fields($result);
                    print("<table border='1'><tr>");
                    for($i=0; $i<$fields_num; $i++)
                    {
                        $field = mysqli_fetch_field($result);
                        print("<td>".($field->name)."</td>");
                    } 
                    print("</tr>");
                    while($row = $result->fetch_assoc()) {
                        
                        print("<tr>");
                        foreach($row as $cell)
                            print("<td>".$cell."</td>");
                        
                        print("</tr>\n");
                    }	

                }
                else{
                    print("<p>No results found with query $sql</p>");
                }
            }
        }
        mysqli_close($conn);
    
	?>
	<form method = "post" action = "search.php">
        <p>File id:
            <input type = "text" name = "file_name" size=1500>
        </p>
        <p>
		<input type = "submit" value = "Search Again"> 
		<input type = "reset"  value = "Clear">
        </p>
	</form>
</body>
</html>