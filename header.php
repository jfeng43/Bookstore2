<html>
<head>
<title>A2</title>      
</head>
<body>    
<div align = "center">   
<h1>JIAJIE'S Bookstore</h1>
</body>
</div>
</html>

<?php

$lines=file('../secret/topsecret.txt');
$dbhost=trim($lines[0]);
$dbuser=trim($lines[1]);
$dbpass=trim($lines[2]);
$dbname=trim($lines[3]);
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Failed to connect to MySQL: " . mysql_error());

    	
		//sanitization function
		
function sanitize($input) 
{ 	
$input = htmlspecialchars($input);		
$input = trim($input);			
$input = stripslashes($input);		
			
return $input;		
}
	


?>