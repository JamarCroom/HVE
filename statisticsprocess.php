<?php
session_start();
	include 'includes/httpsRedirect.inc';
$showForm=false;
	if(!isset($_SESSION['userId']))
	{
		include 'includes/privilegeError.inc';
	}
	else
	{
		include 'includes/head.inc';

		if(isset($_POST['submit']))
		{
			require_once 'objects/Validation.php';
			$validate= new Validation();
			$startDate=$validate->validDate($_POST['startDate'],'Start Date');
			$endDate=$validate->validDate($_POST['endDate'],'End Date');
			$choice = $_POST['choice'];
			//echo "$choice";
			if(isset($endDate)&&isset($startDate))
				$validate->dateCompare($startDate,$endDate);
			$errors=$validate->getErrorCount();
			if($errors!=0)
			{
				$validate->printErrorMsgs();
?>
				<script type="text/javascript">
				$(function()
				{

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
			}
*/
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

						$( "#startDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
						
						$( "#endDate" ).datepicker({ dateFormat: 'yy-mm-dd' });
					}
						$('.county').each(function()
						{
							$(this).hide();

						});

						$('.final').each(function()
						{
							$(this).hide();
						});

						$('.department').each(function()
						{
							$(this).hide();
						});
						$('#countyChoice').bind("click",function()
						{
							$('.final').each(function()
							{
								$(this).hide();
							});
							$('.final').eq(1).prop('disabled',true);
							



							$('.county').each(function()
							{
								$(this).show();

							});
							$('.county').eq(1).prop('disabled', false);
							$('.department').each(function()
							{
								$(this).hide();

							});



							$('.department').eq(1).prop('disabled', true);
							$('.state').each(function()
							{
								$(this).hide();

							});
							$('.state').eq(1).prop('disabled', true);
						});

						$('#stateChoice').bind("click",function()
						{
							$('.state').each(function()
							{
								$(this).show();

							});
							$('.state').eq(1).prop('disabled', false);
							
							$('.final').each(function()
							{
								$(this).hide();
							});
							$('.final').eq(1).prop('disabled',true);


							$('.county').each(function()
							{
								$(this).hide();

							});
							$('.county').eq(1).prop('disabled', true);
							$('.department').each(function()
							{
								$(this).hide();

							});
							$('.department').eq(1).prop('disabled', true);
						});


						$('#finalChoice').bind("click",function()
						{
							$('.final').each(function()
							{
								$(this).show();
							});
							$('.final').eq(1).prop('disabled',false);
							
							$('.county').each(function()
							{
								$(this).hide();
							});
							$('.county').eq(1).prop('disabled', true);

							$('.department').each(function()
							{
								$(this).hide();
							});
							$('.department').eq(1).prop('disabled', true);

							$('.state').each(function()
							{
								$(this).hide();
							});
							$('.state').eq(1).prop('disabled', true);
						});


						$('#departmentChoice').bind("click",function()
						{
							$('.final').each(function()
							{
								$(this).hide();
							});
							$('.final').eq(1).prop('disabled',true);

							$('.department').each(function()
							{
								$(this).show();

							});
							$('.department').eq(1).prop('disabled', false);

							$('.county').each(function()
							{
								$(this).hide();

							});
							$('.county').eq(1).prop('disabled', true);

							$('.state').each(function()
							{
								$(this).hide();

							});
							$('.state').eq(1).prop('disabled', true);
						});
				});
				</script>
					<h2 class="center">Review Statistics</h2>


					<form action="statisticsprocess.php" method="POST" style="margin: 15px 0 15px 40px;">

					<p>
						<span class="state"><strong>View Stats By State:</strong></span>&nbsp;&nbsp;&nbsp;<select class="state" disabled><option value="">Statewide Stats</option></select>
						<span class="final"><strong>View Stats Final Report:</strong></span>&nbsp;&nbsp;&nbsp;<select class="final" disabled><option value="">Final Stats</option></select>
						<span class="department"><strong>View Stats By Department:</strong></span>&nbsp;&nbsp;&nbsp;
							<?php
						$policeDept=array();
						$file = file_get_contents('Maine_PD_List.txt');
						$policeDept = explode(',',$file);
						natcasesort($policeDept);

					?>
					<select name='department' class="department" disabled>
						
					<?php
						foreach($policeDept as $policeDepts)
						{
							echo "<option value='".trim($policeDepts)."'>$policeDepts</option>";
						}
					?>
				</select>
						<span class="county"><strong>View Stats By County:</strong></span>&nbsp;&nbsp;&nbsp;
										<select class="county"name="county" disabled>
									
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
								
								<br/>
								<br/>
						<span><strong>Select a timeframe:</strong></span>&nbsp;&nbsp;&nbsp;Start Date:&nbsp;&nbsp;<input type="text" id="startDate" name="startDate" />&nbsp;&nbsp;&nbsp;End Date:&nbsp;&nbsp;<input type="text" id="endDate" name="endDate"/>
						<br/>
						<br/>
						<span><strong>Select a filter criteria:</strong></span>&nbsp;&nbsp;&nbsp;County<input type="radio" id="countyChoice" name="choice" value="county"/>&nbsp;&nbsp;Department<input type="radio" id="departmentChoice" name="choice" value="department"/>&nbsp;&nbsp;State<input type="radio" id="stateChoice" name="choice" value="state" checked/><?php
						if(isset($_SESSION['isAdmin']))
						{
						?>
							&nbsp;&nbsp;Final Report<input type="radio" id="finalChoice" name="choice" value="final"/>
						<?php
						}
						?>
						<br/>
						<br/>
						<input type="submit"  name="submit" value="Review Report" id="submit"/>
					</p>
					</form>
<?php
			}
			else
			{
				try
				{
					require_once 'includes/dbConnect.inc';
					$query="SELECT  SUM(totalStops) as totalStops, SUM(ouiLiquorCitSum) as ouiLiquorCitSum,SUM(ouiLiquorCitWarn) as ouiLiquorCitWarn,SUM(ouiMinorCitSum) as ouiMinorCitSum, SUM(ouiMinorCitWarn) as ouiMinorCitWarn,
						SUM(ouiDrugsCitSum) as ouiDrugsCitSum,SUM(ouiDrugsCitWarn) as ouiDrugsCitWarn,SUM(ouicdl04CitSum) as ouicdl04CitSum,SUM(ouicdl04CitWarn) as ouicdl04CitWarn,SUM(speedInfractionCitSum) as speedInfractionCitSum,SUM(speedInfractionCitWarn) as speedInfractionCitWarn,SUM(speedCriminalCitSum) as speedCriminalCitSum, SUM(speedCriminalCitWarn) as speedCriminalCitWarn,SUM(speedConstZoneCitSum)as speedConstZoneCitSum, SUM(speedConstZoneCitWarn) as speedConstZoneCitWarn,
						SUM(speedConstZoneDblFneCitSum) as speedConstZoneDblFneCitSum, SUM(speedConstZoneDblFneCitWarn) as speedConstZoneDblFneCitWarn, SUM(speedTollArea10ZoneCitSum) as speedTollArea10ZoneCitSum, SUM(speedTollArea10ZoneCitWarn) as speedTollArea10ZoneCitWarn, SUM(speedTollArea35ZoneCitSum) as speedTollArea35ZoneCitSum, SUM(speedTollArea35ZoneCitWarn) as speedTollArea35ZoneCitWarn,  SUM(dftEquipmentCitSum) as dftEquipmentCitSum, SUM(dftEquipmentCitWarn) as dftEquipmentCitWarn,
						SUM(drgViolationCivilCitSum) as drgViolationCivilCitSum, SUM(drgViolationCivilCitWarn) as drgViolationCivilCitWarn, SUM(drgViolationCriminalCitSum) as drgViolationCriminalCitSum, SUM(drgViolationCriminalCitWarn) as drgViolationCriminalCitWarn, SUM(warrantCitSum) as warrantCitSum, SUM(warrantCitWarn) as warrantCitWarn, SUM(stBltViolationCitSum) as stBltViolationCitSum, SUM(stBltViolationCitWarn) as stBltViolationCitWarn, SUM(chldRestraintCitSum) as chldRestraintCitSum, SUM(chldRestraintCitWarn) as chldRestraintCitWarn, SUM(oasHabitualOffenderCitSum) as oasHabitualOffenderCitSum,
						SUM(oasHabitualOffenderCitWarn) as oasHabitualOffenderCitWarn, SUM(commVehicleOffenderCitSum) as commVehicleOffenderCitSum, SUM(commVehicleOffenderCitWarn) as commVehicleOffenderCitWarn, SUM(uninsuredMotoristCitSum) as uninsuredMotoristCitSum, SUM(uninsuredMotoristCitWarn) as uninsuredMotoristCitWarn, SUM(otherMovingViolationsCitSum) as otherMovingViolationsCitSum, SUM(otherMovingViolationsCitWarn) as otherMovingViolationsCitWarn, SUM(otherNonMovingViolationsCitSum) as otherNonMovingViolationsCitSum, SUM(otherNonMovingViolationsCitWarn) as otherNonMovingViolationsCitWarn
						  FROM reportTable WHERE approvalStatus='approved' AND dateSubmit >=:startDate AND dateSubmit <=:endDate";
					$query2="SELECT COUNT(officerDetailsTable.officerName) as officerNameCount, SUM(officerDetailsTable.officerHours) as officerHours FROM officerDetailsTable JOIN reportTable ON officerDetailsTable.rptId= reportTable.rptId WHERE approvalStatus='approved' AND dateSubmit >=:startDate AND dateSubmit <=:endDate";
					$totalDepartmentStopsquery="SELECT reportTable.department as department , SUM(totalStops) as totalDepartmentStops FROM reportTable WHERE approvalStatus='approved' AND dateSubmit >=:startDate AND dateSubmit <=:endDate GROUP BY department ORDER BY department";
					$departmentOfficerDetails="SELECT reportTable.department as department, officerDetailsTable.officerName, SUM(officerDetailsTable.officerHours) as officerHours FROM officerDetailsTable JOIN reportTable ON officerDetailsTable.rptId= reportTable.rptId WHERE approvalStatus='approved' AND dateSubmit >=:startDate AND dateSubmit <=:endDate GROUP BY reportTable.department,officerDetailsTable.officerName ORDER BY reportTable.department";
					$totalDetailHours="SELECT reportTable.department, SUM(officerDetailsTable.officerHours) as officerHours FROM officerDetailsTable JOIN reportTable ON officerDetailsTable.rptId= reportTable.rptId WHERE approvalStatus='approved' AND dateSubmit >=:startDate AND dateSubmit <=:endDate GROUP BY reportTable.department ORDER BY reportTable.department, reportTable.detailDate";
					$singleDepartmentOfficerDetails="SELECT reportTable.department as department, officerDetailsTable.officerName, officerDetailsTable.officerHours as officerHours, detailDate FROM officerDetailsTable JOIN reportTable ON officerDetailsTable.rptId= reportTable.rptId WHERE approvalStatus='approved' AND dateSubmit >=:startDate AND dateSubmit <=:endDate AND department =:department  ORDER BY reportTable.detailDate";
					$singleDepartmentDetailHours="SELECT reportTable.department, SUM(officerDetailsTable.officerHours) as officerHours FROM officerDetailsTable JOIN reportTable ON officerDetailsTable.rptId= reportTable.rptId WHERE approvalStatus='approved' AND dateSubmit >=:startDate AND dateSubmit <=:endDate AND department =:department ORDER BY reportTable.detailDate";
					$singleDepartmentStopsquery="SELECT reportTable.department as department , SUM(totalStops) as totalDepartmentStops FROM reportTable WHERE approvalStatus='approved' AND dateSubmit >=:startDate AND dateSubmit <=:endDate AND department=:department ORDER BY department";

					switch($choice)
					{

						case 'department':
							$query.=" AND department=:department";
							$statement=$db->prepare($query);
							$statement->bindValue(':department',$_POST['department']);
							$statement->bindValue(':startDate',$startDate);
							$statement->bindValue(':endDate',$endDate);
							$statement->execute();
							$reportResult=$statement->fetchAll();
							$statement->closeCursor();
							$query2.=" AND department=:department";
							$statement2=$db->prepare($query2);
							$statement2->bindValue(':department',$_POST['department']);
							$statement2->bindValue(':startDate',$startDate);
							$statement2->bindValue(':endDate',$endDate);
							$statement2->execute();
							$officerResult=$statement2->fetchAll();
							$statement2->closeCursor();
							/****/

							$statement3=$db->prepare($singleDepartmentStopsquery);
							$statement3->bindValue(':startDate',$startDate);
							$statement3->bindValue(':endDate',$endDate);
							$statement3->bindValue(':department',$department);
							$statement3->execute();
							$totalDepartmentResult=$statement3->fetchAll();



							$statement4=$db->prepare($singleDepartmentOfficerDetails);
							
							$statement4->bindValue(':startDate',$startDate);
							$statement4->bindValue(':endDate',$endDate);
							$statement4->bindValue(':department',$department);
							$statement4->execute();
							$departmentResult=$statement4->fetchAll();

							$statement5=$db->prepare($singleDepartmentDetailHours);
							$statement5->bindValue(':startDate',$startDate);
							$statement5->bindValue(':endDate',$endDate);
							$statement5->bindValue(':department',$department);
							$statement5->execute();
							$totalDetailHoursResult=$statement5->fetchAll();
							$selection = str_ireplace("?", "'", $_POST['department']); 
						break;

						case 'county':
							$query.=" AND county=:county";
							$statement=$db->prepare($query);
							$statement->bindValue(':county',$_POST['county']);
							$statement->bindValue(':startDate',$startDate);
							$statement->bindValue(':endDate',$endDate);
							$statement->execute();
							$reportResult=$statement->fetchAll();
							$query2.=" AND county=:county";
							$statement2=$db->prepare($query2);
							$statement2->bindValue(':county',$_POST['county']);
							$statement2->bindValue(':startDate',$startDate);
							$statement2->bindValue(':endDate',$endDate);
							$statement2->execute();
							$officerResult=$statement2->fetchAll();
							$statement2->closeCursor();
							$selection=$_POST['county']." County";
						break;
						case 'state':
							$statement=$db->prepare($query);
							$statement->bindValue(':startDate',$startDate);
							$statement->bindValue(':endDate',$endDate);
							$statement->execute();
							$reportResult=$statement->fetchAll();
							$statement2=$db->prepare($query2);
							$statement2->bindValue(':startDate',$startDate);
							$statement2->bindValue(':endDate',$endDate);
							$statement2->execute();
							$officerResult=$statement2->fetchAll();
							$statement2->closeCursor();
							$selection ='State-wide';
						break; 
						case 'final':
							$statement=$db->prepare($query);
							$statement->bindValue(':startDate',$startDate);
							$statement->bindValue(':endDate',$endDate);
							$statement->execute();
							$reportResult=$statement->fetchAll();
							$statement2=$db->prepare($query2);
							$statement2->bindValue(':startDate',$startDate);
							$statement2->bindValue(':endDate',$endDate);
							$statement2->execute();
							$officerResult=$statement2->fetchAll();

							$statement3=$db->prepare($totalDepartmentStopsquery);
							$statement3->bindValue(':startDate',$startDate);
							$statement3->bindValue(':endDate',$endDate);
							$statement3->execute();
							$totalDepartmentResult=$statement3->fetchAll();



							$statement4=$db->prepare($departmentOfficerDetails);
							
							$statement4->bindValue(':startDate',$startDate);
							$statement4->bindValue(':endDate',$endDate);
							$statement4->execute();
							$departmentResult=$statement4->fetchAll();

							$statement5=$db->prepare($totalDetailHours);
							$statement5->bindValue(':startDate',$startDate);
							$statement5->bindValue(':endDate',$endDate);
							$statement5->execute();
							$totalDetailHoursResult=$statement5->fetchAll();

							
							$selection ='Final';
						break; 

					}
					$showForm=true;
				}
				catch(PDOException $e)
				{
					$showForm=false;
					include 'includes/dbError.inc';

				}

			}
		}
		else
		{
			echo'<p style="center error"><strong>Error:</strong><br/>You have not submitted data for processing. Please go <a href="stats.php">back</a> and try again.</p>';
			$showForm=false;
		}

		if($showForm)
		{	echo "<div style='margin: 10px 0px 20px 30px;'>";
			echo "<h2 class='center'>Displaying $selection Report Statistics from $startDate to $endDate</h2>";
						if(!empty($officerResult))
			{
				foreach($officerResult as $officerResults)
				{
					echo "<h3 style='margin-top:50px;'><strong>Officer Details</strong></h3><p style='margin-left: 30px;'><strong>Total Number of officers reporting:</strong>&nbsp;&nbsp;",$officerResults['officerNameCount']."<br/><strong>Total Number of detail hours:</strong>&nbsp;&nbsp;".$officerResults['officerHours']."</p>";
				}
			}

			if(!empty($reportResult))
			{
				foreach($reportResult as $reportResults)
				{
					
					echo"<h3 style='margin-top:50px;'><strong>Citation Details</strong></h3><table style='margin: 5px 0px 15px 30px;'>
					<thead><tr><th>Type of citation</th><th>Total Citation<br/>Summons</th><th>Total Citation<br/>Warnings</th></tr></thead>
					<tr><td>OUI - Liquor</td><td>".$reportResults['ouiLiquorCitSum']."</td><td>".$reportResults['ouiLiquorCitWarn']."</td></tr>
					<tr><td>OUI - Drugs</td><td>".$reportResults['ouiDrugsCitSum']."</td><td>".$reportResults['ouiDrugsCitSum']."</td></tr>
					<tr><td>OUI - Minor</td><td>".$reportResults['ouiMinorCitSum']."</td><td>".$reportResults['ouiMinorCitWarn']."</td></tr>
					<tr><td>OUI - CDL.04</td><td>".$reportResults['ouicdl04CitSum']."</td><td>".$reportResults['ouicdl04CitWarn']."</td></tr>
					<tr><td>Speed - Infraction</td><td>".$reportResults['speedInfractionCitSum']."</td><td>".$reportResults['speedInfractionCitWarn']."</td></tr>
					<tr><td>Speed - Criminal</td><td>".$reportResults['speedCriminalCitSum']."</td><td>".$reportResults['speedCriminalCitWarn']."</td></tr>
					<tr><td>Speed - Const. Zone</td><td>".$reportResults['speedConstZoneCitSum']."</td><td>".$reportResults['speedConstZoneCitWarn']."</td></tr>
					<tr><td>Speed - Const. Zone(DOUBLE FINE)</td><td>".$reportResults['speedConstZoneDblFneCitSum']."</td><td>".$reportResults['speedConstZoneDblFneCitWarn']."</td></tr>
					<tr><td>Speed - TOLL AREA (10 ZONE)</td><td>".$reportResults['speedTollArea10ZoneCitSum']."</td><td>".$reportResults['speedTollArea10ZoneCitWarn']."</td></tr>
					<tr><td>Speed - TOLL AREA (35 ZONE)</td><td>".$reportResults['speedTollArea35ZoneCitSum']."</td><td>".$reportResults['speedTollArea35ZoneCitWarn']."</td></tr>
					<tr><td>Defective Equipment</td><td>".$reportResults['dftEquipmentCitSum']."</td><td>".$reportResults['dftEquipmentCitWarn']."</td></tr>
					<tr><td>Drug Violation - CIVIL </td><td>".$reportResults['drgViolationCivilCitSum']."</td><td>".$reportResults['drgViolationCivilCitWarn']."</td></tr>
					<tr><td>Drug Violation - CRIMINAL </td><td>".$reportResults['drgViolationCriminalCitSum']."</td><td>".$reportResults['drgViolationCriminalCitWarn']."</td></tr>
					<tr><td>Warrant</td><td>".$reportResults['warrantCitSum']."</td><td>".$reportResults['warrantCitWarn']."</td></tr>
					<tr><td>Seat Belt Violation</td><td>".$reportResults['stBltViolationCitSum']."</td><td>".$reportResults['stBltViolationCitWarn']."</td></tr>
					<tr><td>Child Restraint<td>".$reportResults['chldRestraintCitSum']."</td><td>".$reportResults['chldRestraintCitWarn']."</td></tr>
					<tr><td>OAS/Habitual Offender</td><td>".$reportResults['oasHabitualOffenderCitSum']."</td><td>".$reportResults['oasHabitualOffenderCitWarn']."</td></tr>
					<tr><td>Comm. Vehicle Violation</td><td>".$reportResults['commVehicleOffenderCitSum']."</td><td>".$reportResults['commVehicleOffenderCitWarn']."</td></tr>
					<tr><td>Uninsured Motorist</td><td>".$reportResults['uninsuredMotoristCitSum']."</td><td>".$reportResults['uninsuredMotoristCitWarn']."</td></tr>
					<tr><td>Other Moving Violations</td><td>".$reportResults['otherMovingViolationsCitSum']."</td><td>".$reportResults['otherMovingViolationsCitWarn']."</td></tr>
					<tr><td>Other Non Moving Violations</td><td>".$reportResults['otherNonMovingViolationsCitSum']."</td><td>".$reportResults['otherNonMovingViolationsCitWarn']."</td></tr>
					</table><p><strong>Total Number of Stops:</strong> &nbsp;&nbsp;&nbsp;".$reportResults['totalStops']."</p>";
				}

				
				if($choice=='final'||$choice=='department')
				{
						$policeDept=array();
						$file = file_get_contents('Maine_PD_List.txt');
						$policeDept = explode(',',$file);
						natcasesort($policeDept);

					echo "<h3 style='margin-top:50px;'><strong>Department Details</strong></h3><br/>";
					foreach($policeDept as $policeDepts)
					{
						
						
						foreach($totalDepartmentResult as $totalDepartmentResults)
						{
							
							
							if(trim(str_ireplace("'", "?", $policeDepts)) == trim($totalDepartmentResults['department']))
							{

								echo"<p><strong>Department:&nbsp;&nbsp;</strong>".trim(str_ireplace("?", "'",$totalDepartmentResults['department']))."</p>";
								echo "<p><strong>Total number of stops:&nbsp;&nbsp;</strong>".$totalDepartmentResults['totalDepartmentStops']."</p>";
								echo"<br/><h4>Officer Details</h4>";
								echo"<table style='margin: 5px 0px 15px 30px;'><thead><tr><th>Officer Name</th><th>Department</th><th>Total<br/>Officer Hours</th><th>Detail Date</th></tr></thead>";
								break;
							
							}
							
						}

					
						foreach($departmentResult as $departmentResults)
						{
								if(trim(str_ireplace("'", "?", $policeDepts)) == trim($departmentResults['department']))
								{

									echo "<tr><td>".$departmentResults['officerName']."</td><td>".trim(str_ireplace("?", "'",$departmentResults['department']))."</td><td>".$departmentResults['officerHours']."</td><td>".$departmentResults['officerHours']."</td></tr>";
								}
						}
						foreach($departmentResult as $departmentResults)
						{
								if(trim(str_ireplace("'", "?", $policeDepts)) == trim($departmentResults['department']))
								{
									echo"</table>";
									break;	
								}
								
						}
						foreach($totalDetailHoursResult as $totalDetailHoursResults)
						{
								if(trim(str_ireplace("'", "?", $policeDepts)) == trim($totalDetailHoursResults['department']))
								{
									echo"<p><strong>Total number of detail hours:</strong> ".$totalDetailHoursResults['officerHours']."</p><br/><br/><br/><br/><br/>";
									break;
								}
								
						}



					}
					
				}

				echo"</div>";


			}
			else
			{
				echo"<p>There are no results to display for the criteria selected</p>";
			}



		}


		include 'includes/foot.inc';
	}