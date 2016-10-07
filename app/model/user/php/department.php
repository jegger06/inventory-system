<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$query = mysqli_query($conn, "SELECT `dep_id`, `dep_name` FROM `tbl_user_department` ORDER BY `dep_id`");
$query_num_rows = mysqli_num_rows($query);
if ($query_num_rows == 0) {
	$success = 0;
} else {
	$result = array();
	while ($row = mysqli_fetch_assoc($query)) {
		$result[] = $row['dep_id']."#".
					ucwords($row['dep_name']);
	}
	$success = 1;
}

$data = array('success' => $success, 'result' => $result);

generate_json($data);

?>