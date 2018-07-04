<script src="./lectorqr/jquery.js"></script>
<script src="./lectorqr/jsqrcode-combined.js"></script>
<script src="./lectorqr/html5-qrcode.js"></script>
<script>
console.log("a");
var scanning = false;
$(document).ready(function() 
{
	//$("div").click(function()
	//{
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
				$("#mensaje").html("Coloque el código QR frente a la cámara.")
			}, 
			function(videoError)
			{
				//the video stream could be opened
				$("#mensaje").html('Hubo un error, no se pudo cargar el vídeo.');
			});
			scanning = true;
		}
	//});
});
	
</script>