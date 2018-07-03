<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="bootstrap.min.css">
<title>QR Code Scanner Example</title>
</head>
<body>
	<a href="https://github.com/mebjas/html5-qrcode" style="position: fixed;top: 0px;right: 0px;"><img src="./forkme_right_darkblue_121621.png" alt="Fork me on GitHub"></a>
	<div class="container" style="text-align: center">
		<h1> QR Code scanner Example </h1>
		<br><br>

		<div id="qr" style="display: inline-block; width: 600px; height: 450px; border: 1px solid silver"></div>
		<br><br>

		<div class="row">
			<button id="scan" class="btn btn-success btn-sm">start scaning</button>
			<button id="stop" class="btn btn-warning btn-sm disabled">stop scanning</button>
			<button id="change" class="btn btn-warning btn-sm disabled">change camera</button>
			<p id="texto">Holitas</p>
		</div>
		<br><br>
		<div class="row">
			<div class="col-md-12">
				<code>Start Scanning</code> <span class="feedback"></span>
			</div>
		</div>
	</div>

	<hr>

	<footer>
		<div class="container">
			<a href="http://minhazav.me">Home</a>
			&nbsp;|&nbsp;
			<a href="http://blog.minhazav.me/">Blog</a>
			&nbsp;|&nbsp;
			<a href="http://github.com/mebjas">mebjas@github</a>


		</div>
	</footer>
</body>

<script src="./jquery.js"></script>
<script src="./jsqrcode-combined.js"></script>
<script src="./html5-qrcode.js"></script>
<script>
var scanning = false;
$(document).ready(function() {
	$("#scan").on('click', function() 
	{
		if(!scanning)
		{
			scanning = true;
		
			$("code").html('scanning');
			$('#qr').html5_qrcode(function(data)
				{
					var p = document.getElementById("texto");
					p.textContent = "adiosin";
					 // do something when code is read
					 $(".feedback").html('code scanned as: ' +data);
				},
				function(error)
				{
					//show read errors 
					$(".feedback").html('Unable to scan the code! Error: ' +error)
				}, 
				function(videoError)
				{
					//the video stream could be opened
					$(".feedback").html('Video error');
				}
			);
		}

		$("#scan").addClass('disabled');
		$("#stop").removeClass('disabled');
		$("#change").removeClass('disabled');
	});
	$("#stop").on('click', function() 
	{
		scanning = false;
		
		$("#qr").html5_qrcode_stop();
		$("code").html('Start Scanning');

		$("#scan").removeClass('disabled');
		$("#stop").addClass('disabled');
		$("#change").addClass('disabled');
	});
	$("#change").on('click', function() 
	{
		$("#qr").html5_qrcode_changeCamera();

		$("#scan").addClass('disabled');
		$("#stop").removeClass('disabled');
	});
});
	
</script>
</html>