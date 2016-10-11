<?php	
class Registrants {
	public $id = null;
	public $reg_type = null;
	public $f_name = null;
	public $l_name = null;
	public $bday = null;
	public $age_group = null;
	public $address = null;
	public $city = null;
	public $zip = null;
	public $home_phone = null;
	public $mobile_phone = null;
	public $mother_name = null;
	public $father_name = null;
	public $email = null;
	public $emergency_contact = null;
	public $emergency_phone = null;
	public $medical_conditions = null;
	public $paid = null;
	public $last_modified = null;
	public $waiver_signed = null;
	public $grade = null;
	public $team = null;
	public $enrollment_status = null;
	
    public function __construct( $data=array() ) {
      if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
	  if ( isset( $data['reg_type'] ) ) $this->reg_type = $data['reg_type'];
      if ( isset( $data['f_name'] ) ) $this->f_name = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['f_name'] );
	  if ( isset( $data['l_name'] ) ) $this->l_name = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['l_name'] );
	  if ( isset( $data['bday'] ) ) $this->bday = (int) $data['bday'];
	  if ( isset( $data['age_group'] ) ) $this->age_group = $data['age_group'];
	  if ( isset( $data['address'] ) ) $this->address = preg_replace ( "/[^\,\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['address'] );
	  if ( isset( $data['city'] ) ) $this->city = preg_replace ( "/[^\,\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['city'] );
	  if ( isset( $data['zip'] ) ) $this->zip = (int) $data['zip'];
	  if ( isset( $data['home_phone'] ) ) $this->home_phone = preg_replace ( "/[^\.\,\_\'\"\@\?\!\:\$\s+ 0-9()]/", "", $data['home_phone'] );
	  if ( isset( $data['mobile_phone'] ) ) $this->mobile_phone = preg_replace ( "/[^\.\,\_\'\"\@\?\!\:\$ 0-9()]/", "", $data['mobile_phone'] );
	  if ( isset( $data['mother_name'] ) ) $this->mother_name = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['mother_name'] );
	  if ( isset( $data['father_name'] ) ) $this->father_name = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['father_name'] );
	  if ( isset( $data['email'] ) ) $this->email = $data['email'];
	  if ( isset( $data['emergency_contact'] ) ) $this->emergency_contact = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['emergency_contact'] );
	  if ( isset( $data['emergency_phone'] ) ) $this->emergency_phone = preg_replace ( "/[^\.\,\_\'\"\@\?\!\:\$ 0-9()]/", "", $data['emergency_phone'] );
	  if ( isset( $data['medical_conditions'] ) ) $this->medical_conditions = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['medical_conditions'] );
	  if ( isset( $data['paid'] ) ) $this->paid = (int) $data['paid'];
	  if ( isset( $data['last_modified'] ) ) $this->last_modified = $data['last_modified'];
	  if ( isset( $data['waiver_signed'] ) ) $this->waiver_signed = (int) $data['waiver_signed'];
	  if ( isset( $data['grade'] ) ) $this->grade = $data['grade'];
	  if ( isset( $data['team'] ) ) $this->team = $data['team'];	  
	  if ( isset( $data['enrollment_status'] ) ) $this->enrollment_status = (int) $data['enrollment_status'];		
	}
	
    public function storeFormValues ( $params ) {
      $this->__construct( $params );
      if ( isset($params['bday']) ) {
        $bday = explode ( '-', $params['bday'] );
        if ( count($bday) == 3 ) {
          list ( $y, $m, $d ) = $bday;
          $this->bday = mktime ( 0, 0, 0, $m, $d, $y );
        }
      }
    }
	
    public static function getById( $id ) {
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $sql = "SELECT *, UNIX_TIMESTAMP(bday) AS bday FROM registrants WHERE id = :id";
      $st = $conn->prepare( $sql );
      $st->bindValue( ":id", $id, PDO::PARAM_INT );
      $st->execute();
      $row = $st->fetch();
      $conn = null;
      if ( $row ) return new Registrants( $row );
    }
	
    public static function getList( $selectedFields, $criteria, $order ) {
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
      $sql = "SELECT SQL_CALC_FOUND_ROWS ".$selectedFields.", UNIX_TIMESTAMP(bday) as bday FROM registrants WHERE ".$criteria." ORDER BY ".$order;
      $st = $conn->prepare( $sql );
      $st->execute();
      $list = array();
      while ( $row = $st->fetch() ) {
        $registrant = new Registrants( $row );
        $list[] = $registrant;
      }
      $sql = "SELECT FOUND_ROWS() AS totalRows";
      $totalRows = $conn->query( $sql )->fetch();
      $conn = null;
      return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
    }
	
    public function insert() {
      if ( !is_null( $this->id ) ) trigger_error ( "Registrants::insert(): Attempt to insert a Registrant object that already has its ID property set (to $this->id).", E_USER_ERROR );
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "INSERT INTO registrants ( reg_type, f_name, l_name, bday, age_group, address, city, zip, home_phone, mobile_phone, mother_name, father_name, email, emergency_contact, emergency_phone, medical_conditions, paid, last_modified, waiver_signed, grade, team, enrollment_status ) VALUES ( :reg_type, :f_name, :l_name, FROM_UNIXTIME(:bday), :age_group, :address, :city, :zip, :home_phone, :mobile_phone, :mother_name, :father_name, :email, :emergency_contact, :emergency_phone, :medical_conditions, :paid, :last_modified, :waiver_signed, :grade, :team, :enrollment_status )";
      $st = $conn->prepare ( $sql );
	  $st->bindValue( ":reg_type", $this->reg_type, PDO::PARAM_STR );
	  $st->bindValue( ":f_name", $this->f_name, PDO::PARAM_STR );
	  $st->bindValue( ":l_name", $this->l_name, PDO::PARAM_STR );
      $st->bindValue( ":bday", $this->bday, PDO::PARAM_INT );
	  $st->bindValue( ":age_group", $this->age_group, PDO::PARAM_STR );
	  $st->bindValue( ":address", $this->address, PDO::PARAM_STR );
	  $st->bindValue( ":city", $this->city, PDO::PARAM_STR );
	  $st->bindValue( ":zip", $this->zip, PDO::PARAM_INT );
	  $st->bindValue( ":home_phone", $this->home_phone, PDO::PARAM_STR );
	  $st->bindValue( ":mobile_phone", $this->mobile_phone, PDO::PARAM_STR );
	  $st->bindValue( ":mother_name", $this->mother_name, PDO::PARAM_STR );
	  $st->bindValue( ":father_name", $this->father_name, PDO::PARAM_STR );
	  $st->bindValue( ":email", $this->email, PDO::PARAM_STR );
	  $st->bindValue( ":emergency_contact", $this->emergency_contact, PDO::PARAM_STR );
	  $st->bindValue( ":emergency_phone", $this->emergency_phone, PDO::PARAM_STR );
	  $st->bindValue( ":medical_conditions", $this->medical_conditions, PDO::PARAM_STR );
	  $st->bindValue( ":paid", $this->paid, PDO::PARAM_INT );
	  $st->bindValue( ":last_modified", $this->last_modified, PDO::PARAM_INT );
	  $st->bindValue( ":waiver_signed", $this->waiver_signed, PDO::PARAM_INT );
	  $st->bindValue( ":grade", $this->grade, PDO::PARAM_STR );
	  $st->bindValue( ":team", $this->team, PDO::PARAM_INT );
	  $st->bindValue( ":enrollment_status", $this->enrollment_status, PDO::PARAM_INT );		
	  $st->execute();	
	  $this->id = $conn->lastInsertId();	
      $conn = null;
	  return $this->id;
    }
	
    public function update() {
      if ( is_null( $this->id ) ) trigger_error ( "Registrants::update(): Attempt to update a Registrant object that does not have its ID property set.", E_USER_ERROR );
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $sql = "UPDATE registrants SET reg_type=:reg_type, f_name=:f_name, l_name=:l_name, bday=FROM_UNIXTIME(:bday), age_group=:age_group, address=:address, city=:city, zip=:zip, home_phone=:home_phone, mobile_phone=:mobile_phone, mother_name=:mother_name, father_name=:father_name, email=:email, emergency_contact=:emergency_contact, emergency_phone=:emergency_phone, medical_conditions=:medical_conditions, paid=:paid, last_modified=:last_modified, waiver_signed=:waiver_signed, grade=:grade, team=:team, enrollment_status=:enrollment_status WHERE id=:id";
      $st = $conn->prepare ( $sql );
	  $st->bindValue( ":reg_type", $this->reg_type, PDO::PARAM_INT );
	  $st->bindValue( ":f_name", $this->f_name, PDO::PARAM_STR );
	  $st->bindValue( ":l_name", $this->l_name, PDO::PARAM_STR );
      $st->bindValue( ":bday", $this->bday, PDO::PARAM_INT );
	  $st->bindValue( ":age_group", $this->age_group, PDO::PARAM_STR );
	  $st->bindValue( ":address", $this->address, PDO::PARAM_STR );
	  $st->bindValue( ":city", $this->city, PDO::PARAM_STR );
	  $st->bindValue( ":zip", $this->zip, PDO::PARAM_INT );
	  $st->bindValue( ":home_phone", $this->home_phone, PDO::PARAM_STR );
	  $st->bindValue( ":mobile_phone", $this->mobile_phone, PDO::PARAM_STR );
	  $st->bindValue( ":mother_name", $this->mother_name, PDO::PARAM_STR );
	  $st->bindValue( ":father_name", $this->father_name, PDO::PARAM_STR );
	  $st->bindValue( ":email", $this->email, PDO::PARAM_STR );
	  $st->bindValue( ":emergency_contact", $this->emergency_contact, PDO::PARAM_STR );
	  $st->bindValue( ":emergency_phone", $this->emergency_phone, PDO::PARAM_STR );
	  $st->bindValue( ":medical_conditions", $this->medical_conditions, PDO::PARAM_STR );
	  $st->bindValue( ":paid", $this->paid, PDO::PARAM_INT );
	  $st->bindValue( ":last_modified", $this->last_modified, PDO::PARAM_INT );
	  $st->bindValue( ":waiver_signed", $this->waiver_signed, PDO::PARAM_INT );
	  $st->bindValue( ":grade", $this->grade, PDO::PARAM_STR );
	  $st->bindValue( ":team", $this->team, PDO::PARAM_INT );
	  $st->bindValue( ":enrollment_status", $this->enrollment_status, PDO::PARAM_INT );		
	  $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
      $st->execute();
      $conn = null;
    }
	
    public function delete() {
      if ( is_null( $this->id ) ) trigger_error ( "Registrant::delete(): Attempt to delete a Registrant object that does not have its ID property set.", E_USER_ERROR );
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
      $st = $conn->prepare ( "DELETE FROM registrants WHERE id = :id LIMIT 1" );
      $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
      $st->execute();
      $conn = null;
    }
	
	public static function startRegistration( $f_name, $l_name, $bday ) {
		$conn = new PDO ( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT *, UNIX_TIMESTAMP(bday) AS bday FROM registrants WHERE f_name=:f_name AND l_name = :l_name AND bday=:bday";
		$st = $conn->prepare($sql);
		$st->bindValue(":f_name", $f_name, PDO::PARAM_STR);
		$st->bindValue(":l_name", $l_name, PDO::PARAM_STR);
		$st->bindValue(":bday", $bday, PDO::PARAM_INT);
		$st->execute();
		$entry = $st->fetch();
		$conn = null;
		if ( $entry ) return new Registrants( $entry );
	}
	
}
?>