<?php
session_start();
require '../../../controller/db/connect.php';
// print_r($conn);
$user 		= mysqli_real_escape_string($conn, $_POST['user']);
$password 	= mysqli_real_escape_string($conn, $_POST['password']);
$remember	= $_POST['remember'];
$hash_password = md5($password);

$query = mysqli_query($conn, "SELECT `user_id`, `pos_id`, `first_name`, `middle_name`, `last_name`, `email`, `attempt` FROM `tbl_user_info` WHERE `user_name` = '$user' AND `user_password` = '$hash_password' LIMIT 1");
$query_num_rows = mysqli_num_rows($query);
if ($query_num_rows == 0) {
	$result = 'Sorry you got no match';
	$success = 0;
} else {
	$row = mysqli_fetch_assoc($query);
	$user_id = $row['user_id'];
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$pos_id = $row['pos_id'];
	$result = 'It match';
	$success = 1;
	$_SESSION['firstname'] = ucfirst($first_name);
	$_SESSION['lastname'] = ucfirst($last_name);
	$_SESSION['user_id'] = $user_id;
	$_SESSION['pos_id'] = $pos_id;
	$cookie_name = 'userID';
	$cookie_val = $user_id;
	if ($remember == 'true') {		
		setcookie($cookie_name, $cookie_val, time() + 300, '/');
	} else {
		unset($_COOKIE['userID']);
		setcookie('userID', null, -1, '/');
	}
}

$data = array('result' => $result, 'password' => $hash_password, 'success' => $success, 'remember' => $remember);

echo json_encode($data);