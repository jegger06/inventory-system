<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$depName = trim(mysqli_real_escape_string($conn, $_POST['department']));
$dep_name = strtolower($depName);

$sql = mysqli_query($conn, "SELECT `dep_name` FROM `tbl_user_department` WHERE `dep_name` = '$dep_name' LIMIT 1");
$sql_row = mysqli_num_rows($sql);
if ($sql_row == 0) {
	$data = array('dep' => $dep_name, 'result' => $sql_row);
} else {
	$data = array('dep' => $dep_name, 'result' => $sql_row);
}

generate_json($data);