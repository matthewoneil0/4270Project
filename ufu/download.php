<?php
	$path = $_GET['path'];
	if (file_exists($path)) {
			$size = filesize($path);
			$info = pathinfo($path);
			$ext = strtolower($info["extension"]);
			switch ($ext) {
				case "pdf": $ctype="application/pdf"; break;
				case "doc": $ctype="application/msword"; break;
				case "docx": $ctype="application/msword"; break;
				default: $ctype="application/force-download";
			}
			header("Content-Type: $ctype");
			header("Content-Disposition: attachment; filename=\"".basename($path)."\";");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".$size);
			ob_clean();
			flush();
			readfile($path);
	}
	else {
		die("File not found");
	}
?>
