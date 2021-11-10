<?php
ob_start();
session_start();
     		
require_once('header.php');	


?>

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
<body>    
<div align = "center">

<?php
	
 

	
	

If($_POST)
{
	
	
	
	
$user = sanitize($_POST['username']);
$pass = sanitize($_POST['password']);
$cpass = sanitize($_POST['cpassword']);

	if($pass ==  $cpass)
	{
$user = mysqli_real_escape_string($connection, $user);

$pass = mysqli_real_escape_string($connection, $pass);

$pass = md5($pass);

$query = "INSERT INTO user(username,password)";
$query .= " VALUES ('$user', '$pass')";

$result = mysqli_query($connection, $query);


If($result)
{
	
	
		echo "New User";
		
		
		$_SESSION['user'] = $user ;


		header("location: menu.php");
 


}
Else
{
Echo "Failed to register User";
}



}

else{echo " Re-Enter :  The passwords do not match";}


}



?>


<html>
<head>
<title>rigister</title>      
<style>   
body { background-color: grey;}
</style>     
</head>
<body> 
<div align = "center">	
<div style="width:400px;height:300px;-webkit-border-radius: 15px 18px 20px 20px;-moz-border-radius: 15px 18px 20px 20px;border-radius: 15px 18px 20px 20px;background:rgba(154,203,227,0.7);-webkit-box-shadow: #B3B3B3 2px 2px 2px;-moz-box-shadow: #B3B3B3 2px 2px 2px; box-shadow: #B3B3B3 2px 2px 2px;">
<BR><BR>
<BR><BR>
	<form method="post" action="">
		UserName:<input type="text" name="username" value="" />
		<br><br>
		Password:<input type="password" name="password" value="" />
		<br><br>
		Confirm Password:<input type="password" name="cpassword" value="" />
		<br><br>
		<input type="submit" name="submit" value="register" />
	</form>
	</div>
	<pre>
		<h1><a href = "index.php">HOME</a></h1> 
	</pre>
	
	
</body>
</div>
</html>

<?php

	require_once('footer.php');
	
?>