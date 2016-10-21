<?php 

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$id = trim(mysqli_real_escape_string($conn, $_POST['userID']));
$status = trim(mysqli_real_escape_string($conn, $_POST['status']));
$waiting = trim(mysqli_real_escape_string($conn, $_POST['waiting']));
$unlocked = trim(mysqli_real_escape_string($conn, $_POST['unlocked']));

if ($status == 'true') {
	$statusID = 1;
} else {
	$statusID = 2;
}

$query = "UPDATE `tbl_user_info` SET `status_id` = $statusID";


if ($waiting == true || $unlocked == true) {
	$query .= ", `attempt` = 1 ";
}

$query .= " WHERE `user_id` = $id";

$query_run = mysqli_query($conn, $query);

$success = 1;

$data = array('success' => $success, 'statusID' => $statusID);

generate_json($data);