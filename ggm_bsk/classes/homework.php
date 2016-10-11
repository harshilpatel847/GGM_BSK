<?php 
class Homework {
	
	public $id = null;
	public $reg_id = null;
	public $homework_date = null;
	public $assignment_num = null;
	public $homework_score = null;

	public function __construct($data=array()){
		if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
		if ( isset( $data['reg_id'] ) ) $this->reg_id = (int) $data['reg_id'];
		if ( isset( $data['homework_date'] ) ) $this->homework_date = (int) $data['homework_date'];
		if ( isset( $data['assignment_num'] ) ) $this->assignment_num = (int) $data['assignment_num'];
		if ( isset( $data['homework_score'] ) ) $this->homework_score = (int) $data['homework_score'];
	}
	
	public function insert( $homework_array ) {
		if ( !is_null( $this->id ) ) trigger_error ( "Homework::insert(): Attempt to insert an Homework object that already has its ID property set (to $this->id).", E_USER_ERROR );
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		foreach($homework_array as $reg_id=>$homework_score){
			$homework_score = ($homework_score == "1")?1:0;
			if ( $reg_id > 0 ) {
				$sql = "INSERT INTO homework ( reg_id, homework_date, assignment_num, homework_score ) VALUES ( :reg_id, CURDATE(), :assignment_number , :homework_score )";
				$st = $conn->prepare ( $sql );
				$st->bindValue(":reg_id", $reg_id, PDO::PARAM_INT);
				$st->bindValue(":assignment_number", $homework_array['number'], PDO::PARAM_INT);
				$st->bindValue(":homework_score", $homework_score, PDO::PARAM_INT);
				$st->execute();
				$this->id = $conn->lastInsertId();
			}
		}
		$conn = null;
	}	
	
/* 	public function homeworkGrade( $id ) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT * FROM homework WHERE id = :id";	
		$st = $conn->prepare( $sql );
		$st->bindValue( ":id", $id, PDO::PARAM_INT );
		$st->execute();
		$row = $st->fetch();	
		$conn = null;
		if ( $row ) return new Homework( $row );
	} */
	
}

?>