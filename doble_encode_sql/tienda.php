<?php

echo "<a href='/'>Ir anicio</a>";


if(!isset($_GET["id_producto"]))
{
	header("Location: tienda.php?id_producto=1");
}
else
{



	require_once("../cone.php");

 	$resultado=mysqli_query($conexion,"select * from productos where id=".urldecode($_GET["id_producto"])." limit 10");

 	if ($resultado=mysqli_fetch_array($resultado))
 	{
 		echo "<br><br><br><br>id: <strong>".$resultado["Id"]."</strong><br><br>";
 		echo "Producto: <strong>".$resultado["nombre"]."</strong><br><br>";
 		echo "Descripcion: <strong>".$resultado["descripcion"]."</strong><br><br><br><br>";
 		echo "La consulta que se esta utilizando es:<br>";
 		echo "<strong>select * from productos where id=<font color='red'>".urldecode($_GET["id_producto"])."</font> limit 10</strong>";
 	}
 	else
 	{
 		echo "<br><br>no se encontro el producto solicitado<br><br>";
 		echo "<strong>select * from productos where id=<font color='red'>".urldecode($_GET["id_producto"])."</font> limit 10</strong>";
 	}

}







?>
