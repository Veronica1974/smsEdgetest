<?php

class Model{
	
	public function __construct() {
		
	}
	
	protected static $connection;
	protected $csvfile;
	public function connect() {
		
		// Try and connect to the database
		if(!isset(self::$connection)) {
			
			$config = parse_ini_file('./config.ini');
			self::$connection = new mysqli('localhost',$config['username'],$config['password'],$config['dbname']);
		}
		
		// If connection was not successful, handle the error
		if(self::$connection === false) {
			// Handle error - notify administrator, log to a file, show an error screen, etc.
			return false;
		}
		return self::$connection;
	}
	
	
	public function query($query) {
		// Connect to the database
		$connection = $this->connect();
		
		// Query the database
		$result = $connection->query($query);
		
		return $result;
	}
	
	
	public function select($query) {
		$rows = array();
		$result = $this->query($query);
		if($result === false) {
			return false;
		}
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
		return $rows;
	}
	
	
	public function error() {
		$connection = $this->connect();
		return $connection->error;
	}
	
	
	public function quote($value) {
		$connection = $this -> connect();
		return "'" . $connection -> real_escape_string($value) . "'";
	}
	
	
	
	
	
	public function nameValid($name=null){
		$nameErr = '';
		// check if name only contains letters and whitespace
		if(!empty($name)){
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				$nameErr = "Only letters and white space allowed";
			}
		}else{
			$nameErr = "Name is required";
		}
		return $nameErr;
	}
	
	function isValidDate($date, $format= 'Y-m-d'){
	    return $date == date($format, strtotime($date));
	}
	
	function validateDate($date, $format = 'Y-m-d'){
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}
	
}