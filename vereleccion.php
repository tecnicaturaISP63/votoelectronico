<html>
    <head>
       <title>Iniciar votación</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/admin.css">
        <link href="C:\Users\bangho\Desktop\generarqr" rel="stylesheet"> 
        <?php
            require ("generadorQR/phpqrcode/qrlib.php"); 
            require ("funciones/codigoaleatorio.php"); 
            require ("funciones/conexionBD.php");
            include('funciones/sesiones.php');
            
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
    </head>
    
    <body>
        <hr>
            <img src="Imagenes/logo.png" style="width: 150px; height: 150px;">
            <a>Ver una elección</a>
        <hr>
        <div class="botones">
            <div id="centrar">
                <a>Elija la elección a ver</a>
                <form action='informacion.php' method='post'>
                    <?php
                        print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                        print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                        print "<input type='hidden' name='habilitar' value=0>";
                        
                        $listaElecciones = ObtenerElecciones();
                        print "<select name='eleccion' required>";
                        print "<option value='' selected disabled hidden>Elija la elección</option>";
                        while ($row=$listaElecciones->fetch_object())
                        {
                            print "<option value='$row->idEleccion'>$row->nombre</option>";
                        }
                        print "</select>";
                    ?>
                    <input type="submit" value="Iniciar votación" id="boton" class="btnff6" align="center">
                </form>
            </div>
        </div>
    </body>
</html>