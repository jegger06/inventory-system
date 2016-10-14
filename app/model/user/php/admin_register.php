<?php 

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$name = [];
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
$depName 	= strtolower(trim(mysqli_real_escape_string($conn, $depname)));
$posName 	= strtolower(trim(mysqli_real_escape_string($conn, $posname)));
$depID 		= $name['department'];
$posID 		= $name['position'];
$username 	= $name['username'];
$email		= $name['email'];
$firstname 	= strtolower($name['firstname']);
$lastname 	= strtolower($name['lastname']);
$password 	= $name['password'];
$hash_password = md5($password);
$fullname = $firstname.' '.$lastname;

// Check if first name, last name, username, email  exists in database
$query = mysqli_query($conn, "SELECT `user_name`, `email`, `first_name`, `last_name` FROM `tbl_user_info`");
$query_num_rows = mysqli_num_rows($query);
$flue = 1;
if ($query_num_rows != 0) {
	$user_name = array();
	$user_email = array();
	$full_name = array();
	while ($row = mysqli_fetch_assoc($query)) {
		array_push($user_name, $row['user_name']);
		array_push($user_email, $row['email']);
		$name = $row['first_name'].' '.$row['last_name'];
		array_push($full_name, $name);
	}
	$error_result = array();
	if(in_array($fullname, $full_name)) {
		$flue = 0;
		array_push($error_result, 'First name and last name already exists.#fullname');
		$success = 0;
	}
	if (in_array($username, $user_name)) {
		$flue = 0;
		array_push($error_result, 'Username already exists.#username');
		$success = 0;
	}
	if (in_array($email, $user_email)) {
		$flue = 0;
		array_push($error_result, 'Email already exists.#email');
		$success = 0;
	}
}

// Check if department id matches the department name
$query_dep = mysqli_query($conn, "SELECT `dep_name` FROM `tbl_user_department` WHERE `dep_id` = $depID LIMIT 1");
$query_num_dep_rows = mysqli_num_rows($query_dep);
if ($query_num_dep_rows == 0) {
	$dep_result = 0;
} else {
	$row_dep = mysqli_fetch_assoc($query_dep);
	$dep_name = $row_dep['dep_name'];
	$dep_result = 1;
}

// Check if position id matches the position name
$query_pos = mysqli_query($conn, "SELECT `pos_name` FROM `tbl_user_position` WHERE `pos_id` = $posID LIMIT 1");
$query_num_pos_rows = mysqli_num_rows($query_pos);
if ($query_num_pos_rows == 0) {
	$pos_result = 0;
} else {
	$row_pos = mysqli_fetch_assoc($query_pos);
	$pos_name = $row_pos['pos_name'];
	$pos_result = 1;

}

// Insert data into table if no error on validation
if ($dep_result == 1 && $pos_result == 1) {
	if ($depName == $dep_name && $posName == $pos_name && $flue == 1) {
		$query = mysqli_query($conn, "INSERT INTO `tbl_user_info`(`pos_id`, `dep_id`, `first_name`, `last_name`, `email`, `user_name`, `user_password`) VALUES ('$posID', '$depID', '$firstname', '$lastname', '$email', '$username', '$hash_password')");
		$success = 1;
	}
}

if (count($error_result) > 0) {
	$data = array('success' => $success, 'result' => $error_result, 'dep_result' => $dep_result, 'pos_result' => $pos_result);
} else {
	$data = array('success' => $success, 'dep_result' => $dep_result, 'pos_result' => $pos_result);
}

generate_json($data);

?>