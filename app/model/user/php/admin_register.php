<?php 

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$name = [];
// for ($i=0; $i < count($_POST['data']); $i++) { 
// 	$name[str_replace('_', '', $_POST['data'][$i]['name'])] = );
// }
foreach ($_POST['data'] as $key => $value) {
	$name[str_replace('_', '', $value['name'])] = trim(mysqli_real_escape_string($conn, $value['value']));
}
// $username 	= trim(mysqli_real_escape_string($conn, $_POST['data'][0]['value']));
// $email		= trim(mysqli_real_escape_string($conn, $_POST['data'][1]['value']));
// $firtname	= trim(mysqli_real_escape_string($conn, $_POST['data'][2]['value']));
// $lastname 	= trim(mysqli_real_escape_string($conn, $_POST['data'][3]['value']));
// $depID 		= trim(mysqli_real_escape_string($conn, $_POST['data'][4]['value']));
// $posID 		= trim(mysqli_real_escape_string($conn, $_POST['data'][5]['value']));
// $password 	= trim(mysqli_real_escape_string($conn, $_POST['data'][6]['value']));
$depname 	= trim(mysqli_real_escape_string($conn, $_POST['dep_name']));
$posname 	= trim(mysqli_real_escape_string($conn, $_POST['pos_name']));
$depName 	= strtolower($depname);
$posName 	= strtolower($posname);
$depID 		= $name['department'];
$posID 		= $name['position'];
$username 	= $name['username'];
$email		= $name['email'];
$firstname 	= strtolower($name['firstname']);
$lastname 	= strtolower($name['lastname']);
$password 	= $name['password'];
$hash_password = md5($password);

$query = mysqli_query($conn, "SELECT `dep_name` FROM `tbl_user_department` WHERE `dep_id` = $depID LIMIT 1");
$query_num_rows = mysqli_num_rows($query);
if ($query_num_rows == 0) {
	$dep_result = 0;
} else {
	$row = mysqli_fetch_assoc($query);
	$dep_name = $row['dep_name'];
	$dep_result = 1;
}

$query = mysqli_query($conn, "SELECT `pos_name` FROM `tbl_user_position` WHERE `pos_id` = $posID LIMIT 1");
$query_num_rows = mysqli_num_rows($query);
if ($query_num_rows == 0) {
	$pos_result = 0;
} else {
	$row = mysqli_fetch_assoc($query);
	$pos_name = $row['pos_name'];
	$pos_result = 1;
}

if ($depName == $dep_name && $posName == $pos_name) {
	$query = mysqli_query($conn, "INSERT INTO `tbl_user_info`(`pos_id`, `dep_id`, `first_name`, `last_name`, `email`, `user_name`, `user_password`) VALUES ('$posID', '$depID', '$firstname', '$lastname', '$email', '$username', '$hash_password')");
	$success = 1;
} else {
	$success = 0;
}

$data = array('success' => $success);

generate_json($data);


// Still missing the validation of unique user name and email.
// Missing check of full name in database if it exists.

?>