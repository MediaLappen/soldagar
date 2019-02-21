<?php
class DbConnection{

	//function __construct(){
		
	//}
	
	function conn(){

		$db_user = DB_USER;
		$db_pass = DB_PASS;
		$db_host = DB_HOST;
		$db_name = DB_NAME;

		$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		return $conn;

	}
	
}
?>