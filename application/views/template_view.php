<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=windows-1255" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>Content Form Test</title>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<script src="/js/jquery-1.6.2.js" type="text/javascript"></script>
		<script type="text/javascript">
		// return a random integer between 0 and number
		function random(number) {
			
			return Math.floor( Math.random()*(number+1) );
		};
		
		// show random quote
		$(document).ready(function() { 
			$('.box').hide();
			$("#error_countries").empty();
			$("#error_users").empty();
			$("#error_from_date").empty();
			$("#error_to_date").empty();
			$("table th.cnt_data").hide();
			$("table th.usr_data").hide();
			$("#button").click(function(e){
				$('#table_data tbody').empty();
					    e.preventDefault();
					    $.ajax({
					        url: '/main/showdata/',
					        type: 'POST',
					        dataType: 'json',
					        data: {
					            countries: $('#countries').val(),      
					            users:$('#users').val(),
					            from_date :$('#from_date').val(),
					            to_date :$('#to_date').val()
					        },
					        success:function(response){
					        	$('.box').show();
					        	console.log(response.error);
					        	console.log(response.data);
					        	//countries
					        	if(typeof response.error.countries !== "undefined"){
					        		$("#error_countries").text(response.error.countries );
					        		$("table th.cnt_data").show();
						        }else{
						        	$("#error_countries").empty();
						        	$("table th.cnt_data").hide();
					        		if(response.data.cnt_title != "undefined"){
						        			$("#country_data_sp").text(response.data.cnt_title );
						        		}
							      }
							    //users  
							   
					        	if(typeof  response.error.users !== "undefined"){
					        		$("#error_users").text(response.error.users );
					        		$("table th.usr_data").show();
					        	
						        }else{
						        	$("#error_users").empty();
						        	$("table th.usr_data").hide();
						        	 console.log("usr_name "+response.data.usr_name);
						        	if(response.data.usr_name != "undefined"){
						        		 console.log("usr_name "+response.data.usr_name);
						        		$("#user_data_sp").text(response.data.usr_name );
					        		}
							     }


							     //from date
					        	if(typeof response.error.from_date !== "undefined"){
					        		$("#error_from_date").text(response.error.from_date );
					        		$('.box').hide();
					        		
						        }else{
						        	$("#error_from_date").empty();
						        	if(response.data.from_date != "undefined"){
						        		$("#from_data_sp").text(response.data.from_date );
							        	}
							     }

							     //to date
					        	if(typeof response.error.to_date !== "undefined"){
					        		$("#error_to_date").text(response.error.to_date );
					        		$('.box').hide();
					        		
						        }else{
						        	$("#error_to_date").empty();
						        	if(response.data.to_date != "undefined"){
						        		$("#to_data_sp").text(response.data.to_date );
						        	
						        	}
							     }

						        if (typeof response.data.date!=="undefined" && response.data.length == 0){
                                    $(".error_data_empty").text("there is no data in data base");

							      }else if(typeof response.data.date!=="undefined"){
							    	  $(".error_data_empty").empty();
							    	  var obj = response.data.date
							    	  $.each( obj, function( key, value ) {
							    		  appendTableColumn( $("#table_data"), value);
							    		 
							    		});
								      }
					        	
					        }
					   });
					});

			
		});
		
		function appendTableColumn(table, rowData) {
			  var lastRow = $('<tr/>').appendTo(table.find('tbody:last'));
			  $.each(rowData, function(colIndex, c) { 
			      lastRow.append($('<td/>').text(c));
			  });
			   
			  return lastRow;
			}
		</script>
	</head>
	<body>
		<div id="wrapper">
			
			<div id="page">
				
				<div id="content">					
						<?php include 'application/views/'.$content_view; ?>				
					<br class="clearfix" />
				</div>
				<br class="clearfix" />
			</div>
			<div id="page-bottom">
				
				<div id="page-bottom-content">
					
				</div>
				<br class="clearfix" />
			</div>
		</div>
		<div id="footer">
			
		</div>
	</body>
</html>