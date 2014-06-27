<?php
	include 'includes/httpsRedirect.inc';
	$iteration = $_GET['citIteration'];

	$CitSum = $_GET['CitSum'];
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
$(function()
{
	var CitSum = $('#CitSum').val();
	
	$('#sendCitation').bind("click",function()
	{
			var index = 0;
			$('.citationNumber').each(function()
			{
				var value = $(this).val();				
				$(window.opener.document).find('.'+CitSum+'CitClass').eq(index).val(value);
				index++;
			});
		 	window.close();
	});
	
});
</script>
</head>
<body>
<h1>Citation Numbers</h1>
	<p>Please enter citation numbers for each violation.</p>
<?php
	for($i=0;$i<$iteration;$i++ )
	{
?>
		<p><input type = "text" class = "citationNumber" /></p>	
<?php
	}
?>
	<p><input type="hidden" id="CitSum" value="<?php echo $CitSum;?>"></p>
		
	<button id="sendCitation">Submit</button>
</body>
</html>