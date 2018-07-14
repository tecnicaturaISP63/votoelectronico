<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php

include('funciones/sesiones.php');
include('funciones/conexionBD.php');


IniciarSesion();

?>
<html>
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <title> Recuento de Votos </title>

    </head>
<body>
    
     <?php
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_ALL, "es_RA.UTF-8");

 ?>    <header>
	     <h3> Centro de Estudiante </h3>
		 <h3 id="derecha"> ISP  N° 63  Las  Toscas </h3>
	</header>
	
<div class="contenedor">
     <div class="con1"> Lista 1 </div>
     <div class="con2"> Lista 2 </div>
	 
     <div class="izquierda"> Cantidad de votos: <br><br>
           Porcentaje de votos: </div>
		   
     <div class="derecha"> 
	 Cantidad de votos: <br><br>
     Porcentaje de votos: </div>
	 
</div>

   <div class="center"> Votos en blanco: <br><br>
	       Votos anulados: </div>
</body>
</html>
