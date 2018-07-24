<html>
    <head>
       <title>Administrador</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/admin.css">
        
        <?php
            include('funciones/sesiones.php');
            include('funciones/conexionBD.php');


            IniciarSesion();

            setlocale(LC_ALL, "es_RA.UTF-8");

            if (!isset($_SESSION['QR']) || !ExisteQR($_SESSION['QR']))
            {
                CerrarSesion();
            }
        ?>
    </head>
    
    <body>
        <div class="botones">
            <?php

                //Guardamos temporalmente el qr para ser usado mas adelante
                $qrleido = $_SESSION['QR'];
                $idQr = $_SESSION['idQR'];

                unset($_SESSION['QR']);
                unset($_SESSION['idQR']);

                //print "Bienvenido administrador " . $qrleido . " " . $idQr;
                
                print "<form action='cargareleccion.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<div><input type='submit' value='Cargar Eleccion' class='btnff6'></div>";
                print "</form>";
                
                print "<form action='cargarlista.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<div><input type='submit' value='Cargar Listas' class='btnff6'></div>";
                print "</form>";
                
                print "<form action='QRgenerar.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<div><input type='submit' value='Generar QR' class='btnff6'></div>";
                print "</form>";
                
                print "<form action='resultados.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<input id='codigo' type='hidden' name='habilitar' value=1>";
                print "<div><input type='submit' value='Iniciar votacion' class='btnff6'></div>";
                print "</form>";
                
                print "<form action='resultados.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<input id='codigo' type='hidden' name='habilitar' value=0>";
                print "<div><input type='submit' value='Cierre y Resultado' class='btnff6'></div>";
                print "</form>";

                
            ?>
        </div>
        <img src="Imagenes/logo.png" style="width: 150px; height: 150px;">
    </body>
</html>