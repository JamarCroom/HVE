<?php
	//process login here create session variable etc.
	session_start();
	include 'includes/httpsRedirect.inc';
?>

<!DOCTYPE html>
<html>


<head>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="./jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'/>
<link href='https://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="./jquery-ui-1.10.3.custom/css/overcast/jquery-ui-1.10.3.custom.css" / >

<title>Seat Belt High Visibility Enforcement Application</title>

<script type="text/javascript">
$(function()
{
	var spd_infr = $('#spd_infr');
	var spd_crim = $('#spd_crim');
	var spd_cnstzne = $('#spd_cnstzne');
	var spd_cnstznedbl = $('#spd_cnstznedbl');
	var spd_tollarea10 = $('#spd_tollarea10');
	var spd_tollarea35 = $('#spd_tollarea35');
	var stbltvio = $('#stbltvio');
	var chldRestr = $('#chldRestr');

	spd_infr.bind("click", function()
	{
		makeFields('spdInfractionCitSum');
	});

	spd_crim.bind("click", function()
	{
		makeFields('spdCriminalCitSum');
	});

	spd_cnstzne.bind("click", function()
	{
		makeFields('spdConZneCitSum');
	});

	spd_cnstznedbl.bind("click", function()
	{
		makeFields('spdConZneDblFneCitSum');
	});

	spd_tollarea10.bind("click", function()
	{
		makeFields('spdToll10CitSum');
	});

	spd_tollarea35.bind("click", function()
	{
		makeFields('spdToll35CitSum');
	});

	stbltvio.bind("click", function()
	{
		makeFields('seatBltCitSum');
	});

	chldRestr.bind("click", function()
	{
		makeFields('chldRestrCitSum');
	});

	var citationsCitationSummonsArray =  new Array(
		'ouiLiquorCitSum',			
		'ouiDrugsCitSum',
				'ouiMinorCitSum',
				'ouiCdl04CitSum',
				'spdInfractionCitSum',
				'spdCriminalCitSum',
				'spdConZneCitSum',
				'spdConZneDblFneCitSum',
				'spdToll10CitSum',
				'spdToll35CitSum',
				'dftsCitSum',
				'drgVioCivilCitSum',
				'drgVioCriminalCitSum',
				'warntCitSum',
				'seatBltCitSum',
				'chldRestrCitSum',
				'oasCitSum',
				'commVehicleViolationCitSum',
				'uninsrdMotrCitSum',
				'othMvgVltCitSum',
				'othNonMvgVltCitSum'
			);
		var citSummonsArrayLength = citationsCitationSummonsArray.length;
		
		for (var i =0;i<citSummonsArrayLength;i++)	
		{
			var summonsHolder = document.getElementById(citationsCitationSummonsArray[i]);
			$(summonsHolder).bind("change", function()
			{
				//alert("hello");
				addFields('summons');
			});
		}

		var citationsCitationWarningsArray = new Array(		
				'ouiLiquorCitWarn',
				'ouiDrugsCitWarn',
				'ouiMinorCitWarn',
				'ouiCdl04CitWarn',
				'spdInfractionCitWarn',
				'spdCriminalCitWarn',
				'spdConZneCitWarn',
				'spdConZneDblFneCitWarn',
				'spdToll10CitWarn',
				'spdToll35CitWarn',
				'dftsCitWarn',
				'drgVioCivilCitWarn',
				'drgVioCriminalCitWarn',
				'warntCitWarn',
				'seatBltCitWarn',
				'chldRestrCitWarn',	
				'oasCitWarn',
				'commVehicleViolationCitWarn',
				'uninsrdMotrCitWarn',
				'othMvgVltCitWarn',
				'othNonMvgVltCitWarn');
		var citWarnArrayLength = citationsCitationWarningsArray.length;
	for (var i =0; i<citWarnArrayLength;i++)	
	{
		var warnHolder = document.getElementById(citationsCitationWarningsArray[i]);
		$(warnHolder).bind("change", function()
		{		
			addFields('warnings');
		});
	}

	function addFields (CitSum)
	{
		
		if (CitSum=='summons')
		{
			var total = 0;
			
			var input = 0;
			for(var i =0; i<citSummonsArrayLength; i++)
			{
				var holder = document.getElementById(citationsCitationSummonsArray[i]);
				
				total += parseInt($(holder).val());
				
				
				
			}
			$('#cit_summons').html(total);
			
		}

		if(CitSum=='warnings')
		{

			var total = 0;
			
			for(var i =0; i<citWarnArrayLength; i++)
			{
				var holder = document.getElementById(citationsCitationWarningsArray[i]);
				total += parseInt($(holder).val());
			}
			
			$('#cit_warnings').html(total);
		}

	}


	function makeFields(CitSum)
	{
		var value = $('#'+CitSum+'').val();

		if(value==0)
		{
			alert("Alert: In order to enter a citation number the citation summons field must be greater than zero.");
		}
		else
		{
			for(var i=0; i<value; i++)
			{
				$('#violations').after('<p><input type = "hidden" name = "'+CitSum+'CitClass[]" class = "'+CitSum+'CitClass" /></p>');	
			}
			window.open("citationpopUp.php?citIteration="+value+"&CitSum="+CitSum+"","","width=500,height=500, scrollbars=yes,resizable=yes");
		}
	}
/*
	function pickerCompatible()
	// Returns the version of Internet Explorer or a -1
	// (indicating the use of another browser).
	{
  	  var rv = true; // Return value assumes failure.
	  if (navigator.appName == 'Microsoft Internet Explorer')
	  {
	    var ua = navigator.userAgent;
	    var re  = new RegExp('MSIE ([0-9]{1,}[\.0-9]{0,})');
	    if (re.exec(ua) != null)
	      var version = parseFloat( RegExp.$1 );
		  if(version<=8)
		  {
		  	rv=false;
		  }  
	  }

	  return rv;
	}*/
		function pickerCompatible()
		// Returns the version of Internet Explorer or a -1
		// (indicating the use of another browser).
		{
	  	  var rv = true; // Return value assumes failure.
		  if (navigator.appName == 'Microsoft Internet Explorer')
		  {
			  	rv=false;
			 
		  }

		  return rv;
		}


		var compatible=pickerCompatible();
		if(compatible)
		{
			$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
		}



	$('.officerHours').bind("change",function()
	{
		calculate();
	});
	$('.officerRate').bind("change",function()
		{
			calculate();
		});
	function calculate()
	{

		var grandHours=0;
		
		var grandTotal=0;	
		var index= 1;
		
		var hours = new Array();
		var j=0;
		$('.officerHours').each(function()
		{
			hours[j]=$(this).val();
			grandHours+=parseInt(hours[j]);
			j++;	
		});


		var rates = new Array();
		j=0;
		$('.officerRate').each(function()
		{
			rates[j]=parseFloat($(this).val());
			
			j++;
		});
		

		j=0;
		$('.officerCost').each(function()
		{
			var ttl =rates[j]*hours[j];
			grandTotal +=ttl;
			$(this).html("$"+ttl.toFixed(2));
			j++;
		});
		$('#ttlDtlHrVal').html(grandHours);
		
		$('#cstDtlVal').html("$"+grandTotal.toFixed(2));
		
	}

	$('#addButton').click(function(){
		$('#officer_details tr:last').after('<tr><td><input type="text" name="name[]" class="officerDtl" /></td><td><input type="text" name="hours[]" class="officerDtl officerHours"  value="0"/></td></tr>');


					$('.officerHours').bind("change",function(){
						calculate();
		

					});		
		return false;
		});



	
	$('#removeButton').click(function()
	{
		var rowLength= $('#officer_details tr').length;
		if(rowLength>2)
			$('#officer_details tr:last').remove();

		return false;
	});



});
</script>
<style type="text/css">
*
{
	margin: 0;
	padding: 0;
}

