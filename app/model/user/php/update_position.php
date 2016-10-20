<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$id = trim(mysqli_real_escape_string($conn, $_POST['id']));
$position = strtolower(trim(mysqli_real_escape_string($conn, $_POST['pos_name'])));

$sql = mysqli_query($conn, "UPDATE `tbl_user_position` SET `pos_name` = '$position' WHERE `pos_id` = $id");
$success = 1;


$data = array('name' => $position, 'success' => $success);

generate_json($data);