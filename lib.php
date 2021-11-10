
	<?php
	

	
	
			
	$title_Err =$Pub_Err=$author_Err=$isbn_Err=$price_Err=$date_Err =$cat_Err ="";
    $title= $author= $price=  $pub_date =  $isbn =  $status =  $rating = $note = $category =  "";	
    $valid=false;
	
	if ($_POST){
	
	
	
	
	
	
    $status = $_POST["status"];
	$rating =$_POST["rating"];
	
	$note =sanitize($_POST["note"]);
	
	
	
	
	if ( trim($_POST["title"]) == NULL)
	{
		$title_Err = "*Error: Input title.";
	
		
	} else{
		
		$title=sanitize($_POST["title"]);
			
	}
	
	
	
	if( trim($_POST["author"]) == NULL )
	{
		$author_Err = "*Error: Input author";

	} else{
		
		
		$author=sanitize($_POST["author"]);
		
		
		
	}


	
    if( trim($_POST["price"]) == NULL || (!(is_numeric($_POST["price"])) ))
	{
		$priceErr = "* Error:   Input a numeric value for price";
		
	} else{
		
			
				
						$price= sanitize($_POST["price"]);
		   }
		   

	
	
			$pub_date = $_POST["publishdate"];
	
         preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/",$pub_date, $match);
    
  
			if(!$match)  
			{
		    			
		
				$date_Err = "*Error:  input format as mm/dd/yyyy ";
				
				
			}
  
	
	if(isset($_POST['ca']))
{
	$category = $_POST["ca"];
	
}  else {
              
			  $cat_Err = "*Select a category";
         }
	
	if((strlen( trim($_POST["isbn"])) >13) || (!(is_numeric($_POST["isbn"])) ))
{
        $isbn_Err = "*Error: Input title.";
		
}
else
{
	            $isbn =sanitize($_POST["isbn"]);
	
					
			 
		
}
	
	}
	
			 if (empty($title_Err) && (empty($author_Err))    && (empty($isbn_Err)) &&  (empty($cat_Err)) &&(empty($price_Err)) &&(empty($date_Err )))
	{ 
				
				$valid = true;
	}
		
		

	
		 if (isset($_POST["submit"]))
{		
			
			if($valid){
			
										
			$find="SELECT isbn FROM book WHERE isbn=$isbn";
			
			$query = mysqli_query($connection,$find);		
			
			
			$number_of_rows = mysqli_fetch_array($query, MYSQLI_NUM);
			
			
			if($number_of_rows[0] > 1) 	{         	$isbn_Err = "isbn $isbn  Already in Exists";		}					
					
				else
				{									
	
	
					
/////////////////////////////////////////////////////////////////////////////////////////////////////
 // Perfrom a SQL sanitization before the SQL insert
  	
	
			$db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);		
			$title = mysqli_real_escape_string($db, $title);
			$author = mysqli_real_escape_string($db, $author);
			$isbn = mysqli_real_escape_string($db, $isbn);
			$pub_date = mysqli_real_escape_string($db, $pub_date);
			$note = mysqli_real_escape_string($db, $note);
			$price = mysqli_real_escape_string($db, $price);
		
	
	
	
//////////////////////////////////////////////////////////////////////////////////////////////////////

	
	
	
					$query = "INSERT INTO book ";
					$query .= "( title, author, isbn, publishDate,category,price,status,note) ";
					$query .= "VALUES ";
					$query .= "('$title', '$author', '$isbn', '$pub_date','$category','$price','$status','$note')";
			    	$result = mysqli_query($connection, $query);
					echo $query."<br>";
					
	
	
	
	
					$result = mysqli_query($connection,"SELECT * FROM book");
					
					
					//get the last input by  mysqli_num_rows
					$bID =mysqli_num_rows($result);	

							//get user from session
					$user = $_SESSION['user']; 				

		
			
					
							
					       $updateAvg = false;		
					if(isset($_POST["rating"]))
					{
								
								//insert new rating
	$query = "INSERT INTO rating (userName,bookID,rating) values ";
	$query .= "('$user', '$bID', '$rating')";								
	mysqli_query($connection, $query);					
	
	echo "insert new rating of the book by bookID";			  
		
			//$continue =	true;		
					
					       $updateAvg = true;		
			
					}
			
			if($updateAvg==true)
			{
				
				
						
//update overall book 
 $query = "UPDATE book SET rating = (SELECT ROUND(AVG(rating), 2) FROM rating WHERE bookID = $bID)  ";
 $query .=	"WHERE bookID = $bID";
 mysqli_query($connection,$query);

				
				
			}
			
			
						
				
	
			  }
			  
			}
			
			   }
		
		
			?>