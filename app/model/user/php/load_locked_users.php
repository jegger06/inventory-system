<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$depID = trim(mysqli_real_escape_string($conn, $_POST['depID']));
$posID = trim(mysqli_real_escape_string($conn, $_POST['posID']));
$search_key = trim(mysqli_real_escape_string($conn, $_POST['search']));
$per_page = trim(mysqli_real_escape_string($conn, $_POST['per_page']));
$page_num = trim(mysqli_real_escape_string($conn, $_POST['page_num']));

$page_num = $page_num > 1 ? $page_num - 1 : 0;
$page_num = $page_num * $per_page;

$perPage = array('5', '10', '15', '20', '30');

// Check if department id matches the dep_id on database
$departmentID = null;
if ($depID != null) {
	$query_dep = mysqli_query($conn, "SELECT `dep_id` FROM `tbl_user_department` WHERE `dep_id` = $depID LIMIT 1");
	if ($query_dep) {
		$query_dep_row = mysqli_num_rows($query_dep);
		if ($query_dep_row == 0) {
			$departmentID = null;
		} else {
			$row_dep = mysqli_fetch_assoc($query_dep);
			$departmentID = $row_dep['dep_id'];
		}
	}
}
// Check if position id matches the pos_id on database
$positionID = null;
if ($posID != null) {
	$query_pos = mysqli_query($conn, "SELECT `pos_id` FROM `tbl_user_position` WHERE `pos_id` = $posID LIMIT 1");
	if ($query_pos) {
		$query_pos_row = mysqli_num_rows($query_pos);
		if ($query_pos_row == 0) {
			$positionID = null;
		} else {
			$row_pos = mysqli_fetch_assoc($query_pos);
			$positionID = $row_pos['pos_id'];
		}
	}
}

// Query locked users
$sql = "SELECT i.user_id, i.first_name, i.last_name, i.email, i.user_name, d.dep_name, p.pos_name FROM tbl_user_info i LEFT JOIN tbl_user_department d ON i.dep_id = d.dep_id LEFT JOIN tbl_user_position p ON i.pos_id = p.pos_id ";

$sql_condition = "WHERE";

if (!is_null($departmentID) || !empty($departmentID)) {
	$sql .= "$sql_condition i.dep_id = $departmentID ";
	$sql_condition = 'AND';
}

if (!is_null($positionID) || !empty($positionID)) {
	$sql .= "$sql_condition i.pos_id = $positionID ";
	$sql_condition = 'AND ';
}

if ($search_key != '') {
	$sql .= "$sql_condition (i.first_name LIKE '%$search_key%' || i.last_name LIKE '%$search_key%' || i.email LIKE '%$search_key%' || i.user_name LIKE '%$search_key%')";
	$sql_condition = 'AND ';
}

if ($search_key == '' && (is_null($departmentID) || empty($departmentID)) && (is_null($positionID) || empty($positionID))) {
	$sql .= "WHERE";
} else {
	$sql .= " AND";
}

$sql .= " i.status_id = 2 AND i.attempt = 6 ORDER BY i.first_name";

if (in_array($per_page, $perPage)) {
	$sql .= " LIMIT $page_num, $per_page";
}

$sql_query = mysqli_query($conn, $sql);

if ($sql_query) {
	$sql_num_rows = mysqli_num_rows($sql_query);
	if ($sql_num_rows == 0) {
		$success = 0;
		$err_message = 'No results found.';
	} else {
		$result = array();
		while ($row = mysqli_fetch_assoc($sql_query)) {
			$result[] = $row['user_id'].'#'.
						ucwords($row['first_name']).'#'.
						ucwords($row['last_name']).'#'.
						$row['user_name'].'#'.
						$row['email'].'#'.
						ucwords($row['dep_name']).'#'.
						ucwords($row['pos_name']);
		}
		$success = 1;
	}
} else {
	$success = 0;
	$err_message = 'Something is wrong with the query';
}



// Query total locked users
$sql_total = "SELECT COUNT(`user_id`) AS `total_users` FROM `tbl_user_info` ";

$sql_total_condition = "WHERE";

if (!is_null($departmentID) || !empty($departmentID)) {
	$sql_total .= "$sql_total_condition `dep_id` = $departmentID ";
	$sql_total_condition = 'AND';
}

if (!is_null($positionID) || !empty($positionID)) {
	$sql_total .= "$sql_total_condition `pos_id` = $positionID ";
	$sql_total_condition = 'AND ';
}

if ($search_key != '') {
	$sql_total .= "$sql_total_condition (`first_name` LIKE '%$search_key%' || `last_name` LIKE '%$search_key%' || `email` LIKE '%$search_key%' || `user_name` LIKE '%$search_key%')";
	$sql_total_condition = 'AND ';
}

if ($search_key == '' && (is_null($departmentID) || empty($departmentID)) && (is_null($positionID) || empty($positionID))) {
	$sql_total .= "WHERE";
} else {
	$sql_total .= " AND";
}

$sql_total .= " status_id = 2 AND attempt = 6";

$sql_total_query = mysqli_query($conn, $sql_total);

$data = mysqli_fetch_assoc($sql_total_query);
$total_users = $data['total_users'];




if ($success == 0) {
	$data = array('success' => $success, 'result' => $err_message, 'total_users' => $total_users);
} else {
	$data = array('success' => $success, 'result' => $result, 'total_users' => $total_users);
}


generate_json($data);