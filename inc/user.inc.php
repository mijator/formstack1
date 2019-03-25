<?php

//echo 'test';

$link = mysqli_connect("localhost", "root", "", "formstack1");

//check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


//checks email and password to see if they are valid credentials
function valid_credentials($email, $password){

	$pass = sha1($password);

	$link = mysqli_connect("localhost", "root", "", "formstack1");
    
    $sql = "SELECT * from  `users` where `email_address` = 
    '{$email}' AND `pass_word` = '{$pass}' ";
    
    $result = mysqli_query($link, $sql);
    
	return (mysqli_result($result, 0) == '1') ? true : false;

}

//fetch user information for a given user using the GET variable
function fetch_user_info($uid){
    
    $uid = (int)$uid;
    
    $link = mysqli_connect("localhost", "root", "", "formstack1");
    
    $sql = "SELECT * from  `users` where `user_id` = $uid";
    
    $result = mysqli_query($link, $sql);
    
    $row= mysqli_fetch_array($result);
    
	return mysqli_fetch_assoc($result);
	
	}


function fetch_user($uid){
    
    $uid = (int)$uid;
    
    $link = mysqli_connect("localhost", "root", "", "formstack1");
    
    if ($result = mysqli_query($link, "SELECT * FROM users WHERE user_id = $uid LIMIT 1")) {
    
    	//do nothing
    
	}
    
    return mysqli_fetch_assoc($result);
    	
}

function fetch_user2($email){
    
    $link = mysqli_connect("localhost", "root", "", "formstack1");
    
    //$sql = "SELECT * FROM `users` WHERE `email_address` = `$email`";
    $sql = "SELECT * FROM `users` WHERE `email_address` = '$email'";
    
    //$result = mysqli_query($link,$sql);
    
    if ($result = mysqli_query($link, $sql)) {
    
    	//do nothing
    
	}
    
    return mysqli_fetch_assoc($result);
    	
}

//fetches all of the users
function fetch_users(){

	$users = array(); 

	$link = mysqli_connect("localhost", "root", "", "formstack1");
    
    $result = mysqli_query($link, "select * from users");

	//check connection
	if (mysqli_connect_errno()) {
    	printf("Connect failed: %s\n", mysqli_connect_error());
    	exit();
	}

	$row_cnt = mysqli_num_rows($result);

	while ($row= mysqli_fetch_array($result)) {

		$users[] = $row;

	}

	return $users; 
    
}

function insert_profile_info($email, $firstname, $lastname, $password, $avatar){

$link = new mysqli("localhost", "root", "", "formstack1");

$email	= mysqli_real_escape_string($link, htmlentities($email)); 
$firstname	= mysqli_real_escape_string($link, htmlentities($firstname)); 
$lastname	= mysqli_real_escape_string($link, htmlentities($lastname)); 
//$password	= mysqli_real_escape_string($link, htmlentities($password)); 
$password = sha1($password);

if (file_exists($avatar)){

echo "Avatar File Exists!";

//resize image, etc.
}

//$sql = "INSERT INTO users (user_id, email_address, first_name, last_name, pass_word, avatar_image)
//VALUES ('NULL', '$_POST['email']', '$_POST['firstname']', '$_POST['lastname']', '$_POST['password']', '')";

$sql = "INSERT INTO users (user_id, email_address, first_name, last_name, pass_word, avatar_image)
VALUES ('', '$email', '$firstname', '$lastname', '$password', '')";

if (mysqli_query($link, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

mysqli_close($link);

}



function set_profile_info($email, $firstname, $lastname, $password, $avatar){

//$link = new mysqli("localhost", "root", "", "formstack1");

$email		= mysqli_real_escape_string($link, htmlentities($email)); 
$firstname	= mysqli_real_escape_string($link, htmlentities($firstname)); 
$lastname	= mysqli_real_escape_string($link, htmlentities($lastname)); 
$password	= mysqli_real_escape_string($link, htmlentities($password)); 

$var_dump($email);

if (file_exists($avatar)){

echo "Avatar File Exists!";

//resize image, etc.
}
	
	$sql = "UPDATE `users` SET `email_address`= '{$email}',  
	`first_name`= '{$firstname}',  
	`last_name`= '{$lastname}',  
	`pass_word`= '{$password}' WHERE user_id = {$_SESSION['uid']}";
		
if (mysqli_query($link, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

mysqli_close($link);
	
}


function delete_profile_info($uid){

	echo "";
	
	$uid = (int)$uid;
    		
	$link = new mysqli("localhost", "root", "", "formstack1");

	$sql = "DELETE FROM `users` WHERE `user_id` = $uid";
	
	mysqli_query($link, $sql);
	
}







?>