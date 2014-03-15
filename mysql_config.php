<?php

class mysql_config{
	
	/// Declare variable array for connect db ///
	private $conn;
	private $dbconfig = array(
							'hostname' => NULL ,
							'username' => NULL ,
							'password' => NULL ,
							'database' => NULL ,
							'collation_connection' => NULL ,
							'character_set' => NULL ,
							'timezone' => NULL,
							);
	
	
	/// Set all config connection ///
	public function set_hostname($value){
		$this->dbconfig['hostname'] = $value;
	}
	public function set_username($value){
		$this->dbconfig['username'] = $value;
	}
	public function set_password($value){
		$this->dbconfig['password'] = $value;
	}
	public function set_database($value){
		$this->dbconfig['database'] = $value;
	}
	public function set_collation($value){
		$this->dbconfig['collation_connection'] = $value;
	}
	public function set_character($value){
		$this->dbconfig['character_set'] = $value;
	}
	public function set_timezone($value){
		$this->dbconfig['timezone'] = $value;
	}
	public function get_dbconfig(){
		return $this->dbconfig;
	}
	
	/// Operator all connection ///
	public function connection(){
		$this->conn = mysql_connect($this->dbconfig['hostname'], $this->dbconfig['username'], $this->dbconfig['password']);
		
		if(!empty($this->dbconfig['database'])){
			mysql_select_db($this->dbconfig['database']);
		}
		
		if(!empty($this->dbconfig['character_set'])){
			$this->dbquery('SET CHARACTER SET '.$this->dbconfig['character_set'].';');
		}
		
		if(!empty($this->dbconfig['collation_connection'])){
			$this->dbquery('SET collation_connection = '.$this->dbconfig['collation_connection'].';');
		}
		
		if(!empty($this->dbconfig['timezone'])){
			date_default_timezone_set($this->dbconfig['timezone']);
		}
	}
	public function closedb(){
		$this->conn = mysql_close();
	}
	public function dbquery($string){
		if(!empty($string)){
			$result = mysql_query($string);
		}
	}
}

class mysql_operator extends mysql_config{
	
	public function mysql_operator(){
		$this->set_hostname('localhost');
		$this->set_username('root');
		$this->set_password('mysql');
		$this->set_database('mypage');
		$this->set_collation('utf8_general_ci');
		$this->set_character('utf8');
		
		$this->connection();
	}
}

$conn = new mysql_operator();
?>
