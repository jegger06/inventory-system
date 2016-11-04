<?php 

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';


$userID = trim(mysqli_real_escape_string($conn, $_POST['userID']));
$current_password = trim(mysqli_real_escape_string($conn, $_POST['c_password']));
$new_password = trim(mysqli_real_escape_string($conn, $_POST['n_password']));

$hash_current_password = md5($current_password);
$hash_new_password = md5($new_password);

$sql = mysqli_query($conn, "SELECT `user_password` FROM `tbl_user_info` WHERE `user_id` = $userID LIMIT 1");
if ($sql) {
	$sql_num_row = mysqli_num_rows($sql);
	if ($sql_num_row == 0) {
		$status = 0;
		$err_pass = 'Something\'s wrong. Please try again.';
	} else {
		$row = mysqli_fetch_assoc($sql);
		$password = $row['user_password'];
		$message = 'All is ok for now.';
		if ($password == $hash_current_password) {
			$status = 1;
			$message = 'The password matches.';
		} else {
			$status = 0;
			$err_pass = 'The password didn\'t match. Try again.';
		}
	}
}

if ($hash_new_password != $password && $status == 1) {
	$save_pass = 1;
} else {
	$save_pass = 0;
	$err_msg = 'The new password and the previous password match. Please try again';
}

if ($status == 1 && $save_pass == 1) {
	$sql_password = mysqli_query($conn, "UPDATE `tbl_user_info` SET `user_password` = '$hash_new_password' WHERE `user_id` = $userID");
	$success = 1;
	$message = 'Your password have been updated.';
} else {
	$success = 0;
}


if ($success == 0) {
	if ($status == 0) {
		$data = array('success' => $success, 'message' => $err_pass);
	} else if ($save_pass == 0) {
		$data = array('success' => $success, 'message' => $err_msg);
	}
} else {
	$data = array('success' => $success, 'message' => $message);
}

generate_json($data);