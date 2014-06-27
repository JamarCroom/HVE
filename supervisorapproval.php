<?php
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
<!--<link rel="stylesheet" type="text/css" href="style/bhsStyle.css" />-->
<title>Seat Belt High Visibility Enforcement Application</title>
<style type="text/css">
*
{
	margin: 0;
	padding: 0;
}
.center
{
	text-align: center;
}



.success
{
	color: blue;
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
#wrapper
{
	margin: 0 auto;
	padding: 10px 15px;
	width :80%;
	background-color: #cedce7;
	border-radius: 5px;
	min-height: 100%;
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
<script type="text/javascript">
$(function()
{
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
		}
		$('.disabled').each(function()
		{
			$(this).prop('disabled',true);
		});


		var compatible = pickerCompatible();

		if(compatible)
			$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });




	$('#edit').click(function()
	{
		$('.disabled').each(function()
		{
			$(this).prop('disabled',false);
		});
		return false;
	});

	$('#submit').click(function()
	{
		$('.disabled').each(function()
		{
			$(this).prop('disabled',false);
		});

	});


});
</script>
</head>
<body>
	<div id="wrapper">
	<div id="header"><img src="pics/bhs_logo.jpg" id="logo" style="vertical-align: middle; border-radius: 5px;"/><span id="logoWording">Bureau of Highway Safety Web Applications Portal</span></div>
<?php
	include 'includes/navbar.inc';
