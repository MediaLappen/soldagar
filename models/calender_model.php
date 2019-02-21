<?php 

class Calender_Model extends Model
{
	public function __construct()
	{
		parent::__construct();	
		
		//var_dump( $this->holidays());

	}


	public function getSun()
	{
		$sun = Array();

		//make sure of connection
		if ($this->db->conn()->connect_errno) 
		{
			echo "Kunde inte koppla up till databasen <br>";
    		exit();
		}
		else
		{
			//echo "uppkoppling till databas OK <br>";
		}

		$query = mysqli_query($this->db->conn(),
			"SELECT * FROM soldagar WHERE weather = 'sunny'");
        
		
		//if query found == succeed
		if (mysqli_num_rows($query) > 0) 
		{	
				
    				while($row = mysqli_fetch_assoc($query)) {
						$sun[] = $row['datum'];
					}
					$this->dayarray = $sun;

					
		}
		else
		{
			echo "Användaren finns inte";
			$this->dayarray = $sun;
		}
		
		return $this->dayarray;

	}


	public function signs()
	{
		$signs = Array();

		//make sure of connection
		if ($this->db->conn()->connect_errno) 
		{
			echo "Kunde inte koppla up till databasen <br>";
    		exit();
		}
		else
		{
			//echo "uppkoppling till databas OK <br>";
		}

		$query = mysqli_query($this->db->conn(),
			"SELECT * FROM solboken");
        
		
		//if query found == succeed
		if (mysqli_num_rows($query) > 0) 
		{	
				
    				while($row = mysqli_fetch_assoc($query)) {
    					
						$signs[] = array($row['datum'], $row['signatur'], $row['datestamp']);
					}
					$this->bookSigns = $signs;

					
		}
		else
		{
			echo "Användaren finns inte";
		}
		//var_dump($this->bookSigns);
		return $this->bookSigns;

	}

	public function saveTheSun($datum,$weather,$datestamp,$sign){
		//make sure of connection
		if ($this->db->conn()->connect_errno) 
		{
			echo "Kunde inte koppla up till databasen <br>";
    		exit();
		}
		else
		{
			//echo "uppkoppling till databas OK <br>";
		}

		//$dag = $datum;

		//$datestamp
		//$datum
		//$weather
		//$sign
		$query = mysqli_query($this->db->conn(),"SELECT * FROM soldagar WHERE datum = '$datum'");

		//if query found == succeed
		if (mysqli_num_rows($query) > 0) 
		{	
			$query = mysqli_query($this->db->conn(),
			"UPDATE soldagar SET sign = '$sign', weather = '$weather', datestamp = '$datestamp' WHERE datum = '$datum'");

		}
		else
		{
			$query = mysqli_query($this->db->conn(),
			"INSERT INTO soldagar (datum, sign, weather, datestamp) VALUES ('$datum', '$sign', '$weather', '$datestamp')");
		}

	}

	public function signTheBook($datum, $sign, $datestamp){
		//make sure of connection
		if ($this->db->conn()->connect_errno) 
		{
			echo "Kunde inte koppla up till databasen <br>";
    		exit();
		}
		else
		{
			$query = mysqli_query($this->db->conn(),
			"INSERT INTO solboken (datum, signatur, datestamp) VALUES ('$datum', '$sign', '$datestamp')");
		}

	}

}
?>