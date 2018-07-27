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
        <hr>
            <img src="Imagenes/logo.png" alt="logo" style="width: 150px; height: 150px;">
            <a>Bienvenido administrador</a>
        <hr>
        <div class="botones">
            <?php

                //Guardamos temporalmente el qr para ser usado mas adelante
                $qrleido = $_SESSION['QR'];
                $idQr = $_SESSION['idQR'];

                unset($_SESSION['QR']);
                unset($_SESSION['idQR']);

                //print "Bienvenido administrador " . $qrleido . " " . $idQr;
                print "<div id='centrar'>";
                print "<form action='cargareleccion.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<input type='submit' value='Cargar Elección' class='btnff6'>";
                print "</form>";
                
                print "<form action='cargarlista.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<input type='submit' value='Cargar Listas' class='btnff6'>";
                print "</form>";
                
                print "<form action='QRgenerar.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<input type='submit' value='Generar QR' class='btnff6'>";
                print "</form>";
                
                print "<form action='vereleccion.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<input type='submit' value='Ver elección' class='btnff6'>";
                print "</form>";
                
                print "<form action='iniciarvotacion.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<input type='submit' value='Iniciar votación' class='btnff6'>";
                print "</form>";
                
                print "<form action='resultados.php' method='post'>";
                print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                print "<input id='codigo' type='hidden' name='habilitar' value=0>";
                print "<input type='submit' value='Cierre y Resultado' class='btnff6'>";
                print "</form>";
                
                print "<form action='qr.php' method='post'>";
                print "<input type='submit' value='Cerrar Sesión' class='btnff6'>";
                print "</form>";
                print "</div>";
            ?>
        </div>
    </body>
</html>