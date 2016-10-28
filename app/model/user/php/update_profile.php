<?php

require '../../../controller/db/connect.php';
require '../../../controller/helpers/generate_json.php';

$profile 	= $_FILES['profile_pic'];
$firstname 	= strtolower(trim(mysqli_real_escape_string($conn, $_POST['first_name'])));
$middlename = strtolower(trim(mysqli_real_escape_string($conn, $_POST['middle_name'])));
$lastname 	= strtolower(trim(mysqli_real_escape_string($conn, $_POST['last_name'])));
$gender 	= trim(mysqli_real_escape_string($conn, $_POST['gender']));
$userID 	= trim(mysqli_real_escape_string($conn, $_POST['userID']));

// The previous values of form on load of  the page
$previous_first_name	= trim(mysqli_real_escape_string($conn, $_POST['fname']));
$previous_middle_name	= trim(mysqli_real_escape_string($conn, $_POST['mname']));
$previous_last_name		= trim(mysqli_real_escape_string($conn, $_POST['lname']));
$previous_gender		= trim(mysqli_real_escape_string($conn, $_POST['pgender']));


$flag = false;
$new_file_name = '';
$file_size = 0;

// Check if currently logged in user has already a profile pic.

$query_image = mysqli_query($conn, "SELECT `profile_pic` FROM `tbl_user_info` WHERE `user_id` = $userID LIMIT 1");
$isImg = mysqli_fetch_assoc($query_image);
if ($query_image) {
	$query_img_row = mysqli_num_rows($query_image);
	if (is_null($isImg['profile_pic']) || empty($isImg['profile_pic'])) {
		$profile_img = 0;
		$img = 0;
	} else {
		$profile_img = $isImg['profile_pic'];
		$img = 1;
	}
}

// Check if the previous first name and last name exists on database

$details_query = mysqli_query($conn, "SELECT `user_id` FROM `tbl_user_info` WHERE `first_name` = '$firstname' AND `last_name` = '$lastname' LIMIT 1");
if ($details_query) {
	$details_query_rows = mysqli_num_rows($details_query);
	if ($details_query_rows == 0) {
		$status = 1;
		$message = 'No match found';
	} else {
		$row = mysqli_fetch_assoc($details_query);
		$match_userID = $row['user_id'];
		if ($userID == $match_userID) {
			$status = 1;
			$message = 'It is the same account';
		} else {
			$status = 0;
			$err_msg = 'The account already exists.';
		}
	}
}

// Checked if userID of the currently logged in user matches the userID of the returned query of details_query
if ($status == 1) {
	$update_query =  "UPDATE `tbl_user_info` SET `first_name` = '$firstname', `middle_name` = '$middlename', `last_name` = '$lastname', `gender_id` = $gender";

	if (!empty($profile['name'])) {

		$allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');

		$file_name = strtolower($profile['name']); // Name of the file from the form.
		$file_size = $profile['size'];
		$max_size = 1000000; // 1mb maximum file size of image.
		$file_extension = end(explode('.', $file_name)); // Get the extension of the file.
		$file_temp = $profile['tmp_name']; // File is temporary stored.

		if (in_array($file_extension, $allowed_extensions)) { // Check if the file extensions is in array.
			
			if ($file_size < $max_size) { // Check if file size is less than 1mb.


				// Save the file on the uploads/img folder and save the file path on the database.
				$new_file_name = '/uploads/img/' . substr(md5(time()), 0, 10) . '.' . $file_extension; // Changed the file name
				$file_path = $_SERVER['DOCUMENT_ROOT'] . $new_file_name; // Path of the folder in which it will be saved

				if($img == 1) {
					$delete_img = $_SERVER['DOCUMENT_ROOT'] . $profile_img;
					unlink($delete_img);
				}
				
				move_uploaded_file($file_temp, $file_path); // Moved the image file into the folder


				$update_query .= ", `profile_pic` = '$new_file_name'";
				$img_status = 1;
			} else {
				$img_status = 0;
				$err_msg = 'The image is too much. Maximum file size is 1mb.';
			}

		} else {

			$img_status = 0;
			$err_msg = 'Incorrect file type: Allowed files are: '. implode(', ', $allowed_extensions);
		}

	} else {

		$img_status = 1;

	}

	$update_query .= " WHERE `user_id` = $userID";

	if ($img_status == 1) {

		$update_sql = mysqli_query($conn, $update_query);

		$success = 1;
	} else {
		$success = 0;
	}


} else {

	$success = 0;

}

if ($success == 0) {
	$data = array('success' => $success, 'message' => $err_msg);
} else {
	$data = array('success' => $status, 'message' => $message, 'name' => ucfirst($firstname) . ' ' . ucfirst($lastname), 'image' => $new_file_name);
}


generate_json($data);