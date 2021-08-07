<?php



if(!isset($_GET["id_producto"]))
{
	header("Location: t.php?id_producto=1");
}
else
{
	require_once("cone.php");

 	$resultado=mysqli_query($conexion,"select * from productos where id=".$_GET["id_producto"]." limit 10");

 	if ($resultado=mysqli_fetch_array($resultado))
 	{

 		echo "<strong>".$resultado["nombre"]."</strong>-".rand(1, 1000)."<br><br><br><br>";
 		
 	}
 	else
 	{
 		echo "<strong>NO_SE_ECNONTRO_NINGUNO-".rand(1,1000)."</strong><br><br><br><br>";
 		
 	}

}







?>
