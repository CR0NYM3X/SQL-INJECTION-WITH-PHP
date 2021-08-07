<?php
	//SISTEMA DE DETECCION DE VULNERABILIDAD SQL INJECCION.


#set_time_limit — Limita el tiempo máximo de ejecución
#http://php.net/manual/es/function.set-time-limit.php


require_once "class/facilcurl.php";
require_once "configuraciones/tiempo.php";
require_once "configuraciones/comparadorTextos.php";
require_once "configuraciones/filtroswaf.php";
require_once "Detector.php";


$curl = new facilcurl();
$tiempo= new tiempo();
#$filtro= new filtros();


$link='www.paginaVulnerable.com';



/*

#opcional para mostrar los headers
$curl->curl($link,null,0,null,0);
$curl->header_in();
$headerIn= $curl->exe_curl($info);
$curl->header_desability(); //para desabilitarlo

echo "\n\nLO QUE MANDAMOS AL SERVIDOR\n";
print_r($info['request_header']);
echo "\n\nLO QUE CONTESTA EL SERVIDOR\n";
print_r($headerIn);
*/



$tiempo->start();
$curl->curl($link,null,0,null,0);
$pagina1	=	$curl->exe_curl();
echo "\nTiempo de ejecucion link Normal #1:	".$tiempo->end();


$tiempo->start();
$curl->curl($link,null,0,null,0);  #and sleep(5)
$pagina2	=	$curl->exe_curl();
echo "\nTiempo de ejecucion link Normal #2:	".$tiempo->end();

$tiempo->start();
$curl->curl($link,null,0,null,0);  #and sleep(5)
$pagina3	=	$curl->exe_curl();
echo "\nTiempo de ejecucion link Normal #3:	".$tiempo->end();


$tiempo->start();
$curl->curl($link."%56%41%4c%49%53%54%45%56%52%47%50%4f%52%50%45%4e%44%45%4a%4f%4a%41%4a%41%22%27",null,0,null,0);
$paginaError	=	$curl->exe_curl();
echo "\nTiempo de ejecucion link Error:		".$tiempo->end();


$tatus=0; #0= etatica y 1= Dinamica
$xss=0; #si es vulnerable a xss se pone en 1
$baseTime=0; #Si la pagina a webo nesesita SQLI basas en tiempo
$ShowError=0;	# si la pagina muestra mensajes de errores







#PONER FUNCIONA QUE VERIFIQUE LA URL









if(preg_match_all('#VALISTEVRGPORPENDEJOJAJA#', $paginaError))
{
	$xss=1;
	echo "\nVULNERABLE A XSS\n";
}

	
if (preg_match_all('#(mysqli_fetch_array\(\)|mysqli_query\(\)|mysqli_connect\(\)|mysqli_fetch|mysql_fetch|mysql_fetch_array\(\)|mysql_query\(\)|Unknown column|You have an error in your SQL syntax|check the manual that corresponds to your|server version for the right syntax to use near|Duplicate entry|XPATH syntax error\:|The used SELECT statements have a different number of columns
)#i', $paginaError))
{
		$ShowError=1;
		echo "\nLa pagina muestra Errores Se puede Utilizar SQLI-BASE ERROR\n";

		##verificar bien esta opcion para sacar mas provecho y tratar de evitar las injecciones con tiempo
}


if(md5($pagina1)==md5($paginaError) OR md5($pagina2)==md5($paginaError) OR md5($pagina3)==md5($paginaError) and $ShowError==0)
{

		$baseTime=1;
		#como opcion antes de hacer las injecciones de tiempo se pueden ver que intente con las otras variables
		#como opcion verificar si se puede con injecciones blind en vez de "and 1=1" ahora sera "or 1=1" 
		echo "\nESTA PAGINA NECESITA SQLI BASE-TIME\n";

}
else
{

	if(md5($pagina1) == md5($pagina2) AND md5($pagina1) == md5($pagina3) AND  md5($pagina2) == md5($pagina3))
	{
		echo "\nSTATUS DE PAGINA: ESTATICA";
		estatico($pagina1,$pagina2,$paginaError);
	}
	else
	{

			$tatus=1;
		echo "\nSTATUS DE PAGINA: DINAMICA";
		$varArray=paginas($pagina1,$pagina2,$paginaError);
		if(coincidenciaTexto($varArray,$pagina2))
		{
			echo "\nSE ENCONTRO CONSIDENCIAS";
		}
		else
		{
			echo "\nNOOOOOOOOOOO SE ECONTRARON CONSIDENCIAS";
		}

		if(coincidenciaTexto($varArray,$paginaError))
		{
			echo "\nSE ENCONTRO CONSIDENCIAS";
		}
		else
		{
			echo "\nNOOOOOOOOOOO SE ECONTRARON CONSIDENCIAS";
		}

			#dinamico($link);
			#ACRIVAR FILTROS DE QUITADO DE XSS
	}

}
