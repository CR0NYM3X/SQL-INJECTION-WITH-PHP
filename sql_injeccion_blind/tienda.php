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
 		echo "<strong>select * from productos where id=<font color='red'>".$_GET["id_producto"]."</font> limit 10</strong>";
 	}
 	else
 	{
 		echo "<br><br>no se encontro el producto solicitado<br><br>";
 		echo "<strong>select * from productos where id=<font color='red'>".$_GET["id_producto"]."</font> limit 10</strong>";
 	}

}


?>
