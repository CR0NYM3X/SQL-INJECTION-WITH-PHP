<?php

echo "<a href='/'>Ir anicio</a>";


if(isset($_POST["id_producto"]) and $_POST["id_producto"]!="" and isset($_POST["btn"]))
{
	require_once("../cone.php");

 	$resultado=mysqli_query($conexion,"select * from productos where id=".$_POST["id_producto"]." limit 10");

 	if ($resultado=mysqli_fetch_array($resultado))
 	{
 		echo "<br><br><br><br>id: <strong>".$resultado["Id"]."</strong><br><br>";
 		echo "Producto: <strong>".$resultado["nombre"]."</strong><br><br>";
 		echo "Descripcion: <strong>".$resultado["descripcion"]."</strong><br><br><br><br>";
 		echo "La consulta que se esta utilizando es:<br>";
 		echo "<strong>select * from productos where id=<font color='red'>".$_POST["id_producto"]."</font> limit 10</strong>";
 	}
 	else
 	{
 		echo "<br><br>no se encontro el producto solicitado<br><br>";
 		echo "<strong>select * from productos where id=<font color='red'>".$_POST["id_producto"]."</font> limit 10</strong>";
 	}

}



?>
<br><br><br>
<form action="" method="POST">
	id de producto: <textarea rows="1" cols="100" name="id_producto"><?php if(isset($_POST['id_producto'])){ echo $_POST['id_producto'];}?></textarea><br>
	<input type="submit" name="btn" value="Ver Producto">
</form>