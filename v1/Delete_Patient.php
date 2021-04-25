<?php 

require_once '../includes/DB_operation.php';

$response = array(); 



if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['Patient_agrm'])){
		//operate the data further 
       // Patient_agrm Name Surname Patronymic sex weight height 	age blood_type
		$db = new DbOperations(); 

		$result = $db->dellPatient( $_POST['Patient_agrm']);


	}else{
		$response['error'] = true; 
		$response['message'] = "Required fields are missing";
	}
}else{
	$response['error'] = true; 
	$response['message'] = "Invalid Request";
}

echo json_encode($response);