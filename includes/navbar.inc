<?php
if(isset($_SESSION['userId']))
{
?>
		<nav><ul><li><a href="index.php">Log-in</a></li><li><a href="logout.php">Log-out</a></li>
	<li><a href="HVE.php">Add A Report</a></li>


<?php
	if(isset($_SESSION['isSupervisor']))
		echo'<li><a href="supervisormenu.php">Supervisor Menu</a></li>';
	if(isset($_SESSION['isAdmin']))
		echo'<li><a href="admin.php">Admin Menu</a></li>';
?>

	<li><a href="stats.php">Review Statistics</a></li></ul></nav>



<?php
}


?>