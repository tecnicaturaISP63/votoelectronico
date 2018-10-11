<html>
    <head>
       <title>modidificar alumno y dar baja</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/admin.css"> 
    </head>
    
    <body>
	<?php

            include('funciones/sesiones.php');
            include('funciones/conexionBD.php');


            IniciarSesion();

           /* if (!isset($_POST['QR']) || !ExisteQR($_POST['QR']))
            {
                CerrarSesion();
            }

            //print $_POST['QR'] . " ". $_POST['idQR'];
            $qrleido = $_POST['QR'];
            $idQr = $_POST['idQR'];
            
            unset($_POST['QR']);
            unset($_POST['idQR']);*/
        ?>
        <hr>
            <img src="Imagenes/logo.png" alt="logo" style="width: 150px; height: 150px;">
            <a>Modificar Datos del alumno</a>
        <hr>


        
        <div class="botones">
            
                <H1>modificar datos del alumno o dar de baja</h1>
                
                <form action='modificaralumnoydarbaja.php' method='post'>
                    
                    <?php      
                    if (isset($_GET['idAlumno']))
{
      $idAlumno=$_GET['idAlumno'];
      $ApelNom=$_GET['nomyapel'];
      $dni=$_GET['dni'];
      $sexo='F';
      if (isset($_GET['sexo']) )
        $sexo=$_GET['sexo'];
      
      if (isset($_GET['DeBaja']) )
            $debaja=1;
      else
            $debaja=0;
       $ObjListado=ModificarAlumno($idAlumno,$ApelNom,$dni,$sexo,$debaja);

 }

                    //carga la lista desplegable//
                        $ObjListado=ObtenerAlumnos();
                        print "<select name='alumno' required>";
                        print "<option value='' selected disabled hidden>Ver Alumnos</option>";
                        while ($row=$ObjListado->fetch_object())
                        {
                            print "<option value='$row->idalumno'>$row->ApelNom</option>";
                            
                        }
                      
                        print "</select>";
                    ?>
                          <input type='submit' value='Buscar' class='btnff6'>
                    
                    </form>

<?php
if (isset($_POST['alumno']))
{
    $idAlumno=$_POST['alumno'];
    $ObjListado=BuscarUnAlumno($idAlumno);
    $fila=$ObjListado->fetch_object();
    $nom=$fila->ApelNom;
    $dni=$fila->dni;
    $sexo=$fila->sexo;
    
    
    /*  muestro el formulario para el alumno elegido */
    
                    print "<form action='modificaralumnoydarbaja.php' method='GET'>";   

                    print "<div>";
                    print "<br>";
                    print "<input type='hidden'  name='idAlumno'  value=$idAlumno value=1>";
                    print "<input type='text' name='nomyapel' VALUE='$nom' placeholder='nombre y apellido' class='data'>";
                    print "<br><br>";
                    print "<input type='text' name='dni'value='$dni' placeholder='dni' class='data'>";
                    print "<br><br>";
                    print "<table>";
                    print "<td>";
                    if ($sexo=='F')                        
                    {print "<input type='radio' name='sexo' value='F' selected><h3>Femenino</h3>";
                    print"<td>";
                    print "<input type='radio' name='sexo' value='M'><h3>Masculino</h3>";
                    }
                    else {
                {print "<input type='radio' name='sexo' value='F'><h3>Femenino</h3>";
                    print"<td>";
                    print "<input type='radio' name='sexo' value='M' selected><h3>Masculino</h3>";
                    }
                        }
                    print "</td>";
                    print "</table>";
                    print "<br><br>";
                    print "<table>";
                    print "<tr>";
                    print "Dar de Baja<input type='checkbox' name='DeBaja'>"; 
                    print "<tr>";
                    print "<input type='submit' value='Modificar' name='modificar'class='btnff6'>";
                    print "</div>";
                    print "</table>";
                    print "</form>";
    
}
else
{}

?>
                

            </div>
        </div>
    </body>
</html>