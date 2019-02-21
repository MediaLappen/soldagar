<?php

class Kontakt extends Controller{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->view->title = "Kontakta Oss";
		$this->view->render('kontakt');

	}


}

?>