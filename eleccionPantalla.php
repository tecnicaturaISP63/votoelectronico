
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>VotoElectronico</title>


 <script type="text/javascript">
 function Salir()
 {
	location.href = 'eleccionPantalla.php';
 }
   
</script>
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<h1> Voto Electronico </h1>
				<p>ISP63</p>
			</div>
		</div>
	</div>
	<!-- end #header -->
	<div id="menu-wrapper">
		<div id="menu">
			<ul>
				<li><a href="index.html">Inicio</a></li>
				<li class="current_page_item" ><a href="eleccion.php">Eleccion</a></li>

			</ul>
		</div>
	</div>
	<!-- end #menu -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="page-content">
					<div id="content">
						<!--<div class="post">-->

<!-- INICIO AGREGADO ************************************************** -->

 <?php
include_once ("Clases/eleccion.php"); // incluye las clases
	$nombre="";
	$fecha=date("d-m-Y");
	//$ObjEleccion="";
	 

if (!is_null(filter_input(INPUT_POST,'md'))) // si la operacion es modificar, este valor viene seteado y ejecuta el siguiente codigo
{	$id= filter_input(INPUT_POST,'md');
	$ObjEleccion=new Eleccion(filter_input(INPUT_POST,'md'));  // instancio la clase   pasandole el nro de  , de esta forma lo busca
	$nombre=$ObjEleccion->getNombre();
	$fecha=$ObjEleccion->getFecha();
	 
}
// background-color: rgb(238, 238, 238);
?>
 
 

<?php
 // TABLA DE LISTADO
$ObjEleccion=new Eleccion();
$ObjListado= $ObjEleccion->getEleccion();
print "<h3  class='title' >Listado </h3>";
print "<hr> ";
  
print "<div style='overflow: auto; width: 100%;  height: 70%;'>";
print '<br/><br/><table    border="0" width="95%" style="margin-left: 50px;"  cellspacing="0" cellpadding="5">'
		  .'<tr   bgcolor="#2483A6" align="center">'
                 . '<td><p class="blanco">Codigo</p></td>'
		  .'<td><p class="blanco">Eleccion</p></td>'
		  .'<td><p class="blanco">Fecha</p></td>'
		  .'<td><p class="blanco">Modificar</p></td>'
		  .'<td><p class="blanco">Borrar</p></td></tr>';
 
  
while ($row=$ObjListado->fetch_object()) // recorre los  es uno por uno hasta el fin de la tabla
{
	// tr 
	print '<tr  bgcolor="#e6e6e6" align="left">'
		  .'<td><p class="whitetxt">'.sprintf('%04d',$row->idEleccion).'</p></td>'
		  .'<td><p class="whitetxt">'.$row->nombre.'</p></td>'
		  .'<td><p class="whitetxt">'.$row->fecha.'</p></td>'
		  .'<td><a href="eleccionPantalla.php?md='.$row->idEleccion.'"><img src="Imagenes/b_edit.png" border=0></img></a></td>'   // en este ejemplo para simplificar se envian los parametros por get utilizando un href
		  .'<td><a href="eleccionPantalla.php?br='.$row->idEleccion.'"><img src="Imagenes/b_drop.png" border=0></img></a></td>'		// lo correcto seria enviarlos por post con un submit por ejem.
		  .'</tr>';		 
}

print '</table>';


?>
<br>
<h3  class='title' >Datos </h3><hr>

<div id="contenido_a_mostrar" style="overflow: auto; width: 100%;  height: 80%; top: 5%;">

<form method="POST" action="eleccionPantalla.php"> 
<input type="hidden" name="id" value="<?php print $id ?>">
<table border="0" width="90%" >
  <tr>
    <th width="209" height="24" scope="row"><div align="right">Nombre</div></th>
    <td colspan="4"><input name="nombre"  id="nombre" type="text" size="30" maxlength="60" required value = "<?php print $nombre ?>"/>	
    </td>
  </tr>
  <tr>
    <th height="24" scope="row"><div align="right">Fecha</div></th>
	<td colspan="4"><input type="date" name="fecha" id="fecha" size="30" maxlength="15" value = "<?php print $fecha ?>"  required /></td>
  </tr>
  <tr>
	<br>
	<td>
    <input type="submit"   name="submit" value ="<?php if(isset($id)){ print "Modificar";} else {print "Ingresar";}?>"></th>
    <input type="button"   name="btnSalir" value ="Cancelar" onclick='Salir()'>
    </td>
  </tr> 
</table>
 
 
 
</form>
</div>
<!----------------- INICIO -->


<?php


//if (isset($_POST['submit']) ) // si presiono el boton ingresar
if (!is_null(filter_input(INPUT_POST,'submit')  ) ) // si presiono el boton ingresar
{
	$ObjEleccion=new Eleccion();	 
	$ObjEleccion->setNombre(filter_input(INPUT_POST,'nombre')); // setea los datos
        $ObjEleccion->setFecha(filter_input(INPUT_POST,'fecha'));
//        print "INGRESO A INSERT";
	$ObjEleccion->insert(); // inserta y muestra el resultado
	header('Location: eleccionPantalla.php');
 	}
 
  
if (!is_null(filter_input(INPUT_POST,'md'))) // si presiono el boton y es modificar
{
	$ObjEleccion=new Eleccion(filter_input(INPUT_POST,'id'));  // instancio la clase pasandole el nro de   para cargar los datos
	$ObjEleccion->setNombre(filter_input(INPUT_POST,'nombre')); // setea los datos
	$ObjEleccion->setFecha(filter_input(INPUT_POST,'fecha'));
	///print "INGRESO A UPDATE";
	 $ObjEleccion->update(); // inserta y muestra el resultado
	header('Location: eleccionPantalla.php'); 
}
if (!is_null(filter_input(INPUT_POST,'br'))&& is_numeric(filter_input(INPUT_POST,'br'))) // si presiono el boton y es eliminar
{
        $ObjEleccion=new Eleccion();
	 $ObjEleccion->delete(filter_input(INPUT_POST,'br')); // elimina el   y muestra el resultado
 	header('Location: eleccionPantalla.php');
 }


 
?>

 					 
				  </div> <!-- END <div id="content">-->						
                                <div style="clear: both;">&nbsp;</div>

				</div><!-- end #content -->
				<div style="clear: both;">&nbsp;</div>
			</div><!-- end Div  "page-content" -->
		</div> <!-- end "page-bgbtm" -->
	</div> <!--  END "page-bgtop" -->
</div> <!-- end #page -->
<div id="footer">
	<p>Copyright (c) 2018. Design by Ing. A. Casali</p>
</div>
<!-- end #footer -->
</body>
</html>
