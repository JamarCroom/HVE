<?php
session_start();
include 'includes/httpsRedirect.inc';

if(isset($_SESSION['isAdmin']))
{
	$style="
		#wrapper
		{
			height:500px;
		}";
	include_once 'includes/head.inc';
?>

	<h2 class="center" style="padding-bottom:30px;">Admin Menu</h2>
<div style="float:left; height: 200px; margin-left:30%;">	
	<form action='passwordReset.php' method='POST'><button>Reset User Password</button></form>
		<br/>
	<form action='addUser.php' method='POST'><button>Add A New User</button></form><br/>
	
	<form action='updateUser.php' method='POST'><button>Update User Information</button></form>
</div>


	<div style="float:right; height: 200px; margin-right:30%;"><form action='enableAdmin.php' method='POST'><button>Disable/Re-enable User Account</button></form>
	<br/>
	<form action='supervisorPrivileges.php' method='POST'><button>Add/Remove Supervisor Privileges</button></form>
	<br/>
		<form action='addAdmin.php' method='POST'><button>Add/Remove Admin Privileges</button></form>


</div>



<?php
	include_once 'includes/foot.inc';

}
else
{
		
	include_once 'includes/privilegeError.inc';


}
?>