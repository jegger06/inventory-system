<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$posName = trim(mysqli_real_escape_string($conn, $_POST['position']));
$pos_name = strtolower($posName);

$sql = mysqli_query($conn, "SELECT `pos_name` FROM `tbl_user_position` WHERE `pos_name` = '$pos_name' LIMIT 1");
$sql_row = mysqli_num_rows($sql);
if ($sql_row == 0) {
	$data = array('dep' => $pos_name, 'result' => $sql_row, 'pos_name' => $posName);
} else {
	$data = array('dep' => $pos_name, 'result' => $sql_row, 'pos_name' => $posName);
}

generate_json($data);