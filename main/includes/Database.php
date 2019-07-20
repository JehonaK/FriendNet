<?php
    $connect = mysqli_connect("localhost", "root", "", "friendnetdb");

class Database {
	public $conn;

    
	function __construct() {
		$servername = "localhost";
		$dbusername = "root";
		$dbpassword = "";
		$dbname = "friendnetdb";

		$this->conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

		if (!$this->conn) {
			die("Connection failed: ".mysqli_connect_error());
		}
	}
}

?>