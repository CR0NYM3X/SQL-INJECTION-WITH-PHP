<?php

/**
	Agrega slashes invertidas para que puedan ser leeidas por expreciones regulares
*/

function slashes($var1,$quitarslashes=null)
{
	if(!is_null($quitarslashes))
	{
		$textoOriginal=$var1;
		if(!($var1=@preg_replace("/\\/", "", $var1 )))
		{
			return $textoOriginal;
		}

		return $var1;
	}

	return preg_replace(array("/\)/","/\*/","/\'/","/\"/","/\//","/\=/","/\(/","/\"/","/\?/","/\!/", "/\</", "/\>/", "/\#/", "/\[/", "/\]/", "/\{/", "/\}/", "/\:/", "/\%/", "/\+/", "/\-/", "/\_/", "/\|/", "/\^/"), array("\)","\*","\'","\"","\/","\=","\(","\"","\?","\!", "\<", "\>", "\#", "\[", "\]", "\{", "\}", "\:", "\%", "\+", "\-", "\_", "\|", "\^"),  $var1);

}


/**
	Compara dos Textos y retorna las palabras diferentes
	Compara el Texto1 con el Texto2 y  retornar aun array(Diferencias de palabras de texto2, Diferencias de palabras de Texto1)
*/
function compararTexto($var1,$var2,$PrepararExpreRg=null)
{


	if(!is_null($PrepararExpreRg))
	{

		$var1=slashes($var1);
		$var2=slashes($var2);

		$var1=preg_replace(array("/\s+/"), array("/i<*|*>/") , strtolower(trim("/".$var1."/i")));
		$var2=preg_replace(array("/\s+/"), array("/i<*|*>/") , strtolower(trim("/".$var2."/i")));
	}
	else
	{

		$var1=preg_replace(array("/\s+/"), array("<*|*>") , strtolower(trim($var1)));
		$var2=preg_replace(array("/\s+/"), array("<*|*>") , strtolower(trim($var2)));
	}



	if($var1!=$var2)
	{

		$var1=explode("<*|*>",$var1);
		$var2=explode("<*|*>",$var2);
		return array(array_values(array_diff($var2,$var1)),array_values(array_diff($var1,$var2)));


	}
	else
	{
		return false;
	}
}



/**
	Sirve para encontrar la diferencia de textotrue y textofalse y coinsidencia del textotrue con textoAcoinsidir
	Funcion que sirve solamente para paginas html
*/
function coincidenciaTexto($textoTrue,$textoAcoinsidir)
{
	return preg_match_all("/(".implode("\-|\-",slashes($textoTrue)).")/i",preg_replace("/\s+/","-",$textoAcoinsidir));

	#return preg_match_all("/(".implode("\-|\-",slashes(compararTexto(/*Link true*/	$textoTrue,/* Link false*/	$textoFalse)[1])).")/i", /*Link al que quieres que coinsida*/ preg_replace("/\s+/","-",$textoAcoinsidir));

}



function paginas($texto1,$texto2,$textofalse)
{

	if(count($resultado=array_diff(compararTexto(	$texto1,	$textofalse)[1],compararTexto(	$texto1,	$texto2)[1]))==0)
	{
		die("\nSE PRODUJO UN ERROR AL TRATAR DE COMPARAR EL DESARROLLADOR NO A REPARADO ESTE PROBLEMA\n");
	}
	return $resultado;
}






$var1="<a href='/'>Ir anicio</a><br><br><br><br>id: <strong>1</strong><br><br>Producto: <strong>jamon</strong><br><br>Descripcion: <strong>rico delicioso</strong><br><br><br><br><br><br><br><a href='/prueba/nomas/perra/201'>Dar click</a>";



$var2="<a href='/'>Ir anicio</a><br><br><br><br>id: <strong>1</strong><br><br>Producto: <strong>jamon</strong><br><br>Descripcion: 5<strong>rico delicioso</strong><br><br><br><br><br><br><br><a href='/prueba/nomas/perra/444'>Dar click</a>";


$var3="<a href='/'>Ir anicio</a><br><br>no se encontro el producto solicitado<br><br><br><br><br><a href='/prueba/nomas/perra/243'>Dar click</a>";

#mysqli_fetch_array()
/*

###########################comparar solo paginas estaticas y evade el xss####################################
print_r($varArray= compararTexto($var1,$var3)[1]);

	if(coincidenciaTexto($varArray,$var2))
	{
		echo "SE ENCONTRO CONSIDENCIAS";
	}
	else
	{
		echo "NOOOOOOOOOOO SE ECONTRARON CONSIDENCIAS";
	}

*/

$as="John Winston Ono Lennon [a] MBE (del 9 de octubre de 1940 al 8 de diciembre de 1980) fue un cantante, compositor y activista por la paz inglés cofundador de los Beatles , [2] la banda con mayor éxito comercial en la historia de la música popular . Él y su compañero Paul McCartney formaron una asociación de composición muy celebrada . Junto con George Harrison y Ringo Starr , el grupo ascendería a la fama mundial durante los años sesenta. Después de que el grupo se disolvió en 1970, Lennon siguió una carrera en solitario y comenzó la banda Plastic Ono Band con su segunda esposa, Yoko Ono .";

$as1="John Winston Ono L1ennon [a] MBE (del 9 de octubre de 1940 al 8 de diciembre de 1980) fue un cantante, compositor y activista por la paz inglés cofundador de los Beatles , [2] la banda con mayor éxito comercial en la historia de la música popular . Él y su compañero Paul McCartney formaron una asociación de composición muy celpebrada . Junto con George Harr1ison y Ringo Starr , el grupo ascendería a la fama mundial durante los años sesenta. Después de que el grupo se disolvió en 1970, Lennon siguió una carrera en solitario y comenzó la banda Plastic Ono Band con su segunda esposa, Yoko Ono .";




#######################COMPARACION SOLO PARA CUANDO LA PAGINA ES DINAMICA##############################
$varArray=paginas($var1,$var2,$var3);

var_dump(compararTexto($as,$as1));



if(compararTexto($var1,$var2))
{
	echo "ES UNA PAGINA DINAMICA\n\n\n ";

	if(($lo=coincidenciaTexto($varArray,$var3)))
	{
		echo "SE ENCONTRO CONSIDENCIAS ";
	}
	else
	{
		echo "NOOOOOOOOOOO SE ECONTRARON CONSIDENCIAS";
	}


}
else
{
	echo "NO ES UNA PAGINA DINAMICA";
}
