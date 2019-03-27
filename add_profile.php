<?php

$path = dirname(__FILE__);
include("{$path}/init.inc.php");

$user_info = array();

if (isset($_GET['uid'])){
    	$user_info = fetch_user($_GET['uid']);
    	$id = $_GET['uid'];
    } else if (isset($_SESSION['uid'])){
    	$user_info = fetch_user($_SESSION['uid']);
    	$id = $_SESSION['uid'];
    } else {
    
}

if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], 
$_POST['password'])) {

$email = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$password = $_POST['password'];
//$avatar = $_POST['avatar'];
$password = sha1($password);

$errors = array();

//validation continues inside this section

//$link = mysqli_connect("localhost", "root", "", "formstack1");

//$imageName = mysqli_real_escape_string($link, $_FILES['avatar']['name']);
//$imageData = mysqli_real_escape_string($link, file_get_contents($_FILES['avatar']['tmp_name']));
//$imageType = mysqli_real_escape_string($link, $_FILES['avatar']['type']);

//$sql = "SELECT * FROM users";

//if (substr($imageType,0,5) == 'image'){

//$sql = "INSERT INTO users (user_id, email_address, first_name, last_name, pass_word, avatar_image)
//VALUES ('', '$email', '$firstname', '$lastname', '$password', $imageData)";
    
//}

//$sql = "INSERT INTO users (user_id, email_address, first_name, last_name, pass_word, avatar_image)
//VALUES ('', '$email', '$firstname', '$lastname', '$password', $imageData)";

//   $result = mysqli_query($link, $sql); 


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

	echo "Avatar image exists!";

	//should do some more checks, resize, etc. here

}

if (empty($errors)){ 

	$password = $_POST['password'];
	$email = $_POST['email'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	
	$password = sha1($password);

	upload($email,$firstname,$lastname,$password);
	
    }  

    $user_info = array(
        '$email' => htmlentities($_POST['email']), 
        '$firstname' => htmlentities($_POST['firstname']), 
        '$lastname' => htmlentities($_POST['lastname']), 
        '$password' => htmlentities($_POST['password']), 
    );
    
} else { 

        echo "";
        
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
            label { float:left; width:150px; }
            input[type="text", textarea { float:left; width:600px; } 
            input[type="submit" { margin:10px 0px 0px 100px; } 
            a { display: block; }
            </style>
            
            <title>Register Account</title>
        </head>
        <body>
        <font face=arial>
        <center>
        <h3>Sign Up For A New Account</h3>
        </center>
        <p>
        
            <div> 
                <?php 
                
                if (isset($errors) === false){ 
                    echo 'Click Add to create a new profile.';
                    
                    } else if (empty($errors)){
                    echo 'Your profile has been created.';
                    
                    } else { 
                    echo '<ul><li>', implode('</li><li>', $errors), 
                    '</li></ul>';
                
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
                   <input type="text" name="firstname" id="firstname" value="<?php if (isset($_POST['firstname'])) echo htmlentities($_POST['firstname']); ?>" />
               </div>
               <div>
               
                   <label for="lastname">Last Name:</label>
                   <br>
                   <input type="text" name="lastname" id="lastname" value="<?php if (isset($_POST['lastname'])) echo htmlentities($_POST['lastname']); ?>" />
                   
               
               </div>
               <p>
               
               <div>
               
               <label for="email">Email Address:</label>
               <br>
                   <input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) echo htmlentities($_POST['email']); ?>" />
                   
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
                   <input type="submit" value="Add" />
    
               <p>
               <br />
               
	  
        </div>
              </form> 
              
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
               
               
                        
        
        