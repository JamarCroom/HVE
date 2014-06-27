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
	echo '<h2 class="center">Add/Remove User</h2>';
	$showForm=true;
	$department = 0;
	$lookup = false;
	$noObs=false;
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
		if(isset($_GET['action'])&&isset($_GET['usersId']))
	{
		$userId=$_GET['usersId'];
		try
		{
			$query='DELETE FROM userTable WHERE userId=:userId';
			require_once 'includes/dbConnect.inc';
			$statement=$db->prepare($query);
			$statement->bindValue(':userId',$userId);
			$result=$statement->execute();
			$statement->closeCursor();
			echo "<h2 class='center'>Success</h2><p class='center'>Your request was successfully processed - $result record(s) removed from the database.</p>";
			$showForm=false;
		}
		catch(PDOException $e)
		{
			include 'includes/dbError.inc';

		}

	}
	if($showForm)
	{
		
		

		$policeDept=array();
		$file = file_get_contents('Maine_PD_List.txt');
		$policeDept = explode(',',$file);
		natcasesort($policeDept);
?>
		<form action="delete.php" method="POST">
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

		echo '&nbsp;&nbsp;<input type="submit" name="Search"/></p>';
?>

		</form>
<?php
	}

	if($lookup)
	{
?>

		<table>
			<thead><tr><th>Name</th><th>Department</th><th>Remove</br>User</th></tr></thead>
<?php
		foreach($results as $result)
		{
			echo '<tr><td>'.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'</td><td>'.trim(str_ireplace("?", "'",$result['department'])).'</td><td><form action="delete.php?action=remove&usersId="'.$result['userId'].'" method="POST"><button>Modify</button></form></td><tr/>';
		}
	}
	if($noObs)
	{
?>
		<p>There were no users registered under the department submitted.</p>
<?php		
	}
	include_once 'includes/foot.inc';

	




}

?>