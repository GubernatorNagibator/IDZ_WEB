<?php 

require_once '../includes/DB_operation.php';

$response = array(); 

if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_POST['MED_ID'])){
		$db = new DbOperations(); 
        $colPatient = $db->GetColPatient($_POST['MED_ID']);
		if($colPatient>0){

			$user = $db->getPatientbyMed_ID($_POST['MED_ID']);

			$response['error'] = false; 
			echo json_encode($user,JSON_UNESCAPED_UNICODE);
			
		}else{
			$response['error'] = true; 
			$response['message'] = "Any patient was not found";			
		}

	}else{
		$response['error'] = true; 
		$response['message'] = "Required fields are missing";
	}
}

echo json_encode($response);