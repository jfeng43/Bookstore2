<?php
ob_start();
session_start();
require_once('header.php');
require_once('lib.php');

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
</style> 


</head>
<body >
	
	
	<h1>Welcome to Jiajie's bookstore</h1>
		<p>You can<a href="addBook.php">Add a book</a> to the database or
		<a href="viewBooks.php">view all the book</a> available in the database</p><br>
		<pre><a href="addBook.php">Add a book</a> <a href="viewBooks.php">View books</a>
		</pre>
	
    <form name ="frm1" method ="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		
		Title:<input type = "text" name = "title" value="<?php echo $title;?>"/> 
		<span style="color:red;"> <?php echo $title_Err;?></span>
		<br><br>
		Author(s):<input type="text" name ="author" value="<?php echo $author;?>"/>
		<span style="color:red;"> <?php echo $author_Err;?></span>
		<br><br>
		PublishDate:<input type = "text" name = "publishdate" value="<?php echo $pub_date;?>"/> 
		<span style="color:red;"> <?php echo $date_Err;?>  </span>
		<br><br>
		ISBN:<input type = "text" name = "isbn" value="<?php echo $isbn;?>"/>
	<span style="color:red;"> <?php echo $isbn_Err;?></span>	
		<br><br>
		Category:<input type="radio" name="ca" value="hardcover" />
		Hardcover <input type="radio" name="ca" value="paperback" />
		Paperback<input type="radio" name="ca" value="ebook" />eBOOK	
		<span style="color:red;"> <?php echo $cat_Err;?></span>
		<br><br>
		Price:<input type = "text" name = "price" value="<?php echo $price;?>" />
	<span style="color:red;"> <?php echo $price_Err;?></span>	
		<br><br>
		Status:<select name ="status">
			<option value="instock">in stock</option>
			<option value="outofstock">out of stock</option>
			<option value="pre-order">pre-order</option>
			<option value="NA">N/A</option>
		</select>
		<br><br>
		Rating:<select name="rating">
			<option value="NA">N/A</option>
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
		<br><br>
		Note:<textarea row="4" cols="50" name='note' id='note'></textarea><br>
		<input type="submit" name= "submit" value ="submit"> &nbsp; &nbsp; <input type="reset" name="reset" value="clear">			
		
</form>

<h1><a href = "index.php">Home</a>
<a href = "menu.php">Menu</a>
<a href = "logoff.php">logoff</a></h1>


</body>
</html>
<?php

	require_once('footer.php');
	
	?>

<?php 
	//5. close database connection
	mysqli_close($connection);
	?>


