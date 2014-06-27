<?php
session_start();
if (!isset($_SESSION['isAdmin']))
{
	include_once 'includes/privilegeError.inc';
}
else
{
	include_once 'includes/head.inc';
	echo '<h2 class="center" style="margin-bottom: 35px;">Modify Administrative Privileges</h2>';
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
			if($action=='add')
				$admin='y';
			else if ($action=='remove')
				$admin='n';
			


			if(isset($_POST['Modify']))
			{
			

					try
					{
						$query = 'UPDATE userTable SET isAdmin = :admin WHERE userId=:userId';
						require_once 'includes/dbConnect.inc';
						$statement=$db->prepare($query);
						$statement->bindValue(':admin',$admin);
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
					<p class="center">Admin privileges have been successfully updated for <?php echo $_GET['name']?>.</p>
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
		<form action="addAdmin.php" method="POST">
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
			<thead><tr><th>Name</th><th>Department</th><th>Add admin</th><th>Remove Admin</th></tr></thead>
<?php
		foreach($results as $result)
		{

			echo '<tr><td>'.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'</td><td>'.trim(str_ireplace("?", "'",$result['department'])).'</td><td><form action="addAdmin.php?action=add&name='.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'" method="POST"><input type="hidden" name="usersId" value="'.$result['userId'].'"/><input type="submit" name="Modify" value="Modify"/></form></td><td><form action="addAdmin.php?action=remove&name='.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'" method="POST"><input type="hidden" name="usersId" value="'.$result['userId'].'"/><input type="submit" name="Modify" value="Modify"/></form></td><tr/>';
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