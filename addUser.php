<?php
session_start();
include 'includes/httpsRedirect.inc';
if (!isset($_SESSION['isAdmin']))
{
	include_once 'includes/privilegeError.inc';

}
else
{
		
	$showForm=true;
	$department=0;
	$isAdmin='dummystring';
	include_once 'includes/head.inc';
	if(isset($_POST['Submit']))
	{
		require_once 'objects/Validation.php';
		$validate= new Validation();
		$firstName = $validate->validAlpha($_POST['firstName'],'First Name');
		$lastName= $validate->validAlpha($_POST['lastName'],'Last Name');
		$department= $validate->validateInput($_POST['slctPdDept'],'Department');
		$email= $validate->validAlphaNum($_POST['email'],'Username');
		$password = $validate->confirmPass($_POST['password'],$_POST['confirmPassword']);
		if(isset($_POST['isAdmin']))
			$isAdmin = 'y';
		else
			$isAdmin ='n';
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
			
				$queryString='SELECT userName FROM userTable WHERE userName =:userName';
				$statement=$db->prepare($queryString);
				$statement->bindValue(':userName',$email);
				$statement->execute();
				$result = $statement->fetchAll();
				foreach($result as $results)
				{
					$confirmEmail = $results['email'];
				}
				$statement->closeCursor();
				if(!isset($confirmEmail))
					$confirmEmail=0;
				if($confirmEmail!==$email)
				{

					$query ='INSERT INTO userTable (firstName,lastName,userName,password,department,isAdmin)
					VALUES
					(:firstName,:lastName,:userName,:password,:department,:isAdmin)';
					$statement=$db->prepare($query);
					$statement->bindValue(':firstName',strtolower($firstName));
					$statement->bindValue(':lastName',strtolower($lastName));
					$statement->bindValue(':userName',strtolower($email));
					$statement->bindValue(':department',$department);
					$statement->bindValue(':password',crypt($password[0],'%20This%20is%20the%20salt%20I%20use'));
					$statement->bindValue(':isAdmin',$isAdmin);
					$statement->execute();
					$statement->closeCursor();	
					?>
					<h2 class="center">Success!</h2>
					<p class="center">You have successfully entered a new user into the database.</p>
					<?php
					$showForm = false;
				}
				else
				{
					echo '<p class="error">Error: There is a user who has already been registered with this username. Please try again.</p>';
				}
				
			}
			catch(PDOException $e)
			{
				$showForm =false;
				include 'includes/dbError.inc';
			}

		}
	}
	if($showForm)
	{
	?>
		<h2 class="center">Add a New User</h2>
		<form action="addUser.php" method="POST">
		<p>First Name: <input type="text" name="firstName" <?php if (isset($firstName)) echo "value='$firstName'"; ?>/></p>
		<p>Last Name: <input type="text" name="lastName" <?php if (isset($lastName)) echo "value='$lastName'"; ?>/></p>
		<?php
				$policeDept=array();
			$file = file_get_contents('Maine_PD_List.txt');
			$policeDept = explode(',',$file);
			natcasesort($policeDept);
			
	?>
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
		<p>Username:<input type="text" name="email" <?php if (isset($email)) echo "value='$email'"; ?>/> </p>
		<p>Password:<input type="password" name="password" <?php if (isset($password[0])) echo "value='".$password[0]."'"; ?>/></p>
		<p>Confirm Password: <input type="password" name="confirmPassword" <?php if (isset($password[1])) echo "value='".$password[1]."'"; ?>/></p>
		<p>Check the box to give the user administrative privileges <input type="checkbox" name="isAdmin" value="y" <?php if($isAdmin=='y') echo 'checked'?>/></p>
		<p><input type="submit" name="Submit" /></p>
		</form>
	<?php
	}
}
	include_once 'includes/foot.inc';
?>