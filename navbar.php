<?php
if(isset($_SESSION['userId']))
{
?>
		<nav><a href="index.php">Log-in</a><a href="logout.php">Log-out</a>
	<a href="HVE.php">Add A <br/>Report</a>


<?php
	if(isset($_SESSION['isSupervisor']))
		echo'<a href="supervisormenu.php">Supervisor</br>Menu</a>';
	elseif(isset($_SESSION['isAdmin']))
		echo'<a href="admin.php">Admin Menu</a>';
?>

	<a href="stats.php">Review<br/>Statistics</a></nav>



<?php
}


?>