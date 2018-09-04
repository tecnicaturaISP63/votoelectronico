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
            <a>Consultar Alumnos</a>
        <hr>
        <?php
            $criterio = "";
            $busqueda;
            if(isset($_POST["criterio"]) && isset($_POST["apelnom"]))
            {
                $criterio = $_POST["criterio"];
                $busqueda = $_POST["apelnom"];
            }
            
            unset($_POST["buscar"]);
            unset($_POST["criterio"]);
        ?>
        
        <div class="botones">
            <div id="centrar">
                <a>Ingrese palabra o número a buscar</a>
                <form action='consultaralumno.php' method='post'>

                    <?php
                        //Con esto podemos colocar varias elecciones sin tener que ingresar el codigo nuevamente
                        /*print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
                        print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";*/
                    ?>
                    <select name='criterio' required>
                        <option value='' selected disabled hidden>Elija el criterio</option>
                        <option value='apelnom'>Nombre y/o Apellido</option>
                        <option value='idalumno'>ID Alumno (Número)</option>
                        <option value='dni'>DNI (sin puntos)</option>
                        <option value='sexo'>Sexo (M/F)</option>
                        <option value='regular'>Regular (1/0)</option>
                        <option value='debaja'>De baja (1/0)</option>
                    </select>
                    <input class="data" type="text"  name="apelnom" value="" placeholder="Escriba Aquí" required>
                    <input type="submit" name="buscar" value="Buscar" id="boton" class="btnff6">
                    <input type='button' onclick='window.print();' class="btnff6" value='Imprimir Página' />
                </form>
                <form action='qr.php' method='post'>
                    <input type='submit' value='Salir' class='btnff6'>
                </form>
                
            </div>
            <?php
                    if(isset($busqueda))
                    {
                        $resultados = NULL;
                        if(!strcmp($criterio, "apelnom"))
                        {
                            $resultados = BuscarPorNombre(trim($busqueda));
                        }
                        else if (!strcmp($criterio, "idalumno"))
                        {
                            $resultados = BuscarPorIdAlumno($busqueda);
                        }
                        else if (!strcmp($criterio, "dni"))
                        {
                            $resultados = BuscarPorDNI(trim($busqueda));
                        }
                        else if (!strcmp($criterio, "sexo"))
                        {
                            $resultados = BuscarPorSexo($busqueda);
                        }
                        else if (!strcmp($criterio, "regular"))
                        {
                            $resultados = BuscarPorRegular($busqueda);
                        }
                        else if (!strcmp($criterio, "debaja"))
                        {
                            $resultados = BuscarPorDeBaja($busqueda);
                        }
                        
                        if (isset($resultados))
                        {
                            print "<table border='1' width='70%' style='margin-left: 50px;'   cellspacing='0' cellpadding='5'>";
                            print "<tr bgcolor='#2483A6'>";
                            print "<td>Nombre y Apellido</td>";
                            print "<td>DNI</td>";
                            print "<td>Sexo</td>";
                            print "<td>Regular</td>";
                            print "<td>De Baja</td>";
                            print "</tr>";
                            while ($row=$resultados->fetch_object())
                            {
                                print "<tr bgcolor='#e6e6e6'>";
                                print "<td>$row->ApelNom</td>";
                                print "<td>$row->dni</td>";
                                print "<td>$row->sexo</td>";
                                print "<td>$row->regular</td>";
                                print "<td>$row->debaja</td>";
                                print "</tr>";
                            }
                            print "</table>";
                        }
                        
                    }
                    
                ?>
        </div>
    </body>
</html>