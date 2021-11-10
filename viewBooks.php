<?php
ob_start();
session_start();
require_once('./header.php');
require_once('./lib.php');
	
	if (isset($_SESSION['user']))
{
		echo $_SESSION['user'] . "  is logged in";
}
else
{
		header("location: login.php");
}

	// 2. Perform database query
	$query = "SELECT * FROM book  "; 
	$result = mysqli_query($connection, $query);

?>
<!DOCTYPE html>
<html>
<head>
<title> </title>
 <style>
 
 table, td, th {
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 15px;
}

body  {
    background-image: url("paper.gif");
    background-color: #cccccc;
	text-align: center;
 </style> 
</head>
<body >
		<a href = "addBook.php">HOME</a> 
    <?php						
				    echo "<br>";
					echo "<table  > ";
					echo "<caption> Book Information </caption>";
					echo "<tr>";
					echo "<th> Book Title </th>";
					echo "<th> Book Author </th>";
					echo "<th> Publish Date </th>";
					echo "<th> View Book Details </th>";
					echo "</tr>";
	
	 if (mysqli_num_rows($result) > 0)
	{
	while ($row = mysqli_fetch_array($result))

	{			
					$book_id = $row['bookID'];	
					echo "<tr>";
					echo "<td>".$row["title"]."</td>";
					echo "<td>".$row["author"]."</td>";
					echo "<td>".$row["publishDate"]."</td>";	
					echo '<td><a href="viewDetails.php?id=' . $book_id  .' ">details</a></td>';
					echo "</tr>";
		
	}			
	 }				echo "</table>";
						
   ?>  

  <?php 
	//4. Release returned data
	mysqli_free_result($result);
   ?>  
   
  <pre>
<a href = "index.php">Home</a>		<a href = "menu.php">Menu</a>		<a href = "logoff.php">logoff</a>	
</pre>
</div > 
</body>
</html>

<?php 
	//5. close database connection
	mysqli_close($connection);
?>