<?php
//------------------------------------------------------------------------
/*
	function db_connect()
	{
		$link = mysqli_connect("localhost", "pepe", "pepe", "bencam"); //sitio,usuario,password,base
//		 check connection 
		if (mysqli_connect_errno()) {
	  		echo "<p><strong>Fallo en la coneccion</strong></p>";
	    	printf("Connect failed: %s\n", mysqli_connect_error());
    		exit();
		}
		return $link;
	}
*/

function db_connect()
{

	$Conexion = mysqli_connect('localhost','pepe','pepe');
  
   if (!$Conexion)
	{
	  echo "<p><strong>Fallo en la coneccion</strong></p>";
      return false;
	}
	
   if (!@mysqli_select_db ($Conexion, 'ifts5'))
	{
	  echo "<p><strong>Fallo en la base</strong></p>";
      return false;
	}
   return $Conexion;
}

//------------------------------------------------------------------------
function db_result_to_array($result)
{
   $res_array = array();

   for ($count=0; $row = @mysql_fetch_array($result); $count++)
     $res_array[$count] = $row;

   return $res_array;
}

?>
