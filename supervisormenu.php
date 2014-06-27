<?php
	session_start();
	include 'includes/httpsRedirect.inc';

$showAgencyList=true;
	if(!isset($_SESSION['isSupervisor']))
	{
		include 'includes/privilegeError.inc';
	}

	else
	{
		include 'includes/head.inc';
		echo '<h3 class="center">Supervisor Approval Menu</h3>';

		$userId = $_SESSION['userId'];

		try
		{
			include_once 'includes/dbConnect.inc';
			$query ='SELECT reportTable.rptId, userTable.firstName,userTable.lastName,reportTable.dateSubmit,reportTable.detailDate, reportTable.approvalStatus
					FROM supervisorBridgeTable
					JOIN reportTable
					ON reportTable.userId = supervisorBridgeTable.superviseeId
					JOIN userTable
					ON supervisorBridgeTable.superviseeId = userTable.userId 
					Where reportTable.approvalStatus = "unapproved" AND supervisorBridgeTable.supervisorId = :supervisorId';
			
			$statement=$db->prepare($query);
			$statement->bindValue(':supervisorId',$userId);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			

		?>
		<table>
		<thead><tr><th>Report Number</th><th>Officer Submitting</th><th>Date Submitted</th><th>Detail Date</th><th>Approval Status</th><th>Review and <br/> Approve Detail Report</th></tr></thead>
		<?php

			foreach($result as $results)
			{
				echo "<tr><td>".$results['rptId']."</td><td>".$results['firstName']." ".$results['lastName']."</td><td>".$results['dateSubmit']."</td><td>".$results['detailDate']."</td><td>".$results['approvalStatus']."</td><td><a href='supervisorapproval.php?rptId=".$results['rptId']."&pass=true'>Review Report</a></td></tr>";
			}
		?>
	</table>
		<?php
			if(empty($result))
			{
				echo '<p class="center success"><strong>Attention: You have no reports to approve.<strong/></p>';
			}
		}
		catch (PDOException $e)
		{

			include 'includes/dbError.inc';

		}
		include 'includes/foot.inc';
	}

?>
