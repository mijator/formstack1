<?php
 
 //session_start();

	$path = dirname(__FILE__);
	include("{$path}/init.inc.php");
	
	echo "Logout Successfully ";
  	$_SESSION = array(); //sets SESSION variables to empty array
  
  	session_destroy();   // function that Destroys Session Cookies 
  
  	header("Location: login.php");
  	
?>

<html>
<head>
<title>
</head>
<body>

<h3>Logout</h3>


<div>
      <center>
       <p>
         <a href=profile.php>Home</a><br> 
         <a href=login.php>Login</a>  | 
         <a href=logout.php>Log Out</a><br>
       <a href=add_profile.php>Register</a>  |   
       <a href=user_list.php>View Users</a>  
       <p>
       </center>   
       
       </div>   
       


</body>
</html>

