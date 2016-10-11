<?php 

class Teams {
	
	public $id = null;
	public $name = null;
	public $score = null;

	public function __construct($data=array()){
		if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
		if ( isset( $data['name'] ) ) $this->name = $data['name'];
		if ( isset( $data['score'] ) ) $this->score = (int) $data['score'];
	}

	public function points( $point_array ) {
		if ( !is_null( $this->id ) ) trigger_error ( "Teams::insert(): Attempt to insert a Teams object that already has its ID property set (to $this->id).", E_USER_ERROR );
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		foreach( $point_array as $id=>$point_score ) {
			$point_score = ($point_score == "1")?10:-10;
			$sql = "UPDATE teams SET score = score + :point_score WHERE id = :id";
			$st = $conn->prepare ( $sql );
			$st->bindValue(":point_score", $point_score, PDO::PARAM_INT);
			$st->bindValue(":id", $id, PDO::PARAM_INT);
			$st->execute();
		}
		$conn = null;
	}
	
    public static function getTeam( $id ) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT * FROM teams WHERE id = :id";	
		$st = $conn->prepare( $sql );
		$st->bindValue( ":id", $id, PDO::PARAM_INT );
		$st->execute();
		$row = $st->fetch();	
		$conn = null;
		if ( $row ) return new Teams( $row );		
    }
	
    public static function getAllTeams() {
      $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
      $sql = "SELECT * FROM teams";
      $st = $conn->prepare( $sql );
      $st->execute();
      $list = array();
      while ( $row = $st->fetch() ) {
        $team = new Teams( $row );
        $list[] = $team;
      }
      $totalRows = $conn->query( $sql )->fetch();
      $conn = null;
      return ( array ( "team_results" => $list, "team_totalRows" => $totalRows[0] ) );
    }
		
}

?>