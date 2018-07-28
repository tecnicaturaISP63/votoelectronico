<html>
    <head>
       <title>Cargar elección</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/admin.css">
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
        <hr>
            <img src="Imagenes/logo.png" alt="logo" style="width: 150px; height: 150px;">
            <a>Cargar elección</a>
        <hr>
        <?php
            $agregar = 0;
            if(isset($_POST["nombre"]) && isset($_POST["fecha"]) && isset($_POST["agregar"]))
            {
                $agregar = $_POST["agregar"];
                if($agregar)
                {
                    if(InsertarEleccion($_POST["nombre"], $_POST["fecha"]))
                    {
                        print "<div id='cuadro'>";
                        print "<p id='alerta'>Elección cargada</p>";
                        print "</div>";
                    }
                    else
                    {
                        print "<div id='cuadroR'>";
                        print "<p id='alertaR'>Hubo un error al cargar la elección</p>";
                        print "</div>";
                    }
                }
            }
            
            unset($_POST["nombre"]);
            unset($_POST["fecha"]);
            unset($_POST["agregar"]);
        ?>
        
        <div class="botones">
            <div id="centrar">
                <a>Cargar una nueva elección</a>
                <form action='cargareleccion.php' method='post'>

                    <?php
                        //Con esto podemos colocar varias elecciones sin tener que ingresar el codigo nuevamente
                        print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                        print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                    ?>
                    <input id='codigo' type='hidden' name='agregar' value='1'>
                    <input class="data" type ="text" name="nombre" align="center" placeholder="Nombre de elección" required>
                    <input class="data" type ="date" name="fecha" placeholder="Fecha de elección">
                    <input type="submit" value="Cargar elección" id="boton" class="btnff6">
                </form>
                <form action='qr.php' method='post'>
                    <input type='submit' value='Salir' class='btnff6'>
                </form>
            </div>
        </div>
    </body>
</html>