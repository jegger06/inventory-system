<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$userID = trim(mysqli_real_escape_string($conn, $_POST['userID']));


$sql = mysqli_query($conn, "SELECT i.profile_pic, i.pos_id, p.pos_name FROM tbl_user_info i LEFT JOIN tbl_user_position p ON i.pos_id = p.pos_id WHERE i.user_id = $userID LIMIT 1");

$row = mysqli_fetch_assoc($sql);
$position = ucfirst($row['pos_name']);
$img = $row['profile_pic'];
if (empty($img) || is_null($img)) {
	$profile = 0;
} else {
	$profile = $img;
}


$success = 1;

if ($success == 1) {

	$data = array('success' => $success, 'image' => $profile, 'position' => $position);

}

generate_json($data);