<?php

echo "<a href='/'>Ir anicio</a>";


if(!isset($_GET["id_producto"]))
{
	header("Location: tienda.php?id_producto=1");
}
else
{
	require_once("../cone.php");

 	$resultado=mysqli_query($conexion,"select * from productos where id='".addslashes($_GET["id_producto"])."' limit 10");

 	if ($resultado=mysqli_fetch_array($resultado))
 	{
 		echo "<br><br><br><br>id: <strong>".$resultado["Id"]."</strong><br><br>";
 		echo "Producto: <strong>".$resultado["nombre"]."</strong><br><br>";
 		echo "Descripcion: <strong>".$resultado["descripcion"]."</strong><br><br><br><br>";
 		echo "La consulta que se esta utilizando es:<br>";
 		echo "<strong>select * from productos where id=<font color='red'>'".addslashes($_GET["id_producto"])."'</font> limit 10</strong>";
 	}
 	else
 	{
 		echo "<br><br>no se encontro el producto solicitado<br><br>";
 		echo "<strong>select * from productos where id=<font color='red'>'".addslashes($_GET["id_producto"])."'</font> limit 10</strong>";
 	}

}

echo "<br><br>Solo en tipo de caracteres 好 GBK  %bf%27 or %af%27  or %eb%27 or  %bc%27 or %a7%27

<br>aprender que es --+ <---el mas se significa un espacio en blanco";
?>
