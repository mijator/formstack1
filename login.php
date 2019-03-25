<?php  

//session_start(); 

$path = dirname(__FILE__);
include("{$path}/init.inc.php");

?>  

// session starts with your email and password

<?php

$errors = array();

//validation continues inside this section

if (isset ($_POST['email'])){

	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){

    	$errors[] = 'The email address you entered is not valid.';

	}

}

if (isset ($_POST['password'])){

	if (preg_match('#^[a-z0-9 ]+$#i', $_POST['password']) === 0) {

    	$errors[] = 'The password you entered is not valid.';
	}

}

if (empty($errors)){ 

	if (isset($_POST['email'])) $email = $_POST['email'];

    $user_info = @fetch_user2($email);

	if (isset($_POST['password'])) $password = $_POST['password'];

	if (empty($password)) $password = '';

    $password = sha1($password);
    
    echo "<br>All is good here...checking user_info...";
    
    if ($user_info === false){
    
    	echo "<br>User does not exist.";
    
    } else {
    
    	if (empty($email)) $email='';
    	if (empty($password)){
    		$password = '';
    		$password = sha1($password);
    	} 
    	
    	$user_info = fetch_user2($email);
    	
    	if (($email = $user_info['email_address']) && ($password = $user_info['pass_word'])){
    
    		$_SESSION['uid']=$user_info['user_id'];
    
    		echo "<br>All Is Good Here.";
    		echo $_SESSION['uid'];
    	
    		
    	} else {
    
    		echo "<br>Incorrect Data.";
    	}
    
    }
    
    
} 


 ?>
<html>
<head>

<title> Login Page </title>

</head>

<body>

<form action="" method="post">

    <table width="200" border="0">
  <tr>
    <td>Email Address </td>
    <td> <input type="text" name="email" value="" > </td>
  </tr>
  <tr>
    <td>Password </td>
    <td><input type="password" name="pass" value="" ></td>
  </tr>
  <tr>
    <td> <input type="submit" name="login" value="LOGIN"></td>
    <td></td>
  </tr>
</table>
</form>

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
       
       
</body>
</html>