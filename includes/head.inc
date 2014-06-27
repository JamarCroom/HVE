<!DOCTYPE html>
<html>


<head>
<!--
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>-->

<link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'/>
<link href='https://fonts.googleapis.com/css?family=Paytone+One' rel='stylesheet' type='text/css'>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/overcast/jquery-ui.min.css" rel="stylesheet" type="text/css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="style/bhsStyle.css" /> 
<!--
<script type="text/javascript" src="./jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
<link rel="stylesheet" type="text/css" href="./jquery-ui-1.10.3.custom/css/overcast/jquery-ui-1.10.3.custom.css" />
-->
<style type="text/css">
<?php
 if(isset($style))
{
	echo $style;
}
?>

</style>
<script type="text/javascript">
<?php
 if(isset($script))
{
	echo $script;
}
?>


</script>
</head>
<body>
<div id="wrapper">
	<div id="header"><img src="pics/bhs_logo.jpg" id="logo" style="vertical-align: middle; border-radius: 5px;"/><span id="logoWording">Bureau of Highway Safety Web Applications Portal</span></div>
<?php
	include 'navbar.inc';
?>