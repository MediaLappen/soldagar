<?php

class Index extends Controller{
	function __construct()
	{
		parent::__construct();
		$this->view->js = array("js/default.js");
		
		//recive specialdays from database through Calender_Model
		require 'models/calender_model.php';
		$this->calender = new Calender_Model;
		
	}

	public function index()
	{
		
		//render the calender
		$this->view->almanacka = $this->almanacka();
		
		//give title for header
		$this->view->title = "Soldagar | Hemsidor | Grafisk Hjälp | Mediaproduktion";
		
		//render the view
		$this->view->render('index');
		
		
	}

	function signBook(){

		if(isset($_GET['datum']))
		{
			$datum = $_GET['datum'];
		}

		if(isset($_GET['sign']))
		{
			$sign = $_GET['sign'];
		}

		date_default_timezone_set("Europe/Stockholm");  
		$datestamp = date('Y-m-d H:i:s');

		$this->calender->signTheBook($datum, $sign, $datestamp);

		//echo 'Signerat '.$datum.' i kalendern den '.$datestamp;

		$dag = explode("-", $datum);
		$initMonth=$dag[1];
		$initYear=$dag[2];
		
		

		$visa = $this->calenderInit($initMonth,$initYear);
		
		
			echo $visa;	
	}

	function guestBook(){

		//montharray
		$months = $this->month();

		$signs = $this->calender->signs();


		echo "<p class='monthtitle'>Solboken<i id='calview' class='fa fa-calendar float-right calview' title='Kalender'></i></p><hr><div class='signview'>";
		foreach ($signs as list($arrDatum, $arrSign, $arrDatestamp)) 
					{
						$day = explode("-",$arrDatum);
   					 	echo "<p class='signatur'><i class='fa fa-book signlist'></i> <strong>".$arrSign."</strong> : ".$day[0]." ".$months[($day[1]-1)]." ".$day[2]." i Kalendern den ".substr($arrDatestamp,0,16)."</p>";
   					 	
					};
					echo '</div>';

		//var_dump($signs);

	}

	function makeSun(){
		
		if(isset($_GET['datum']))
		{
			$datum = $_GET['datum'];
		}
		

		if(isset($_GET['weather']))
		{
			$weather = $_GET['weather'];
		}

		if ($weather == 'sunny'){
			$weather = 'rainy';
		}
		else{
			$weather = 'sunny';
		}

		





		date_default_timezone_set("Europe/Stockholm");  
		$datestamp = date('Y-m-d H:i:s');
		$sign = 'test4';

		$this->calender->saveTheSun($datum, $weather, $datestamp, $sign);

		$dag = explode("-", $datum);
		$initMonth=$dag[1];
		$initYear=$dag[2];
		
		

		$visa = $this->calenderInit($initMonth,$initYear);
		
		
			echo $visa;	
		
	}

	function almanacka(){
		

		//get month from ajax
		if(isset($_GET['month'])){
			$initMonth = $_GET['month'];	
		}
		else
		{
			//initMonth = this month
			$initMonth = date('n');
		}

		//get year from ajax
		if(isset($_GET['year'])){
			$initYear = $_GET['year'];
		}
		else
		{	
			//initYear = this year
			$initYear = date('Y');
		}
		
		
		

		//get the viewing html code
		$visa = $this->calenderInit($initMonth,$initYear);
		
		if(isset($_GET['month']))
		{
			//if month is set
			echo $visa;	
		}
		else
		{
			//if start mode
			return $visa;
		}
	}

	function calenderInit($initMonth, $initYear){
		
		//month array
		$months = $this->month();
		
		
		//get the rainy days
		$sunnyDays = $this->sunnyDays();

		
		//get the year calender structure
		$cal = $this->year2array($initYear);

		//html structure of the calender
		$echo = "<div class='calender'>"; 
		$echo = $echo. "<p class='monthtitle'>".$months[($initMonth-1)]." ".$initYear."<div id='guestbook' class='lead float-right  guestbook' >öppna solboken <i title='Se vilka som signerat i Solboken'  class='fa fa-book'></i></div></p>";
		$echo = $echo. "<p class='monthtitle2'>Du är välkommen att signera i vår Solbok, välj din dag i alamanackan.</p><hr>";
		$echo = $echo. $this->month2table($initMonth, $cal, $initYear, $sunnyDays);	
		$echo = $echo. "<div class='sign' id='sign'>";
		$echo = $echo. "<i class='fa fa-book icon'></i>";
		$echo = $echo. "<i class='fa fa-check icon-confirm'></i>";
		$echo = $echo. "<input class='input-field' name='sign' value='' placeholder='Signera gästbook'>";

		$echo = $echo. "</div>";
		$echo = $echo. "</div>";
	
		date_default_timezone_set("Europe/Stockholm");
		
		return $echo;
	}


