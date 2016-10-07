<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$query = mysqli_query($conn, "SELECT `pos_id`, `pos_name` FROM `tbl_user_position` ORDER BY `pos_id`");
$query_num_rows = mysqli_num_rows($query);
if ($query_num_rows == 0) {
	$success = 0;
} else {
	$result = array();
	while ($row = mysqli_fetch_assoc($query)) {
		$result[] = $row['pos_id']."#".
					ucwords($row['pos_name']);
	}
	$success = 1;
}

$data = array('success' => $success, 'result' => $result);

generate_json($data);

?>