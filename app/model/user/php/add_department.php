<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$dep = trim(mysqli_real_escape_string($conn, $_POST['department']));
$department = strtolower($dep);

$sql = mysqli_query($conn, "INSERT INTO `tbl_user_department`(`dep_name`) VALUES ('$department')");
$success = 1;

$data = array('success' => $success, 'dep' => $dep, 'department' => $department);

generate_json($data);