<?php 

require_once '../includes/DB_operation.php';

$response = array(); 



if($_SERVER['REQUEST_METHOD']=='POST'){
	if(
		isset($_POST['Patient_agrm']) and 
			isset($_POST['Name']) and 
				isset($_POST['Surname'])and 
				isset($_POST['Patronymic'])
				and isset($_POST['sex'])
				and isset($_POST['weight'])
                and isset($_POST['height'])
                and isset($_POST['age'])
                and isset($_POST['blood_type'])
                and isset($_POST['MED_ID'])
	){
		//operate the data further 
       // Patient_agrm Name Surname Patronymic sex weight height 	age blood_type
		$db = new DbOperations(); 
if(!$db->isPatientExist($_POST['Patient_agrm'])){
		$result = $db->createnewPatient( $_POST['Patient_agrm'],
									$_POST['Name'],
									$_POST['Surname'],
									$_POST['Patronymic'],
									$_POST['sex'],
									$_POST['weight'],
									$_POST['height'],
									$_POST['age'],
									$_POST['blood_type'],
									$_POST['MED_ID']);
}
else{
    $response['error'] = true; 
		$response['message'] = "Такой пациент уже зарегистрирован";
		echo json_encode($response);
}
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