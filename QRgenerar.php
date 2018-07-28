<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>GENERAR QR </title>
        <link rel="stylesheet" href="CSS/admin.css">
        
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
        <img src="Imagenes/logo.png" alt="logo" style="width: 150px; height: 150px;">
        <a>Cargar QR</a>
    <hr>
    <!--Mensaje sobre el estado del escaner-->
    <div class="botones">
        <!--<h1 id="mensaje">Cantidad a generar</h1>-->
        <div id="centrar">
            <a id="mensaje">Cantidad a generar</a>
            <form   action="QRgenerar.php" method="post">
                <?php
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
                <input class="data" type="text"  name="txtcantidad" value="" placeholder="Cantidad" required>
                <input type="submit" name="Generar" value="Generar" id="boton" class="btnff6">
            </form>
            <form action='qr.php' method='post'>
                <input type='submit' value='Salir' class='btnff6'>
            </form>
        </div>
    </div>
</body>
    <?php


        //GENERADOR
        if (!is_null(filter_input(INPUT_POST,'txtcantidad')) && !is_null(filter_input(INPUT_POST,'eleccion')))
        {    
           $cantidad=filter_input(INPUT_POST,'txtcantidad');
           $idEleccion = filter_input(INPUT_POST,'eleccion');


            //set it to writable location, a place for temp generated PNG files
           $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;

           //html PNG location prefix
           $PNG_WEB_DIR = 'temp/';

           //ofcourse we need rights to create temp dir
           if (!file_exists($PNG_TEMP_DIR))
           {
               mkdir($PNG_TEMP_DIR);

           }

            $filename = $PNG_TEMP_DIR.'test.png';

            $matrixPointSize = 7;
            $errorCorrectionLevel = 'L';    


            print '<table border=1>';
            $generados = 0;

            for ($i=0; $i<$cantidad;$i=$i+4)
            {
                print '<tr>';

                for ($fila=0; $fila<4;$fila++)
                {

                   if ($generados < $cantidad)
                   {
                        $generados++;
                        $data=generarCodigo(20);
                        InsertarQR($data, $idEleccion);
                        $filename = $PNG_TEMP_DIR.''.$data.'.png';
                        //El primer argumento es el texto a convertirse a QR
                        //El segundo agumento es el nombre del archivo a guardarse. (La imagen se guada automaticamente en .png)

                        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 5); 
                        //muestro la imagen
                        print '<td><img src="'.$PNG_WEB_DIR.basename($filename).'" /><br/></td>';  
                    }
                }//cierra el for
                print '</tr>';//cierro tr

            }//cierra el for
            print '</table>';
        }
    ?>
</html>