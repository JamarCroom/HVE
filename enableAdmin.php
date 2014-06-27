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
	echo '<h2 class="center" style="margin-bottom: 35px;">Disable/Re-enable User Account</h2>';
	$showForm = true;
	$lookup = false;
	$noObs=false;
	if(isset($_POST['Search']))
	{
		require_once 'objects/Validation.php';
		$validate = new Validation();
		$department = $validate->validateInput($_POST['slctPdDept'],'Department');
		$errors=$validate->getErrorCount();
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
				if(empty($results))
				{
					$lookup=false;
					$noObs=true;
				}
				else
					$lookup=true;
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
		if(isset($_GET['action'])&&isset($_POST['usersId']))
		{
			
			$userId = $_POST['usersId'];
			$name = $_GET['name'];
			$successForm = false;
			$showForm=false;
			$action=$_GET['action'];
			if($action=='disable')
				$disabled='y';
			else if ($action=='enable')
				$disabled='n';
			


			if(isset($_POST['Modify']))
			{
			

					try
					{
						$query = 'UPDATE userTable SET isDisabled = :disabled WHERE userId=:userId';
						require_once 'includes/dbConnect.inc';
						$statement=$db->prepare($query);
						$statement->bindValue(':disabled',$disabled);
						$statement->bindValue(':userId',$userId);
						$statement->execute();
						$statement->closeCursor();
						$successForm = true;
						
						
					}
					catch(PDOException $e)
					{
						include_once 'includes/dbError.inc';
						
					}
				if($successForm)
				{
	?>
					<h2 class="center">Success</h2>
					<p class="center">User account privileges have been successfully updated for <?php echo $_GET['name']?>.</p>
	<?php
				}
			}


		}
	


	if($showForm)
	{
		
		$policeDept=array();
		$file = file_get_contents('Maine_PD_List.txt');
		$policeDept = explode(',',$file);
		natcasesort($policeDept);
?>
		<form action="enableAdmin.php" method="POST">
		<p class="center">Select a Police Department:&nbsp;&nbsp;<select name='slctPdDept'>
		<option value=""></option>
<?php
		foreach($policeDept as $policeDepts)
		{

			echo "<option value='".trim(str_ireplace("'", "?", $policeDepts))."'";

			echo ">$policeDepts</option>";
		}

		echo '&nbsp;&nbsp;<input type="submit" name="Search" value="Search"/></p>';
?>

		</form>
<?php
	}


if($lookup)
	{
?>

		<table>
			<thead><tr><th>Name</th><th>Department</th><th>Disable<br/>Account</th><th>Re-enable<br/>Account</th></tr></thead>
<?php
		foreach($results as $result)
		{

			echo '<tr><td>'.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'</td><td>'.trim(str_ireplace("?", "'",$result['department'])).'</td><td><form action="enableAdmin.php?action=disable&name='.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'" method="POST"><input type="hidden" name="usersId" value="'.$result['userId'].'"/><input type="submit" name="Modify" value="Modify"/></form></td><td><form action="enableAdmin.php?action=enable&name='.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'" method="POST"><input type="hidden" name="usersId" value="'.$result['userId'].'"/><input type="submit" name="Modify" value="Modify"/></form></td><tr/>';
		}
?>
	</table>
<?php
	}

	if($noObs)
	{
?>
		<p>There are no users registered under the department submitted.</p>
<?php		
	}


	include_once 'includes/foot.inc';
}
?>