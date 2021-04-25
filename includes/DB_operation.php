
<?php 

class DbOperations{

	private $con; 

	function __construct(){

		require_once dirname(__FILE__).'/DB_connect.php';

		$db = new DbConnect();

		$this->con = $db->connect();

	}

	

	public function createUser($MED_ID, $Name, $Surname, $Num_Telefon, $Email, $Pass){
	
		$Password= md5($Pass);

		if($this->isUserExist($MED_ID)){

			return 0;
		}
		else{

			$stmt = $this->con->prepare("INSERT INTO `doc_users` (`MED_ID`, `Name`, `Surname`, `Num_Telefon`, `Email`, `Password`) VALUES ( ?, ?, ?, ?, ?, ?);");
			$stmt->bind_param("ssssss",$MED_ID,$Name,$Surname,$Num_Telefon,$Email, $Password);

			if($stmt->execute()){
				return 1; 
			}else{
				return 2; 
			}
		}
		
		
	}

public function isPatientExist($Patient_agrm){
    	$stmt=$this->con->prepare("SELECT * FROM Patient WHERE Patient_agrm = ? ");
		$stmt->bind_param("s",$Patient_agrm);
		$stmt->execute();
		$stmt->store_result();
		return $stmt->num_rows > 0;
}

public function dellPatient($Patient_agrm){
    		$stmt=$this->con->prepare("DELETE FROM Patient WHERE Patient_agrm = ? ");
    		$stmt2=$this->con->prepare("DELETE FROM Doc_Patient WHERE Patient_agrm = ? ");
		$stmt->bind_param("s",$Patient_agrm);
		$stmt2->bind_param("s",$Patient_agrm);
		$stmt->execute();
		$stmt2->execute();
		return 1;
}

	public function createnewPatient($Patient_agrm, $Name, $Surname, $Patronymic, $sex, $weight, $height, $age, $blood_type,$MED_ID){
		
		$stmt = $this->con->prepare(
	"INSERT INTO `Patient` (`Patient_agrm`, `Name`, `Surname`, `Patronymic`, `sex`, `weight`, `height`, `age`, `blood_type`) VALUES
	(?, ?, ?, ?, ?, ?, ?, ?, ?);");

	$stmt2 = $this->con->prepare(
	"INSERT INTO `Doc_Patient` (`MED_ID`, `Patient_agrm`) VALUES(?, ?);");

	$stmt->bind_param("sssssssss",$Patient_agrm,$Name,$Surname,$Patronymic,$sex, $weight, $height, $age, $blood_type);
	$stmt2->bind_param("ss",$MED_ID,$Patient_agrm);

		if($stmt->execute()&&$stmt2->execute()){
			return 1; 
		}else{
			return 2; 
		}

	}



	private function isUserExist($MED_ID ){
		$stmt=$this->con->prepare("SELECT Email FROM doc_users WHERE MED_ID = ? ");
		$stmt->bind_param("s",$MED_ID);
		$stmt->execute();
		$stmt->store_result();
		return $stmt->num_rows > 0;
	}

	public function userLogin($MED_ID,$pass ){

		$password = md5($pass) ;
		$stmt=$this->con->prepare("SELECT Email FROM doc_users WHERE MED_ID = ? AND Password = ? ");
		$stmt->bind_param("ss",$MED_ID,$password);
		$stmt->execute();
		$stmt->store_result();
		return $stmt->num_rows > 0;

	}
	public function GetColPatient($MED_ID){
		$stmt=$this->con->prepare("SELECT * FROM Doc_Patient WHERE MED_ID = ?");
		$stmt->bind_param("s",$MED_ID);
		$stmt->execute();
		$stmt->store_result();
		return $stmt->num_rows;

	}
	public function getPatientbyMed_ID($MED_ID){
		$stmt = $this->con->prepare("SELECT * FROM Patient JOIN Doc_Patient USING (Patient_agrm) WHERE MED_ID = ?");
		$stmt->bind_param("s",$MED_ID);
		$stmt->execute();
	

		return $stmt->get_result()->fetch_all(  $mode = MYSQLI_ASSOC);
	}

	public function getUserByMED_ID($MED_ID){
		$stmt = $this->con->prepare("SELECT * FROM doc_users WHERE MED_ID = ?");
		$stmt->bind_param("s",$MED_ID);
		$stmt->execute();
		return $stmt->get_result()->fetch_assoc();
	}
	



}
