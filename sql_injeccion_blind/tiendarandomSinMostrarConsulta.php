<?php

echo "<a href='/'>Ir anicio</a>";

error_reporting(0);
if(!isset($_GET["id_producto"]))
{
	header("Location: tienda.php?id_producto=1");
}
else
{
	require_once("../cone.php");

 	$resultado=mysqli_query($conexion,"select * from productos where id=".$_GET["id_producto"]." limit 10");

 	if ($resultado=mysqli_fetch_array($resultado))
 	{
 		echo "</br></br>ESTO QUIERE DECIR LA PAGINA ES VULNERABLE A SQLI BIND</br>";
 		
 	}
 	else
 	{
 		echo "<br><br>no se encontro el producto solicitado<br><br>";
 		
 	}

}


echo "<br>CON parámetros dinámicos EN HTML<br><br><a href='".rand(1, 1000)."'>CLICK AQUI</a>";

?>
