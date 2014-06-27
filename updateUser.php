<?php
session_start();
include 'includes/httpsRedirect.inc';
if (!isset($_SESSION['isAdmin']))
{
	include_once 'includes/privilegeError.inc';

}
else
{
		
	$searchForm=true;
	$lookupForm=false;
	$updateForm =false;
	$noObs=false;
	$department=0;
	include_once 'includes/head.inc';
	
	if(isset($_POST['Search']))
	{
		require_once 'objects/Validation.php';
		$validate= new Validation();
		$department= $validate->validateInput($_POST['slctPdDept'],'Department');
		$errorCount=$validate->getErrorCount();
		if($errorCount!=0)
		{
			$validate->printErrorMsgs();
		}
		else
		{
			try
			{
				include 'includes/dbConnect.inc';
				$query = 'SELECT * FROM userTable WHERE department = :department AND isDisabled="n"';
				$statement = $db->prepare($query);
				$statement->bindValue(':department',$department);
				$statement->execute();
				$results = $statement->fetchAll();
				$statement->closeCursor();
				$arrayCount=count($results);
				if($arrayCount==0)
					$noObs=true;
				else
					$lookupForm= true;
			}
			catch(PDOException $e)
			{
				$searchForm =false;
				include 'includes/dbError.inc';
			}


		}

	}



	if(isset($_POST['Update']))
	{
		$firstName = $_POST['firstName'];
		$lastName=$_POST['lastName'];
		$department = $_POST['department'];
		$isAdmin = $_POST['isAdmin'];
		$userName=$_POST['userName'];
		$updateForm=true;
		$searchForm=false;
		$userId = $_POST['userId'];

	}

	if(isset($_POST['Submit']))
	{

		require_once 'objects/Validation.php';
		$validate= new Validation();
		$firstName = $validate->validAlpha($_POST['firstName'],'First Name');
		$lastName= $validate->validAlpha($_POST['lastName'],'Last Name');
		$department= $validate->validateInput($_POST['slctPdDept'],'Department');
		$userName= $validate->validAlphaNum($_POST['userName'],'UserName');
		$isAdmin=$_POST['isAdmin'];
		$userId = $_POST['userId'];
		$errorCount =$validate->getErrorCount();
		if($errorCount!=0)
		{
			$validate->printErrorMsgs();
		} 
		else
		{
			try
			{
				include 'includes/dbConnect.inc';
			

					$query ='UPDATE userTable SET firstName=:firstName,lastName=:lastName,userName=:userName,department=:department,isAdmin=:isAdmin
					WHERE userId=:userId';
					$statement=$db->prepare($query);
					$statement->bindValue(':firstName',strtolower($firstName));
					$statement->bindValue(':lastName',strtolower($lastName));
					$statement->bindValue(':userName',strtolower($userName));
					$statement->bindValue(':userId',$userId);
					$statement->bindValue(':department',$department);
					$statement->bindValue(':isAdmin',$isAdmin);
					$statement->execute();
					$statement->closeCursor();	
					?>
					<h2 class="center">Success!</h2>
					<p class="center">You have successfully updated the user&#39;s information.</p>
					<?php
					$searchForm=false;
				
			}
			catch(PDOException $e)
			{
				$showForm =false;
				include 'includes/dbError.inc';
			}

		}
	}

	if($updateForm)
	{
	?>
		<h2 class="center">Update User Information</h2>
		<form action="updateUser.php" method="POST">
		<p>First Name: <input type="text" name="firstName" <?php if (isset($firstName)) echo "value='".ucfirst($firstName)."'"; ?>/></p>
		<p>Last Name: <input type="text" name="lastName" <?php if (isset($lastName)) echo "value='".ucfirst($lastName)."'"; ?>/></p>
		<?php
				$policeDept=array();
			$file = file_get_contents('Maine_PD_List.txt');
			$policeDept = explode(',',$file);
			natcasesort($policeDept);
			
	?>		
			<p>Username:<input type="text" name="userName" <?php if (isset($userName)) echo "value='$userName'"; ?>/> </p>
			<p class=>Select a Police Department:&nbsp;&nbsp;<select name='slctPdDept'>
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
	?>

		</select>

		<p>Is the user an administrator? Yes<input type="radio" name="isAdmin" value="y"<?php if ($isAdmin=="y") echo"checked";?>/> No<input type="radio" name="isAdmin" value="n"<?php if ($isAdmin=="n") echo"checked";?>/></p>
		<input type="hidden" name="userId" value= "<?php echo $userId ?>"/>

		<p><input type="submit" name="Submit" /></p>
		</form>
	<?php
	}



	if($searchForm)
	{
		
		

		$policeDept=array();
		$file = file_get_contents('Maine_PD_List.txt');
		$policeDept = explode(',',$file);
		natcasesort($policeDept);
?>
		<form action="updateUser.php" method="POST">
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


if($lookupForm)
	{
?>

		<table>
			<thead><tr><th>Name</th><th>Department</th><th>Update</br>User</th></tr></thead>
<?php
		foreach($results as $result)
		{

			echo '<tr><td>'.ucfirst($result['firstName']).' '.ucfirst($result['lastName']).'</td><td>'.trim(str_ireplace("?", "'",$result['department'])).'</td><td><form action="updateUser.php" method="POST"><input type="hidden" name="userId" value="'.$result['userId'].'"/><input type="hidden" name="department" value="'.$result['department'].'"/><input type="hidden" name="firstName" value="'.$result['firstName'].'"/><input type="hidden" name="lastName" value="'.$result['lastName'].'"/><input type="hidden" name="userName" value="'.$result['userName'].'"/><input type="hidden" name="isAdmin" value="'.$result['isAdmin'].'"/><input type="submit" name="Update" value="Update"/></form></td><tr/>';
		}
?>
	</table>
<?php
	}
	if($noObs)
	{
?>
		<p class="error">There are no users registered for the department submitted.</p>
<?php		
	}


	include_once 'includes/foot.inc';




}
	include_once 'includes/foot.inc';
?>