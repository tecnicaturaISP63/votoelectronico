<script type="text/javascript">

function confSubmit(form) {
form.votado.value = "true";
console.log(form.votos["CHKLISTA"].value);
form.submit();
/*if (confirm("Esta Seguro de Votar?")) {
    form.votado.value = "true";
    console.log(form.votos["CHKLISTA"].value);
    form.submit();
}

else {
alert("Su voto todavia no se registro reintente!");
}*/
}

var t;
var maximo = 30;
function interval(){
    t=1;
    setInterval(function(){
        //document.getElementById("test").innerHTML = t;
        if(t >= maximo)
        {
            document.votos["CHKLISTA"].value = "0";
            document.votos.votado.value = "true";
            //document.votos.submit();
            
            var audio = new Audio('sonidos/votado.mp3');
            audio.play();
            audio.onended = function () 
            {
                console.log("listo");
                document.votos.submit();
            }
        }
        console.log(t);
        t++;
    },1000,"JavaScript");
}

interval();
</script>  
    <?php
/**
 * Created by PhpStorm.
 * User: Analia
 * Date: 04/10/2016
 * Time: 9:38 PM
 */

include('funciones/sesiones.php');
include('funciones/conexionBD.php');


IniciarSesion();

?>

<?php

setlocale(LC_ALL, "es_RA.UTF-8");

/*if (!isset($_SESSION['QR']))
{
    CerrarSesion();
}*/
?>
<head>
<link rel="stylesheet" type="text/css" href="CSS/votar.css">
</head>
<body> 
<sonido id="sonido">
    <source src="sonidos/votado.mp3" type="audio/mpeg">
</sonido>
    <b><p id="centro"> Centro de Estudiante </p></b> <b><p id="instituto" align="right"> ISP  N° 63  Las  Toscas </p></b>
<hr>
<h2> <center> ELIGE A LA LISTA QUE DESEAS VOTAR</font> </center> </h2>
<hr>
<center> <table>
    <tr>
    <td> <center> <img src="imagenes/logo FE.png"> </img> </center> </td>
    <td> <center> <img src="imagenes/logo ADE.png"> </img> </center> </td> 
    <td> <center> <img src="imagenes/logo blanco.png"> </img> </center> </td> 
    </tr>
</table> </center>
<center> <table border=1 width="80%" bgcolor="white">

  <?php      
        print "<FORM action='votar.php' method='post' name='votos'>";
       
  
     
        print "<tr>";
        print "<td class='nomLista'> <input type='RADIO' name='CHKLISTA' value='1' required/> Fuerte Esperanza</td>";
        print "<td class='nomLista'> <input type='RADIO' name='CHKLISTA' value='2' required/> Alianza Estudiantes</td>";
        print "<td class='nomLista'> <input type='RADIO' name='CHKLISTA' value='0' required/> Voto en Blanco</td>";
        
        print "</tr>";

        print "<input type='hidden' name='votado' value=false>";
        print "<input id='hiddenIDqr' type='hidden' name='hiddenIDqr' value='".$_SESSION['idQR']."'>";
        print "</table> </center>";
 
        print "<input id='codigo' type='hidden' name='hiddenqr' value='".$_SESSION['QR']."'>";
        print " <center> <input type='submit' class='botonVotar' onClick='confSubmit(this.form);'  name='enviar' value ='VOTAR'> </center> ";        
        
        print "</FORM>";
        
      $listas = ObtenerListas();
      $row = $listas->fetch_object();
      print $row->nombre;
?> 
</body>
<?php
	if (!is_null(filter_input(INPUT_POST,"CHKLISTA") ))
        {	
            $qrleido = filter_input(INPUT_POST,"hiddenqr");
            //print "Su código es: " . $qrleido."<BR>";
            $idqrleido = filter_input(INPUT_POST,"hiddenIDqr");
            //print "Su ID es: " . $idqrleido."<BR>";
            $listaVotada = filter_input(INPUT_POST,"CHKLISTA");
            //print "Su ELECCION es: " . $listaVotada."<BR>";

            ActualizarVoto($listaVotada, $idqrleido);
        }   
 
?>
<?php
$votado = "false";
if (!is_null(filter_input(INPUT_POST,'votado')))
{
    $votado = filter_input(INPUT_POST,'votado');
}

if (!strcmp($votado, "true"))
{
    CerrarSesion();
    unset($_POST["votado"]);
}

?>  