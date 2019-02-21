$(function(){

	//doing some ajax when clicking on next or prev button
	$(document).on('click','.prevmonth, .nextmonth', function(){
		var datum = ($(this).attr('id'));
		//spliting the date (yyyy-mm) between (-)
		var myarr = datum.split("-");

		$.ajax({
			url: "index/almanacka",
			type: "GET",
			
			data: {
				//yyyy
				'year':myarr[1],
				//mm
				'month':myarr[0],
				},
			
			dataType:'text',

			success: function(response){
			//var result = $('<div />').append(response).find('#byt').html();
            $('#almanacka').html(response);

		
			}
		
		});	
	});


	

	$(document).on('click','.sunny, .rainy', function(){

		
		var datum = ($(this).attr('id'));
		var weather = $(this).attr('class');
		
		//alert(weather);
		

		$.ajax({
			url: "index/makeSun",
			type: "GET",
			data: {
				//yyyy
				'datum':datum,
				'weather':weather
				},
			dataType:'text',
			success: function(response)
				{
					//var result = $('<div />').append(response).find('#byt').html();
           			$('#almanacka').html(response);
           			$(".sign").css('display','flex');
           			$(".input-field").trigger( "focus" );

           			$(".input-field").keydown(function(){
       					$(".icon-confirm").css('display','block');
       					$(".icon-confirm").attr('id',datum);
       					$(".icon").css('display','none');

    				});

           		//alert(response);
		
				}
			

		});



	});

	$(document).on('click', '.icon-confirm', function(){

		var datum = ($(this).attr('id'));
		var sign = $(".input-field").val();

		//alert(datum+' '+sign);
		$(".icon").css('display','block');
		$(".icon-confirm").css('display','none');
		$(".sign").css('display','none');


		$.ajax({
			url: "index/signBook",
			type: "GET",
			data: {
				//yyyy
				'datum':datum,
				'sign':sign
				},
			dataType:'text',
			success: function(response)
				{
					$('#almanacka').html(response);

				}
					
    	});
			
	});

	 $(document).on('keypress','.input-field', function(e){
        if(e.which == 13){//Enter key pressed
            $('.icon-confirm').click();//Trigger search button click event
        }
    });


	 $(document).on('click', '#calview, #guestbook', function(){
	 	
	 	$view = $(this).attr('id');
	 	//alert($view);
	 	var datavalue;
	 	var path;
	 	var d = new Date();
	 	var yearValue = d.getFullYear();
	 	var monthValue = d.getMonth()+1;

	 	
	 	if ($view == 'guestbook'){
			path = "index/guestBook";
			datavalue = {};
			
		}
			else
		{
			path = "index/almanacka";	
			datavalue = {year:yearValue, month:monthValue};
			
		}

	 	$.ajax({
	 		
			url: path,
			type: "GET",
			data: datavalue,
			dataType:'text',
			success: function(response)
				{
					$('#almanacka').html(response);

					if ($view == 'guestbook'){
					var objDiv = $(".signview");
    	 			var h = objDiv.get(0).scrollHeight;
    	 			objDiv.animate({scrollTop: h});
    	 		}

				}

				
					
    	});


	 });

	

});

