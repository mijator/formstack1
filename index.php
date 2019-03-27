<?php

//profile.php
include('init.inc.php');

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$user_info = array();
//$user_info2 = array();

//if (isset($_GET['uid']))
//{
//   $user_info = fetch_user_info($_GET['uid']);
//}

//if (isset($_SESSION['uid']))
//{
//   $user_info2 = fetch_user_info($_SESSION['uid']);
//}

//else
//{
//   if (empty($user_info)){
   
//   		header("Location: login.php");
   	
//   } else {
   
//   		$user_info = fetch_user_info($_SESSION['uid']);
   	
//   }
//}    



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
            
            <title>Profile</title>
        </head>
        <body>
        <font face=arial>
        <center>
        <h3>Profile</h3>
        </center>
        <p>
        
        
        <table width=600>
        <td width=600>
        <font face=arial>
        
     <div>
     
     <?php 
    
    //this is necessary 
    if (isset($_GET['uid'])){
    	$user_info = fetch_user($_GET['uid']);
    } else if (isset($_SESSION['uid'])){
    	$user_info = fetch_user($_SESSION['uid']);
    } else {
    	$user_info = fetch_user(1);
    }
    
    if ($user_info === false){
    
    	echo "User does not exist.";
    
    } else {
    
    	}
    	
    	?>
    	
    <p>
	

    
          
         
    

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