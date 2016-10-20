<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$id = trim(mysqli_real_escape_string($conn, $_POST['id']));
$department = strtolower(trim(mysqli_real_escape_string($conn, $_POST['dep_name'])));

$sql = mysqli_query($conn, "UPDATE `tbl_user_department` SET `dep_name` = '$department' WHERE `dep_id` = $id");
$success = 1;


$data = array('name' => $department, 'success' => $success);

generate_json($data);