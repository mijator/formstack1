<?php

$path = dirname(__FILE__);
include("{$path}/init.inc.php");

$user_info = array();
$id = -1;

if (isset($_GET['uid'])){
	$uid = $_GET['uid'];
} else {
	$uid = -1;
	
}

if (empty($_SESSION['uid'])){

	if (isset($_GET['uid']) && ($_SESSION['uid'] !=''))
	{
   		$user_info = @fetch_user_info($_GET['uid']);
   		$id = $_GET['uid'];
	}
	
} else
{
   if (empty($user_info)){
   
   		$user_info = @fetch_user_info($_SESSION['uid']);
   		$id = $_SESSION['uid'];
   
   } else {
   
   		$user_info = @fetch_user_info($_SESSION['uid']);
   		$id = $_SESSION['uid'];
   	
   }
}    



$errors = array();

//since it actually works, this is to prevent accidental deletions
if (isset($_POST['submit'])){

$errors[] = 'You cannot Delete records at this time.';

}

if (empty($errors)){ 

echo "<br>Delete is enabled for now.";

	delete_profile_info($id);

} else { 

    echo "delete profile Complains!";
    
    echo $errors;
    
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
    
   <?php         
                     
	$user_info = fetch_user($_GET['uid']);
    
    //var_dump($user_info);
    
    if ($user_info === false){
    
    	echo "User does not exist.";
    
    } else {
    
?>
    <p>
    <img src=template.jpg height=75 width=75>
    <img src="data:image/jpg;base64,'.base64_encode(<?php echo $user_info['avatar_image'] ?>).'"/>
         
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
              
              </font>
              </td> 
              <tr>
              <td> 
              <font face=arial>
               
       
       <div>
      <center>
       <p> 
         <a href=login.php>Login</a>  | 
         <a href=logout.php>Log Out</a><br>
       <a href=add_profile.php>Register</a>  |   
       <a href=user_list.php>View Users</a>  
       <p>
       </center>   
        
       </div>   
       
       </font>
       </td>
       </table>
       
</font>
</body>
</html>
               
               
                        
        
        