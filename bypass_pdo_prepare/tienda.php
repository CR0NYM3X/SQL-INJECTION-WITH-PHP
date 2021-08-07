<?php

echo "<a href='/'>Ir anicio</a>";


if(!isset($_GET["id_producto"]))
{
	header("Location: tienda.php?id_producto=1");
}
else
{
	$base= new PDO('mysql:host=127.0.0.1; dbname=sqli','root','');
	$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$base->exec('SET CHARACTER SET utf8');

	$resultado=$base->prepare("select * from productos where id=:idsql limit 10");
	$sqll=array(":idsql"=>$_GET["id_producto"]);
	#print_r($sqll=array(":idsql"=>$_GET["id_producto"]));
	$resultado->execute($sqll);

 	if ($resultado=$resultado->fetch(PDO::FETCH_ASSOC))
 	{
 		echo "<br><br><br><br>id: <strong>".$resultado["Id"]."</strong><br><br>";
 		echo "Producto: <strong>".$resultado["nombre"]."</strong><br><br>";
 		echo "Descripcion: <strong>".$resultado["descripcion"]."</strong><br><br><br><br>";
 		echo "La consulta que se esta utilizando es:<br>";
 		echo "<strong>select * from productos where id=<font color='red'>".$_GET["id_producto"]."</font> limit 10</strong>";
 	}
 	else
 	{
 		echo "<br><br>no se encontro el producto solicitado<br><br>";
 		echo "<strong>select * from productos where id=<font color='red'>".$_GET["id_producto"]."</font> limit 10</strong>";
 	}

}







?>
