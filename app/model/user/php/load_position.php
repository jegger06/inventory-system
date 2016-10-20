<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$per_page = trim(mysqli_real_escape_string($conn, $_POST['per_page']));
$search_key = trim(mysqli_real_escape_string($conn, $_POST['search']));
$search_key = strtolower($search_key);
$page_num = trim(mysqli_real_escape_string($conn, $_POST['page_num']));

$page_num = $page_num > 1 ? $page_num - 1 : 0;
$page_num = $page_num * $per_page;


$perPage = array('5', '10', '15', '20');

$sql_query = "SELECT p.pos_id, p.pos_name, COALESCE(COUNT(i.pos_id), 0) AS num_users FROM tbl_user_position p LEFT JOIN tbl_user_info i ON p.pos_id = i.pos_id ";

$sql_condition = "WHERE";

if ($search_key != '') {
	$sql_query .= "$sql_condition d.dep_name LIKE '%$search_key%' ";
	$sql_condition = "AND ";
}

$sql_query .= "GROUP by p.pos_id ORDER BY num_users DESC";

if (in_array($per_page, $perPage)) {
	$sql_query .= " LIMIT $page_num, $per_page";
	$perPage = $per_page;
} else {
	$per_page = 5;
	$page_num = $page_num > 1 ? $page_num - 1 : 0;
	$page_num = $page_num * $per_page;
	$sql_query .= " LIMIT $page_num, $per_page ";
	$perPage = 5;
}


$sql = mysqli_query($conn, $sql_query);

if ($sql) {
	$sql_num_rows = mysqli_num_rows($sql);
	if ($sql_num_rows == 0) {
		$success = 0;
		$err_msg = 'No results found.';
	} else {
		$result = array();
		while($row = mysqli_fetch_assoc($sql)) {
			$result[] = $row['pos_id'].'#'.
						ucwords($row['pos_name']).'#'
						.$row['num_users'];
		}
		$success = 1;
	}
} else {
	$success = 0;
	$result = 0;
}


$sql_dep = "SELECT COUNT(`pos_id`) AS `total_position` FROM `tbl_user_position` ";

$sql_dep_condition = "WHERE";

if ($search_key != '') {
	$sql_dep .= "$sql_dep_condition dep_name LIKE '%$search_key%'";
	$sql_dep_condition = 'AND ';
}

$sql_dep_query = mysqli_query($conn, $sql_dep);
if ($sql_dep_query) {
	$data = mysqli_fetch_assoc($sql_dep_query);
	$total_position = $data['total_position'];
} else {
	$total_position = 0;
}





if ($success == 0) {
	$data = array('success' => $success, 'result' => $err_msg, 'total_position' => $total_position, 'perPage' => $perPage);
} else {
	$data = array('success' => $success, 'result' => $result, 'total_position' => $total_position, 'perPage' => $perPage);
}


generate_json($data);