<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$sql = mysqli_query($conn, "SELECT `contact_id`, `type` FROM `tbl_user_contact_type`");
if ($sql) {
	$sql_rows = mysqli_num_rows($sql);
	if ($sql_rows == 0) {
		$success = 0;
		$err_msg = 'There is nothing here';
	} else {
		$result = array();
		while ($row = mysqli_fetch_assoc($sql)) {
			$result[] = $row['contact_id'].'#'.				
						ucwords($row['type']);
		}
		$success = 1;
	}
} else {
	$success = 0;
	$err_msg = 'Something is wrong with the query. Please do check it';
}

if ($success == 0) {
	$data = array('success' => $success, 'message' => $err_msg);
} else {
	$data = array('success' => $success, 'result' => $result);
}

generate_json($data);