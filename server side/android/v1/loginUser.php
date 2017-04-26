<?php 

require_once '../includes/DbOperations.php';
$response = array();  

if ($_SERVER['REQUEST_METHOD']=='POST') {
	if (isset($_POST['username']) and isset($_POST['password'])) {
		$db = new DbOperations();
		if ($db->loginUser($_POST['username'], $_POST['password'])) {
			$user = $db->getUserByUsername($_POST['username']);
			$response['error'] = false;
			$response['id_user'] = $user['id_user'];
			$response['email'] = $user['email'];
			$response['username'] = $user['username'];
		} else {
			$response['error'] = true;
			$response['message'] = "Username atau password salah";
		}
	} else {
		$response['error'] = true;
		$response['message'] = "Required field are missing";
	}
}

echo json_encode($response);