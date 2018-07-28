<html>
    <head>
       <title>Cargar Lista</title>
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
            <a>Cargar lista</a>
        <hr>
        <?php
            if(isset($_POST["nombre"]) && isset($_POST["url"]) && isset($_POST["eleccion"]))
            {
                if(InsertarLista($_POST["nombre"], $_POST["url"], $_POST["eleccion"]))
                {
                    print "<div id='cuadro'>";
                    print "<p id='alerta'>Lista cargada</p>";
                    print "</div>";
                }
                else
                {
                    print "<div id='cuadroR'>";
                    print "<p id='alertaR'>Hubo un error al cargar la lista</p>";
                    print "</div>";
                }
                unset($_POST["eleccion"]);
                unset($_POST["nombre"]);
                unset($_POST["url"]);
            }
        ?>
        <div class="botones">
            <div id="centrar">
                <a>Cargar una nueva lista</a>
                <form action='cargarlista.php' method='post'>
                    <?php
                        //Con esto podemos colocar varias listas sin tener que ingresar el codigo nuevamente
                        print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                        print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
                        
                        $listaElecciones = ObtenerElecciones();
                        print "<select name='eleccion' required>";
                        print "<option value='' selected disabled hidden>Elija la elección</option>";
                        while ($row=$listaElecciones->fetch_object())
                        {
                            print "<option value='$row->idEleccion'>$row->nombre</option>";
                        }
                        print "</select>";
                    ?>
                    <input class="data" type ="text" name="nombre" align="center" placeholder="Nombre de lista" required>
                    <input class="data" type ="text" name="url" placeholder="Nombre de imagen" required>
                    <input type="submit" value="Cargar lista" id="boton" class="btnff6">
                </form>
                <form action='qr.php' method='post'>
                    <input type='submit' value='Salir' class='btnff6'>
                </form>
            </div>
        </div>
    </body>
</html>