<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';


$userID = trim(mysqli_real_escape_string($conn, $_POST['userID']));

$sql = mysqli_query($conn, "SELECT c.id, c.contact_number, p.prefix, t.contact_id, t.type FROM tbl_user_contact c INNER JOIN tbl_contact_prefix p ON c.prefix_id = p.prefix_id INNER JOIN tbl_user_contact_type t ON p.contact_id = t.contact_id WHERE c.user_id = $userID");
if ($sql) {
	$sql_rows = mysqli_num_rows($sql);
	if ($sql_rows == 0) {
		$success = 0;
		$err_msg = 'No contact details to display';
	} else {
		$result = array();

		while ($row = mysqli_fetch_assoc($sql)) {

			$result[] = $row['id'].'#'.
						$row['contact_id'].'#'.
						ucwords($row['type']).'#'.
						$row['prefix'].'#'.
						$row['contact_number'];
			
		}
		$success = 1;
	}
} else {
	$success = 0;
	$err_msg = 'Something is wrong on query';
}

if ($success == 0) {
	$data = array('success' => $success, 'message' => $err_msg);
} else {
	$data = array('success' => $success, 'result' => $result);
}

generate_json($data);