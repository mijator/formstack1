<?php

//profile.php
include('init.inc.php');

$user_info = array();


if (isset($_GET['uid']))
{
   $user_info = fetch_user_info($_GET['uid']);
}
else
{
   if (empty($user_info)){
   
   		header("Location: login.php");
   	
   } else {
   
   		$user_info = fetch_user_info($_SESSION['uid']);
   	
   }
}    



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
    
    //this GET is necessary 
    $user_info = fetch_user($_GET['uid']);
    
    //var_dump($user_info);
    
    if ($user_info === false){
    
    	echo "User does not exist.";
    
    } else {
    
    ?>
    	
    <p>
    <img src=template.jpg height=75 width=75>
         
    <p>
    <a href="profile.php?uid=<?php echo $user_info['user_id']; ?>">
    <?php echo $user_info['first_name']; ?> 
    <?php echo $user_info['last_name']; ?>
    </a>
          | <?php echo $user_info['email_address']; ?> 
          	<?php echo $user_info['pass_word']; ?> 
          | <a href=edit_profile.php?uid=<?php echo $user_info['user_id']; ?> >Edit/Update</a> 
          | <a href=delete_profile.php?uid=<?php echo $user_info['user_id']; ?> >Delete Record</a>
          
          <p>
        
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