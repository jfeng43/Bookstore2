<?php
ob_start();
session_start();
echo ' 					Goodbye   ' . $_SESSION['user']."...					" ;
session_destroy();

?>
<html>
<head>
  <title>logoff</title>
   <style> 
   body 
{
  
    text-align: center;
	background-image: url("paper.gif");
    background-color: #cccccc;

}</style>   
</head>
<body>	
<a href = "index.php"> HOME  </a> 	 
</body>
<br><br>
<script type="text/javascript">
 dt=new Date(document.lastModified);
 document.write("<mark> This page was last modified on " +dt.toLocaleString() + "</mark>");
</script>
</html>
