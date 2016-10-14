<?php 

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$id = $_POST['userID'];
$status = $_POST['status'];
if ($status == 'true') {
	$statusID = 1;
} else {
	$statusID = 2;
}

$query = mysqli_query($conn, "UPDATE `tbl_user_info` SET `status_id` = $statusID WHERE `user_id` = $id");
$success = 1;

$data = array('success' => $success, 'statusID' => $statusID);

generate_json($data);