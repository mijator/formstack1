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


function upload($email,$firstname,$lastname,$password) {
//require_once('file_constants.php');

$link = new mysqli("localhost", "root", "", "formstack1");

$email	= mysqli_real_escape_string($link, htmlentities($email)); 
$firstname	= mysqli_real_escape_string($link, htmlentities($firstname)); 
$lastname	= mysqli_real_escape_string($link, htmlentities($lastname)); 
$password	= mysqli_real_escape_string($link, htmlentities($password)); 
//$password = sha1($password);

$maxsize = 100000; 
$msg = '';
    
    if($_FILES['avatar']['error']==UPLOAD_ERR_OK) {

       
        if(is_uploaded_file($_FILES['avatar']['tmp_name'])) {    

            
            if( $_FILES['avatar']['size'] < $maxsize) {  
  
            
            		//there should not be any special characters in base64 
            		//but this seems to be useful
                    //$imgData =addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
					//turns out it wasn't useful !!!
					//$imgData = base64_encode($imgData);
					//here is the correct code for this
					$imgData = base64_encode(file_get_contents($_FILES['avatar']['tmp_name']));
					
                    $link = new mysqli("localhost", "root", "", "formstack1");

					mysqli_set_charset($link, 'utf8');


					if (file_exists($_FILES['avatar']['tmp_name'])){
					$sql = "INSERT INTO users (user_id, email_address, first_name, last_name, pass_word, avatar_image)
VALUES ('', '$email', '$firstname', '$lastname', '$password', '{$imgData}')";
					} else {

					$sql = "INSERT INTO users (user_id, email_address, first_name, last_name, pass_word, avatar_image)
VALUES ('', '$email', '$firstname', '$lastname', '$password', '')";

					}
					
					$result = mysqli_query($link, $sql);
					
					if ($result) {
    					echo "New record created successfully";
					} else {
    					echo "Error: " . $sql . "<br>" . mysqli_error($link);
					}

					mysqli_close($link);
                    
            }
             else {
              
                $msg='<div>File exceeds the Maximum File limit</div>
                <div>Maximum File limit is '.$maxsize.' bytes</div>
                <div>File '.$_FILES['avatar']['tmp_name'].' is '.$_FILES['avatar']['size'].
                ' bytes</div><hr />';
                }
        }
        else
            $msg="File not uploaded successfully.";

    }
    else {
	
        $msg= file_upload_error_message($_FILES['userfile']['error']);
    }
    
    return $msg;
}


function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return ' ';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
    }
}


function display_image($uid){

//$id = $_GET['uid'];
$id = $uid;


$link = new mysqli("localhost","root","","formstack1");

$sql = "SELECT * FROM upload_image where id='$id'";

//$result = $conn->query($sql);

$result = mysqli_query($link, $sql);

//var_dump($result);

$row_cnt = mysqli_num_rows($result);

while ($row= mysqli_fetch_array($result)) {

	//header('content-type: image/jpeg');
	//echo $a=$row['img'];
 	echo '<img src="data:image/jpg;base64,' . base64_encode($row['img']) . '">';
 	//echo base64_decode($a);

}
	
$link->close();

}


/*
function insert_profile_info($email, $firstname, $lastname, $password, $avatar){

$link = new mysqli("localhost", "root", "", "formstack1");

$email	= mysqli_real_escape_string($link, htmlentities($email)); 
$firstname	= mysqli_real_escape_string($link, htmlentities($firstname)); 
$lastname	= mysqli_real_escape_string($link, htmlentities($lastname)); 
//$password	= mysqli_real_escape_string($link, htmlentities($password)); 
$password = sha1($password);

$image = $_FILES['avatar']['tmp_name'];

$path = realpath($image);
echo $path;

//$path = dirname(__FILE__);
//var_dump($avatar);
$temp = $path.'/'.$avatar['name'];
//var_dump($temp);

if (file_exists($temp)){

echo "Avatar File Exists!";

$image = $_FILES['avatar']['tmp_name'];
$imgContent = addslashes(file_get_contents($image));

}

$target_file = basename($_FILES["avatar"]["name"]);
echo $target_file;

$imgContent = addslashes(file_get_contents($target_file));


if (file_exists($target_file)){
	$sql = "INSERT INTO users (user_id, email_address, first_name, last_name, pass_word, avatar_image)
VALUES ('', '$email', '$firstname', '$lastname', '$password', $imgContent)";
} else {

	$sql = "INSERT INTO users (user_id, email_address, first_name, last_name, pass_word, avatar_image)
VALUES ('', '$email', '$firstname', '$lastname', '$password', '')";

}


if (mysqli_query($link, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

mysqli_close($link);

}
*/



function set_profile_info($email, $firstname, $lastname, $password, $avatar){

$link = new mysqli("localhost", "root", "", "formstack1");

$email		= mysqli_real_escape_string($link, htmlentities($email)); 
$firstname	= mysqli_real_escape_string($link, htmlentities($firstname)); 
$lastname	= mysqli_real_escape_string($link, htmlentities($lastname)); 
$password	= mysqli_real_escape_string($link, htmlentities($password)); 

$password = sha1($password);

//$var_dump($email);

if (file_exists($avatar)){

echo "Avatar File Exists!";

//resize image, etc.
}
	
	$sql = "UPDATE `users` SET `email_address`= '{$email}',  
	`first_name`= '{$firstname}',  
	`last_name`= '{$lastname}',  
	`pass_word`= '{$password}' WHERE user_id = {$_GET['uid']}";
		
if (mysqli_query($link, $sql)) {
    echo "Record updated successfully";
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