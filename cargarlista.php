<html>
    <head>
       <title>Generador de QR</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/generarqr.css">
        <link href="C:\Users\bangho\Desktop\generarqr" rel="stylesheet"> 
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
            <div><a>Cargar una nueva lista</a></div>
            <form action='cargarlista.php' method='post'>
                <?php
                    //Con esto podemos colocar varias listas sin tener que ingresar el codigo nuevamente
                    print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                    print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                ?>
		<div><input type ="text" name="nombre" align="center" placeholder="Nombre de lista" required></div>
		<div><input type ="text" name="url" placeholder="Url del logo" required></div>
                <div><input type="submit" value="Cargar lista" id="boton" class="btnff6"></div>
            </form>
        </div>
        <img src="Imagenes/logo.png" style="width: 150px; height: 150px;">
        <?php
            if(isset($_POST["nombre"]) && isset($_POST["url"]))
            {
                InsertarLista($_POST["nombre"], $_POST["url"]);
                unset($_POST["nombre"]);
                unset($_POST["url"]);
            }
        ?>
    </body>
</html>