	public function year2array($year) 
 	{
    	$res = $year >= 1970;
    	if ($res) 
    	{
      		// this line gets and sets same timezone, don't ask why :)
      		date_default_timezone_set(date_default_timezone_get());

      		$dt = strtotime("-1 day", strtotime("$year-01-01 00:00:00"));
      		$res = array();
      		$week = array_fill(1, 7, false);
      		$last_month = 1;
      		$w = 1;
      		do {
       				$dt = strtotime('+1 day', $dt);
        			$dta = getdate($dt);
        			$wday = $dta['wday'] == 0 ? 7 : $dta['wday'];
        			if (($dta['mon'] != $last_month) || ($wday == 1)) {
          			if ($week[1] || $week[7]) $res[$last_month][] = $week;
          			$week = array_fill(1, 7, false);
          			$last_month = $dta['mon'];
          		}
        		$week[$wday] = $dta['mday'];
        	}
      		while ($dta['year'] == $year);
      	}
    	return $res;
  	}

  	public function month2table($month, $calendar_array, $yearvalue, $sun) 
	{

		$signs = $this->calender->signs();
		
    	$monthvalue = $month;
		$ca = 'align="center"';
    	$res = "<div class=\"monthspace\"> <table cellpadding=\"0\" cellspacing=\"1\" ><tr><td $ca>mon</td><td $ca>tis</td><td $ca>ons</td><td $ca>tor</td><td $ca>fre</td><td $ca>lör</td><td $ca>sön</td></tr>";
    	foreach ($calendar_array[$month] as $month=>$week) 
    	{
      		$res .= '<tr>';
      		foreach ($week as $day) 
      		{
        		if($day!='')
        		{
					$res .= '<td><button ';
			
			//--------------set class="rainday" if marked rain--------------------------
			$closestring = 'class="rainy"';
			foreach ($sun as $val) {
    			if ($val == ($day.'-'.$monthvalue.'-'.$yearvalue)) {
				$closestring = 'class="sunny"';
				
        		break;    /* You could also write 'break 1;' here. */
    			}
			}
			$res .= $closestring;
			//---------------------------------------------------------------------------
			
					
					$res .= ' title="Signerat: ';
					//var_dump($signs);
					foreach ($signs as list($arrDatum, $arrSign, $arrDatestamp)) 
					{
   					 	if ($arrDatum == ($day.'-'.$monthvalue.'-'.$yearvalue)){
   					 		$res .= '('.$arrSign.' den '.substr($arrDatestamp,0,10).") ";

   					 	}
   					 	
					};


					$res .='" id="'.$day.'-'.$monthvalue.'-'.$yearvalue.'">' . ($day ? $day : '&nbsp;') . '</button></td>';

				}
				else
				{
						$res .= '<td>' . ($day ? $day : '&nbsp;') . '</td>';
				}
        	}
      		$res .= '</tr>';
      	}
    	$res .= '</table>';

    	$res .= '<div class="monthbutton"><a id="';

    	if(($monthvalue-1)==0){
    		$res .='12-'.($yearvalue-1);}
    	else{
    		$res .=($monthvalue-1).'-'.($yearvalue); 
    	}

    	$res .= '" class="prevmonth" title="Förgående Månad"><<</a>';
    	$res .= '<a id="';

		if(($monthvalue+1)==13){
    		$res .='1-'.($yearvalue+1);}
    	else{
    		$res .=($monthvalue+1).'-'.($yearvalue); 
    	}

    	$res .= '" class="nextmonth" title="Nästa Månad">>></a>';
    	$res .= '</div></div>';

    	return $res;
    }


	public function sunnyDays()
	{		
		return $this->calender->getSun();
		
	}

	public function month(){

		$months = array(
    		'januari',
    		'februari',
    		'mars',
    		'april',
    		'maj',
    		'juni',
    		'juli',
    		'augusti',
    		'september',
    		'oktober',
    		'november',
    		'december',
		);

		return $months;
	}

}

?>