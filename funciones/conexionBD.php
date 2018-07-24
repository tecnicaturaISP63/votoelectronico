<?php
/*ejecutar consulta es un bloque
que se conecta a la base de datos
y ejecuta una consulta
 *
* */
function conectar()
{
    //                    (host,   usuario, pass, nombreBase)
    $conexion = new mysqli('localhost','root','','votoelectronico');
     $acentos = $conexion->query("SET NAMES 'utf8'");
    return $conexion;
}

function InsertarRegistro($consultaSQL)
{
    $conexion = conectar();
    
    if($conexion->query($consultaSQL) === TRUE)
    {
        $UlcId = $conexion->insert_id;
        return $UlcId;
    }
    else
    {
        echo "Error: " . $consultaSQL . "<br>" . $conexion->error;
    }
    
    $conexion->close();
}


function EjecutarConsulta($consultaSQL)
{
    //                    (host,   usuario, pass, nombreBase)
    $conexion = conectar();
    $resultado = $conexion->query($consultaSQL);
    /*el if pregunta si la conexion no pudo ejecutar la consulta*/


    if (!$resultado)
    {
        print "NO SE PUDO CONECTAR A LA BASE DE DATOS";
    }
    else
    {
        return $resultado;
    }

}

function EsAdministrador($idQR)
{
    $consultaSQL="SELECT * FROM `qr` WHERE idQR = $idQR AND administrador = 1";
    $resultado = EjecutarConsulta($consultaSQL);
    
    if($resultado)
    {
        return $resultado->num_rows;
    }
    else
    {
        print "NO SE PUDO CONECTAR A LA BASE DE DATOS";
    }
}

function ExisteQR($codQR)
{
    
    $consultaSQL=" SELECT idQR FROM qr WHERE QRcodigo='$codQR' and usado=false";
    $resultado=  EjecutarConsulta($consultaSQL);

     if (isset($resultado))
    {
        //VERIFICO SI ENCONTRO DATOS
        $fila=$resultado->fetch_object();
        if (isset($fila->idQR)){
            return $fila->idQR;    
        }
     else {     return false;}
        }
        

}

function ObtenerPadron()
{
    $consultaSQL=" SELECT id_alumno, dni,ApelNom  FROM alumnos order by ApelNom";
    $resultado=  EjecutarConsulta($consultaSQL);

     if (isset($resultado))
    {
            return $resultado;    
        }
     else {     return false;}
        

}

function InsertarQR($codQR)
{
    
    $consultaSQL=" INSERT INTO qr (QRcodigo,usado,administrador) values ('$codQR', 0, 0)";
    $resultado=  EjecutarConsulta($consultaSQL);


     if (isset($resultado))
    {
            return true;    
        }
     else {     return false;}
        
     
}

function Votar($voto,$idQR)
{   
    $consultaSQL="  INSERT INTO votos( id_lista, idQR) VALUES ($voto,$idQR)";            
    $resultado=  EjecutarConsulta($consultaSQL);
    print "Resultado:" . $resultado;
     if (isset($resultado))
    {
            $consultaSQL=" UPDATE qr SET usado=1 WHERE idQR=$idQR";            
            $resultado=  EjecutarConsulta($consultaSQL);

     if (isset($resultado))
            return true;    
    }
     else 
         {     return false;}
     
}

function ActualizarVoto($voto,$idQR)
{   
    $consultaSQL= "UPDATE votos SET id_lista = $voto WHERE id_lista = 0 AND idQR = $idQR";         
    $resultado=  EjecutarConsulta($consultaSQL);
    print "Resultado:" . $resultado;
     if (isset($resultado))
    {
            $consultaSQL=" UPDATE qr SET usado=1 WHERE idQR=$idQR";            
            $resultado=  EjecutarConsulta($consultaSQL);

            return true;    
    }
     else 
         {     return false;}
     
}

function ObtenerResultadosVotos()
{   
    
    $consultaSQL="  SELECT l.id_lista ,nombre as Lista, count(v.id_lista)as 'Votos' FROM votos  v, listas l where v.id_lista=l.id_lista group by  l.id_lista";            
    $resultado=  EjecutarConsulta($consultaSQL);

    if (isset($resultado))
    {

        return $resultado;    
    }
    else 
    {
        return false;
    }
     
}

function ObtenerListas()
{
    $consultaSQL = "SELECT * FROM listas ORDER BY id_lista DESC";
    
    $resultado=  EjecutarConsulta($consultaSQL);
    if (isset($resultado))
    {

        return $resultado;    
    }
    else 
    {
        return false;
    }
}

function VotacionHabilitada($idEleccion)
{
    $consultaSQL = "SELECT habilitado FROM eleccion WHERE idEleccion = $idEleccion";
    
    $resultado=  EjecutarConsulta($consultaSQL);
    if (isset($resultado))
    {
        $habilitado = $resultado->fetch_object();
        return $habilitado->habilitado;    
    }
    else 
    {
        return false;
    }
}

function IniciarCerrarVotacion($habilitarVot, $idEleccion)
{
    $consultaSQL = "UPDATE eleccion SET habilitado = $habilitarVot WHERE idEleccion = $idEleccion";
    
    $resultado=  EjecutarConsulta($consultaSQL);
    if (isset($resultado))
    {
        return true;    
    }
    else 
    {
        return false;
    }
}

function LimpiarVotos()
{
    $consultaSQL = "TRUNCATE TABLE votos";
    
    $resultado=  EjecutarConsulta($consultaSQL);
    if (isset($resultado))
    {
        return true;    
    }
    else 
    {
        return false;
    }
}

function ReiniciaQR()
{
    $consultaSQL = "UPDATE qr SET usado = 0";
    
    $resultado=  EjecutarConsulta($consultaSQL);
    if (isset($resultado))
    {
        return true;    
    }
    else 
    {
        return false;
    }
}

function InsertarEleccion($nombre, $fecha)
{
    $consultaSQL = "INSERT INTO eleccion (nombre, fecha) VALUES ('$nombre', '$fecha')";
    
    $resultado=  EjecutarConsulta($consultaSQL);
    if (isset($resultado))
    {
        return true;    
    }
    else 
    {
        return false;
    }
}

function InsertarLista($nombre, $urlImagen)
{
    //INSERT INTO listas (nombre, imagen) VALUES ('Ivan', 'Mangrullo4.jpg')
    $consultaSQL = "INSERT INTO listas (nombre, imagen) VALUES ('$nombre', '$urlImagen')";
    
    $resultado=  EjecutarConsulta($consultaSQL);
    if (isset($resultado))
    {
        return true;    
    }
    else 
    {
        return false;
    }
}