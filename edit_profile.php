<?php

$path = dirname(__FILE__);
include("{$path}/init.inc.php");

$user_info = array();

//if (isset($_GET['uid']))
//{
//   $user_info = fetch_user_info($_GET['uid']);
//}



if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], 
$_POST['password'])) {

$errors = array();

//validation continues inside this section


if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){

    $errors[] = 'The email address you entered is not valid.';

}

if (preg_match('#^[a-z0-9 ]+$#i', $_POST['firstname']) === 0) {

    $errors[] = 'The first name you entered is not valid.';
}

if (preg_match('#^[a-z0-9 ]+$#i', $_POST['lastname']) === 0) {

    $errors[] = 'The last name you entered is not valid.';
}

//if (preg_match('#^[a-z0-9 ]+$#i', $_POST['email']) === 0) {

//    $errors[] = 'The email you entered is not valid.';
//}

if (preg_match('#^[a-z0-9 ]+$#i', $_POST['password']) === 0) {

    $errors[] = 'The password you entered is not valid.';
}

if (empty($_FILES['avatar']['tmp_name']) === false){
    $file_ext = end(explode('.', $_FILES['avatar']['tmp_name']));

    if (in_array(strtolower($file_ext), array('jpg', 'jpeg', 'png', 'gif')) === false){
        $errors[] = 'Your avatar must be an image.';
    }
}

if (empty($errors)){ 

    set_profile_info($_POST['email'], $_POST['firstname'], 
    $_POST['lastname'], $_POST['password'], (empty($_FILES['avatar']['tmp_name'])) ? false : $_FILES['avatar']['tmp_name']);
    
    } 
    

    $user_info = array(
        'email' => htmlentities($_POST['email']),
        'firstname' => htmlentities($_POST['firstname']), 
        'lastname' => htmlentities($_POST['lastname']), 
        'password' => htmlentities($_POST['password']), 
    );
    
} else { 

    //$user_info = fetch_user_info($_SESSION['uid']);
    
}

?>

<!DOCTYPE html PUBLIC "-//W#C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta> 
        <style type="text/css">
            form { margin:10px 0px 0px 0px; }
            form div { float:left; clear-both; margin:0px 0px 4px 8px; }
            label { float:left; width:16px; }
            input[type="text", textarea { float:left; width:600px; } 
            input[type="submit" { margin:10px 0px 0px 100px; } 
            </style>
            
            <title>Edit Your Profile</title>
        </head>
        <body>
        
        <font face=arial>
        <center>
        <h3>Edit/Update Profile</h3>
        </center>
        <p>
        
            <div> 
                <?php 
                
                if (isset($errors) === false){ 
                    echo 'Click update to edit your profile.';
                    
                    } else if (empty($errors)){
                    echo 'Your profile has been updated.';
                    
                    } else { 
                    echo '<ul><li>', implode('</li><li>', $errors), 
                    '</li></ul>';
                
                }
                
    
    //this is necessary 
    if (isset($_GET['uid'])){
    	$user_info = fetch_user($_GET['uid']);
    } else if (isset($_SESSION['uid'])){
    	$user_info = fetch_user($_SESSION['uid']);
    } else {
    
    }
    
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
           
           <table width=600>
           <td width=600>
           <font face=arial>
           
           
           <form action="" method="post" enctype="multipart/form-data">
               <div>
                   <label for="firstname">First Name:</label>
                   <br>
                   <input type="text" name="firstname" id="firstname" value="<?php echo $user_info['first_name']; ?>" />
               </div>
               <div>
               
                   <label for="lastname">Last Name:</label>
                   <br>
                   <input type="text" name="lastname" id="lastname" value="<?php echo $user_info['last_name']; ?>" />
                   
               
               </div>
               <p>
               
               <div>
               
               <label for="email">Email Address:</label>
               <br>
                   <input type="text" name="email" id="email" value="<?php echo $user_info['email_address']; ?>" />
                   
               </div>
               
               <div>
               
               <label for="password">Pass Word:</label>
               <br>
                   <input type="password" name="password" id="password" value="" />
                   
               </div>
               <p>
               
               <div>
               
                   <label for="avatar">Avatar:</label>
                   <br>
                   <input type="file" name="avatar" id="avatar" />
                   
               </div>
               
               <div>
               <p>
               <br>
                   <input type="submit" value="Update" />
    
               
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
               
               
                        
        
        