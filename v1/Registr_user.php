<?php 

require_once '../includes/DB_operation.php';

$response = array(); 



if($_SERVER['REQUEST_METHOD']=='POST'){
	if(
		isset($_POST['MED_ID']) and 
			isset($_POST['Name']) and 
				isset($_POST['Surname'])and 
				isset($_POST['Num_Telefon'])
				and isset($_POST['Email'])
				and isset($_POST['Password'])
	){
		//operate the data further 

		$db = new DbOperations(); 

		$result = $db->createUser( 	$_POST['MED_ID'],
									$_POST['Name'],
									$_POST['Surname'],
									$_POST['Num_Telefon'],
									$_POST['Email'],
									$_POST['Password']);

		if($result == 1){
			$response['error'] = false; 
			$response['message'] = "User registered successfully";
		}elseif($result == 2){
			$response['error'] = true; 
			$response['message'] = "Some error occurred please try again";			
		}elseif($result == 0){
			$response['error'] = true; 
			$response['message'] = "It seems you are already registered, please choose a different email and username";						
		}

	}else{
		$response['error'] = true; 
		$response['message'] = "Required fields are missing";
	}
}else{
	$response['error'] = true; 
	$response['message'] = "Invalid Request";
}

echo json_encode($response);