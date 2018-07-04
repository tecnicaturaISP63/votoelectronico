<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LECTOR </title>
<link rel="stylesheet" type="text/css" href="estilos/Qr.css">
<?php
require("lectorqr/lectorqr.php");
require("funciones/conexionBD.php");
require("funciones/sesiones.php");
 
 
?>

 </head>
<body>

	<!--Mensaje sobre el estado del escaner-->
	<h1 id="mensaje">Coloque el código QR frente a la cámara.</h1>
	<!--Cuadrado donde va a aparecer lo que recibe la camara -->
        <!--style="display: inline-block; width: 600px; height: 450px; border: 1px solid silver"-->
	<div id="qr">
	<!--Formulario oculto desde el cual se enviará el codigo escaneado-->
            <form id="enviarqr" action="QR.php" method="post">
            <input id="codigo" type="hidden" name="hiddenqr" value="a">
            </form>
            </div>
 
</body>
<?php
	//Lector de codigos QR
	if (!is_null(filter_input(INPUT_POST,"hiddenqr") ))
{	$qrleido = filter_input(INPUT_POST,"hiddenqr");
	print "Su código es: " . $qrleido;
     

        //BUSCA QUE LOS DATOS COINCIDAN CON LOS QUE ESTAN EN LA BASE

        $resultadoQR=ExisteQR($qrleido);

        //SI ENCONTRO AL USUARIO EN LA BASE
        if ($resultadoQR!=false)
            {
              
                    IniciarSesionQR($qrleido,$resultadoQR);
                     header ("Location:votar.php");
                }
                else
                  { 
                      /* REDIRECCIONAMOS PARA VOLVER AL LOGIN*/
                    PRINT "NO ES CORRECTO"; 
                    header ("Location:qr.php");
                  }
            
        
}


?>
</html>