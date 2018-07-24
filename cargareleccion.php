<html>
    <head>
       <title>Generador de QR</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/generarqr.css">
    </head>
    
    <body>
	<?php

            include('funciones/sesiones.php');
            include('funciones/conexionBD.php');


            IniciarSesion();

            if (!isset($_POST['QR']) || !ExisteQR($_POST['QR']))
            {
                CerrarSesion();
            }

            //print $_POST['QR'] . " ". $_POST['idQR'];
            $qrleido = $_POST['QR'];
            $idQr = $_POST['idQR'];
            
            unset($_POST['QR']);
            unset($_POST['idQR']);
        ?>
        
        <div class="botones">
            <div><a>Cargar una nueva elección</a></div>
            <form action='cargareleccion.php' method='post'>
                <?php
                    //Con esto podemos colocar varias elecciones sin tener que ingresar el codigo nuevamente
                    print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                    print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                ?>
                <div><input type ="text" name="nombre" align="center" placeholder="Nombre de elección" required></div>
                <div><input type ="date" name="fecha" placeholder="Fecha de elección"></div>
                <div><input type="submit" value="Cargar elección" id="boton" class="btnff6"></div>
            </form>
        </div>
        <?php
            if(isset($_POST["nombre"]) && isset($_POST["fecha"]))
            {
                InsertarEleccion($_POST["nombre"], $_POST["fecha"]);
                unset($_POST["nombre"]);
                unset($_POST["fecha"]);
            }
        ?>
        <img src="Imagenes/logo.png" style="width: 150px; height: 150px;">
    </body>
</html>