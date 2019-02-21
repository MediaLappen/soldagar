<?php

class Kontakt extends Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->view->js = array("js/kontakt.js");
	}

	function index()
	{
		$this->view->title = "Kontakta Oss";
		$this->view->render('kontakt');

	}

	function skicka(){
	
	$errorMSG = "";

	// NAME
	if (empty($_POST["namn"])) {
    	$errorMSG = "Namn behövs ";
	} else {
    	$name = $_POST["namn"];
	}

	// EMAIL
	if (empty($_POST["epost"])) {
    	$errorMSG .= "E-post adress behövs ";
	} else {
    	$email = $_POST["epost"];
	}

	
	if (empty($_POST["msg_subject"])) {
    	$errorMSG .= "Ämne krävs ";
	} else {
    	$msg_subject = $_POST["msg_subject"];
	}

	//$msg_subject = 'Kontakformulär';


	// MESSAGE
	if (empty($_POST["meddelande"])) {
    	$errorMSG .= "Meddelande krävs ";
	} else {
    	$message = $_POST["meddelande"];
	}


	$EmailTo = "kontakt@soldagar.se";
	$Subject = "Nytt meddelande mottaget";

	// prepare email body text
	$Body = "";
	$Body .= "Namn: ";
	$Body .= $name;
	$Body .= "\n";
	$Body .= "E-Post: ";
	$Body .= $email;
	$Body .= "\n";
	$Body .= "Ämne: ";
	$Body .= $msg_subject;
	$Body .= "\n";
	$Body .= "Meddelande: ";
	$Body .= $message;
	$Body .= "\n";

	// send email
	$success = mail($EmailTo, $Subject, $Body, "From:".$email);

	// redirect to success page
	if ($success && $errorMSG == ""){
   	echo "success";
	}else{
    	if($errorMSG == ""){
        	echo "Something went wrong :(";
    	} else {
        	echo $errorMSG;
    	}
	}
	}



}

?>