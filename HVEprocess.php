<?php
session_start();
include 'includes/httpsRedirect.inc';
?>
<!DOCTYPE html>
<html>
<head>
<title>Seat Belt High Visibility Enforcement Application</title>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="./jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
<link rel="stylesheet" type="text/css" href="./jquery-ui-1.10.3.custom/css/overcast/jquery-ui-1.10.3.custom.css" / >
<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'/>
<link href='https://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
$(function()
{
		function addFields (CitSum)
	{
		
		if (CitSum=='summons')
		{
			var total = 0;
			
			
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
	var citationSumTotal=0;
	var citationWarnTotal=0;
	
	$('.CitationSum').each(function()
	{
		citationSumTotal=citationSumTotal+parseInt($(this).val());

	});
	$('.CitationWarn').each(function()
	{
		citationWarnTotal=citationWarnTotal+parseInt($(this).val());
	});
	$('#cit_summons').html(citationSumTotal);
	$('#cit_warnings').html(citationWarnTotal);


		var compatible=pickerCompatible();
		if(compatible)
		{
			$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
		}
	$('.officerHours').bind("change",function()
	{
		calculate();
	});
	$('.officerRate').bind("change",function()
		{
			calculate();
		});


	$('#addButton').click(function(){
		$('#officer_details tr:last').after('<tr><td><input type="text" name="name[]" class="officerDtl" /></td><td><input type="text" name="hours[]" class="officerDtl officerHours"  value="0"/></td></tr>');	
		return false;
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
	height: 100%;
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
#wrapper
{
	margin: 0 auto;
	padding: 10px 15px;
	width :80%;
	background-color: #cedce7;
	border-radius: 5px;
	min-height: 100%;
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

//if(isset($_SESSION['logged_in']))
//{
//	$userId = $_SESSION['userId'];

	if(isset($_POST['submit']))
	{
		//require validation object
		require_once 'objects/Validation.php';
		$validate = new Validation();
		$citationsTypArray= array(
		'OUI Liquor',
		'OUI Drugs', 
		'OUI Minor',
		'OUI CDL.04',
		'Speed - Infraction',
		'Speed - Criminal',
		'Speed - Const. Zone',
		'Speed - Const. Zone(DOUBLE FINE)',
		'Speed - TOLL AREA (10 ZONE)',
		'Speed - TOLL AREA (35 ZONE)',
		'Defective Equipment',
		'Drug Violation - CIVIL',
		'Drug Violation - CRIMINAL',
		'Warrant',
		'Safety Belt Violation',
		'Child Restraint',
		'OAS/Habitual Offender',
		'Comm. Vehicle Violation',
		'Uninsured Motorist',
		'Other Moving Violations',
		'Other Non Moving Violations'
		);
		$citationsArray = array(
			'ouiLiquorCitSum'=>'Citation Summons -- OUI Liquor',			
			'ouiLiquorCitWarn'=>'Citation Warnings -- OUI Liquor',
			'ouiDrugsCitSum'=>'Citation Summons -- OUI Drugs',
			'ouiDrugsCitWarn'=>'Citation Warnings -- OUI Drugs',
			'ouiMinorCitSum'=>'Citation Summons -- OUI Minor',
			'ouiMinorCitWarn'=>'Citation Warnings -- OUI Minor',
			'ouiCdl04CitSum'=>'Citation Summons -- OUI CDL.04',
			'ouiCdl04CitWarn'=>'Citation Warnings -- OUI CDL.04',
			'spdInfractionCitSum'=>'Citation Summons -- Speed Infraction',
			'spdInfractionCitWarn'=>'Citation Warnings -- Speed Infraction',
			'spdCriminalCitSum'=>'Citation Summons -- Speed Criminal',
			'spdCriminalCitWarn'=>'Citation Warnings -- Speed Criminal',
			'spdConZneCitSum'=>'Citation Summons -- Speed Const. Zone',
			'spdConZneCitWarn'=>'Citation Warnings -- Speed Const. Zone',
			'spdConZneDblFneCitSum'=>'Citation Summons -- Speed Const. Zone(DOUBLE FINE)',
			'spdConZneDblFneCitWarn'=>'Citation Warnings -- Speed Const. Zone(DOUBLE FINE)',
			'spdToll10CitSum'=>'Citation Summons -- Speed Toll Area (10 Zone)',
			'spdToll10CitWarn'=>'Citation Warnings -- Speed Toll Area (10 Zone)',
			'spdToll35CitSum'=>'Citation Summons -- Speed Toll Area (35 Zone)',
			'spdToll35CitWarn'=>'Citation Warnings -- Speed Toll Area (35 ZONE)',
			'dftsCitSum'=>'Citation Summons -- Defective Equipment',
			'dftsCitWarn'=>'Citation Warnings -- Defective Equipment',
			'drgVioCivilCitSum'=>'Citation Summons -- Drug Violation - CIVIL',
			'drgVioCivilCitWarn'=>'Citation Warnings --Drug Violation - CIVIL',
			'drgVioCriminalCitSum'=>'Citation Summons -- Drug Violation - CRIMINAL',
			'drgVioCriminalCitWarn'=>'Citation Warnings --Drug Violation - CRIMINAL',
			'warntCitSum'=>'Citation Summons -- Warrant',
			'warntCitWarn'=>'Citation Warnings -- Warrant',
			'seatBltCitSum'=>'Citation Summons -- Safety Belt',
			'seatBltCitWarn'=>'Citation Warnings -- Safety Belt',
			'chldRestrCitSum'=>'Citation Summons -- Child Restraint',
			'chldRestrCitWarn'=>'Citation Warnings -- Child Restraint',	
			'oasCitSum'=>'Citation Summons -- OAS/Habitual Offender',
			'oasCitWarn'=>'Citation Warnings -- OAS/Habitual Offender',
			'commVehicleViolationCitSum'=>'Citation Summons -- Comm. Vehicle Violation',
			'commVehicleViolationCitWarn'=>'Citation Warnings -- Comm. Vehicle Violation',
			'uninsrdMotrCitSum'=>'Citation Summons -- Uninsured Motorist',
			'uninsrdMotrCitWarn'=>'Citation Warnings -- Uninsured Motorist',
			'othMvgVltCitSum'=>'Citation Summons -- Other Moving Violations',
			'othMvgVltCitWarn'=>'Citation Warnings -- Other Moving Violations',
			'othNonMvgVltCitSum'=>'Citation Summons -- Other Non Moving Violations',
			'othNonMvgVltCitWarn'=>'Citation Warnings -- Other Non Moving Violations'
		);
		$class = array("CitationSum","CitationWarn");

			if(!isset($_POST['slctPdDept']))
				$_POST['slctPDept']=0;
			$department = $validate->validateInput($_POST['slctPdDept'],'Select a Local Enforcement Agency');

			$date = $validate->validDate($_POST['date'],'Date');
			
			$times = $validate->valid24Time($_POST['startHours'], $_POST['startMinutes'],$_POST['endHours'],$_POST['endMinutes']);
			if(!array_key_exists('activity', $_POST))
				$_POST['activity']=0;
			$officerSubmit = $validate->validAlpha($_POST['officerSubmit'],'Name of submitting officer');
			$activity = $validate->validateInput($_POST['activity'],'Activity');
			$weather = $validate->validAlpha($_POST['weather'],'Weather');
			$county = $validate->validAlpha($_POST['county'],'County');
			$town = $validate->validAlpha($_POST['town'],'Town');
			$route = $validate->validAlphaNum($_POST['route'],'Route/Road');
			$totalStops=$validate->validNum($_POST['total_stops'], 'Number of total stops');
		//validate citation fields
		foreach($citationsArray as $citKey => $citVal)
		{
			
				$citationValues[]=$validate ->validNum($_POST[$citKey],$citVal);
		}
		
		$officerName = $_POST['name'];
		$officerHour = $_POST['hours'];
		$officerNameCount=count($officerName);
		
		for ($i=0;$i<$officerNameCount; $i++)
		{
			
			$officerName[$i]= trim($validate->validEmptyAlpha($officerName[$i],'Officer Details Error: Name'),'');

			$officerHour[$i] = str_replace('$','',trim($validate->validNum($officerHour[$i],'Officer Details Error: Hour'),' '));
			

			if(empty($officerName[$i])&&($officerHour[$i]>0))
			{
					$validate->addErrorMsgs('<p class="error">Officer Details Error: a name field cannot be left blank when the "Officer Hours" 
						field has an amount greater than zero.</p>');
					$validate-> incErrorCount();
			}

			else if(!empty($officerName[$i])&&($officerHour[$i]==0))
			{
					$validate->addErrorMsgs('<p class="error">Officer Details Error: The "Officer Hours" field may not have an amount equal to zero when the name field is completed.</p>');
					$validate-> incErrorCount();
			}
			
		}
		if(!array_key_exists('confirm', $_POST))
			$_POST['confirm'] = 0;
			$confirm = $validate->validateInput($_POST['confirm'],'Confirm');




		$errorno = $validate->getErrorCount();
		/*Test
		echo"<p style=color:white>".$errorno."</p>";
		echo "<p style=color:white>".$date."</p>";*/

		if($errorno==0)
		{
			$dateSubmit =date('Y-m-d');
			$startTime = $times[0].":".$times[1];
			$endTime = $times[2].":".$times[3];
			$userId=$_SESSION['userId'];
			$ouiLiquorCitSum=$_POST['ouiLiquorCitSum'];
			$ouiLiquorCitWarn = $_POST['ouiLiquorCitWarn'];
			$ouiLiquorComments = $_POST['ouiLiquorComments'];
			$ouiDrugsCitSum=$_POST['ouiDrugsCitSum'];
			$ouiDrugsCitWarn = $_POST['ouiDrugsCitWarn'];
			$ouiDrugsComments = $_POST['ouiDrugsComments'];
			$ouiMinorCitSum=$_POST['ouiMinorCitSum'];
			$ouiMinorCitWarn=$_POST['ouiMinorCitWarn'];
			$ouiMinorComments = $_POST['ouiMinorComments'];
			$ouiCdl04CitSum=$_POST['ouiCdl04CitSum'];
			$ouiCdl04CitWarn=$_POST['ouiCdl04CitWarn'];
			$ouiCdl04Comments =$_POST['ouiCdl04Comments'];
			$speedInfractionCitSum=$_POST['spdInfractionCitSum'];
			$speedInfractionCitWarn=$_POST['spdInfractionCitWarn'];
			$speedInfractionComments =$_POST['spdInfractionComments'];
			$speedCriminalCitSum=$_POST['spdCriminalCitSum'];
			$speedCriminalCitWarn=$_POST['spdCriminalCitWarn'];
			$speedCriminalComments=$_POST['spdCriminalComments'];
			$speedConstZoneCitSum=$_POST['spdConZneCitSum'];
			$speedConstZoneCitWarn=$_POST['spdConZneCitWarn'];
			$speedConstZoneComments=$_POST['spdConZneComments'];
		$speedConstZoneDblFneCitSum=$_POST['spdConZneDblFneCitSum'];
		$speedConstZoneDblFneCitWarn=$_POST['spdConZneDblFneCitWarn'];
		$speedConstZoneDblFneComments=$_POST['spdConZneDblFneComments'];
		$speedTollArea10ZoneCitSum=$_POST['spdToll10CitSum'];
		$speedTollArea10ZoneCitWarn=$_POST['spdToll10CitWarn'];
		$speedTollArea10ZoneComments=$_POST['spdToll10Comments'];
		$speedTollArea35ZoneCitSum=$_POST['spdToll35CitSum'];
		$speedTollArea35ZoneCitWarn=$_POST['spdToll35CitWarn'];
		$speedTollArea35ZoneComments=$_POST['spdToll35Comments'];
		$dftEquipmentCitSum=$_POST['dftsCitSum'];
		$dftEquipmentCitWarn=$_POST['dftsCitWarn'];
		$dftEquipmentComments=$_POST['dftsComments'];
		$drgViolationCivilCitSum=$_POST['drgVioCivilCitSum'];
		$drgViolationCivilCitWarn=$_POST['drgVioCivilCitWarn'];
		$drgViolationCivilComments=$_POST['drgVioCivilComments'];
		$drgViolationCriminalCitSum=$_POST['drgVioCriminalCitSum'];
		$drgViolationCriminalCitWarn=$_POST['drgVioCriminalCitWarn'];
		$drgViolationCriminalComments=$_POST['drgVioCriminalComments'];
		$warrantCitSum=$_POST['warntCitSum'];
		$warrantCitWarn=$_POST['warntCitWarn'];
		$warrantComments=$_POST['warntComments'];
		$stBltViolationCitSum= $_POST['seatBltCitSum'];
		$stBltViolationCitWarn=$_POST['seatBltCitWarn'];
		$stBltViolationComments = $_POST['seatBltComments'];
		$chldRestraintCitSum=$_POST['chldRestrCitSum'];
		$chldRestraintCitWarn=$_POST['chldRestrCitWarn'];
		$chldRestraintComments=$_POST['chldRestrComments'];
		$oasHabitualOffenderCitSum=$_POST['oasCitSum'];
		$oasHabitualOffenderCitWarn=$_POST['oasCitWarn'];
		$oasHabitualOffenderComments=$_POST['oasComments'];
		$commVehicleOffenderCitSum=$_POST['commVehicleViolationCitSum'];
		$commVehicleOffenderCitWarn=$_POST['commVehicleViolationCitWarn'];
		$commVehicleOffenderComments=$_POST['commVehicleViolationComments'];
		$uninsuredMotoristCitSum=$_POST['uninsrdMotrCitSum'];
		$uninsuredMotoristCitWarn=$_POST['uninsrdMotrCitWarn'];
		$uninsuredMotoristComments=$_POST['uninsrdMotrComments'];
		$otherMovingViolationCitSum=$_POST['othMvgVltCitSum'];	
		$otherMovingViolationCitWarn=$_POST['othMvgVltCitWarn'];
		$otherMovingViolationComments=$_POST['othMvgVltComments'];
		$otherNonMovingViolationCitSum=$_POST['othNonMvgVltCitSum'];
		$otherNonMovingViolationCitWarn=$_POST['othNonMvgVltCitWarn'];
		$otherNonMovingViolationComments =$_POST['othNonMvgVltComments'];
		$remarks=$_POST['remarks'];
		$rmsCadNumber=$_POST['rmsCadNumber'];
		$approvalStatus='unapproved';
			try
			{
					include_once 'includes/dbConnect.inc';
					$db->beginTransaction();
					$query = 'INSERT INTO reportTable
					(rptId,userId, officerSubmit,dateSubmit, detailDate, totalStops, dateApproved, department, startTime, endTime, activity, weather, county, town, route, ouiLiquorCitSum,ouiLiquorCitWarn,ouiLiquorComments,ouiMinorCitSum, ouiMinorCitWarn,ouiMinorComments,
					ouiDrugsCitSum,ouiDrugsCitWarn,ouiDrugsComments,ouiCdl04CitSum,ouiCdl04CitWarn,ouiCdl04Comments,speedInfractionCitSum,speedInfractionCitWarn,speedInfractionComments,speedCriminalCitSum, speedCriminalCitWarn, speedCriminalComments,speedConstZoneCitSum, speedConstZoneCitWarn,speedConstZoneComments,
					speedConstZoneDblFneCitSum, speedConstZoneDblFneCitWarn, speedConstZoneDblFneComments, speedTollArea10ZoneCitSum, speedTollArea10ZoneCitWarn, speedTollArea10ZoneComments, speedTollArea35ZoneCitSum, speedTollArea35ZoneCitWarn, speedTollArea35ZoneComments, dftEquipmentCitSum, dftEquipmentCitWarn,
					dftEquipmentComments, drgViolationCivilCitSum, drgViolationCivilCitWarn, drgViolationCivilComments, drgViolationCriminalCitSum, drgViolationCriminalCitWarn, drgViolationCriminalComments,warrantCitSum, warrantCitWarn, warrantComments, stBltViolationCitSum, stBltViolationCitWarn, stBltViolationComments, chldRestraintCitSum, chldRestraintCitWarn, chldRestraintComments, oasHabitualOffenderCitSum,
					oasHabitualOffenderCitWarn, oasHabitualOffenderComments, commVehicleOffenderCitSum, commVehicleOffenderCitWarn, commVehicleOffenderComments, uninsuredMotoristCitSum, uninsuredMotoristCitWarn, uninsuredMotoristComments, otherMovingViolationsCitSum, otherMovingViolationsCitWarn, otherMovingViolationsComments, otherNonMovingViolationsCitSum, otherNonMovingViolationsCitWarn, otherNonMovingViolationsComments, remarks, rmsCadNumber, approvalStatus)
					
					VALUES
					(:rptId,:userId, :officerSubmit,:dateSubmit, :detailDate, :totalStops, :dateApproved, :department, :startTime, :endTime, :activity, :weather, :county, :town, :route, :ouiLiquorCitSum, :ouiLiquorCitWarn, :ouiLiquorComments, :ouiMinorCitSum, :ouiMinorCitWarn, :ouiMinorComments,
					:ouiDrugsCitSum,:ouiDrugsCitWarn,:ouiDrugsComments,:ouiCdl04CitSum, :ouiCdl04CitWarn, :ouiCdl04Comments, :speedInfractionCitSum, :speedInfractionCitWarn,:speedInfractionComments, :speedCriminalCitSum, :speedCriminalCitWarn,:speedCriminalComments, :speedConstZoneCitSum,:speedConstZoneCitWarn, :speedConstZoneComments,
					:speedConstZoneDblFneCitSum, :speedConstZoneDblFneCitWarn, :speedConstZoneDblFneComments, :speedTollArea10ZoneCitSum, :speedTollArea10ZoneCitWarn, :speedTollArea10ZoneComments, :speedTollArea35ZoneCitSum, :speedTollArea35ZoneCitWarn, :speedTollArea35ZoneComments, :dftEquipmentCitSum, :dftEquipmentCitWarn,
					:dftEquipmentComments, :drgViolationCivilCitSum, :drgViolationCivilCitWarn, :drgViolationCivilComments, :drgViolationCriminalCitSum, :drgViolationCriminalCitWarn, :drgViolationCriminalComments, :warrantCitSum, :warrantCitWarn, :warrantComments, :stBltViolationCitSum, :stBltViolationCitWarn, :stBltViolationComments, :chldRestraintCitSum, :chldRestraintCitWarn, :chldRestraintComments, :oasHabitualOffenderCitSum,
					:oasHabitualOffenderCitWarn, :oasHabitualOffenderComments, :commVehicleOffenderCitSum, :commVehicleOffenderCitWarn, :commVehicleOffenderComments, :uninsuredMotoristCitSum, :uninsuredMotoristCitWarn, :uninsuredMotoristComments, :otherMovingViolationCitSum, :otherMovingViolationCitWarn, :otherMovingViolationComments, :otherNonMovingViolationCitSum, :otherNonMovingViolationCitWarn, :otherNonMovingViolationComments, :remarks, :rmsCadNumber, :approvalStatus)';
					
					$statement = $db->prepare($query);
					$statement->bindValue(':rptId','');
					$statement->bindValue(':userId',$userId);
					$statement->bindValue(':officerSubmit',$officerSubmit);
					$statement->bindValue(':dateSubmit',$dateSubmit);
					$statement->bindValue(':detailDate',$date);
					$statement->bindValue(':dateApproved','');
					$statement->bindValue(':totalStops',$totalStops);
					$statement->bindValue(':department',$department);
					$statement->bindValue(':startTime',$startTime);
					$statement->bindValue(':endTime',$endTime);
					$statement->bindValue(':activity',$activity);
					$statement->bindValue(':weather',$weather);
					$statement->bindValue(':county',$county);
					$statement->bindValue(':town',$town);
					
					$statement->bindValue(':route',$route);
					
					$statement->bindValue(':ouiLiquorCitSum',$ouiLiquorCitSum);
					$statement->bindValue(':ouiLiquorCitWarn',$ouiLiquorCitWarn);
					$statement->bindValue(':ouiLiquorComments',$ouiLiquorComments);
				
					$statement->bindValue(':ouiMinorCitSum',$ouiMinorCitSum);
					$statement->bindValue(':ouiMinorCitWarn',$ouiMinorCitSum);
					$statement->bindValue(':ouiMinorComments',$ouiMinorComments);
						
					$statement->bindValue(':ouiDrugsCitSum',$ouiDrugsCitSum);
					$statement->bindValue(':ouiDrugsCitWarn',$ouiDrugsCitSum);
					
					$statement->bindValue(':ouiDrugsComments',$ouiDrugsComments);
					
					$statement->bindValue(':ouiCdl04CitSum',$ouiCdl04CitSum);
					$statement->bindValue(':ouiCdl04CitWarn',$ouiCdl04CitWarn);
					
					$statement->bindValue(':ouiCdl04Comments',$ouiCdl04Comments);
					
					$statement->bindValue(':speedInfractionCitSum',$speedInfractionCitSum);
					$statement->bindValue(':speedInfractionCitWarn',$speedInfractionCitWarn);
					$statement->bindValue(':speedInfractionComments',$speedInfractionComments);
					
					$statement->bindValue(':speedCriminalCitSum',$speedCriminalCitSum);
					$statement->bindValue(':speedCriminalCitWarn',$speedCriminalCitWarn);
					$statement->bindValue(':speedCriminalComments',$speedCriminalComments);
				
					$statement->bindValue(':speedConstZoneCitSum',$speedConstZoneCitSum);
					
					$statement->bindValue(':speedConstZoneCitWarn',$speedConstZoneCitWarn);
					
					$statement->bindValue(':speedConstZoneComments',$speedConstZoneComments);
					
					$statement->bindValue(':speedConstZoneDblFneCitSum','');
					
					$statement->bindValue(':speedConstZoneDblFneCitWarn',$speedConstZoneDblFneCitWarn);
					
					$statement->bindValue(':speedConstZoneDblFneComments', $speedConstZoneDblFneComments);
					
					$statement->bindValue(':speedTollArea10ZoneCitSum',$speedTollArea10ZoneCitSum);
					$statement->bindValue(':speedTollArea10ZoneCitWarn',$speedTollArea10ZoneCitWarn);
					$statement->bindValue(':speedTollArea10ZoneComments',$speedTollArea10ZoneComments);
					
					$statement->bindValue(':speedTollArea35ZoneCitSum',$speedTollArea35ZoneCitSum);
					$statement->bindValue(':speedTollArea35ZoneCitWarn',$speedTollArea35ZoneCitWarn);
					$statement->bindValue(':speedTollArea35ZoneComments',$speedTollArea35ZoneComments);
					$statement->bindValue(':dftEquipmentCitSum',$dftEquipmentCitSum);
					$statement->bindValue(':dftEquipmentCitWarn',$dftEquipmentCitWarn);
					$statement->bindValue(':dftEquipmentComments',$dftEquipmentComments);
					
					$statement->bindValue(':drgViolationCivilCitSum',$drgViolationCivilCitSum);
					$statement->bindValue(':drgViolationCivilCitWarn',$drgViolationCivilCitWarn);
					$statement->bindValue(':drgViolationCivilComments',$drgViolationCivilComments);
					
					$statement->bindValue(':drgViolationCriminalCitSum',$drgViolationCriminalCitSum);
					$statement->bindValue(':drgViolationCriminalCitWarn',$drgViolationCriminalCitWarn);
					$statement->bindValue(':drgViolationCriminalComments',$drgViolationCriminalComments);
					
					$statement->bindValue(':warrantCitSum',$warrantCitSum);
					$statement->bindValue(':warrantCitWarn',$warrantCitWarn);
					$statement->bindValue(':warrantComments',$warrantComments);
					$statement->bindValue(':stBltViolationCitSum',$stBltViolationCitSum);
					$statement->bindValue(':stBltViolationCitWarn',$stBltViolationCitWarn);
					$statement->bindValue(':stBltViolationComments',$stBltViolationComments);
					$statement->bindValue(':chldRestraintCitSum',$chldRestraintCitSum);
					$statement->bindValue(':chldRestraintCitWarn', $chldRestraintCitWarn);
					$statement->bindValue(':chldRestraintComments',$chldRestraintComments);
					
					$statement->bindValue(':oasHabitualOffenderCitSum',$oasHabitualOffenderCitSum);
					
					$statement->bindValue(':oasHabitualOffenderCitWarn',$oasHabitualOffenderCitWarn);
					$statement->bindValue(':oasHabitualOffenderComments',$oasHabitualOffenderComments);
					$statement->bindValue(':commVehicleOffenderCitSum',$commVehicleOffenderCitSum);
					$statement->bindValue(':commVehicleOffenderCitWarn',$commVehicleOffenderCitWarn);
					$statement->bindValue(':commVehicleOffenderComments',$commVehicleOffenderComments);
					$statement->bindValue(':uninsuredMotoristCitSum',$uninsuredMotoristCitSum);
					$statement->bindValue(':uninsuredMotoristCitWarn',$uninsuredMotoristCitWarn);
					$statement->bindValue(':uninsuredMotoristComments',$uninsuredMotoristComments);
					$statement->bindValue(':otherMovingViolationCitSum',$otherMovingViolationCitSum);
					$statement->bindValue(':otherMovingViolationCitWarn',$otherMovingViolationCitWarn);
					$statement->bindValue(':otherMovingViolationComments',$otherMovingViolationComments);
					$statement->bindValue(':otherNonMovingViolationCitSum',$otherNonMovingViolationCitSum);
					$statement->bindValue(':otherNonMovingViolationCitWarn',$otherNonMovingViolationCitWarn);
					$statement->bindValue(':otherNonMovingViolationComments',$otherNonMovingViolationComments);
					$statement->bindValue(':remarks',$remarks);
					$statement->bindValue(':rmsCadNumber',$rmsCadNumber);
					$statement->bindValue(':approvalStatus',$approvalStatus);
					
					$statement->execute();
					
					$reportId = $db->lastInsertId();
					
					//Citation tables
					if((array_key_exists('spdInfractionCitSumCitClass',$_POST))||(array_key_exists('spdCriminalCitSumCitClass',$_POST))||(array_key_exists('spdConZneCitSumCitClass',$_POST))||(array_key_exists('spdConZneDblFneCitSumCitClass',$_POST))||(array_key_exists('spdToll10CitSumCitClass',$_POST))||(array_key_exists('spdToll35CitSumCitClass',$_POST))||(array_key_exists('seatBltCitSumCitClass',$_POST))||(array_key_exists('chldRestrCitSumCitClass',$_POST)))
					{
						$query2 = 'INSERT INTO citationsTable 
						(citId,rptId,citNumber,citType)
						VALUES(:citId, :rptId, :citNumber, :citType)';
						
						$statements = $db->prepare($query2);
						if(array_key_exists('spdInfractionCitSumCitClass',$_POST))
						{			
							$speedInfraction=$_POST['spdInfractionCitSumCitClass'];
							$arrayCount=count($speedInfraction);
						
							for($i=0; $i<$arrayCount; $i++)
							{
								$statements->bindValue(':citId','');
								$statements->bindValue(':rptId',$reportId);
								$statements->bindValue(':citNumber',$speedInfraction[$i]);
								$statements->bindValue(':citType','Speed Infraction');
								$statements->execute();
							}
						}
						if(array_key_exists('spdCriminalCitSumCitClass',$_POST))
						{
							$speedCriminal = $_POST['spdCriminalCitSumCitClass'];
							$arrayCount = count($speedCriminal);
							for($i=0; $i<$arrayCount; $i++)
							{
								$statements->bindValue(':citId','');
								$statements->bindValue(':rptId',$reportId);
								$statements->bindValue(':citNumber',$speedCriminal[$i]);
								$statements->bindValue(':citType','Speed Infraction');
								$statements->execute();
							}
						
						}
						
						if(array_key_exists('spdConZneCitSumCitClass',$_POST))
						{
							$speedConZone = $_POST['spdConZneCitSumCitClass'];
							$arrayCount = count($speedConZone);
							for($i=0; $i<$arrayCount; $i++)
							{
								$statements->bindValue(':citId','');
								$statements->bindValue(':rptId',$reportId);
								$statements->bindValue(':citNumber',$speedConZone[$i]);
								$statements->bindValue(':citType','Speed Construction Zone');
								$statements->execute();
							}
						
						}
						
						if(array_key_exists('spdConZneDblFneCitSumCitClass',$_POST))
						{
							$speedConZoneDbl = $_POST['spdConZneDblFneCitSumCitClass'];
							$arrayCount = count($speedConZoneDbl);
							for($i=0; $i<$arrayCount; $i++)
							{
								$statements->bindValue(':citId','');
								$statements->bindValue(':rptId',$reportId);
								$statements->bindValue(':citNumber',$speedConZoneDbl[$i]);
								$statements->bindValue(':citType','Speed Construction Zone Double Fine');
								$statements->execute();
							}
						
						}
						
						if(array_key_exists('spdToll10CitSumCitClass',$_POST))
						{
							$speedToll10 = $_POST['spdToll10CitSumCitClass'];
							$arrayCount = count($speedToll10);
							for($i=0; $i<$arrayCount; $i++)
							{
								$statements->bindValue(':citId','');
								$statements->bindValue(':rptId',$reportId);
								$statements->bindValue(':citNumber',$speedToll10[$i]);
								$statements->bindValue(':citType','Speed Toll Area 10 Construction Zone');
								$statements->execute();
							}
						
						}
						
						if(array_key_exists('spdToll35CitSumCitClass',$_POST))
						{
							$speedToll35 = $_POST['spdToll35CitSumCitClass'];
							$arrayCount = count($speedToll35);
							for($i=0; $i<$arrayCount; $i++)
							{
								$statements->bindValue(':citId','');
								$statements->bindValue(':rptId',$reportId);
								$statements->bindValue(':citNumber',$speedToll35[$i]);
								$statements->bindValue(':citType','Speed Toll Area 35 Construction Zone');
								$statements->execute();
							}
						
						}
						
						if(array_key_exists('seatBltCitSumCitClass',$_POST))
						{
							$seatBelt = $_POST['seatBltCitSumCitClass'];
							$arrayCount = count($seatBelt);
							for($i=0; $i<$arrayCount; $i++)
							{
								$statements->bindValue(':citId','');
								$statements->bindValue(':rptId',$reportId);
								$statements->bindValue(':citNumber',$seatBelt[$i]);
								$statements->bindValue(':citType','Seat Belt Violation');
								$statements->execute();
							}
						
						}
						
						if(array_key_exists('chldRestrCitSumCitClass',$_POST))
						{
							$childRestraint = $_POST['chldRestrCitSumCitClass'];
							$arrayCount = count($childRestraint);
							for($i=0; $i<$arrayCount; $i++)
							{
								$statements->bindValue(':citId','');
								$statements->bindValue(':rptId',$reportId);
								$statements->bindValue(':citNumber',$childRestraint[$i]);
								$statements->bindValue(':citType','Child Restraint Violation');
								$statements->execute();
							}
						
						}				
					}
					
				//officer name table
				
				$query3 = 'INSERT INTO officerDetailsTable
						(offDtlId,rptId,officerName,officerHours)
						VALUES (:offDtlId,:rptId,:officerName,:officerHours)';
				$officerNamesCount = count($officerName);
				$newStatements = $db->prepare($query3);
				for($j=0; $j<$officerNamesCount; $j++)
				{
					$newStatements->bindValue(':offDtlId','');
					$newStatements->bindValue(':rptId',$reportId);
					$newStatements->bindValue(':officerName',$officerName[$j]);
					$newStatements->bindValue(':officerHours',$officerHour[$j]);
					$newStatements->execute();
				}		
				
				
				$db->commit();

?>
<form>
<fieldset>
			<h2>Success!<h2/><p>Your report was successfully added to the database!</p>
</fieldset>
</form>

<?php
			}
			
			catch(PDOException $e)
			{
				$db->rollback();
				echo'<form><fieldset>';
				echo'<p class="error">Error: Unable to connect to the database at this time!<br/>Error code:'.$e->getCode().' Error message:'.$e->getMessage().' </p>';
?>
</form>
<fieldset>
<?php
			}
		
				

		}
		else
		{

			$i=0;
			$j=0;
			//build sticky form
?>
			
			<form name="formHVE" id="formHVE"action="HVEprocess.php" method="POST">
			<h2 style="text-align:center;">Seat Belt High Visibility Enforcement Report</h2>	
			<fieldset>
				<p class="errors" style="font-size: 1.2em;">Errors:</p>
<?php
				$validate ->printErrorMsgs();
?>
			</fieldset>
			<fieldset>
			<p><strong>Report Details</strong></p>
<?php
			$policeDept=array();
			$file = file_get_contents('Maine_PD_List.txt');
			$policeDept = explode(',',$file);
			natcasesort($policeDept);

?>

			<p>Select a Department:&nbsp;&nbsp;<select name='slctPdDept'>
<?php
			foreach($policeDept as $policeDepts)
			{

				echo "<option value='".trim(str_ireplace("'", "?", $policeDepts))."'";
				if($department==trim(str_ireplace("'", "?", $policeDepts)))
				{
					echo"selected='selected'";
				}
		        echo ">$policeDepts</option>";
			}
?>
			</select>
			</p>
<?php
			echo'<p>Date: <input type="text" id="datepicker" name = "date" value="'.$date.'"/></p>';
		//add time fields
?>
			<p>
			Start Time:&nbsp;&nbsp;

			<select name='startHours'>
<?php
			$i=1;
			while($i<25)
			{
				echo "<option value='$i'"; 
				if($times[0]==$i)
					echo " selected='selected'";
				 echo">$i</option>";
				$i++;
			}
			echo"</select>:<select name='startMinutes'>";
			
			$j=0;
			while ($j<60) 
			{
				echo "<option";
				if($j<10)
				{
					$format = sprintf("%02d", $j);
					echo " value='$format'";
					if($times[1]==$format)
						echo "  selected='selected'";
					echo ">$format</option>";

				}
				else

					echo " value='$j'";
					if($times[1]==$j)
					 echo " selected='selected'";
					echo ">$j</option>";	
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
				echo "<option value='$i'";
				if($times[2]==$i)
					echo "selected='selected'";
				echo " >$i</option>";
				$i++;
			}
			echo"</select>: <select name='endMinutes'>";
			
			$j=0;
			while ($j<60) 
			{
				echo"<option";
				if($j<10)
				{
					$format = sprintf("%02d", $j);
					echo " value = '$format'";
					if($times[3]==$format)
						echo "selected='selected' ";
					echo">$format</option>";
				}
				else
					echo " value='$j'";
					if($times[3]==$j)
						echo "selected='selected' ";
					echo ">$j</option>";
					$j++;
			}

		?>
		</select>

		</p>


		<p>
		<?php
		echo 'Activity:&nbsp;&nbsp; Patrol<input name="activity" id="activity" type="radio" value="patrol"'; 
		if(isset($_POST['activity']))
		{
			if($activity=='patrol')
			{
				echo' checked="checked"';
			} 
		}
		echo'/>&nbsp;&nbsp;Roadblock<input name="activity" id="activity" type="radio" value="roadblock"';
		if(isset($_POST['activity']))
		{
			if($activity=='roadblock')
			{
				echo' checked="checked"';
			} 
		}
		echo'/>';
		?>
		</p>
		<p>
	<?php
		echo 'Weather:&nbsp;&nbsp;<input type="text" name="weather" id="weather" value="'.$weather.'"/>';
	?>
		</p>
		<p>
	<?php
		$countiesArray = array('Androscoggin','Aroostook','Cumberland','Franklin','Hancock','Kennebec','Lincoln',
		'Oxford','Penobscot','Piscataquis','Sagadahoc','Somerset','Waldo','Washington','York');

		echo'Location:&nbsp;&nbsp;County:
			<select name="county">
				<option value =""></option>';
				foreach($countiesArray as$countiesArrays)
				{
					echo'<option value="'.$countiesArrays.'"';
					if($countiesArrays ==$county)
					{
						echo' selected="selected"';
					}
					echo '>'.$countiesArrays.'</option>';

				}
			echo '</select>&nbsp;&nbsp;Town:<input type="text" name="town" id="town" value="'.$town.'"/>&nbsp;&nbsp;Route:<input type="text" name="route" id="route" value="'.$route.'"/>';
	?>
	</p>

			</fieldset>

			<fieldset>
			<p><strong>Citations</strong></p>
			<table id="violations">
			<thead><tr><th>Type of citation</th><th>Citation <br/>Summons</th><th>Citation <br/>Warnings</th></tr></thead>
<?php
				$i=1;
				echo"<tr>";
				$n=0;
				$l=0;
				$classIndex=0;
				$count=count($citationsArray);
				foreach($citationsArray as $citKey=>$citValue)
				{

					if($i%2!=0)
					{
						echo"<td>".$citationsTypArray[$l]."</td>";
					}

					echo'<td><input type="text" name="'.$citKey.'"  class="'.$class[$classIndex].'"id="'.$citKey.'" value="'.$citationValues[$n].'"/></td>';
					if(($i%2==0) && ($i!=$count))
					{
						
						echo"</tr><tr>";
						$l++;
					}
					else if ($i==$count)
					{
						
						echo"</tr>";
					}
					if($classIndex==0)
						$classIndex++;
					else
						$classIndex=0;
					$i++;
					$n++;
				}
				//hidden comments			
?>
					<input type="hidden" id="ouiLiquorComments" name="ouiLiquorComments" value =<?php echo"'".$_POST['ouiLiquorComments']."'";?>/>
					<input type="hidden" id="ouiDrugsComments" name="ouiDrugsComments" value =<?php echo"'".$_POST['ouiDrugsComments']."'";?>/>
					<input type="hidden" id="ouiMinorComments" name="ouiMinorComments" value =<?php echo"'".$_POST['ouiMinorComments']."'";?>/>
					<input type="hidden" id="ouiCdl04Comments" name="ouiCdl04Comments" value =<?php echo"'".$_POST['ouiCdl04Comments']."'";?>/>
					<input type="hidden" id="spdInfractionComments" name="spdInfractionComments"value =<?php echo "'".$_POST['spdInfractionComments']."'";?>/>
					<input type="hidden" id="spdCriminalComments" name="spdCriminalComments" value =<?php echo "'".$_POST['spdCriminalComments']."'";?>/>
					<input type="hidden" id="spdConZneComments" name="spdConZneComments" value =<?php echo "'".$_POST['spdConZneComments']."'";?>/>
					<input type="hidden" id="spdConZneDblFneComments" name="spdConZneDblFneComments" value =<?php echo "'".$_POST['spdConZneDblFneComments']."'";?>/>
					<input type="hidden" id="spdToll10Comments" name="spdToll10Comments" value =<?php echo"'".$_POST['spdToll10Comments']."'";?>/>
					<input type="hidden" id="spdToll35Comments" name="spdToll35Comments" value =<?php echo"'".$_POST['spdToll35Comments']."'";?>/>
					<input type="hidden" id="dftsComments" name="dftsComments" value =<?php echo"'".$_POST['dftsComments']."'";?>/>
					<input type="hidden" id="drgVioCivilComments" name="drgVioCivilComments" value =<?php echo"'".$_POST['drgVioCivilComments']."'";?>/>
					<input type="hidden" id="drgVioCriminalComments" name="drgVioCriminalComments" value =<?php echo"'".$_POST['drgVioCriminalComments']."'";?>/>
					<input type="hidden" id="warntComments" name="warntComments" value =<?php echo"'".$_POST['warntComments']."'";?>/>
					<input type="hidden" id="seatBltComments" name="seatBltComments" value =<?php echo"'".$_POST['seatBltComments']."'";?>/>
					<input type="hidden" id="chldRestrComments" name="chldRestrComments" value =<?php echo"'".$_POST['chldRestrComments']."'";?>/>
					<input type="hidden" id="oasComments" name="oasComments" value =<?php echo"'".$_POST['oasComments']."'";?>/>
					<input type="hidden" id="commVehicleViolationComments" name="commVehicleViolationComments" value =<?php echo"'".$_POST['commVehicleViolationComments']."'";?>/>
					<input type="hidden" id="uninsrdMotrComments" name="uninsrdMotrComments" value =<?php echo"'".$_POST['uninsrdMotrComments']."'";?>/>
					<input type="hidden" id="othMvgVltComments" name="othMvgVltComments" value =<?php echo"'".$_POST['othMvgVltComments']."'";?>/>
					<input type="hidden" id="othNonMvgVltComments" name="othNonMvgVltComments" value =<?php echo"'".$_POST['othNonMvgVltComments']."'";?>/>
			<?php
			//hidden citation Numbers
									if(array_key_exists('spdInfractionCitSumCitClass',$_POST))
						{			
							$speedInfraction=$_POST['spdInfractionCitSumCitClass'];
							$arrayCount=count($speedInfraction);
							
							for($i=0; $i<$arrayCount; $i++)
							{
				
								echo'<input type="hidden" name="spdInfractionCitSumCitClass[]" value="'.$speedInfraction[$i].'"/>';
	
							}
						}
						if(array_key_exists('spdCriminalCitSumCitClass',$_POST))
						{
							$speedCriminal = $_POST['spdCriminalCitSumCitClass'];
							$arrayCount = count($speedCriminal);
							for($i=0; $i<$arrayCount; $i++)
							{
					
								echo'<input type="hidden" name="spdCriminalCitSumCitClass[]" value="'.$speedCriminal[$i].'"/>';
	
							}
						
						}
						
						if(array_key_exists('spdConZneCitSumCitClass',$_POST))
						{
							$speedConZone = $_POST['spdConZneCitSumCitClass'];
							$arrayCount = count($speedConZone);
							for($i=0; $i<$arrayCount; $i++)
							{
						
								echo'<input type="hidden" name="spdConZneCitSumCitClass[]" value="'.$speedConZone[$i].'"/>';
					
							}
						
						}
						
						if(array_key_exists('spdConZneDblFneCitSumCitClass',$_POST))
						{
							$speedConZoneDbl = $_POST['spdConZneDblFneCitSumCitClass'];
							$arrayCount = count($speedConZoneDbl);
							for($i=0; $i<$arrayCount; $i++)
							{
			
							echo'<input type="hidden" name="spdConZneDblFneCitSumCitClass[]" value="'.$speedConZoneDbl[$i].'"/>';
				
							}
						
						}
						
						if(array_key_exists('spdToll10CitSumCitClass',$_POST))
						{
							$speedToll10 = $_POST['spdToll10CitSumCitClass'];
							$arrayCount = count($speedToll10);
							for($i=0; $i<$arrayCount; $i++)
							{
					
								echo'<input type="hidden" name="spdToll10CitSumCitClass[]" value="'.$speedToll10[$i].'"/>';
							
							}
						
						}
						
						if(array_key_exists('spdToll35CitSumCitClass',$_POST))
						{
							$speedToll35 = $_POST['spdToll35CitSumCitClass'];
							$arrayCount = count($speedToll35);
							for($i=0; $i<$arrayCount; $i++)
							{
						
							echo'<input type="hidden" name="spdToll35CitSumCitClass[]" value="'.$speedToll35[$i].'"/>';
								
							}
						
						}
						
						if(array_key_exists('seatBltCitSumCitClass',$_POST))
						{
							$seatBelt = $_POST['seatBltCitSumCitClass'];
							$arrayCount = count($seatBelt);
							for($i=0; $i<$arrayCount; $i++)
							{
				
							echo'<input type="hidden" name="seatBltCitSumCitClass[]" value="'.$seatBelt[$i].'"/>';
							
							}
						
						}
						
						if(array_key_exists('chldRestrCitSumCitClass',$_POST))
						{
							$childRestraint = $_POST['chldRestrCitSumCitClass'];
							$arrayCount = count($childRestraint);
							for($i=0; $i<$arrayCount; $i++)
							{
							
								echo'<input type="hidden" name="chldRestrCitSumCitClass[]" value="'.$childRestraint[$i].'"/>';
								
							}
						
						}	

			?>
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
			<p>Total number of stops <input type="text" name="total_stops" value=<?php echo "'$totalStops'";?>/></p>
			</fieldset>

			<fieldset>
				<p><strong>Officer Details</strong></p>
				<table id="officer_details">
				<thead><tr><th>Name</th><th>Officer Hours</th></tr></thead>
				<?php
				
				$officerNameLength = count($officerName);

				for($i=0;$i<$officerNameLength;$i++)
				{
					echo'<tr><td><input type="text" name="name[]" class="officerDtl" value="'.$officerName[$i].'"/></td><td><input type="text" name="hours[]" class="officerDtl officerHours" value="'.$officerHour[$i].'"/></td></tr>';
				}

			?>
			</table>
			<!--<p><strong>Total Detail Hours:</strong>&nbsp;&nbsp;<span id="ttlDtlHrVal">0</span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Detail Cost:</strong>&nbsp;&nbsp;&nbsp;<span id="cstDtlVal">$0.00</span></p>-->
				<p><button id="addButton">Add an officer</button>&nbsp;&nbsp;&nbsp;<button id="removeButton">Remove an officer</button></p>
			<br/>
			<br/>
			<br/>
				<p>Name of submitting officer: <input type='text' name='officerSubmit' value="<?php echo $officerSubmit ?>"/></p>
			<br/>
			<br/>
			<br/>
			<p>RMS/CAD Number:&nbsp;&nbsp;<input type="text" name="rmsCadNumber" id="RmsCadNumber" <?php echo "value ='".$_POST['rmsCadNumber']."'"; ?>/></p><br/>
			<p>
			Remarks:&nbsp;&nbsp;<textarea rows="4" cols="50" name="remarks"><?php echo $_POST['remarks'] ?></textarea>
			</p>
						</fieldset>
			<p class="confirmation">By clicking on the following checkbox, you confirm that the above information is correct. &nbsp;<input type="checkbox" name="confirm" value="confirmed" <?php if(isset($_POST['confirm'])) echo "checked='checked'"; ?> /></p>
			<p style="text-align:center;"><input type="submit" class="buttons" name="submit" value="Submit"/>&nbsp;&nbsp;<input type="reset" class="buttons" name="Reset Form"/></p>
		
			<?php //echo $_POST['confirm']; ?>
		</form>

<?php
		}


	}
	else
	{
		
		echo"<p>You have not submitted form data for processing. Please go back<a href='HVE.php'></a> 
			and complete the form. Then press submit.</p>";
		

	}




/*
else
{
?>
	<p>You are not logged-in. Please go <a href="index.php">back</a> to login. </p>




<?php

}
*/


?>
</div>
</body>
</html>