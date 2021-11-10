<?php
ob_start();
session_start();
require_once('./header.php');

?>
<!DOCTYPE html>
<html>
<head>
<title> </title>
<style> 
  body  {
    background-image: url("paper.gif");
    background-color: #cccccc;
	text-align: center;
}
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
  
</style>
</head>
<body  align="center">
<h3><a href = "addBook.php">HOME</a></h3>
<div  align="center">
<?php

	if (isset($_SESSION['user']))
{
		echo $_SESSION['user'] . "  is logged in";
}
else
{
		header("location: login.php");
}


$found = mysqli_real_escape_string($connection, $_SESSION['match'] );     

$sqlSearch = "SELECT * FROM book WHERE lower(title) LIKE lower('%".$found."%')"; 
$sqlSearch .=" order BY  rating  DESC ";
$result = mysqli_query($connection,$sqlSearch);		
 
 
	 
	 
	 
if (mysqli_num_rows($result)) 
{
   	
			
				
					echo "<table> ";
					echo "<caption>		Search Results 		</caption>";
					echo "<tr>";		
					echo "<th>		 Title 		</th>";
					echo "<th> 		 Author 	</th>";
					echo "<th> 		 Date 	</th>";
					echo "<th> 		 Details 	</th>";		
					echo "</tr>";
					
	while ($row = mysqli_fetch_assoc($result))
	{			
					$bookID = $row['bookID'];	
					echo "<tr>";
					
					echo "<td>".$row["title"]."</td>";
					echo "<td>".$row["author"]."</td>";		
					echo "<td>".$row["publishDate"]."</td>";	
					
					echo '<td><a href="viewDetails.php?id=' . $bookID  .' ">Details</a></td>';	
					
					echo "</tr>";
		
		
	}
					echo "</table>";
					
	
	  
    
  }
   else
     { 
       echo "<h1>There are no matching records</h1>";  
	   
	   
     }

	 
	 echo "<br>";
	 
	

?>


	
	<pre>
<a href = "index.php">Home</a>		<a href = "menu.php">Menu</a>		<a href = "logoff.php">logoff</a>	
</pre>
</div > 
</body>
</html>

<?php 
	require_once('footer.php');
?>
