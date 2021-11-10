<?php
ob_start();
session_start();
require_once('header.php');

?>	

<html>
<head>
<title>A2</title>      
<style>   
  body  {
    background-image: url("paper.gif");
    background-color: #cccccc;
	text-align: center;
}
</style>     
</head>
<body>    
<div align = "center">  
<h2>Menu Page</h2><br>
<pre>
<h2><a href = "addBook.php">Add a Book</a> <a href = "viewBooks.php">View Books</a></h2>	 
</pre>
<br>
<h2>SEARCH FOR A BOOK</h2>
<br>
<form action="menu.php" method="post"> 
<input type="text" name="search" />
<input type="submit" value="search" /> <br /> 
</form> 
<br><br>
<pre><h2><a href = "index.php">HOME</a> <a href = "logoff.php">Logoff</a></h2>	 </pre>
</body>
</div>
</html>

<?php
	
	
	if (isset($_SESSION['user']))
{
		echo $_SESSION['user'] . "  is logged in";
}
else
{
		header("location: login.php");
}


if ($_POST) 
{

$search = mysqli_real_escape_string($connection, sanitize($_POST['search']));     
$query = "SELECT * FROM book where lower(title) LIKE lower('%".$search."%')"; 
$match = mysqli_query($connection,$query);		

if ($match) 
{
  $_SESSION['match'] = $_POST['search'];
 header("Location: search.php");	
		
 }

	 
}		
 ob_end_flush();
 require_once('footer.php');	
	?>