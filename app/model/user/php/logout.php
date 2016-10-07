<?php 

session_start();

$id = $_POST['userID'];

if (isset($_SESSION['user_id'])) {
	session_destroy();
	$data = 1;
} else {
	$data = 2;
}

$result = array('result' => $data);

echo json_encode($result);

?>