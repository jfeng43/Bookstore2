<?php
ob_start();
session_start();
require_once('header.php');
 	
	if (isset($_SESSION['user']))
{
		echo $_SESSION['user'] . "  is logged in";
}
else
{
		header("location: login.php");
}

	  
?>


<!DOCTYPE html>
<html>
<head>
  <title></title> 
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
<body>
 
  <div align="center">
 
    <?php
	
					if (!$connection)
	{
		die("Database connection failed: ".
			mysqli_connect_error().
			" ( ". mysqli_connect_errno(). " )"
		);
	} 
	else
	{		
	
	// 2. Perform database query     		  
	$id = $_GET['id'];
	$result = mysqli_query($connection,"SELECT * FROM book WHERE bookID = $id");

	
	
	
						//3. Process with query result if any	
						$row = mysqli_fetch_assoc($result);
						echo "<br><br>";
						echo "<table  > ";						
						echo "<caption> Book Information </caption>";
						echo "<tr>";
						echo "<th>BookId:</th>" ;
						echo "<th>Title: </th>";					
						echo "<th>Author: </th>";					
						echo "<th>Publish Date:</th>";					
						echo "<th>ISBN: </th>";			
						echo "<th>Category: </th>";	
						echo "<th>Price($): </th>";
						echo "<th>Status: </th>";
						echo "<th>Rating: </th>";
						echo "<th>note: </th>";
						echo "</tr>";
					
																
						echo "<tr>";
						echo "<td>" . $row["bookID"] . "</td>" ;
						echo "<td> " .  $row["title"] ."</td>";					
						echo "<td> " . $row["author"] ."</td>";					
						echo "<td> " . $row["publishDate"]. "</td>";					
						echo "<td> " . $row["isbn"]. "</td>";			
						echo "<td> " . $row["category"]. "</td>";	
						echo "<td> " . $row["price"] ."</td>";
						echo "<td> " . $row["status"]. "</td>";
						echo "<td> " . $row["rating"] ."</td>";
						echo "<td>" . $row["note"] .   "</td>";
						echo "</tr>";
						
						echo "</table  > ";	
						
						
	}
 ?>
  <form  method ="post"  action = ""> 
  	Rating:<select name="rating">
			<option value="NA">N/A</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option></select><br>  
<input type="submit" name= "" value ="submit"> 
	</form>
 <pre> <h2> <a href = "index.php">Home</a> <a href = "menu.php">menu</a> <a href = "logoff.php">logoff</a></h2>	</pre>
  </div > 
</body>
</html>   



<?php 
	
	
					
	 if ($_POST)
{
		
		//get user from session
$user = $_SESSION['user']; 		

		
$rating = $_POST["rating"];	

//get book id 				
$bID = $id;

$query =   "SELECT * FROM rating ";
$query .= " WHERE userName ='$user' AND bookID= '$bID'  ";		
$result = mysqli_query($connection,$query);

if($result) 
{
   //update rating
 $query = "UPDATE rating SET rating = '$rating' WHERE userName ='$user' AND bookID= '$bID' ";
   
    mysqli_query($connection, $query);
	
 
   
 echo "updated rating of the book by bookID";
 

			$continue =	true;		
					

					
}
else
{
	
	//insert new rating
	$query = "INSERT INTO rating (userName,bookID,rating) values ";
	
	
	$query .= "('$user', '$bID', '$rating')";								
	mysqli_query($connection, $query);					
	 echo "insert new rating of the book by bookID";			  
		
			$continue =	true;		
					
					
}



if($continue){
//update overall book 

 $query = "UPDATE book SET rating = (SELECT ROUND(AVG(rating), 2) FROM rating WHERE bookID = $bID)  ";
 
 $query .=	"WHERE bookID = $bID";
 mysqli_query($connection,$query);

}

				
	}
 
	
	
?>
   
