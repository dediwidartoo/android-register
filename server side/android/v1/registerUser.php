<?php 

require_once '../includes/DbOperations.php';
$response = array();  

if ($_SERVER['REQUEST_METHOD']=='POST') {
	if (
		isset($_POST['username']) and
			isset($_POST['email']) and
				isset($_POST['password'])
	){
		$db = new DbOperations();

		$result = $db->createUser(
			$_POST['username'],
			$_POST['password'],
			$_POST['email']
		);
		if ($result == 1){
			$response['error'] = false;
			$response['message'] = "Pendaftaran user baru telah berhasil";
		} elseif ($result == 2) {
			$response['error'] = true;
			$response['message'] = "Terjadi kesalahan, silahkan ulangi!";
		} elseif ($result == 0) {
			$response['error'] = true;
			$response['message'] = "Akun sudah pernah digunakan, silahkan gunakan username dan email yang lain!";
		}
	} else {
		$response['error'] = true;
		$response['message'] = "Required Fields are missing";
	}
	
} else {
	$response['error'] = true;
	$response['message'] = "Invalid Request";
}

echo json_encode($response);
