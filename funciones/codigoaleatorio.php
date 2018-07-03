<?php

function  generarCodigo($longitud)//falta el for para generar numero total de codigos
{
    
    $codigo= "";
	
	//$caracteres="ABCDEFGHIJKLMNOPQRSTUVWXYZ";//caracteres permitidos
	$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";//caracteres permitidos
    
    $max=strlen($caracteres)-1;
    
    for($i=0;$i < $longitud;$i++)
    {
        $codigo.=$caracteres[rand(0,$max)];
		
    }
//    return md5($codigo);
    
    return $codigo;
	
}

//echo  "<br>Código aleatorio : ".generarCodigo(40);// aumenta el num de digitos

?>