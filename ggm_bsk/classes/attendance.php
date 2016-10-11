<?php 
class Attendance {
	
	public $id = null;
	public $reg_id = null;
	public $class_date = null;
	public $present = null;

	public function __construct($data=array()){
		if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
		if ( isset( $data['reg_id'] ) ) $this->reg_id = (int) $data['reg_id'];
		if ( isset( $data['class_date'] ) ) $this->class_date = (int) $data['class_date'];
		if ( isset( $data['present'] ) ) $this->present = (int) $data['present'];
	}
	
	public function insert( $attendance_array ) {
		if ( !is_null( $this->id ) ) trigger_error ( "Attendance::insert(): Attempt to insert an Attendance object that already has its ID property set (to $this->id).", E_USER_ERROR );
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		foreach($attendance_array as $id=>$present){
			$present = ($present == "1")?1:0;
			$sql = "INSERT INTO attendance ( reg_id, class_date, present ) VALUES (:id, CURDATE(), :present)";
			$st = $conn->prepare ( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->bindValue( ":present", $present, PDO::PARAM_INT );
			$st->execute();
			$this->id = $conn->lastInsertId();
		}
		$conn = null;
	}	

	public function update() {
		if ( is_null( $this->id ) ) trigger_error ( "Attendance::update(): Attempt to update an Attendance object that does not have its ID property set.", E_USER_ERROR );
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "UPDATE attendance SET reg_id=:reg_id, class_date=FROM_UNIXTIME(:class_date), present=:present WHERE id = :id";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":reg_id", $this->reg_type, PDO::PARAM_INT );
		$st->bindValue( ":class_date", $this->bday, PDO::PARAM_INT );
		$st->bindValue( ":present", $this->present, PDO::PARAM_INT );		
		$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
		$st->execute();
		$conn = null;
	}
	
}

?>