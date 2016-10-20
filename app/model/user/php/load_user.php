<?php 

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$depID = trim(mysqli_real_escape_string($conn, $_POST['depID']));
$posID = trim(mysqli_real_escape_string($conn, $_POST['posID']));
$statID = trim(mysqli_real_escape_string($conn, $_POST['statID']));
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
// Check if status id matches the status_id on database
$statusID = null;
if ($statID != null) {
	$query_stat = mysqli_query($conn, "SELECT `status_id` FROM `tbl_user_status` WHERE `status_id` = $statID LIMIT 1");
	if ($query_stat) {
		$query_stat_row = mysqli_num_rows($query_stat);
		if ($query_stat_row == 0) {
			$statusID = null;
		} else {
			$row_stat = mysqli_fetch_assoc($query_stat);
			$statusID = $row_stat['status_id'];
		}
	}
}
// Query the users table
$query_users = "SELECT i.user_id, i.first_name, i.last_name, i.email, i.user_name, d.dep_name, p.pos_name, s.status_name FROM tbl_user_info i LEFT JOIN tbl_user_department d ON i.dep_id = d.dep_id LEFT JOIN tbl_user_position p ON i.pos_id = p.pos_id LEFT JOIN tbl_user_status s ON i.status_id = s.status_id ";

$query_condition = "WHERE";

if (!is_null($departmentID) || !empty($departmentID)) {
	$query_users .= "$query_condition i.dep_id = $departmentID ";
	$query_condition = 'AND';
}

if (!is_null($positionID) || !empty($positionID)) {
	$query_users .= "$query_condition i.pos_id = $positionID ";
	$query_condition = 'AND ';
}

if (!is_null($statusID) || !empty($statusID)) {
	$query_users .= "$query_condition i.status_id = $statusID ";
	$query_condition = 'AND ';
}

if ($search_key != '') {
	$query_users .= "$query_condition (i.first_name LIKE '%$search_key%' || i.last_name LIKE '%$search_key%' || i.email LIKE '%$search_key%' || i.user_name LIKE '%$search_key%')";
	$query_condition = 'AND ';
}

if ((is_null($departmentID) || empty($departmentID)) && (is_null($positionID) || empty($positionID)) && (is_null($statusID) || empty($statusID)) && $search_key == '' ) {
	$query_users .= "WHERE";
} else {
	$query_users .= "AND";
}

$query_users .=  " i.attempt IN (1,2,3,4,5) ORDER BY i.first_name";

if (in_array($per_page, $perPage)) {
	$query_users .= " LIMIT $page_num, $per_page";
}


$query = mysqli_query($conn, $query_users);


if ($query) {
	$query_num_rows = mysqli_num_rows($query);
	if ($query_num_rows == 0) {
		$success = 0;
		$err_msg = 'No results found.';
	} else {
		$result = array();
		while ($row = mysqli_fetch_assoc($query)) {
			$result[] = $row['user_id'].'#'.
						ucwords($row['first_name']).'#'.
						ucwords($row['last_name']).'#'.
						$row['email'].'#'.
						$row['user_name'].'#'.
						ucwords($row['dep_name']).'#'.
						ucwords($row['pos_name']).'#'.
						$row['status_name'];
		}
		$success = 1;
	}
} else {
	$success = 0;
	$result = 0;
}

$sql = "SELECT COUNT(`user_id`) AS `total_users` FROM `tbl_user_info` ";

$sql_condition = "WHERE";


if (!is_null($departmentID) || !empty($departmentID)) {
	$sql .= "$sql_condition `dep_id` = $departmentID ";
	$sql_condition = 'AND';
}

if (!is_null($positionID) || !empty($positionID)) {
	$sql .= "$sql_condition `pos_id` = $positionID ";
	$sql_condition = 'AND ';
}

if (!is_null($statusID) || !empty($statusID)) {
	$sql .= "$sql_condition `status_id` = $statusID ";
	$sql_condition = 'AND ';
}

if ($search_key != '') {
	$sql .= "$sql_condition (`first_name` LIKE '%$search_key%' || `last_name` LIKE '%$search_key%' || `email` LIKE '%$search_key%' || `user_name` LIKE '%$search_key%')";
	$sql_condition = 'AND ';
}

if ((is_null($departmentID) || empty($departmentID)) && (is_null($positionID) || empty($positionID)) && (is_null($statusID) || empty($statusID)) && $search_key == '' ) {
	$sql .= "WHERE";
} else {
	$sql .= "AND";
}

$sql .=  " attempt IN (1,2,3,4,5)";

$sql_query = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($sql_query);
$total_users = $data['total_users'];

if ($success == 0) {
	$data = array('success' => $success, 'result' => $err_msg, 'depID' => $depID, 'departmentID' => $departmentID, 'total_users' => $total_users);
} else{
	$data = array('success' => $success, 'result' => $result, 'total_result' => $query_num_rows, 'depID' => $depID, 'departmentID' => $departmentID, 'total_users' => $total_users, 'query' => $query_users);
}

generate_json($data);

