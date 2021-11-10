<?php
   session_start();
    ob_start();
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
<div style="width:400px;height:300px;-webkit-border-radius: 15px 18px 20px 20px;-moz-border-radius: 15px 18px 20px 20px;border-radius: 15px 18px 20px 20px;background:rgba(154,203,227,0.7);-webkit-box-shadow: #B3B3B3 2px 2px 2px;-moz-box-shadow: #B3B3B3 2px 2px 2px; box-shadow: #B3B3B3 2px 2px 2px;">
<BR><BR>
<BR><BR>
	 <?php
           
     	
		
		$week=time() + 7 * 24 * 60 * 60;
	  		
		if(isset($_POST['rem']))
				{
							
							setcookie('username', $_POST['user'], $week);
							setcookie('password', 	$_POST['pass'], $week);
							
				}else{}
							
			
					
			if(isset($_POST['for']))
				{
      				    				
							setcookie('username', NULL, $week);
							setcookie('password', 	NULL, $week);
				}
				else{}
						
			  			  

?>		 

	
 <form align = "center" class = "form-signin" role = "form" 
            action = "<?php echo $_SERVER['PHP_SELF']?>" method = "post">              
 <?php   
	  

echo "Username:";
	   
if(isset($_COOKIE['username'])) 
{
    echo "<input type=\"text\" id=\"username\" name=\"user\" value=".$_COOKIE['username'].">";
} else {
    echo "<input type=\"text\" id=\"username\" name=\"user\"  value=\"\">";
}
		echo"<br>";
		
echo "Password:";
if(isset($_COOKIE['password'])) 
{
	
	echo "<input type=\"password\" id=\"password\" name=\"pass\"  value=".$_COOKIE['password'].">";
} else {
    echo "<input type=\"password\" id=\"password\" name=\"pass\"  value=\"\">";
}
 
 echo"<br><button class = \"\" type = \"submit\"   name = \"login\">LOG IN</button><br>";							 		            

echo "Remember me"; 
if(isset($_POST['rem'])) { echo "<input type=\"checkbox\" id=\"rem\" name=\"rem\" checked=\"checked\">";} 
else {  echo "<input type=\"checkbox\" id=\"rem\" name=\"rem\">";}

echo"<br>";


echo "Forget me";
if(isset($_POST['for'])) { echo "<input type=\"checkbox\" id=\"for\" name=\"for\" checked=\"checked\">";} 
            else {  echo "<input type=\"checkbox\" id=\"for\" name=\"for\">";  }
			
			
?>
 </form>
	
</div>
</div>

<pre>
<h1><a href = "index.php">HOME</a></h1> 
</pre>
</body>
</html>

<?php


if($_POST){

$Uname = sanitize($_POST["user"]);
$password = sanitize($_POST["pass"]);

$sql = "select * from user where lower(userName)= lower('".$Uname."') and  password ='".md5($password)."' ";

$result = mysqli_query($connection,$sql);		

$rowcount = mysqli_num_rows($result);

if ($rowcount == 1) 
{				
        $_SESSION['user'] = $Uname ;
		header("location: menu.php");
		

}else{


echo "INVALID USER";

}


}





ob_end_flush();
require_once('footer.php');
	


?>