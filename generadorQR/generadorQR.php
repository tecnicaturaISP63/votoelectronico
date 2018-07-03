<?php
include "phpqrcode/qrlib.php";

function generarQR($texto, $nombreArchivo)
{
	// create a QR Code with this text and display it
	QRcode::png($texto, "codigos/" . $nombreArchivo . ".png", "L", 6, 2);

        
}
?>