html, body
{
	width: 100%;
	height: auto;
	font-family: 'Droid Sans', sans-serif;
	
	background: #4F4F4F;
 /* IE10 Consumer Preview */
	background: -ms-linear-gradient(bottom, #4F4F4F 0%, #141414 100%) fixed;

	/* Mozilla Firefox */ 
	background: -moz-linear-gradient(bottom, #4F4F4F 0%, #141414 100%) fixed;

	/* Opera */ 
	background: -o-linear-gradient(bottom, #4F4F4F 0%, #141414 100%) fixed;

	/* Webkit (Safari/Chrome 10) */ 
	background: -webkit-gradient(linear, left bottom, left top, color-stop(0, #4F4F4F), color-stop(1, #141414)) fixed;

	/* Webkit (Chrome 11+) */ 
	background: -webkit-linear-gradient(bottom, #4F4F4F 0%, #141414 100%) fixed;

	/* W3C Markup, IE10 Release Preview */ 
	background: linear-gradient(to top, #4F4F4F 0%, #141414 100%) fixed;

}
#header
{
	margin: 10px 0;
	background-color: #000066;
	border-radius:5px;	
	width: 100%;
}

#logoWording
{
	margin-left: 10px;
	font-family: chunkfive,'Paytone One', sans-serif;
	font-size: 1.45em;

	color: white;
}

nav
 {
 	width: 95%;
 	margin: 15px auto;
 	text-align: center;
 	height: 35px;
 	padding-top:  5px;
 	 background-color: #000066;
 	 border-radius: 5px;
 }

 nav ul li a
 {
 	width: 100%;
 	height: 100%;
 	text-decoration: none;
 	font-weight: bold;
 	background-color: #000066;
 	color:white;
 	padding: 0;
 	margin-right: 15px;

 	font-size: 1.3em;

 }

 nav ul li a:active
 {
 	color: #cedce7;
 }
  nav ul li a:hover
 {
 	color: #cedce7;
 }
 nav ul
 {
 	
 	padding: 0;
 	margin: 0;
 	list-style-type: none;

 }
 nav ul li
 {
 	padding: 0;
 	margin: 0;
  	display: inline;	
 }
/*#wrapper
{
	width:70%;

}*/
#wrapper
{
	margin: 0 auto;
	padding: 10px 15px;
	width :80%;
	background-color: #cedce7;
	border-radius: 5px;
	height: 100%;
}
#formHVE
{
	width:80%;
	margin: 0 auto 0 auto;
	background-color: #cedce7;
	
}
.errors, .error
{
	color: red;
	font-weight: bold;
	font-size: 0.8em;
}
fieldset
{
	margin: 15px auto 15px auto;
	width: 95%;
	background-color: #E2E2E2;	
	border-radius: 4px;
	padding: 10px 0 10px 5px;
	-moz-box-shadow:    3px 1px 3px 4px rgb(95,95,95);
  	-webkit-box-shadow: 3px 1px 3px 4px rgb(95,95,95);
 	 box-shadow:         2px 1px 2px 3px rgb(95,95,95);
}

p
{
	margin-bottom: 8px;
	margin-left:6px;
}



table tr td input
{
	margin-bottom: 8px;
	padding-left: 6px;
}
table tr td 
{
	margin-bottom: 8px;
	padding-left: 6px;
}

#violations tr td
 {
 
 	padding-bottom: 15px;
 }

legend
{
	font-weight: bold;	
	font-size: 1.1em;
}

.confirmation
{
	text-align: center;
	font-size: 1em;
	font-weight: bold;
	padding: 8px 0;
}

.buttons
{
	width: 10%;
	margin: 20px auto;
}


@media (max-width: 480px)
 {
 	*
 	{
 		font-size: 0.95em;
		
 	}

 	input
 	{
 		width: 30%;
 	}
 	input[type='submit']
 	{
 		width: 35%;
 	}
 	input[type='reset']
 	{
 		width: 35%;
 	}

 }


</style>

</head>
<body>
	<div id="wrapper">
	<div id="header"><img src="pics/bhs_logo.jpg" id="logo" style="vertical-align: middle; border-radius: 5px;"/><span id="logoWording">Bureau of Highway Safety Web Applications Portal</span></div>
<?php
	include 'includes/navbar.inc';

if(isset($_SESSION['userId']))
{
?>
	<form name="formHVE" id="formHVE"action="HVEprocess.php" method="POST">
	<h2 style="text-align:center;">Seat Belt High Visibility Enforcement Report</h2>	
	<fieldset>
	<p><strong>Report Details</strong></p>
	<?php
		$policeDept=array();
		$file = file_get_contents('Maine_PD_List.txt');
		$policeDept = explode(',',$file);
		natcasesort($policeDept);

	?>

	<p>Select a Local Enforcement Agency:&nbsp;&nbsp;<select name='slctPdDept'>
	<?php
		foreach($policeDept as $policeDepts)
		{
			echo "<option value='".trim(str_ireplace("'", "?", $policeDepts))."'>$policeDepts</option>";
		}
	?>

	</select>
	</p>

	<p>Date: <input type="text" name="date" id="datepicker"/></p>

	<p>
	Start Time:&nbsp;&nbsp;

	<select name='startHours'>
	<?php
		$i=1;
		while($i<25)
		{
			echo "<option>$i</option>";
			$i++;
		}
		echo"</select>:<select name='startMinutes'>";
		
		$j=0;
		while ($j<60) 
		{
			if($j<10)
			{
				$format = sprintf("%02d", $j);
				echo"<option>$format</option>";
			}
			else
				echo"<option>$j</option>";	
			 $j++;
		}

	?>
	</select>

	</p>

	<p>
	End Time: &nbsp;&nbsp;

	<select name='endHours'>
	<?php
		$i=1;
		while($i<25)
		{
			echo "<option>$i</option>";
			$i++;
		}
		echo"</select>: <select name='endMinutes'>";
		
		$j=0;
		while ($j<60) 
		{
			if($j<10)
			{
				$format = sprintf("%02d", $j);
				echo"<option>$format</option>";
			}
			else
				echo"<option>$j</option>";
				$j++;
		}

	?>
	</select>

	</p>

	<p>
	Activity:&nbsp;&nbsp; Patrol<input name="activity" id="activity" type="radio" value="patrol"/>&nbsp;&nbsp;Roadblock<input name="activity" id="activity" type="radio" value="roadblock"/>
	</p>
	<p>
	Weather:&nbsp;&nbsp;<input type="text" name="weather" id="weather" />

	</p>

	<p>
	Location:&nbsp;&nbsp;County:&nbsp;
				<select name="county">
					<option value =""></option>
					<option value="Androscoggin">Androscoggin</option>
					<option value="Aroostook">Aroostook</option>
					<option value="Cumberland">Cumberland</option>
					<option value="Franklin">Franklin</option>
					<option value="Hancock">Hancock</option>
					<option value="Kennebec">Kennebec</option>
					<option value="Knox">Knox</option>
					<option value="Lincoln">Lincoln</option>
					<option value="Oxford">Oxford</option>
					<option value="Penobscot">Penobscot</option>
					<option value="Piscataquis">Piscataquis</option>
					<option value="Sagadahoc">Sagadahoc</option>
					<option value="Somerset">Somerset</option>
					<option value="Waldo">Waldo</option>
					<option value="Washington">Washington</option>
					<option value="York">York</option>
				</select>
		&nbsp;&nbsp;Town:&nbsp;<input type="text" name="town" id="town"/>
		&nbsp;&nbsp;Route/Road:&nbsp;<input type="text" name="route" id="route"/>
	</p>
	</fieldset>
	<fieldset>

	<p><strong>Citations</strong></p>
	<table id="violations">
	<thead><tr><th>Type of citation</th><th>Citation<br/>Summons</th><th>Citation<br/>Warnings</th><th>Comments (Optional)</th></tr></thead>
	<tr><td>OUI - Liquor</td><td><input type="text" name="ouiLiquorCitSum"  id="ouiLiquorCitSum" value="0"/></td><td><input type="text" id="ouiLiquorCitWarn" name="ouiLiquorCitWarn" value="0"/></td><td><input type="text" id="ouiLiquorComments" name="ouiLiquorComments" /></td></tr>
	<tr><td>OUI - Drugs</td><td><input type="text" name="ouiDrugsCitSum" id="ouiDrugsCitSum" value="0"/></td><td><input type="text" id="ouiDrugsCitWarn" name="ouiDrugsCitWarn" value="0"/></td><td><input type="text" id="ouiDrugsComments" name="ouiDrugsComments" /></td></tr>
	<tr><td>OUI - Minor</td><td><input type="text" name="ouiMinorCitSum" id="ouiMinorCitSum" value="0"/></td><td><input type="text" id="ouiMinorCitWarn" name="ouiMinorCitWarn" value="0"/></td><td><input type="text" id="ouiMinorComments" name="ouiMinorComments" /></td></tr>
	<tr><td>OUI - CDL.04</td><td><input type="text" id="ouiCdl04CitSum"name="ouiCdl04CitSum" value="0"/></td><td><input type="text" id="ouiCdl04CitWarn" name="ouiCdl04CitWarn" value="0"/></td><td><input type="text" id="ouiCdl04Comments" name="ouiCdl04Comments" /></td></tr>
	<tr><td>Speed - Infraction &nbsp;<img id="spd_infr" src="bloc_notes_sz.png" height = "9%" width = "9%"/></td><td><input type="text" id = 'spdInfractionCitSum' name="spdInfractionCitSum" value="0"/></td><td><input type="text" id="spdInfractionCitWarn" name="spdInfractionCitWarn" value="0"/></td><td><input type="text" id="spdInfractionComments" name="spdInfractionComments" /></td></tr>
	<tr><td>Speed - Criminal&nbsp;<img id="spd_crim" src="bloc_notes_sz.png" height = "9%" width = "9%"/></td><td><input type="text" id = 'spdCriminalCitSum' name="spdCriminalCitSum" value="0"/></td><td><input type="text" name="spdCriminalCitWarn" id="spdCriminalCitWarn" value="0"/></td><td><input type="text" id="spdCriminalComments" name="spdCriminalComments" /></td></tr>
	<tr><td>Speed - Const. Zone&nbsp;<img id="spd_cnstzne" src="bloc_notes_sz.png" height = "9%" width = "9%"/></td><td><input type="text" id = 'spdConZneCitSum' name="spdConZneCitSum" value="0"/></td><td><input type="text" id="spdConZneCitWarn" name="spdConZneCitWarn" value="0"/></td><td><input type="text" id="spdConZneComments" name="spdConZneComments" /></td></tr>
	<tr><td>Speed - Const. Zone(DOUBLE FINE)&nbsp;<img id="spd_cnstznedbl" src="bloc_notes_sz.png" height ="9%" width = "9%"/></td><td><input type="text" id ='spdConZneDblFneCitSum' name="spdConZneDblFneCitSum" value="0"/></td><td><input type="text" id="spdConZneDblFneCitWarn" name="spdConZneDblFneCitWarn" value="0"/></td><td><input type="text" id="spdConZneDblFneComments" name="spdConZneDblFneComments" /></td></tr>
	<tr><td>Speed - TOLL AREA (10 ZONE)&nbsp;<img id="spd_tollarea10" src="bloc_notes_sz.png" height = "9%" width = "9%"/></td><td><input type="text" id = 'spdToll10CitSum' name="spdToll10CitSum" value="0"/></td><td><input type="text" id="spdToll10CitWarn" name="spdToll10CitWarn" value="0"/></td><td><input type="text" id="spdToll10Comments" name="spdToll10Comments" /></td></tr>
	<tr><td>Speed - TOLL AREA (35 ZONE)&nbsp;<img id="spd_tollarea35" src="bloc_notes_sz.png" height = "9%" width = "9%"/></td><td><input type="text" id = 'spdToll35CitSum' name="spdToll35CitSum" value="0"/></td><td><input type="text" id="spdToll35CitWarn" name="spdToll35CitWarn" value="0"/></td><td><input type="text" id="spdToll35Comments" name="spdToll35Comments" /></td></tr>
	<tr><td>Defective Equipment</td><td><input type="text" name="dftsCitSum" id="dftsCitSum" value="0"/></td><td><input type="text" id="dftsCitWarn" name="dftsCitWarn" value="0"/></td><td><input type="text" id="dftsComments" name="dftsComments" /></td></tr>
	<tr><td>Drug Violation - CIVIL </td><td><input type="text" name="drgVioCivilCitSum" id="drgVioCivilCitSum" value="0"/></td><td><input type="text" id="drgVioCivilCitWarn" name="drgVioCivilCitWarn" value="0"/></td><td><input type="text" id="drgVioCivilComments" name="drgVioCivilComments" /></td></tr>
	<tr><td>Drug Violation - CRIMINAL </td><td><input type="text" name="drgVioCriminalCitSum" id="drgVioCriminalCitSum" value="0"/></td><td><input type="text" id="drgVioCriminalCitWarn" name="drgVioCriminalCitWarn" value="0"/></td><td><input type="text" id="drgVioCriminalComments" name="drgVioCriminalComments" /></td></tr>
	<tr><td>Warrant</td><td><input type="text" name="warntCitSum" id="warntCitSum" value="0"/></td><td><input type="text" name="warntCitWarn" id="warntCitWarn" value="0"/></td><td><input type="text" id="warntComments" name="warntComments" /></td></tr>
	<tr><td>Seat Belt Violation&nbsp;<img id="stbltvio" src="bloc_notes_sz.png" height = "9%" width = "9%"/></td><td><input type="text" id = "seatBltCitSum" name="seatBltCitSum" id="seatBltCitSum" value="0"/></td><td><input type="text" name="seatBltCitWarn" id="seatBltCitWarn" value="0"/></td><td><input type="text" id="seatBltComments" name="seatBltComments" /></td></tr>
	<tr><td>Child Restraint&nbsp;<img id="chldRestr" src="bloc_notes_sz.png" height = "9%" width = "9%"/></td><td><input type="text" id = "chldRestrCitSum" name="chldRestrCitSum" id="chldRestrCitSum" value="0"/></td><td><input type="text" name="chldRestrCitWarn" id="chldRestrCitWarn" value="0"/></td><td><input type="text" id="chldRestrComments" name="chldRestrComments" /></td></tr>
	<tr><td>OAS/Habitual Offender</td><td><input type="text" id="oasCitSum" name="oasCitSum" value="0"/></td><td><input type="text" name="oasCitWarn" id="oasCitWarn" value="0"/></td><td><input type="text" id="oasComments" name="oasComments" /></td></tr>
	<tr><td>Comm. Vehicle Violation</td><td><input type="text" name="commVehicleViolationCitSum" id="commVehicleViolationCitSum" value="0"/></td><td><input type="text" name="commVehicleViolationCitWarn" id="commVehicleViolationCitWarn" value="0"/></td><td><input type="text" id="commVehicleViolationComments" name="commVehicleViolationComments" /></td></tr>
	<tr><td>Uninsured Motorist</td><td><input type="text" name="uninsrdMotrCitSum" id="uninsrdMotrCitSum" value="0"/></td><td><input type="text" name="uninsrdMotrCitWarn" id="uninsrdMotrCitWarn" value="0"/></td><td><input type="text" id="uninsrdMotrComments" name="uninsrdMotrComments" /></td></tr>
	<tr><td>Other Moving Violations</td><td><input type="text" name="othMvgVltCitSum" id="othMvgVltCitSum" value="0"/></td><td><input type="text" name="othMvgVltCitWarn" id="othMvgVltCitWarn" value="0"/></td><td><input type="text" id="othMvgVltComments" name="othMvgVltComments" /></td></tr>
	<tr><td>Other Non Moving Violations</td><td><input type="text" name="othNonMvgVltCitSum" id="othNonMvgVltCitSum" value="0"/></td><td><input type="text" name="othNonMvgVltCitWarn" id="othNonMvgVltCitWarn" value="0"/></td><td><input type="text" id="othNonMvgVltComments" name="othNonMvgVltComments" /></td></tr>
	</table>

	<br/>
	<br/>
	<br/>
	<p>Total number of citation summons:&nbsp;<span id="cit_summons">0</span><br/>
	Total number of citation warnings:&nbsp;<span id="cit_warnings">0</span>
	</p>
	<br/>
	<br/>
	<br/>
	<p>Total number of stops <input type="text" name="total_stops" /></p>
	</fieldset>


	<fieldset>

	<p><strong>Officer Details</strong></p>
	<table id="officer_details">
	<thead><tr><th>Name</th><th>Officer Hours</th></tr></thead>
	<tr><td><input type="text" name="name[]" class="officerDtl" /></td><td><input type="text" name="hours[]" class="officerHours officerDtl"  value='0'/></td></tr>
	<!--
	<tr><td><input type="text" name="name[]" class="officerDtl" /></td><td><input type="text" name="hours[]" class="officerDtl" id="hours2" value='0'/></td><td><input type="text" name="rate[]" id ="rate2"class="officerDtl" value='0.00'/></td><td id="cst2Val">$0.00</td></tr>

	<tr><td><input type="text" name="name[]" class="officerDtl"/></td><td><input type="text" name="hours[]" class="officerDtl" id="hours3" value='0'/></td><td><input type="text" name="rate[]" id ="rate3"class="officerDtl" value='0.00'/></td><td id="cst3Val">$0.00</td></tr>

	<tr><td><input type="text" name="name[]" class="officerDtl"/></td><td><input type="text" name="hours[]" class="officerDtl" id="hours4" value='0'/></td><td><input type="text" name="rate[]" id ="rate4"class="officerDtl" value='0.00'/></td><td id="cst4Val">$0.00</td></tr>

	<tr><td><input type="text" name="name[]" class="officerDtl"/></td><td><input type="text" name="hours[]" class="officerDtl" id="hours5" value='0'/></td><td><input type="text" name="rate[]" id ="rate5"class="officerDtl" value='0.00'/></td><td id="cst5Val">$0.00</td></tr>-->

	</table>
	<p><strong>Total Detail Hours:</strong>&nbsp;&nbsp;<span id="ttlDtlHrVal">0</span></p>


	<button id="addButton">Add an officer</button>&nbsp;&nbsp;&nbsp;<button id="removeButton">Remove an officer</button>
	<br/>
	<br/>
	<br/>
	<p>Name of submitting officer: <input type='text' name='officerSubmit'/></p>
	<br/>
	<br/>
	<br/>
	<p>RMS/CAD Number:&nbsp;&nbsp;<input type="text" name="rmsCadNumber" id="RmsCadNumber" /></p><br/>
	<p>
	Remarks:&nbsp;&nbsp;<textarea rows="4" cols="50" name="remarks"></textarea>
	</p>
	</fieldset>
	<p class="confirmation">By clicking on the following checkbox, you confirm that the above information is correct. &nbsp;<input type="checkbox" name="confirm" value="confirmed"/></p>
	<p style="text-align:center;"><input type="submit" class="buttons" name="submit" value="Submit"/>&nbsp;&nbsp;<input type="reset" class="buttons" name="Reset Form"/></p>

	</form>
<?php
}
else
{
?>
	<form>
	<fieldset>
	<p> You have not logged-in. Please log-in and try again.</p>
	</fieldset>
	</form>
<?php
}
?>

</div>
</body>
</html>
