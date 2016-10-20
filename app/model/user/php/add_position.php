<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$pos = trim(mysqli_real_escape_string($conn, $_POST['position']));
$position = strtolower($pos);

$sql = mysqli_query($conn, "INSERT INTO `tbl_user_position`(`pos_name`) VALUES ('$position')");
$success = 1;

$data = array('success' => $success, 'pos' => $pos, 'position' => $position);

generate_json($data);