<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$userID = trim(mysqli_real_escape_string($conn, $_POST['userID']));

$query = "SELECT `first_name`, `middle_name`, `last_name`, `gender_id` FROM `tbl_user_info` WHERE `user_id` = $userID LIMIT 1";

$sql = mysqli_query($conn, $query);
if ($sql) {
	$sql_rows = mysqli_num_rows($sql);
	if ($sql_rows == 0) {
		$success = 0;
		$err_msg = 'There was an error fetching your records. Try again later.';
	} else {
		$result = array();
		while ($row = mysqli_fetch_assoc($sql)) {
			$result[] = ucwords($row['first_name']).'#'.
						ucwords($row['middle_name']).'#'.
						ucwords($row['last_name']).'#'.
						$row['gender_id'];
		}
		$success = 1;
	}
} else {
	$success = 0;
	$err_msg = 'Error on query.';
}

if ($success == 0) {
	$data = array('success' => $success, 'result' => $err_msg);
} else {
	$data = array('success' => $success, 'result' => $result);
}



generate_json($data);