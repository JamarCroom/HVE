<?php
session_start();


if(!isset($_POST['submit']))
{
?>
	<p>You have not submitted any data for processing</p>

<?php
}
else
{
	$userId=1;
	$showForm=true;
	require_once '../objects/Validation.php';
	$validate= new Validation();
	$parentFname = $validate->validAlpha($_POST['prnt1firstName'],'First Name');
	$parentLname = $validate->validAlpha($_POST['prnt1fLastName'],'Last Name');
	$otherParentFname=$validate->validAlpha($_POST['prntFnme'], 'First name of other parent/guardian');
	$otherParentLname=$validate->validAlpha($_POST['prntLstme'], 'Last name of other parent/guardian');
	$address = $validate->validateInput($_POST['address'],'Address');
	$city =$validate->validAlpha($_POST['city'], 'City');
	$zipcode = $validate->validAlpha($_POST['zipcode'],'Zipcode');
	$incomeEligible = $validate->validateInput($_POST['incmeEligType'],'Income Eligibility Verification');
	$maineResidency = $validate->validateInput($_POST['maineRes'],'Maine Residency Verification');

	$childFirstName = $_POST['childFirstName'];
	foreach($childFirstName as $key=>$value)
	{
		$childFirstName[$key] = $validate->validAlpha($childFirstName[$key],"Child's First Name");
	}

	$childLastName= $_POST['ChildLastName'];
	foreach ($childLastName as $key=>$value) 
	{
		$childLastName[$key] = $validate->validAlpha($childLastName[$key],"Child's Last Name");
	}

	$childsAge = $_POST['childsAge'];
	foreach ($childsAge as $key=>$value) 
	{
		$childsAge[$key] = $validate->validNum($childsAge[$key],"Child's Age");
	}

	$childDOB = $_POST['childDOB'];
	foreach ($childDOB as $key=>$value) 
	{
		$childDOB[$key]=$validate->validDate($childDOB[$key],"Child's Date of Birth");
	}

	$childWeight = $_POST['childWeight'];
	foreach ($childWeight as $key=>$value) 
	{
		$childWeight[$key] = $validate->validNum($childWeight[$key],"Child's Weight");
	}

	$childHeight = $_POST['childHeight'];
	foreach ($childHeight as $key=>$value) 
	{
		$childHeight[$key] = $validate->validNum($childHeight[$key],"Child's Height");
	}


	$manufacturerCount = count($manufacturerList);
	$manufacturerList = $_POST['manufacturerList'];
	$manufacturerText = $_POST['manufacturerText'];
	$carSeatNme = $_POST['carSeatNme'];

	for($i=0; $i<$manufacturerCount;$i++)
	{
		if(empty($manufacturerList[$i])&&empty($manufacturerText[$i])&& empty($carSeatNme[$i]))
		{
			$manufacturerList[$i] = $validate->validateInput($manufacturerList[$key],"Select from list: Car Seat Manufacturer");
			$manufacturerText[$i]=$validate->validAlphaNum($manufacturerText[$i],"Car Seat Manufacturer: (if different from the list above)");
			$carSeatNme[$i]=$validate->validAlphaNum($carSeatNme[$i],"Car Seat Model Name: (if different from the list above)")
		}
		else if(empty($manufacturerList[$i])&& (!empty($manufacturerText[$i])||!empty($carSeatNme[$i])))
		{
			$manufacturerText[$i]= $validate->validAlphaNum($manufacturerText[$i],"Car Seat Manufacturer: (if different from the list above)");
			$carSeatNme[$i]= $validate->validAlphaNum($carSeatNme[$i],"Car Seat Model Name: (if different from the list above)");
		}
		else if(!empty($manufacturerList[$i])&& (!empty($manufacturerText[$i])||!empty($carSeatNme[$i])))
		{
			$validate->incErrorCount();
			$validate->addErrorMsgs("Error:Either the 'Manufacturer's list' field and the 'Car Seat Manufacturer' and 'Car Seat Model Name' fields must be completed.");
		}

	}

	$carSeatDte = $_POST['carSeatDte'];
	foreach ($carSeatDte as $key=>$value) 
	{
		$carSeatDte[$key] = $validate->validDate($carSeatDte[$key],"Car Seat Manufacturer Date");
	}

	$carSeatSerialNum = $_POST['carSeatSerialNum'];
	foreach ($carSeatSerialNum as $key=>$value) 
	{
		$carSeatSerialNum[$i]= $validate->validAlphaNum($carSeatSerialNum[$key],"Car Seat Model/Serial Number");
	}

	if(isset($_POST['confirm']))
		$confirm =$_POST['confirm'];
	else
		$confirm = 0;
	$confirm = $validate->validateInput($confirm, 'Confirmation');
	
	$errors=$validate->getErrorCount();

	if($errors>0)
	{
?>
		<fieldset>
<?php
			$validate->printErrorMsgs();
?>
		</fieldset>
<?

	}
	else
	{
		//dump into db
		echo '<p>Success</p>';
	}

	if($showForm)
	{
?>
		<form id="formCPS" action="CPSprocess.php" method="POST">
		<h2 style ="text-align:center; margin-top: 3px;">Child Passenger Safety Reporting Form</h2>

		<fieldset id="applicantInformation">
		<h4>Parent/Guardian Information</strong></h4>
		<p> First Name(parent/guardian/caregiver): <input id="appFnme" class="appInfo" name="prnt1firstName" type="text" value=<?php echo"'$parentFname'"; ?>/></p>
		<p>Last Name(parent/guardian/caregiver): <input id="appLstme" class="appInfo" name="prnt1LastName" type="text" value=<?php echo"'$parentLname'"; ?>/></p>
		<p>First name of other parent/guardian(if available): <input id="prntFnme" class="appInfo" name="prntFnme" type="text" value=<?php echo"'$otherParentFname'"; ?>/></p>
		<p>Last name of other parent/guardian(if available): <input id="prntLstme" class="appInfo" name="prntLstme" type="text" value=<?php echo"'$otherParentLname'"; ?>/></p>
		<p>Applicant's Physical Address: <input id="address" name="address" class="appInfo" type="text" value=<?php echo"'$address'"; ?>/>/></p>
		<p>Applicant's Town/City of Residence: <input id="city" name="city" class="appInfo" type="text" value=<?php echo"'$city'"; ?>/>/></p>
		<p>Applicant's Zip Code of Residence: <input id="zipcode" class="appInfo" name="zipcode" value=<?php echo"'$zipcode'"; ?>/>/></p>
		<p>Applicant's County of Residence:
			<select name="county" class="appInfo">
				<option value =""></option>
				<option value="Androscoggin" <?php if($county=="Androscoggin") echo "selected";?>>Androscoggin</option>
				<option value="Aroostook" <?php if($county=="Aroostook") echo "selected";?>>Aroostook</option>
				<option value="Cumberland" <?php if($county=="Cumberland") echo "selected";?>>Cumberland</option>
				<option value="Franklin" <?php if($county=="Franklin") echo "selected";?>>Franklin</option>
				<option value="Hancock" <?php if($county=="Hancock") echo "selected";?>>Hancock</option>
				<option value="Kennebec" <?php if($county=="Kennebec") echo "selected";?>>Kennebec</option>
				<option value="Knox" <?php if($county=="Knox") echo "selected";?>>Knox</option>
				<option value="Lincoln" <?php if($county=="Lincoln") echo "selected";?>>Lincoln</option>
				<option value="Oxford" <?php if($county=="Oxford") echo "selected";?>>Oxford</option>
				<option value="Penobscot" <?php if($county=="Penobscot") echo "selected";?>>Penobscot</option>
				<option value="Piscataquis" <?php if($county=="Piscataquis") echo "selected";?>>Piscataquis</option>
				<option value="Sagadahoc" <?php if($county=="Sagadahoc") echo "selected";?>>Sagadahoc</option>
				<option value="Somerset" <?php if($county=="Somerset") echo "selected";?>>Somerset</option>
				<option value="Waldo" <?php if($county=="Waldo") echo "selected";?>>Waldo</option>
				<option value="Washington" <?php if($county=="Washington") echo "selected";?>>Washington</option>
				<option value="York" <?php if($county=="York") echo "selected";?>>York</option>
			</select>
		</p>
		<p>Income Eligibility Verification:
			<select name="incmeEligType" class="appInfo" >
				<option value="" <?php ?> ></option>
				<option value="WIC" <?php if($incomeEligible=="WIC") echo "selected";?>>WIC letter</option>
				<option value="TANF" <?php if($incomeEligible=="TANF") echo "selected";?>>TANF letter</option>
				<option value="SNAP" <?php if($incomeEligible=="SNAP") echo "selected";?>>SNAP Letter</option>
				<option value="Maine Care" <?php if($incomeEligible=="Maine Care") echo "selected";?>>Maine Care Letter</option>
			</select>
		</p>
		<p>Maine Residency Verification:
			<select name="maineRes" id="maineRes" class="appInfo">
				<option value=""></option>
				<option value="Maine Driver's License" <?php if($maineResidency=="Maine Driver's License") echo "selected";?>>Maine Driver's License</option>
				<option value="Maine Identification Card" <?php if($maineResidency=="Maine Identification Card") echo "selected";?>>Maine Identification Card</option>
				<option value="Tribal Identification" <?php if($maineResidency=="Tribal Identification") echo "selected";?>>Tribal Identification</option>
				<option value="Refugee I-94"<?php if($maineResidency=="Refugee I-94") echo "selected";?>>Refugee I-94 letter with photo</option>
			</select>
		</p>
		</fieldset>

		<fieldset id="childAndSeatInformation">
<?php

		foreach ($childFirstName as $key => $value) 
		{
?>

			<div class="childAndSeatInfo">
				<div class="childInformation">
					<h4>Recipient's Information</strong></h4>
						<p>Child's First Name <input type="text" name="childFirstName[]" value=<?php echo"'".$childFirstName[$key]."'";?>/></p>
						<p>Child's Last Name <input type="text" name="childLastName[]" value=<?php echo"'".$childLastName[$key]."'";?>/></p>
						<p>Child's Age (Note: if child has not yet been born enter 0) <input type="text" name="childsAge[]" value=<?php echo"'".$childsAge[$key]."'"; ?>/></p>
						<p>Child's Date of Birth/Due Date <input type="text" class="datepicker" name="childDOB[]" value=<?php echo"'".$childDOB[$key]."'"; ?>/></p>
						<p>Child's Weight (Note: if child has not yet been born enter 0) <input type="text" name="childWeight[]" value=<?php echo"'".$childWeight[$key]."'"; ?>/></p>
						<p>Child's Height (Note: if child has not yet been born enter 0) <input type="text" name="childHeight[]" value=<?php echo"'".$childHeight[$key]."'"; ?>/></p>
				
				</div>

				<div class="safetySeatInfo">
					<h4>Safety Seat Information</h4>
						<p>Car Seat Manufacturer:
							<select name="manufacturerList[]" class="safetySeatInfo">
								<option value=""></option>
								<option value="Evenflo Embrace" <?php if ($manufacturerList[$key]=="Evenflo Embrace") echo"selected";?>>Evenflo Embrace-Infant Seat</option>
								<option value="Evenflo Titan" <?php if ($manufacturerList[$key]=="Evenflo Titan") echo"selected";?>>Evenflo Titan-Convertible Seat</option>
								<option value="Evenflo Secure Kid" <?php if ($manufacturerList[$key]=="Evenflo Secure Kid") echo"selected";?>>Evenflo Secure Kid-Combination Seat</option>
								<option value="Evenflo" <?php if ($manufacturerList[$key]=="Evenflo") echo"selected";?>>Evenflo-Highback to No Back Booster Seat</option>
							</select>
						</p>
					<p>Car Seat Manufacturer:(if different from the list above)<input type="text" name="manufacturerText[]" value=<?php echo"'".$manufacturerText[$key]."'";?> /></p>
					<p>Car Seat Model Name:(if different from the list above)<input type="text"  name="carSeatNme[]" class="safetySeatInfo" value=<?php echo"'".$carSeatNme[$key]."'";?> /></p>

					<p>Car Seat Manufacture Date: <input type="text" class="datepicker" name="carSeatDte[]" value=<?php echo"'".$carSeatDte[$key]."'"; ?> />
					</p>
					<p>Car Seat Model/Serial Number: <input type="text" class="safetySeatInfo" name="carSeatSerialNum[]" value=<?php echo"'".$carSeatSerialNum[$key]."'"; ?> /></p>
				</div>

			</div>
<?php
			
		}
?>
		<button id="addChildSt">Add another child and seat</button>
	</fieldset>
	<p>By checking the following box, you are confirming that the information above is correct. <input type="checkbox" name="confirm" value="confirmed" <?php if($confirm=="confirmed") echo"checked";?> /></p>

		<p style = "text-align:center"><input type="submit" class = "buttons" name="submit" id="submit" value="Submit" /></p>
</form>



<?php
	}

}

?>