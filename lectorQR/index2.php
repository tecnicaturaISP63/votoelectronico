<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>QR Code Scanner Example</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
	<div id="qr" style="display: inline-block; width: 600px; height: 450px; border: 1px solid silver">
	<form id="enviarqr" action="/lectorQR/codigo.php" method="post">
	<input id="codigo" type="hidden" name="hiddenqr" value="a">
	</form>
	<h1>
</body>

<script src="./jquery.js"></script>
<script src="./jsqrcode-combined.js"></script>
<script src="./html5-qrcode.js"></script>
<script>
var scanning = false;
$(document).ready(function() 
{
	$("div").click(function()
	{
		if(!scanning)
		{
			$('#qr').html5_qrcode(function(data)
			{
				// do something when code is read
				//$("h1").html('code scanned as: ' +data);
				
				$("#codigo[name=hiddenqr]").val(data);
				$("#enviarqr").submit();
			},
			function(error)
			{
				//show read errors 
				$(".feedback").html('Unable to scan the code! Error: ' +error)
				//console.log("data: ", +error);
			}, 
			function(videoError)
			{
				//the video stream could be opened
				$(".feedback").html('Video error');
			});
			scanning = true;
		}
	});
});
	
</script>
</html>