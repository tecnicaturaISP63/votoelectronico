<?php
/**
 * Created by PhpStorm.
 * User: Analia
 * Date: 04/10/2016
 * Time: 7:36 PM
 */
function IniciarSesion()
{
        session_start();
}
function IniciarSesionQR($QR,$idQR)
{
    session_start();
    $_SESSION['QR']=$QR;
    $_SESSION['idQR']=$idQR;
}
function CerrarSesion()
{
    // CIERRRO LA SESION
    session_start();

    // UNSET liberarán las variables de sesión registradas ,
    unset($_SESSION['QR']);
    unset($_SESSION['idQR']);
    //session_unset(); // libero la sesion
    session_destroy(); //libera la sesión actual, elimina cualquier dato de la sesión.

    // redirecciona para q retorne a la pagina de inicio
    header ("Location:../votoelectronico/qr.php");

    //exit;

}

