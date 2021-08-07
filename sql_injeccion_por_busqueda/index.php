<?php

echo "<a href='/'>Ir anicio</a>";


if(isset($_POST["nom_producto"]) and $_POST["nom_producto"]!="" and isset($_POST["btn"]))
{
	require_once("../cone.php");

 	$resultado=mysqli_query($conexion,"select * from productos where nombre like ('%".$_POST["nom_producto"]."%') limit 10");

 	if (mysqli_num_rows($resultado))
 	{
 		echo "<table border='1'><tr><th>id: </th><th>Producto</th><th>Descripcion</th></tr>";	
 		while ($res=mysqli_fetch_array($resultado)) 
 		{
 			echo "<tr>
 					<td>".$res['Id']."</td>
 					<td>".$res['nombre']."</td>
 					<td>".$res['descripcion']."</td>
 				</tr>";


 		}
 		

 		echo "</table><strong>select * from productos where nombre like ('%<font color='red'>".$_POST["nom_producto"]."</font>%')</strong>";
 	}
 	else
 	{
 		echo "<br><br>no se encontro el producto solicitado<br><br>";
 		echo "<strong>select * from productos where nombre like ('%<font color='red'>".$_POST["nom_producto"]."</font>%')</strong>";
 	}

}
 #select * from login where usuario like ("%jose%")


?>
<br><br><br>
<form action="" method="POST">
	Buscar Producto: <textarea rows="1" cols="100" name="nom_producto"><?php if(isset($_POST['nom_producto'])){ echo $_POST['nom_producto'];}?></textarea><br>
	<input type="submit" name="btn" value="Ver Producto">
</form>


<br><br><a >m%') union all select 1,2,version()-- -</a>