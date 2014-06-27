<?php
session_start();
	include 'includes/httpsRedirect.inc';
if (!isset($_SESSION['isAdmin']))
{
	include_once 'includes/privilegeError.inc';

}
else
{
	include_once 'includes/head.inc';
	echo '<h2 class="center" style="margin-bottom: 15px;">Modify Supervisor Privileges</h2>';
	$showForm=true;
	$department = 0;
	$lookup = false;
	$noUsers =false;
	if(isset($_POST['Search']))
	{
		require_once 'objects/Validation.php';
		$validate = new Validation();
		$department = $validate->validateInput($_POST['slctPdDept'],'Department field');
		$errors = $validate->getErrorCount();
		if($errors==0)
		{
			try
			{
				require_once 'includes/dbConnect.inc';
				$query='SELECT * FROM userTable WHERE department=:department';
				$statement=$db->prepare($query); 
				$statement->bindValue(':department',$department);
				$statement->execute();
				$results=$statement->fetchAll();
				$statement->closeCursor();
				if(!empty($results))
					$lookup=true;	
				else
				{
					$noUsers=true;
				}
			}
			catch(PDOException $e)
			{
				include_once 'includes/dbError.inc';
				$showForm=false;

			}

		}
		else
		{
			$validate->printErrorMsgs();
		}
	}
	if(isset($_GET['action'])&&isset($_POST['usersId'])&&isset($_GET['department']))
	{
		$usersId = $_POST['usersId'];
		//echo 'hello';
		$department = trim($_GET['department']);
		if(isset($_GET['name']))
			$name = $_GET['name'];
		$showForm=false;

		if($_GET['action']=='add')
		{
			$buildForm=false;
			try
			{

				include 'includes/dbConnect.inc';
				$db->beginTransaction();
				$query='SELECT * FROM userTable WHERE department=:department AND userId !=:userId';
				$statement=$db->prepare($query);
				$statement->bindValue(':department',$department);
				$statement->bindValue(':userId',$usersId);
				$statement->execute();
				$departmentUsers = $statement->fetchAll();

				$query1='SELECT * FROM supervisorBridgeTable WHERE department=:department';
				$statement=$db->prepare($query1);
				$statement->bindValue(':department',$department);
				$statement->execute();
				$supervisees = $statement->fetchAll();
				$db->commit();
				$buildForm=true;
					

			}
			catch(PDOException $e)
			{
				$db->rollback();
				include 'includes/dbError.inc';
			}
			if(isset($_POST['submit']))
			{
				try
				{

					if(isset($_POST['supervisees']))
					{
						$query='INSERT INTO supervisorBridgeTable(superviseeId,supervisorId, department)
						VALUES(:superviseeId,:supervisorId,:department)';
						include 'includes/dbConnect.inc';
						$statement=$db->prepare($query);
						$supervisee =$_POST['supervisees'];
						foreach($supervisee as $supervisees)
						{
							$statement->bindValue(':superviseeId',$supervisees);
							$statement->bindValue(':supervisorId',$usersId);
							$statement->bindValue(':department',$department);
							$statement->execute();
						}
						echo '<h2 class="center">Success</h2><p class="center">The query was successfully processed.</p>';
						$buildForm =false;
					}
					else
					{
						echo '<p class="error" style="margin-left: 25%;"">Error: You have not submitted any data for processing.</p>';
					}
				}
				catch(PDOException $e)
				{
					$db->rollback();
					include 'includes/dbError.inc';
				}
			}
			if($buildForm)
			{
?>
				<h2 class="center">Add Supervisees</h2>
<?php
				echo "<p style='margin-left: 25%;'>To link a supervisee to $name, check the checkbox next to the supervisee's name. The supervisee checkbox will be disabled for selection if they are already supervised.</p>";

				echo'<form action="supervisorPrivileges.php?action=add&department='.$department.'&name='.$name.'" method="POST">';
?>
				<table>
					<thead><tr><th>First Name</th><th>Last Name</th><th>Select</th></tr></thead>
<?php
					foreach($departmentUsers as $departmentUser) 
					{
						echo "<tr><td>".$departmentUser['firstName']."</td><td>".$departmentUser['lastName']."</td><td><input type='checkbox' name='supervisees[]' value='".$departmentUser['userId']."'";
						foreach ($supervisees as $supervisee)
						{
							if($departmentUser['userId']==$supervisee['superviseeId'])
							{
								echo 'disabled';
							}
						}

						echo "/></td></tr>";
					}
?>

				</table>
				
<?php
					echo '<input type="hidden" name="usersId" value="'.$usersId.'"/>';
					echo '<p style="margin-left: 25%;""><input type="submit" name="submit" value="Add Privilege"></p>';
				if(empty($departmentUsers))
					echo'<p class="error" style="margin-left: 25%;"">There must be more than one registered user in the department to grant supervisor privileges.</p>';

				echo '</form>';
			}

		}
		if($_GET['action']=='delete')
		{
			$buildForm=false;
			try
			{

				include 'includes/dbConnect.inc';
				$query="SELECT userTable.firstName,userTable.lastName,userTable.userId  FROM userTable JOIN supervisorBridgeTable ON supervisorBridgeTable.superviseeId=userTable.userId WHERE supervisorBridgeTable.department=:department AND supervisorBridgeTable.supervisorId =:supervisorId";
				$statement=$db->prepare($query);
				$statement->bindValue(':department',$department);
				$statement->bindValue(':supervisorId',$usersId);
				$statement->execute();
				$supervisees = $statement->fetchAll();
				$statement->closeCursor();
				$buildForm=true;
/*				
				$query1='SELECT * FROM supervisorBridgeTable WHERE department=:department';
				$statement=$db->prepare($query1);
				$statement->bindValue(':department',$department);
				$statement->execute();
				$supervisees = $statement->fetchAll();
				$db->commit();*/
				

			}
			catch(PDOException $e)
			{
				
				include 'includes/dbError.inc';
			}
			if(isset($_POST['submit']))
			{
				try
				{					
					include 'includes/dbConnect.inc';
					
					if(!isset($_POST['supervisees']))
					{	
						$message="<p class='error'>Error: You have submitted the form without checking any boxes.Please try again.</p>";
						$buildForm=true;
					}
					else
					{
						$superviseeList =$_POST['supervisees'];	
						$query='DELETE FROM supervisorBridgeTable WHERE supervisorId=? AND department=? AND superviseeId IN (';
						$superviseeCount= count($superviseeList);
						for($i=0; $i<$superviseeCount;$i++)
						{
							if($i==($superviseeCount-1))
							{
								$query.='?)';
								break;
							}
							$query.='?,';
						}
						$statement=$db->prepare($query);
						$statement->bindValue(1,$usersId);
						$statement->bindValue(2,$department);
						//echo "$query";
						$j=3;
						foreach($superviseeList as $superviseeLists)
						{
							$statement->bindValue($j,$superviseeLists);
							$j++;
						}
						$statement->execute();	
						echo "<h2 class='center' style='margin: 30px 0px 8px 0px;''>Success</h2> <p class='center'>You have succesfully removed the selected supervisees from the user's supervisor list.</p>";					
						$buildForm =false;
					}
				}
				catch(PDOException $e)
				{
					
					include 'includes/dbError.inc';
				}
			}
			if($buildForm)
			{
?>
				<h2 class="center" style="margin: 30px 0px 8px 0px;">Remove Supervisees</h2>
<?php
				echo "<p style='margin-left: 25%;'>To remove a supervisee, <strong>check</strong> the checkbox next to the supervisee's name. <br/> 
				Warning: checking all the checkboxes removes supervisor privileges for the user.</p>";

				echo'<form action="supervisorPrivileges.php?action=delete&department='.$department.'" method="POST">';

?>				

				<table>
					<thead><tr><th>First Name</th><th>Last Name</th><th>Select</th></tr></thead>
<?php
					foreach($supervisees as $supervisee) 
					{
						echo "<tr><td>".$supervisee['firstName']."</td><td>".$supervisee['lastName']."</td><td><input type='checkbox' name='supervisees[]' value='".$supervisee['userId']."'";


						echo "/></td></tr>";
					}

?>

				</table>
				
<?php
					echo '<input type="hidden" name="usersId" value="'.$usersId.'"/>';
					echo '<input type="submit" name="submit" value="Remove Privilege" style="margin-left: 20%;">';
				if(empty($supervisees))
				{
					echo "<p style='color:red; margin-left:20%;'>Attention: This user does not have supervisee privileges.</p>";
				}
				echo '</form>';
			}

		}
		

	}

//inital form
	if($showForm)
	{
		
		

		$policeDept=array();
		$file = file_get_contents('Maine_PD_List.txt');
		$policeDept = explode(',',$file);
		natcasesort($policeDept);
?>
		<form action="supervisorPrivileges.php" method="POST">
		<p class="center">Select a Police Department:&nbsp;&nbsp;<select name='slctPdDept'>
		<option value=""></option>
<?php
		foreach($policeDept as $policeDepts)
		{
			echo "<option value='".trim(str_ireplace("'", "?", $policeDepts))."'";
			if($department ==trim(str_ireplace("'", "?", $policeDepts)))
			{
				echo 'selected="selected"';
			}
			echo ">$policeDepts</option>";
		}

		echo '&nbsp;&nbsp;<input type="submit" name="Search" value="Search"/></p>';
?>

		</form>
<?php
	}

	if($lookup)
	{
		echo "<p style='margin-left: 25%;'><strong>Instructions:</strong>To select the user for whom you'd like to add or remove supervisor privileges, click the modify button.</p>";
?>
		<table>
			<thead><tr><th>Name</th><th>Department</th><th>Add<br/>User</th><th>Remove</br>User</th></tr></thead>
<?php
		foreach($results as $result)
		{
			echo '<tr><td>'.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'</td><td>'.trim(str_ireplace("?", "'", $result['department'])) .'</td><td><form action="supervisorPrivileges.php?action=add&department='.$result['department'].'&name='.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'" method="POST"><input type="hidden" name="usersId" value="'.$result['userId'].'"/><button>Modify</button></form></td><td><form action="supervisorPrivileges.php?action=delete&department='.$result['department'].'&name='.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'"" method="POST"><input type="hidden" name="usersId" value="'.$result['userId'].'"/><button>Modify</button></form></td><tr/>';
		}
	}
	if($noUsers)
	{
		echo '<p class="error">There are no users registered in the department submitted. Please try again.</p>';
	}
	include_once 'includes/foot.inc';

	




}

?>