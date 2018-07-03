<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conexion
 *
 * @author Analia
 */
class Conexion {
    //put your code here
    public  $conexionBD;
    function Conexion()
    {
       $objConexion = new mysqli('localhost','root','','votoelectronico');
    
    // crea la conexion pasandole el servidor , usuario y clave
         if ($objConexion  ) // si la conexion fue exitosa , selecciona la base
            {
                $this->conexionBD=$objConexion ;
            }
	}//cierra funcion conexion
        
    function getConexion() // devuelve la conexion
	{ return $this->conexionBD;}

        function Close()  // cierra la conexion
	{ $this->conexionBD->close();}	
}//cierra clase conexion




class  sConsulta   // se declara una clase para poder ejecutar las consultas, esta clase llama a la clase anterior
{

	public  $pConexion;
	public $pConsulta;
	public $resultados;
	
        function  sConsulta()  // constructor, solo crea una conexion usando la clase "Conexion"
	{
		$this->pConexion= new Conexion();
	}
	
        function ejecutarConsulta($consSQL)  // metodo que ejecuta una consulta y la guarda en el atributo $pConsulta
	{
		
                $resultado= $this->pConexion->getConexion()->query($consSQL);
 		if (!$resultado) {
		    print "No pudo ejecutarse satisfactoriamente la consulta ($consSQL) " .
                    "en la BD: " . mysql_error();
                    } 
		else
                    {
                            $this->pConsulta = $resultado;
                            return $this->pConsulta;
                    }
		
	}	
	
	function  ejecutarSProcedimiento($nomSP)  // metodo que ejecuta una consulta y la guarda en el atributo $pConsulta
	
	{
		$result= $this->pConexion->getConexion()->query("CALL $nomSP");
 		if (!$result) {
		    print "No pudo ejecutarse satisfactoriamente la consulta ($nomSP) " .
                	 "en la BD: ";// . mysql_error();
 		} 
		else
                {
                    $this->pConsulta = $result;
                    return $this->pConsulta;
                }
 
	}
	
	function getResultados()   // retorna la consulta en forma de result.
	{return $this->pConsulta;}	
	
	function Close()		// cierra la conexion
	{$this->pConexion->Close();}	
	
	function Clean() // libera la consulta
	{	mysqli_free_result($this->pConsulta);
	}
	function getAfectadas() // devuelve las cantidad de filas afectadas
	{return $this->pConexion->getConexion()->affected_rows ;}
	  
}


 





?>
 