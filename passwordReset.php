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
	echo '<h2 class="center">Reset Password</h2>';
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
			$buildForm = true;
			$userId = $_POST['usersId'];
			$name = $_GET['name'];
			$successForm = false;
			$showForm=false;
		
			if(isset($_POST['submit']))
			{
				require_once 'objects/Validation.php';
				$validate = new Validation();
				$password = $validate->confirmPass($_POST['password'],$_POST['confirmPassword']);
				$errors = $validate->getErrorCount();
				if($errors==0)
				{
					try
					{
						$query = 'UPDATE userTable SET password = :password WHERE userId=:userId';
						require_once 'includes/dbConnect.inc';
						$statement=$db->prepare($query);
						$statement->bindValue(':password', crypt($password[0],'%20This%20is%20the%20salt%20I%20use%20'));
						$statement->bindValue(':userId',$userId);
						$statement->execute();
						$statement->closeCursor();
						$buildForm = false;
						$successForm = true;

					}
					catch(PDOException $e)
					{
						include_once 'includes/dbError.inc';
						$buildForm=false;
					}

				}
				else
				{
					$validate->printErrorMsgs();
				}

			}
			if($buildForm)
			{
	?>
				<p><strong>Instructions:</strong>Please enter a the new password in the password and confirmation fields.<br/> The password must be at least six characters long.</p>
				<form action="passwordReset.php?action=change&name=<?php echo $name;?>" method="POST">
				<p>Password <input type="password" name="password"/></p>
				<p>Confirmation Password<input type="password" name="confirmPassword"/></p>
				<input type="hidden" name="usersId" value=<?php echo "'$userId'"; ?> />
				<p><input type='submit' name='submit' value="Submit"/></p>
				</form>
<?php
			}
			if($successForm)
			{
?>
				<h2 class="center">Success</h2>
				<p>The password has been successfully updated.</p>
<?php
			}


		}


	if($showForm)
	{
		
		

		$policeDept=array();
		$file = file_get_contents('Maine_PD_List.txt');
		$policeDept = explode(',',$file);
		natcasesort($policeDept);
?>
		<form action="passwordReset.php" method="POST">
		<p class="center">Select a Police Department:&nbsp;&nbsp;<select name='slctPdDept'>
		<option value=""></option>
<?php
		foreach($policeDept as $policeDepts)
		{

			echo "<option value='".trim(str_ireplace("'", "?", $policeDepts))."'";

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
			<thead><tr><th>Name</th><th>Department</th><th>Change</br>Password</th></tr></thead>
<?php
		foreach($results as $result)
		{

			echo '<tr><td>'.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'</td><td>'.trim(str_ireplace("?", "'",$result['department'])).'</td><td><form action="passwordReset.php?action=change&name='.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'" method="POST"><input type="hidden" name="usersId" value="'.$result['userId'].'"/><input type="submit" name="Modify" value="Modify"/></form></td><tr/>';
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