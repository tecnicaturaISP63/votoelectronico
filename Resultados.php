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
            $idEleccion = 0;

            //Iniciamos ocerramos las votaciones
            if(isset($_POST["habilitar"]))
            {
                $habilitarVot = $_POST["habilitar"];

                $idEleccion = CerrarVotacion();
            }

            unset($_POST["habilitar"]);

        ?>
    </head>
    <body>
        <hr>
            <img src="Imagenes/logo.png" alt="logo" style="width: 150px; height: 150px;">
            <b><a>Resultados de la elección</a></b>
        <hr>
        <?php
            header("Content-Type: text/html;charset=utf-8");
            setlocale(LC_ALL, "es_RA.UTF-8");
            if($idEleccion == 0)
            {
                print "<div id='cuadroR'>";
                print "<p id='alertaR'>No hay ninguna elección abierta.</p>";
                print "</div>";
            }
            
            $eleccion = ObtenerEleccion($idEleccion);
            $row=$eleccion->fetch_object();
            $nombre = "";
            if(isset($row->nombre))
            {
                $nombre = $row->nombre;
            }

            print "<h4 class='title'>Padron Electroral ISP Nº 63</h3><br>";
            print "<h4 class='title'>Elección: $nombre</h3>";
            print "<hr> ";
            
            print "<div style='overflow: auto; width: 100%;  height: 70%;'>";
            print '<br/><br/><table    border="1" width="70%" style="margin-left: 50px;"  cellspacing="0" cellpadding="5">'
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
            print "<br><h4 id='total'>Se registraron $cant Votos.</h4>"
        ?>
    </body>
</html>