<?php

//user_list.php
include('init.inc.php');

?>


<!DOCTYPE html PUBLIC "-//W#C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv"Content-Type" content="text/html; charset=utf-8" /> 
        <style type="text/css">
            form { margin:10px 0px 0px 0px; }
            form div { float:left; clear-both; margin:0px 0px 4px 8px; }
            label { float:left; width:50px; }
            input[type="text", textarea { float:left; width:600px; } 
            input[type="submit" { margin:10px 0px 0px 100px; } 
            </style>
            
            <title>Registered Users</title>
        </head>
        <body>
        <font face=arial>
        <center>
        <h3>Registered Users</h3>
        </center>
        <p>
        
        
        <table width=600>
        <td width=600>
        <font face=arial>
        
     <div>
     
     <?php 
     
     $link = mysqli_connect("localhost", "root", "", "formstack1");
	 //echo "connecting...<br>";
	 //check connection 
	 if (mysqli_connect_errno()) {
    	printf("Connect failed: %s\n", mysqli_connect_error());
    	exit();
    }
	//echo "connection okay...<br>";
	$query = "SELECT * FROM `users`";
	//echo "Query created<br>";
	$result = mysqli_query($link, $query);
	//echo "result of query coming...<br>";
	
	//big if statement starts here

	if ($result = mysqli_query($link, $query)){

	echo "Results returned...<br>";          

	?>
	<p>
	
	    
   	<?php       

	} else {
	echo "No Results returned...<br>";

                
	?>
	
	<p>
         
   <?php  

	} //end of if statement



	foreach (fetch_users() as $user_info){
     
	echo "";
   
	?>
    
    <p>
    <a href="profile.php?uid=<?php echo $user_info['user_id']; ?>"><?php echo $user_info['first_name']; ?> <?php echo $user_info['last_name']; ?></a>
          | <?php echo $user_info['email_address']; ?> <?php echo $user_info['pass_word']; ?> 
          | <a href=edit_profile.php?uid=<?php echo $user_info['user_id']; ?> >Edit/Update</a> 
          | <a href=delete_profile.php?uid=<?php echo $user_info['user_id']; ?> >Delete Record</a> 
          
         
    <?php
         
} 


         ?>
     
     
         </div>
   
  <p>
   <br>
   </font>
   </td>
   <tr>
   <td>
   <font face=arial>
   	<center>
       <p>
       <br>
       <a href=index.php>Home</a><br>
         <a href=login.php>Login</a>  | 
         <a href=logout.php>Log Out</a><br>
       <a href=add_profile.php>Register</a>  |   
       <a href=user_list.php>View Users</a>  
       <p>
    </center>   
    </font>
    </td>
	</table>
       
       
       </font>
       
     </body>
</html>
     
     
     
     
     