$showForm= true;
if(isset($_GET['pass'])&&(isset($_SESSION['rptId'])||isset($_GET['rptId'])))
{
	if(isset($_GET['rptId']))
	{
		require_once 'objects/Validation.php';
		include_once 'includes/dbConnect.inc';
		$validate = new Validation();
		$_SESSION['rptId'] = $_GET['rptId'];
		$rptId = $_SESSION['rptId'];
		$officerName = array();
		$officerHours= array();
		$offDtlId =array();
		$citId =array();
		$citNumber=array();
		$citType = array();

		$query = 'SELECT * FROM reportTable WHERE rptId=:rptId'; // report table query
		$query2 ='SELECT * FROM citationsTable WHERE rptId=:rptId';
		$query3='SELECT * FROM officerDetailsTable WHERE rptId=:rptId';
		try
		{
			$db->beginTransaction();
			//reports	
				$statement=$db->prepare($query);
				$statement->bindValue(':rptId',$rptId);
				$statement->execute();
				$reportTable=$statement->fetchAll();
			//citations
				$statement=$db->prepare($query2);
				$statement->bindValue(':rptId',$rptId);
				$statement->execute();
				$citationTable=$statement->fetchAll();
			//officer details table
				$statement=$db->prepare($query3);
				$statement->bindValue(':rptId',$rptId);
				$statement->execute();
				$officerTable=$statement->fetchAll();
				$db->commit();

				if(!empty($citationTable))
				{
					$i=0;
					foreach($citationTable as$citationTables)
					{
						$citId[$i] =$citationTables['citId'];
						$citNumber[$i]=$citationTables['citNumber'];
						$citType[$i]= $citationTables['citType'];
						$i++;
					}
					$citationCount=count($citId);
				}

				if(!empty($officerTable))
				{
					$i=0;
					foreach($officerTable as$officerTables)
					{
						$officerName[$i] =$officerTables['officerName'];
						$officerHours[$i]=$officerTables['officerHours'];
						$offDtlId[$i] =$officerTables['offDtlId'];
						$i++;
					}
					$officerNameCount=count($officerName);
				}
				
				foreach($reportTable as $reportTables)
				{
					$rptId=$reportTables['rptId'];
					$detailDate=$reportTables['detailDate'];
					$department=$reportTables['department'];						
					$startTime = $reportTables['startTime'];
					$startTimes = explode(':',$startTime);
					$endTime=$reportTables['endTime'];
					$endTimes =explode(':',$endTime);
					$times[0]=$startTimes[0];
					$times[1]=$startTimes[1];
					$times[2]=$endTimes[0];
					$times[3]=$endTimes[1];
					$activity=$reportTables['activity'];
					$weather=$reportTables['weather'];
					$county=$reportTables['county'];
					$town=$reportTables['town'];
					$route=$reportTables['route'];
					$totalStops = $reportTables['totalStops'];
			
					$dateApproved;
					$officerSubmit = $reportTables['officerSubmit'];
					$ouiLiquorCitSum=$reportTables['ouiLiquorCitSum'];			
					$ouiDrugsCitSum=$reportTables['ouiDrugsCitSum'];
					$ouiMinorCitSum=$reportTables['ouiMinorCitSum'];
					$ouicdl04CitSum=$reportTables['ouicdl04CitSum']; 
					$spdInfractionCitSum=$reportTables['speedInfractionCitSum'];
					$spdCriminalCitSum=$reportTables['speedCriminalCitSum'];
					$spdConZneCitSum=$reportTables['speedConstZoneCitSum'];
					$spdConZneDblFneCitSum=$reportTables['speedConstZoneDblFneCitSum'];
					$spdToll10CitSum=$reportTables['speedTollArea10ZoneCitSum'];
					$spdToll35CitSum=$reportTables['speedTollArea35ZoneCitSum'];; 
					$dftsCitSum =$reportTables['dftEquipmentCitSum'];
					$drgVioCivilCitSum = $reportTables['drgViolationCivilCitSum']; 
					$drgVioCriminalCitSum= $reportTables['drgViolationCriminalCitSum'];
					$warrantCitSum=$reportTables['warrantCitSum'];
					$seatBltCitSum=$reportTables['stBltViolationCitSum'];
					$chldRestrCitSum=$reportTables['chldRestraintCitSum'];
					$oasCitSum=$reportTables['oasHabitualOffenderCitSum'];
					$commVehicleViolationCitSum=$reportTables['commVehicleOffenderCitSum'];
					$uninsrdMotrCitSum=$reportTables['uninsuredMotoristCitSum'];
					$othMvgVltCitSum=$reportTables['otherMovingViolationsCitSum'];
					$othNonMvgVltCitSum=$reportTables['otherNonMovingViolationsCitSum'];
					$ouiLiquorCitWarn=$reportTables['ouiLiquorCitWarn'];			
					$ouiDrugsCitWarn=$reportTables['ouiDrugsCitWarn'];
					$ouiMinorCitWarn=$reportTables['ouiMinorCitWarn'];
					$ouicdl04CitWarn=$reportTables['ouicdl04CitWarn']; 
					$spdInfractionCitWarn=$reportTables['speedInfractionCitWarn'];
					$spdCriminalCitWarn=$reportTables['speedCriminalCitWarn'];
					$spdConZneCitWarn=$reportTables['speedConstZoneCitWarn'];
					$spdConZneDblFneCitWarn=$reportTables['speedConstZoneDblFneCitWarn'];
					$spdToll10CitWarn=$reportTables['speedTollArea10ZoneCitWarn'];
					$spdToll35CitWarn=$reportTables['speedTollArea35ZoneCitWarn'];; 
					$dftsCitWarn =$reportTables['dftEquipmentCitWarn'];
					$drgVioCivilCitWarn = $reportTables['drgViolationCivilCitWarn']; 
					$drgVioCriminalCitWarn= $reportTables['drgViolationCriminalCitWarn'];
					$warrantCitWarn=$reportTables['warrantCitWarn'];
					$seatBltCitWarn=$reportTables['stBltViolationCitWarn'];
					$chldRestrCitWarn=$reportTables['chldRestraintCitWarn'];
					$oasCitWarn=$reportTables['oasHabitualOffenderCitWarn'];
					$commVehicleViolationCitWarn=$reportTables['commVehicleOffenderCitWarn'];
					$uninsrdMotrCitWarn=$reportTables['uninsuredMotoristCitWarn'];
					$othMvgVltCitWarn=$reportTables['otherMovingViolationsCitWarn'];
					$othNonMvgVltCitWarn=$reportTables['otherNonMovingViolationsCitWarn'];
					$remarks =$reportTables['remarks'];
					$rmsCadNumber = $reportTables['rmsCadNumber'];
					$ouiLiquorComments=$reportTables['ouiLiquorComments'];			
					$ouiDrugsComments=$reportTables['ouiDrugsComments'];
					$ouiMinorComments=$reportTables['ouiMinorComments'];
					$ouicdl04Comments=$reportTables['ouicdl04Comments']; 
					$spdInfractionComments=$reportTables['speedInfractionComments'];
					$spdCriminalComments=$reportTables['speedCriminalComments'];
					$spdConZneComments=$reportTables['speedConstZoneComments'];
					$spdConZneDblFneComments=$reportTables['speedConstZoneDblFneComments'];
					$spdToll10Comments=$reportTables['speedTollArea10ZoneComments'];
					$spdToll35Comments=$reportTables['speedTollArea35ZoneComments'];; 
					$dftsComments =$reportTables['dftEquipmentComments'];
					$drgVioCivilComments = $reportTables['drgViolationCivilComments']; 
					$drgVioCriminalComments= $reportTables['drgViolationCriminalComments'];
					$warrantComments=$reportTables['warrantComments'];
					$seatBltComments=$reportTables['stBltViolationComments'];
					$chldRestrComments=$reportTables['chldRestraintComments'];
					$oasComments=$reportTables['oasHabitualOffenderComments'];
					$commVehicleViolationComments=$reportTables['commVehicleOffenderComments'];
					$uninsrdMotrComments=$reportTables['uninsuredMotoristComments'];
					$othMvgVltComments=$reportTables['otherMovingViolationsComments'];
					$othNonMvgVltComments=$reportTables['otherNonMovingViolationsComments'];
				}

		}
		catch(PDOException $e)
		{
			$db->rollback();
			include 'includes/dbError.inc';
			$showForm=false;

		}
	}
	elseif(isset($_POST['approved']))	
	{
		$rptId = $_SESSION['rptId'];
		//$detailDate = $_POST['detailDate'];
		if(!isset($_POST['slctPdDept']))
			$_POST['slctPDept']=0;
		require_once 'objects/Validation.php';
		$validate= new Validation();
		$department = $validate->validateInput($_POST['slctPdDept'],'Select a Local Enforcement Agency');
		$totalStops = $validate->validNum($_POST['total_stops'],'Number of total stops');
		$detailDate = $validate->validDate($_POST['date'],'Date');
			
		$times = $validate->valid24Time($_POST['startHours'], $_POST['startMinutes'],$_POST['endHours'],$_POST['endMinutes']);
		if(!array_key_exists('activity', $_POST))
			$_POST['activity']=0;
		$activity = $validate->validateInput($_POST['activity'],'Activity');
		$weather = $validate->validAlpha($_POST['weather'],'Weather');
		$county = $validate->validAlpha($_POST['county'],'County');
		$town = $validate->validAlpha($_POST['town'],'Town');
		$route = $validate->validAlphaNum($_POST['route'],'Route/Road');
		$dateApproved = date('Y-m-d');
		$ouiLiquorCitSum=$validate->validNum($_POST['ouiLiquorCitSum'],'Citation Summons--OUI Liquor');			
		$ouiDrugsCitSum=$validate->validNum($_POST['ouiDrugsCitSum'],'Citation Summons--OUI Drugs');
		$ouiMinorCitSum=$validate->validNum($_POST['ouiMinorCitSum'],'Citation Summons--OUI Minor');
		$ouicdl04CitSum=$validate->validNum($_POST['ouicdl04CitSum'],'Citation Summons--OUI CDL104');
		$spdInfractionCitSum=$validate->validNum($_POST['spdInfractionCitSum'],'Citation Summons--Speed Infraction');
		$spdCriminalCitSum=$validate->validNum($_POST['spdCriminalCitSum'],'Citation Summons--Speed Criminal');
		$spdConZneCitSum=$validate->validNum($_POST['spdConZneCitSum'],'Citation Summons--Speed Construction Zone');
		$spdConZneDblFneCitSum=$validate->validNum($_POST['spdConZneDblFneCitSum'],'Citation Summons--Speed Construction Zone (DOUBLE FINE)');
		$spdToll10CitSum=$validate->validNum($_POST['spdToll10CitSum'],'Citation Summons--Speed Toll (10 Zone)');
		$spdToll35CitSum=$validate->validNum($_POST['spdToll35CitSum'],'Citation Summons--Speed Toll (35 Zone)'); 
		$dftsCitSum =$validate->validNum($_POST['dftsCitSum'],'Citation Summons--Defective Equipment');
		$drgVioCivilCitSum =$validate->validNum($_POST['drgVioCivilCitSum'],'Citation Summons--Drug Violation (CIVIL)'); 
		$drgVioCriminalCitSum =$validate->validNum($_POST['drgVioCriminalCitSum'],'Citation Summons--Drug Violation (CRIMINAL)');  
		$warrantCitSum=$validate->validNum($_POST['warntCitSum'],'Citation Summons--Warrant');
		$seatBltCitSum=$validate->validNum($_POST['seatBltCitSum'],'Citation Summons--Seat Belt');
		$chldRestrCitSum=$validate->validNum($_POST['chldRestrCitSum'],'Citation Summons--Child Restraint');
		$oasCitSum=$validate->validNum($_POST['oasCitSum'],'Citation Summons--OAS/Habitual Offender');
		$commVehicleViolationCitSum=$validate->validNum($_POST['commVehicleViolationCitSum'],'Citation Summons--Comm. Vehicle Violation');
		$uninsrdMotrCitSum=$validate->validNum($_POST['uninsrdMotrCitSum'],'Citation Summons--Uninsured Motorist');
		$othMvgVltCitSum=$validate->validNum($_POST['othMvgVltCitSum'],'Citation Summons--Other Moving Violation');
		$othNonMvgVltCitSum=$validate->validNum($_POST['othNonMvgVltCitSum'],'Citation Summons--Other Non Moving Violation');
		$ouiLiquorCitWarn=$validate->validNum($_POST['ouiLiquorCitWarn'],'Citation Warning-- OUI Liquor');
		$ouiDrugsCitWarn=$validate->validNum($_POST['ouiDrugsCitWarn'],'Citation Warning--OUI Drugs');
		$ouiMinorCitWarn=$validate->validNum($_POST['ouiMinorCitWarn'],'Citation Warning--OUI Minor');
		$ouicdl04CitWarn=$validate->validNum($_POST['ouicdl04CitWarn'],'Citation Warning--OUI CDL 104');
		$spdInfractionCitWarn=$validate->validNum($_POST['spdInfractionCitWarn'],'Citation Warning--Speed Infraction');
		$spdCriminalCitWarn=$validate->validNum($_POST['spdCriminalCitWarn'],'Citation Warning--Speed Criminal');
		$spdConZneCitWarn=$validate->validNum($_POST['spdConZneCitWarn'],'Citation Warning--Speed Construction Zone');
		$spdConZneDblFneCitWarn=$validate->validNum($_POST['spdConZneDblFneCitWarn'],'Citation Warning--Speed Construction Zone (DOUBLE FINE)');
		$spdToll10CitWarn=$validate->validNum($_POST['spdToll10CitWarn'],'Citation Warning--Speed (10 Zone)');
		$spdToll35CitWarn=$validate->validNum($_POST['spdToll35CitWarn'],'Citation Warning--Speed (35 Zone)');
		$dftsCitWarn=$validate->validNum($_POST['dftsCitWarn'],'Citation Warning--Defective Equipment');
		$drgVioCivilCitWarn=$validate->validNum($_POST['drgVioCivilCitWarn'],'Citation Warning--Drug Violation Civil');
		$drgVioCriminalCitWarn=$validate->validNum($_POST['drgVioCriminalCitWarn'],'Citation Warning--Drug Violation Criminal');
		$warrantCitWarn=$validate->validNum($_POST['warntCitWarn'],'Citation Warning--Warrant');
		$seatBltCitWarn=$validate->validNum($_POST['seatBltCitWarn'],'Citation Warning--Seat Belt');
		$chldRestrCitWarn=$validate->validNum($_POST['chldRestrCitWarn'],'Citation Warning--Child Restraint');
		$oasCitWarn=$validate->validNum($_POST['oasCitWarn'],'Citation Warning--OAS Habitual');
		$commVehicleViolationCitWarn=$validate->validNum($_POST['commVehicleViolationCitWarn'],'Citation Warning--Comm. Vehicle Violation');
		$uninsrdMotrCitWarn=$validate->validNum($_POST['uninsrdMotrCitWarn'],'Citation Warning--Uninsured Motorist');
		$othMvgVltCitWarn=$validate->validNum($_POST['othMvgVltCitWarn'],'Citation Warning--Other Moving Violation');
		$othNonMvgVltCitWarn=$validate->validNum($_POST['othNonMvgVltCitWarn'],'Citation Warning--Other Non Moving Violation');
		$remarks = $_POST['remarks'];
		$officerSubmit = $validate->validAlpha($_POST['officerSubmit'],'Name of submitting officer');
		$rmsCadNumber = $_POST['rmsCadNumber'];
			

			$officerName =$_POST['name'];
			$officerNameCount=count($officerName);
			$officerHours=$_POST['hours'];
			$offDtlId=$_POST['offDtlId'];
			for ($i=0;$i<$officerNameCount; $i++)
			{
			
				$officerName[$i]= trim($validate->validEmptyAlpha($officerName[$i],'Officer Details Error: Name'),'');

				$officerHours[$i] = str_replace('$','',trim($validate->validNum($officerHours[$i],'Officer Details Error: Hour'),' '));
				

				if(empty($officerName[$i])&&($officerHours[$i]>0))
				{
						$validate->addErrorMsgs('<p class="error">Officer Details Error: a name field cannot be left blank when the "Officer Hours" 
							field has an amount greater than zero.</p>');
						$validate-> incErrorCount();
				}

				else if(!empty($officerName[$i])&&($officerHours[$i]==0))
				{
						$validate->addErrorMsgs('<p class="error">Officer Details Error: The "Officer Hours" field may not have an amount equal to zero when the name field is completed.</p>');
						$validate-> incErrorCount();
				}
			
			}

		$offDtlId = $_POST['offDtlId'];
		if(isset($_POST['citId']))
		{
			$citId = $_POST['citId'];
			$citNumber = $_POST['citNumber'];
			$citType = $_POST['citType']; 
			$citationCount = count($citNumber);
			
		}

		$errorno = $validate->getErrorCount();
		if($errorno==0)
		{
			$startTime =$times[0].":".$times[1];
			$endTime =$times[2].":".$times[3];

			try
			{
				include_once 'includes/dbConnect.inc';
				$db->beginTransaction();

				$query = 'UPDATE reportTable
					SET detailDate=:detailDate, officerSubmit=:officerSubmit, totalStops=:totalStops, dateApproved=:dateApproved, department=:department, startTime=:startTime, endTime=:endTime, activity=:activity, weather=:weather, county=:county, town=:town, route=:route, ouiLiquorCitSum=:ouiLiquorCitSum,ouiLiquorCitWarn=:ouiLiquorCitWarn,ouiMinorCitSum=:ouiMinorCitSum, ouiMinorCitWarn=:ouiMinorCitWarn,
					ouiDrugsCitSum=:ouiDrugsCitSum,ouiDrugsCitWarn=:ouiDrugsCitWarn,ouicdl04CitSum=:ouicdl04CitSum,ouicdl04CitWarn=:ouicdl04CitWarn,speedInfractionCitSum=:speedInfractionCitSum,speedInfractionCitWarn=:speedInfractionCitWarn,speedCriminalCitSum=:speedCriminalCitSum, speedCriminalCitWarn=:speedCriminalCitWarn, speedConstZoneCitSum=:speedConstZoneCitSum, speedConstZoneCitWarn=:speedConstZoneCitWarn, 
					speedConstZoneDblFneCitSum=:speedConstZoneDblFneCitSum, speedConstZoneDblFneCitWarn=:speedConstZoneDblFneCitWarn,speedTollArea10ZoneCitSum=:speedTollArea10ZoneCitSum, speedTollArea10ZoneCitWarn=:speedTollArea10ZoneCitWarn, speedTollArea35ZoneCitSum=:speedTollArea35ZoneCitSum, speedTollArea35ZoneCitWarn=:speedTollArea35ZoneCitWarn, dftEquipmentCitSum=:dftEquipmentCitSum, dftEquipmentCitWarn=:dftEquipmentCitWarn,
					drgViolationCivilCitSum=:drgViolationCivilCitSum, drgViolationCivilCitWarn=:drgViolationCivilCitWarn,drgViolationCriminalCitSum=:drgViolationCriminalCitSum, drgViolationCriminalCitWarn=:drgViolationCriminalCitWarn,warrantCitSum=:warrantCitSum, warrantCitWarn=:warrantCitWarn,stBltViolationCitSum=:stBltViolationCitSum, stBltViolationCitWarn=:stBltViolationCitWarn,chldRestraintCitSum=:chldRestraintCitSum, chldRestraintCitWarn=:chldRestraintCitWarn, oasHabitualOffenderCitSum=:oasHabitualOffenderCitSum,
					oasHabitualOffenderCitWarn=:oasHabitualOffenderCitWarn,commVehicleOffenderCitSum=:commVehicleOffenderCitSum, commVehicleOffenderCitWarn=:commVehicleOffenderCitWarn,uninsuredMotoristCitSum=:uninsuredMotoristCitSum, uninsuredMotoristCitWarn=:uninsuredMotoristCitWarn, otherMovingViolationsCitSum=:otherMovingViolationCitSum, otherMovingViolationsCitWarn=:otherMovingViolationCitWarn,otherNonMovingViolationsCitSum=:otherNonMovingViolationCitSum, otherNonMovingViolationsCitWarn=:otherNonMovingViolationCitWarn, remarks=:remarks, rmsCadNumber=:rmsCadNumber, approvalStatus =:approvalStatus
				
					WHERE rptId = :rptId';
			
				$statement = $db->prepare($query);
				$statement->bindValue(':rptId', $rptId);
				$statement->bindValue(':officerSubmit', $officerSubmit);
				$statement->bindValue(':detailDate',$detailDate);
				$statement->bindValue(':totalStops',$totalStops);
					//add php for current dttm
				$statement->bindValue(':dateApproved',$dateApproved);
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
				$statement->bindValue(':ouiMinorCitSum',$ouiMinorCitSum);
				$statement->bindValue(':ouiMinorCitWarn',$ouiMinorCitWarn);
				$statement->bindValue(':ouiDrugsCitSum',$ouiDrugsCitSum);
				$statement->bindValue(':ouiDrugsCitWarn',$ouiDrugsCitWarn);		
				$statement->bindValue(':ouicdl04CitSum',$ouicdl04CitSum);
				$statement->bindValue(':ouicdl04CitWarn',$ouicdl04CitWarn);
				$statement->bindValue(':speedInfractionCitSum',$spdInfractionCitSum);
				$statement->bindValue(':speedInfractionCitWarn',$spdInfractionCitWarn);
				$statement->bindValue(':speedCriminalCitSum',$spdCriminalCitSum);
				$statement->bindValue(':speedCriminalCitWarn',$spdCriminalCitWarn);
				$statement->bindValue(':speedConstZoneCitSum',$spdConZneCitSum);
				$statement->bindValue(':speedConstZoneCitWarn',$spdConZneCitWarn);			
				$statement->bindValue(':speedConstZoneDblFneCitSum',$spdConZneDblFneCitSum);
				$statement->bindValue(':speedConstZoneDblFneCitWarn',$spdConZneDblFneCitWarn);
				$statement->bindValue(':speedTollArea10ZoneCitSum',$spdToll10CitSum);
				$statement->bindValue(':speedTollArea10ZoneCitWarn',$spdToll10CitWarn);
				$statement->bindValue(':speedTollArea35ZoneCitSum',$spdToll35CitSum);
				$statement->bindValue(':speedTollArea35ZoneCitWarn',$spdToll35CitWarn);
				$statement->bindValue(':dftEquipmentCitSum',$dftsCitSum);
				$statement->bindValue(':dftEquipmentCitWarn',$dftsCitWarn);
				$statement->bindValue(':drgViolationCivilCitSum',$drgVioCivilCitSum);
				$statement->bindValue(':drgViolationCivilCitWarn',$drgVioCivilCitWarn);
				$statement->bindValue(':drgViolationCriminalCitSum',$drgVioCriminalCitSum);
				$statement->bindValue(':drgViolationCriminalCitWarn',$drgVioCriminalCitWarn);
				$statement->bindValue(':warrantCitSum',$warrantCitSum);
				$statement->bindValue(':warrantCitWarn',$warrantCitWarn);
				$statement->bindValue(':stBltViolationCitSum',$seatBltCitSum);
				$statement->bindValue(':stBltViolationCitWarn',$seatBltCitWarn);
				$statement->bindValue(':chldRestraintCitSum',$chldRestrCitSum);
				$statement->bindValue(':chldRestraintCitWarn', $chldRestrCitWarn);
				$statement->bindValue(':oasHabitualOffenderCitSum',$oasCitSum);
		
				$statement->bindValue(':oasHabitualOffenderCitWarn',$oasCitWarn);
				$statement->bindValue(':commVehicleOffenderCitSum',$commVehicleViolationCitSum);
				$statement->bindValue(':commVehicleOffenderCitWarn',$commVehicleViolationCitWarn);
				$statement->bindValue(':uninsuredMotoristCitSum',$uninsrdMotrCitSum);
				$statement->bindValue(':uninsuredMotoristCitWarn',$uninsrdMotrCitWarn);
				
				$statement->bindValue(':otherMovingViolationCitSum',$othMvgVltCitSum);
				$statement->bindValue(':otherMovingViolationCitWarn',$othMvgVltCitWarn);
		
				$statement->bindValue(':otherNonMovingViolationCitSum',$othNonMvgVltCitSum);
				$statement->bindValue(':otherNonMovingViolationCitWarn',$othNonMvgVltCitWarn);
				
				$statement->bindValue(':remarks',$remarks);
				$statement->bindValue(':rmsCadNumber',$rmsCadNumber);
				$statement->bindValue(':approvalStatus','approved');
			
				$statement->execute();

					//update officer table

				
				$query2 ='UPDATE officerDetailsTable
					SET officerName =:officerName, officerHours =:officerHours
					WHERE offDtlId =:offDtlId';

				for($i=0;$i<$officerNameCount;$i++) 
				{
					$statement2=$db->prepare($query2);
					$statement2->bindValue(':officerName',$officerName[$i]);
					$statement2->bindValue(':officerHours',$officerHours[$i]);
					$statement2->bindValue(':offDtlId',$offDtlId[$i]);
					$statement2->execute();
				}
				
				if(array_key_exists('citId', $_POST))
				{
					$query3= 'UPDATE citationsTable
						SET citNumber=:citNumber
						WHERE citId=:citId';
					for($i=0; $i<$citationCount;$i++)
					{
						$statement3=$db->prepare($query3);
						$statement3->bindValue(':citNumber',$citNumber[$i]);
						$statement3->bindValue(':citId',$citId[$i]);
						$statement->execute();
					}
				}
				
				$db->commit();
				echo'<h2 class="center">Success</h2><p class="center">You have sucessfully updated the user\'s report in the database.</p>';
				$showForm= false;
			}
			catch(PDOException $e)
			{
				$showForm = false;
				$db->rollback();
				include 'includes/dbError.inc';
			}
		}
		else
		{
?>

			<fieldset>
				<p class="errors" style="font-size: 1.2em;">Errors:</p>
<?php
				$validate ->printErrorMsgs();
?>
			</fieldset>
<?php
		}


	}
	else
	{
		$showForm=false;
		echo "<p class='center error'>Error:You have not submitted any data for processing. Please fill out the form and push the submit button.</p>";
	}

}
else
{
	$showForm=false;
	echo '<h2 class="center error">Error:</h2> <p class="error">You don\'t have the proper privileges to access this page or you have not logged-in to the portal. If you think this is a mistake please contact the system administrator.</p>';
}
if($showForm)
{
?>
			<form name="formHVE" id="formHVE"action="supervisorapproval.php?pass=true" method="POST">
			<h2 style="text-align:center;">Seat Belt High Visibility Enforcement Report</h2>	
<fieldset>
			<p><strong>Report Details</strong></p>
<?php
			$policeDept=array();
			$file = file_get_contents('Maine_PD_List.txt');
			$policeDept = explode(',',$file);
			natcasesort($policeDept);
?>

			<p>Select a Department:&nbsp;&nbsp;<select name='slctPdDept' class="disabled">
				<option value=""></option>
<?php          

			foreach($policeDept as $policeDepts)
			{
				echo "<option value='".trim(str_ireplace("'", "?", $policeDepts))."'";
				if($department==trim(str_ireplace("'", "?", $policeDepts)))
				{
					echo"selected";
				}
		        echo ">$policeDepts</option>";
			}
?>
			</select>
			</p>
<?php
			echo'<p>Date: <input type="text" class="disabled" id="datepicker" name = "date" value="'.$detailDate.'"/></p>';
		//add time fields
?>
			<p>
			Start Time:&nbsp;&nbsp;

			<select name='startHours' class="disabled">
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
			echo"</select>:<select name='startMinutes' class='disabled'>";
			
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

		<select name='endHours' class="disabled">
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
			echo"</select>: <select name='endMinutes' class='disabled'>";
			
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
		echo 'Activity:&nbsp;&nbsp; Patrol<input name="activity" id="activity" class="disabled" type="radio" value="patrol"'; 
		if(isset($activity))
		{
			if($activity=='patrol')
			{
				echo' checked';
			} 
		}
		echo'/>&nbsp;&nbsp;Roadblock<input name="activity" id="activity" type="radio" class="disabled" value="roadblock"';
		if(isset($activity))
		{
			if($activity=='roadblock')
			{
				echo' checked';
			} 
		}
		echo'/>';
		?>
		</p>
	<?php
		echo 'Weather:&nbsp;&nbsp;<input type="text" name="weather" id="weather" class="disabled" value="'.$weather.'"/>';
	?>
		</p>
		<p>
	<?php
	//modify here 
	$countiesArray = array('Androscoggin','Aroostook','Cumberland','Franklin','Hancock','Kennebec','Lincoln',
		'Oxford','Penobscot','Piscataquis','Sagadahoc','Somerset','Waldo','Washington','York');
		echo'Location:&nbsp;&nbsp;County:
			<select name="county" class="disabled">
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

			echo '</select>&nbsp;&nbsp;Town:<input type="text" class="disabled" name="town" id="town" value="'.$town.'"/>&nbsp;&nbsp;Route:<input type="text" class="disabled" name="route" id="route" value="'.$route.'"/>';
	?>
	</p>

	</fieldset>
<fieldset>

<p><strong>Citations</strong></p>
<table id="violations">
<thead><tr><th>Type of citation</th><th>Citation<br/>Summons</th><th>Citation<br/>Warnings</th></tr></thead>
<tr><td>OUI - Liquor</td><td><input type="text" name="ouiLiquorCitSum"  id="ouiLiquorCitSum" class="disabled" value= <?php echo'"'.$ouiLiquorCitSum.'"'?>/></td><td><input type="text" id="ouiLiquorCitWarn" name="ouiLiquorCitWarn" class="disabled" value=<?php echo'"'.$ouiLiquorCitWarn.'"'?>/></td></tr>
<tr><td>OUI - Drugs</td><td><input type="text" name="ouiDrugsCitSum" id="ouiDrugsCitSum" class="disabled" value=<?php echo'"'.$ouiDrugsCitSum.'"'?>/></td><td><input type="text" id="ouiDrugsCitWarn" name="ouiDrugsCitWarn" class="disabled" value=<?php echo'"'.$ouiDrugsCitSum.'"'?>/></td></tr>
<tr><td>OUI - Minor</td><td><input type="text" name="ouiMinorCitSum" id="ouiMinorCitSum" class="disabled" value=<?php echo'"'.$ouiMinorCitSum.'"'?>/></td><td><input type="text" id="ouiMinorCitWarn" name="ouiMinorCitWarn" class="disabled" value=<?php echo'"'.$ouiMinorCitWarn.'"'?>/></td></tr>
<tr><td>OUI - CDL.04</td><td><input type="text" id="ouiCdl04CitSum"name="ouicdl04CitSum" class="disabled" value=<?php echo'"'.$ouicdl04CitSum.'"'?>/></td><td><input type="text" id="ouicdl04CitWarn" name="ouicdl04CitWarn" class="disabled" value=<?php echo'"'.$ouicdl04CitWarn.'"'?>/></td></tr>
<tr><td>Speed - Infraction &nbsp;</td><td><input type="text" id = 'spdInfractionCitSum' name="spdInfractionCitSum" class="disabled" value=<?php echo'"'.$spdInfractionCitSum.'"'?>/></td><td><input type="text" id="spdInfractionCitWarn" name="spdInfractionCitWarn" class="disabled" value=<?php echo'"'.$spdInfractionCitWarn.'"'?>/></td></tr>
<tr><td>Speed - Criminal&nbsp;</td><td><input type="text" id = 'spdCriminalCitSum' name="spdCriminalCitSum" class="disabled" value=<?php echo'"'.$spdCriminalCitSum.'"'?>/></td><td><input type="text" name="spdCriminalCitWarn" id="spdCriminalCitWarn" class="disabled" value=<?php echo'"'.$spdCriminalCitWarn.'"'?>/></td></tr>
<tr><td>Speed - Const. Zone&nbsp;</td><td><input type="text" id = 'spdConZneCitSum' name="spdConZneCitSum" class="disabled" value=<?php echo'"'.$spdConZneCitSum.'"'?>/></td><td><input type="text" id="spdConZneCitWarn" name="spdConZneCitWarn" class="disabled" value=<?php echo'"'.$spdConZneCitWarn.'"'?>/></td></tr>
<tr><td>Speed - Const. Zone(DOUBLE FINE)&nbsp;</td><td><input type="text" id ='spdConZneDblFneCitSum' name="spdConZneDblFneCitSum" class="disabled" value=<?php echo'"'.$spdConZneDblFneCitSum.'"'?>/></td><td><input type="text" id="spdConZneDblFneCitWarn" name="spdConZneDblFneCitWarn" class="disabled" value=<?php echo'"'.$spdConZneDblFneCitWarn.'"'?>/></td></tr>
<tr><td>Speed - TOLL AREA (10 ZONE)&nbsp;</td><td><input type="text" id = 'spdToll10CitSum' name="spdToll10CitSum" class="disabled" value=<?php echo'"'.$spdToll10CitSum.'"'?>/></td><td><input type="text" id="spdToll10CitWarn" name="spdToll10CitWarn" class="disabled" value=<?php echo'"'.$spdToll10CitWarn.'"'?>/></td></tr>
<tr><td>Speed - TOLL AREA (35 ZONE)&nbsp;</td><td><input type="text" id = 'spdToll35CitSum' name="spdToll35CitSum" class="disabled" value=<?php echo'"'.$spdToll35CitSum.'"'?>/></td><td><input type="text" id="spdToll35CitWarn" name="spdToll35CitWarn" class="disabled" value=<?php echo'"'.$spdToll35CitWarn.'"'?>/></td></tr>
<tr><td>Defective Equipment</td><td><input type="text" name="dftsCitSum" id="dftsCitSum" class="disabled" value=<?php echo'"'.$dftsCitSum.'"'?>/></td><td><input type="text" id="dftsCitWarn" name="dftsCitWarn" class="disabled" value=<?php echo'"'.$dftsCitWarn.'"'?>/></td></tr>
<tr><td>Drug Violation - CIVIL </td><td><input type="text" name="drgVioCivilCitSum" id="drgVioCivilCitSum" class="disabled" value=<?php echo'"'.$drgVioCivilCitSum.'"'?>/></td><td><input type="text" id="drgVioCivilCitWarn" name="drgVioCivilCitWarn" class="disabled" value=<?php echo'"'.$drgVioCivilCitWarn.'"'?>/></td></tr>
<tr><td>Drug Violation - CRIMINAL </td><td><input type="text" name="drgVioCriminalCitSum" id="drgVioCriminalCitSum" class="disabled" value=<?php echo'"'.$drgVioCriminalCitSum.'"'?>/></td><td><input type="text" id="drgVioCriminalCitWarn" name="drgVioCriminalCitWarn" class="disabled" value=<?php echo'"'.$drgVioCriminalCitWarn.'"'?>/></td></tr>
<tr><td>Warrant</td><td><input type="text" name="warntCitSum" id="warntCitSum" class="disabled" value=<?php echo'"'.$warrantCitSum.'"'?>/></td><td><input type="text" name="warntCitWarn" id="warntCitWarn" class="disabled" value=<?php echo'"'.$warrantCitWarn.'"'?>/></td></tr>
<tr><td>Seat Belt Violation&nbsp;</td><td><input type="text" id = "seatBltCitSum" name="seatBltCitSum" id="seatBltCitSum" class="disabled" value=<?php echo'"'.$seatBltCitSum.'"'?>/></td><td><input type="text" name="seatBltCitWarn" id="seatBltCitWarn" class="disabled" value=<?php echo'"'.$seatBltCitWarn.'"'?>/></td></tr>
<tr><td>Child Restraint&nbsp;<td><input type="text" id = "chldRestrCitSum" name="chldRestrCitSum" id="chldRestrCitSum" class="disabled" value=<?php echo'"'.$chldRestrCitSum.'"'?>/></td><td><input type="text" name="chldRestrCitWarn" id="chldRestrCitWarn" class="disabled" value=<?php echo'"'.$chldRestrCitWarn.'"'?>/></td></tr>
<tr><td>OAS/Habitual Offender</td><td><input type="text" id="oasCitSum" name="oasCitSum" class="disabled" value=<?php echo'"'.$oasCitSum.'"'?>/></td><td><input type="text" name="oasCitWarn" id="oasCitWarn" class="disabled" value=<?php echo'"'.$oasCitWarn.'"'?>/></td></tr>
<tr><td>Comm. Vehicle Violation</td><td><input type="text" name="commVehicleViolationCitSum" id="commVehicleViolationCitSum" class="disabled" value=<?php echo'"'.$commVehicleViolationCitSum.'"'?>/></td><td><input type="text" name="commVehicleViolationCitWarn" id="commVehicleViolationCitWarn" class="disabled" value=<?php echo'"'.$commVehicleViolationCitWarn.'"'?>/></td></tr>
<tr><td>Uninsured Motorist</td><td><input type="text" name="uninsrdMotrCitSum" id="uninsrdMotrCitSum" class="disabled" value=<?php echo'"'.$uninsrdMotrCitSum.'"'?>/></td><td><input type="text" name="uninsrdMotrCitWarn" id="uninsrdMotrCitWarn" class="disabled" value=<?php echo'"'.$uninsrdMotrCitWarn.'"'?>/></td></tr>
<tr><td>Other Moving Violations</td><td><input type="text" name="othMvgVltCitSum" id="othMvgVltCitSum" class="disabled" value=<?php echo'"'.$othMvgVltCitSum.'"'?>/></td><td><input type="text" name="othMvgVltCitWarn" id="othMvgVltCitWarn" class="disabled" value=<?php echo'"'.$othMvgVltCitWarn.'"'?>/></td></tr>
<tr><td>Other Non Moving Violations</td><td><input type="text" name="othNonMvgVltCitSum" id="othNonMvgVltCitSum" class="disabled" value=<?php echo'"'.$othNonMvgVltCitSum.'"'?>/></td><td><input type="text" name="othNonMvgVltCitWarn" id="othNonMvgVltCitWarn" class="disabled" value=<?php echo'"'.$othNonMvgVltCitWarn.'"'?>/></td></tr>
</table>

<br/>
<br/>
<br/>
<p>Total number of stops: <input type="text" name="total_stops" class="disabled" value=<?php echo"'$totalStops'"; ?>/></p>
</fieldset>


<fieldset>

<p><strong>Officer Details</strong></p>
<table id="officer_details">
<thead><tr><th>Name</th><th>Officer Hours</th></tr></thead>
<?php

for ($i=0; $i<$officerNameCount; $i++) 
{ 
	echo '<tr><td><input type="hidden" name="offDtlId[]" value="'.$offDtlId[$i].'"" class="disabled"><input type="text" name="name[]" class="officerDtl disabled" value="'.$officerName[$i].'"" /></td><td><input type="text" name="hours[]" class="officerHours officerDtl disabled" value="'.$officerHours[$i].'"/></td></tr>';
}
?>
</table>
<br/>
<br/>
<br/>
<p>Name of submitting officer: <input type="text" name="officerSubmit" class="disabled" value=<?php echo'"'.$officerSubmit.'"'?> /></p>
<br/>
<p>RMS/CAD Number:&nbsp;&nbsp;<input type="text" name="rmsCadNumber" class="disabled" id="RmsCadNumber" value=<?php echo'"'.$rmsCadNumber.'"'?>/></p><br/>

<p>
Remarks:&nbsp;&nbsp; 	<textarea class="disabled" rows="4" cols="50" name="remarks"><?php echo $remarks ?></textarea>

</p>
</fieldset>
<?php
	if(isset($citId))
	{
?>
<fieldset>
<p><strong>Citation Details</strong></p>
<table>
	<thead><tr><th>Citation Type</th><th>Citation Number</th></tr></thead>
<?php
	for($i=0;$i<$citationCount;$i++)
	{
		echo '<tr><td><input type="text" name="citType[]" size="50" value="'.$citType[$i].'" class="disabled"/></td><td><input type="text" class="disabled" name="citNumber[]" value="'.$citNumber[$i].'"><input type="hidden" name="citId[]" value="'.$citId[$i].'"></td></tr>';
	}
	
?>
</table>
</fieldset>
<?php
	}
?>
<p style="text-align:center;"><button id="edit" class="buttons">Edit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="submit" class="buttons" name="approved" value="Submit"/></p>

</form>

<?php
}
?>
</div>
</body>
</html>




