<?php 

require_once '../includes/DB_operation.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_POST['MED_ID']) and isset($_POST['Password'])){
		$db = new DbOperations(); 

		if($db->userLogin($_POST['MED_ID'], $_POST['Password'])){
			$user = $db->getUserByMED_ID($_POST['MED_ID']);

			$response['error'] = false; 
			$response['MED_ID'] = $user['MED_ID'];
			$response['Email'] = $user['Email'];
			$response['Name'] = $user['Name'];
			$response['Surname'] = $user['Surname'];
			$response['Num_Telefon'] = $user['Num_Telefon'];
			
			
		}else{
			$response['error'] = true; 
			$response['message'] = "Invalid username or password";			
		}

	}else{
		$response['error'] = true; 
		$response['message'] = "Required fields are missing";
	}
}

echo json_encode($response);