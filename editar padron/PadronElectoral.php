<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php

include('funciones/sesiones.php');
include('funciones/conexionBD.php');


IniciarSesion();

?>
<html>
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    
     <?php
header("Content-Type: text/html;charset=utf-8");
setlocale(LC_ALL, "es_RA.UTF-8");

print "<h3  class='title' >Padron Electroral ISP Nº 63</h3><br>";
print "<h3  class='title' >Elecciones Centro de Estudiantes 2018 </h3>";
print "<hr> ";
  
print "<div style='overflow: auto; width: 100%;  height: 70%;'>";
print '<br/><br/><table    border="1" width="95%" style="margin-left: 50px;"  cellspacing="0" cellpadding="5">'
		  .'<tr   bgcolor="#2483A6" align="center">'
		  .'<td><p class="blanco">DNI</p></td>'
		  .'<td><p class="blanco">Alumno</p></td>'
		  .'<td><p class="blanco">Firma</p></td></tr>';
 
//ObtenerResultadosVotos
 $ObjListado=ObtenerPadron();
 $cant=0;
while ($row=$ObjListado->fetch_object()) // recorre los  es uno por uno hasta el fin de la tabla
{
	// tr 
	print '<tr  bgcolor="#e6e6e6" align="left">'
		  .'<td><p class="whitetxt">'.$row->dni.'</p></td>'
		  .'<td><p class="whitetxt">'.$row->ApelNom.'</p></td>'
		  .'<td><p class="whitetxt"></p></td>'
		  .'</tr>';		 

        $cant++;
}
print '</table>';
print "<br><h4>Se Listaron $cant Alumnos.</h4>"
?>
</body>
</html>