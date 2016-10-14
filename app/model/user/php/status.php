<?php 

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$query = mysqli_query($conn, "SELECT `status_id`, `status_name` FROM `tbl_user_status` ORDER BY `status_id`");
$query_num_rows = mysqli_num_rows($query);
if ($query_num_rows == 0) {
	$success = 0;
} else {
	$result = array();
	while ($row = mysqli_fetch_assoc($query)) {
		$result[] = $row['status_id']."#".
					ucwords($row['status_name']);
	}
	$success = 1;
}

$data = array('success' => $success, 'result' => $result);

generate_json($data);