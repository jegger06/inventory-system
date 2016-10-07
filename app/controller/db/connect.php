<?php

include dirname(__DIR__).'/config/credential.php';

$conn = mysqli_connect($server_name, $db_user_name, $db_password);
$db_conn = mysqli_select_db($conn, $db_name);

if (!$conn || !$db_conn) {
	die("Connection failed: " . mysqli_connect_error());
}