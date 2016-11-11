<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$contactID = trim(mysqli_real_escape_string($conn, $_POST['type_id']));

$sql = mysqli_query($conn, "SELECT `contact_id`, `prefix` FROM `tbl_contact_prefix` WHERE `contact_id` = $contactID");
if ($sql) {
	$sql_rows = mysqli_num_rows($sql);
	if ($sql_rows == 0) {
		$success = 0;
		$err_msg = 'There is nothing to see here';
	} else {
		$result = array();

		while ($row = mysqli_fetch_assoc($sql)) {

			$result[] = $row['contact_id'].'#'.
						$row['prefix'];

		}
		$success = 1;
	}
} else {
	$success = 0;
	$err_msg = 'Something is wrong with the query. Please check it.';
}

if ($success == 0) {
	$data = array('success' => $success, 'message' => $err_msg);
} else {
	$data = array('success' => $success, 'result' => $result);
}

generate_json($data);