<?php

$path = dirname(__FILE__);
include("{$path}/init.inc.php");

$user_info = array();
$id = -1;

if (isset($_GET['uid'])){
    	$user_info = fetch_user($_GET['uid']);
    	$id = $_GET['uid'];
    } else if (isset($_SESSION['uid'])){
    	$user_info = fetch_user($_SESSION['uid']);
    	$id = $_SESSION['uid'];
    } else {
    
    }


//$errors = array();

if(isset($_POST['submit'])){

	//$errors[] = 'You need to be logged in to Delete records.';

	echo "<br>Delete is enabled for now.";

	delete_profile_info($id);
				
} else { 

    echo "delete profile Complains!";
    
    //echo $errors;
    
}

?>

<!DOCTYPE html PUBLIC "-//W#C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta> 
        <style type="text/css">
            form { margin:10px 0px 0px 0px; }
            form div { float:left; clear-both; margin:0px 0px 4px 8px; }
            label { float:left; width:150px; }
            input[type="text", textarea { float:left; width:600px; } 
            input[type="submit" { margin:10px 0px 0px 100px; } 
            </style>
            
            <title>Delete Your Profile</title>
        </head>
        <body>
        <font face=arial>
        <center>
        <h3>Delete Profile</h3>
        </center>
        <p>
    
    <form action="" method="post">
    
   <?php         
                     
	//this is necessary 
    if (isset($_GET['uid'])){
    	$user_info = fetch_user($_GET['uid']);
    } else if (isset($_SESSION['uid'])){
    	$user_info = fetch_user($_SESSION['uid']);
    } else {
    
    }
    
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
          
          <p>
        
        <?php   
    }
         ?>
         
<script>
function myFunction() {
  var txt;
  if (confirm("Delete Record!")) {
    txt = "You pressed OK!";
  } else {
    txt = "You pressed Cancel!";
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>


               <div>
               <p>
               <br>
               <button onclick="myFunction()"><input type="submit" name="submit" value="Delete" /></button>
               
    
                   
    	</form>
    
               
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
               
               
                        
        
        