<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="CSS/admin.css">
        
        <?php

            include('funciones/sesiones.php');
            include('funciones/conexionBD.php');


            IniciarSesion();

            if (!isset($_POST['QR']) || !ExisteQR($_POST['QR']))
            {
                CerrarSesion();
            }

            //print $_POST['QR'] . " ". $_POST['idQR'];

            unset($_POST['QR']);
            unset($_POST['idQR']);

        ?>
    </head>
    <body>
        <hr>
            <img src="Imagenes/logo.png" alt="logo" style="width: 150px; height: 150px;">
            <b><a>Información de la elección</a></b>
        <hr>
        <?php
            $idEleccion = 0;
            if(isset($_POST["eleccion"]))
            {
                $idEleccion = $_POST["eleccion"];
            }
            
            //Verificar si la votacion esta habilitada
            $iniciada = VotacionHabilitada($idEleccion);
            
            $eleccionHabilitada = ObtenerEleccionHabilitada();
            $row=$eleccionHabilitada->fetch_object();
            if(isset($row->idEleccion) && !$iniciada 
                    && isset($_POST["habilitar"]) && $_POST["habilitar"])
            {
                print "<div id='cuadroR'>";
                print "<p id='alertaR'>Ya hay una elección en curso, cierre dicha elección antes de iniciar otra.</p>";
                print "</div>";
            }
            else if ($iniciada)
            {
                print "<div id='cuadroR'>";
                print "<p id='alertaR'>Esta elección esta en curso, no puedes ver su información.</p>";
                print "</div>";
                $idEleccion = 0;
            }
            else
            {
                if(isset($_POST["habilitar"]))
                {
                    $habilitarVot = $_POST["habilitar"];
                    
                    if($habilitarVot == 1)
                    {
                        LimpiarVotos($idEleccion);
                        ReiniciaQR($idEleccion);
                        IniciarCerrarVotacion($habilitarVot, $idEleccion);
                    }
                } 
            }
            unset($_POST["habilitar"]);
            
            
            $eleccion = ObtenerEleccion($idEleccion);
            $row=$eleccion->fetch_object();
            
            $nombreElec = "";
            $fechaElec = "";
            
            if(isset($row->nombre))
            {
                $nombreElec = $row->nombre;
                $fechaElec = $row->fecha;
            }

            print "<h4 class='title'>Padron Electroral ISP Nº 63</h3>";
            print "<h4 class='title'>Elección: $nombreElec</h3>";
            print "<hr>";
            print "<h5 id='totalVotos'>Fecha: $fechaElec</h5>";
            
            print "<div style='overflow: auto; width: 100%;  height: 70%;'>";
            print '<table border="1" width="70%" style="margin-left: 50px;" cellspacing="0" cellpadding="5">'
                              .'<tr   bgcolor="#2483A6" align="center">'
                              .'<td><p class="blanco">Lista</p></td>'
                              .'<td><p class="blanco">Votos</p></td></tr>';

            $ObjListado=ObtenerResultadosVotos($idEleccion);
            $cant=0;
            while ($row=$ObjListado->fetch_object()) // recorre los  es uno por uno hasta el fin de la tabla
            {
                // tr 
                print '<tr  bgcolor="#e6e6e6" align="left">'
                          .'<td><p class="whitetxt">'.$row->Lista.'</p></td>'
                          .'<td><p class="whitetxt">'.$row->Votos.'</p></td>'
                          .'</tr>';		 

                $cant+=$row->Votos;
            }
            print '</table>';
            print "<br>";
            print "<h5 id='totalVotos'>Se registraron $cant Votos.</h5>";
            $cantidadQr = ObtenerCantidadQr($idEleccion);
            $row=$cantidadQr->fetch_object();
            print "<h5 id='totalqr'>Cantidad de QR generados: $row->cantidad</h5>";
        ?>
    </body>
</html>