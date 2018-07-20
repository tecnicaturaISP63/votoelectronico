<?php
    include('funciones/sesiones.php');
    include('funciones/conexionBD.php');


    IniciarSesion();

    setlocale(LC_ALL, "es_RA.UTF-8");

    if (!isset($_SESSION['QR']) || !ExisteQR($_SESSION['QR']))
    {
        CerrarSesion();
    }
    
    //Guardamos temporalmente el qr para ser usado mas adelante
    $qrleido = $_SESSION['QR'];
    $idQr = $_SESSION['idQR'];
    
    unset($_SESSION['QR']);
    unset($_SESSION['idQR']);
    
    print "Bienvenido administrador " . $qrleido . " " . $idQr;
    
    print "<form action='resultados.php' method='post'>";
    print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
    print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
    print "<input id='codigo' type='hidden' name='habilitar' value=0>";
    print "<input type='submit' value='Ver Resultados'>";
    print "</form>";
    
    print "<form action='resultados.php' method='post'>";
    print "<input id='codigo' type='hidden' name='QR' value='$qrleido'>";
    print "<input id='codigo' type='hidden' name='idQR' value='$idQr'>";
    print "<input id='codigo' type='hidden' name='habilitar' value=1>";
    print "<input type='submit' value='Iniciar votacion'>";
    print "</form>";
?>