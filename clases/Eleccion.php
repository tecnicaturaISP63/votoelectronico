<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Eleccion
 *
 * @author Analia
 */
 include_once  ("conexion.php");
class Eleccion {
    //put your code here
	     //se declaran los atributos de la clase, que son los atributos del Eleccion
	public $nombre;
	public $fecha;
	public $id;
	function eleccion($nro=0) 
// declara el constructor, si trae el numero de eleccion lo busca , si no, trae todos los datos de la tabla
	{
		if ($nro!=0)
		{
			$obj_Eleccion=new  sConsulta();
			 // ejecuta la consulta para traer al Eleccion 
 			$result=$obj_Eleccion-> ejecutarSProcedimiento("sp_getEleccionporId($nro)"); // ejecuta la consulta para traer Eleccion 
						 
			if (mysqli_num_rows($result) == 0)
			{  // si  no encontro la localidad le asigno 1 Las Toscas
				$nro=1;
				$obj_Eleccion=new  sConsulta();
				 $result=$obj_Eleccion-> ejecutarSProcedimiento("sp_getEleccionporId($nro)"); 
				}
			
			$row=$result->fetch_object();
			$this->id=$row->idEleccion;
			$this->nombre=$row->nombre;
			$this->fecha=$row->fecha;
		}
	}
	function EleccionByNom($nomEleccion) // declara el constructor, si trae el numero de Eleccion lo busca , si no, trae todos los bd_localidades
	{
		
		if (isset( $nomEleccion) )
			{
				//if ( strcmp( trim($nomlocalidad),)==0 )
			 $obj_Eleccion=new  sConsulta();
			 // ejecuta la consulta para traer al Eleccion 
 			$result=$obj_Eleccion-> ejecutarSProcedimiento("sp_getEleccionporNom('$nomEleccion')"); // ejecuta la consulta para traer Eleccion 
			$row=$result->fetch_object();
			$this->id=$row->idEleccion;
			$this->nombre=$row->nombre;
			$this->fecha=$row->fecha;
			}
 
			 	
		 
	}
	
	public static function   getEleccion() // este metodo podria no estar en esta clase, se incluye para simplificar el codigo, lo que hace es traer todos los bd_localidades 
		{
			$obj_Eleccion=new  sConsulta();
 			$result1 = $obj_Eleccion-> ejecutarSProcedimiento("sp_getEleccion()");
			 
		return $result1;
 		}
		
 
		
		// metodos que devuelven valores
	function getID()
	 { return $this->id;}
	function getNombre()
	 { return $this->nombre;}
	function getFecha()
	 { return $this->fecha;}
		// metodos que setean los valores
	function setNombre($val)
	 { $this->nombre=trim($val);}
	function setFecha($val)
	 {  $this->fecha=trim($val);}
	

	function Guardar()	// actualiza el Eleccion cargado en los atributos
	{
            $obj_Eleccion=new  sConsulta();
            $query="sp_updateEleccion('$this->id','$this->nombre', '$this->fecha')";
            $obj_Eleccion-> ejecutarSProcedimiento($query); // ejecuta la consulta para traer al Eleccion 
		//	return $query .'<br/>Registros afectados: '.$obj_Eleccion->getAffect(); // retorna todos los registros 
	
	}
	
	function insert()	// inserta el Eleccion cargado en los atributos
	{
			$obj_Eleccion=new  sConsulta();
			$query="sp_insertEleccion('$this->nombre', '$this->fecha')";
                        //PRINT $query;
			$obj_Eleccion-> ejecutarSProcedimiento($query); // ejecuta la consulta para traer al Eleccion 
			//return $query .'<br/>Registros afectados: '.$obj_Eleccion->getAffect(); // retorna todos los registros 
	}	
	
	function update()	// inserta el Eleccion cargado en los atributos
	{
			$obj_Eleccion=new  sConsulta();
			$query="sp_updateEleccion($this->id,'$this->nombre', '$this->fecha')";
			$obj_Eleccion-> ejecutarSProcedimiento($query); // ejecuta la consulta para traer al Eleccion 
			//return $query .'<br/>Registros afectados: '.$obj_Eleccion->getAffect(); // retorna todos los registros 
	}	
	
  
	
	function delete($val)	// elimina el Eleccion
	{
			$obj_Eleccion=new  sConsulta();
			$query="sp_deleteEleccion($val)";
			$obj_Eleccion-> ejecutarSProcedimiento($query); // ejecuta la consulta para  borrar el Eleccion
			//return $query .'<br/>Registros afectados: '.$obj_Eleccion->getAffect(); // retorna todos los registros 
	}	
	
}

