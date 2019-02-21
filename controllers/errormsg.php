<?php

class ErrorMsg extends Controller{
	function __construct()
	{
		parent::__construct();	
		
	}

	public function index()
	{
		$this->view->msg = "Sidan finns inte";
		$this->view->title = "Error";
		$this->view->render('errormsg');	
	}
}

?>