<?php
	/*Variables de sesion, url array
	y configuracion del host*/
	session_start();
	$url_array;
	$conf_host;
	/*Funcion para obtener la url*/
	function URL_short(){
		$url = $_SERVER['PATH_INFO'];
	    	return $url;
	}
	/*Funcion para cargar las aplicaciones
	en el sistema
	Funcion que debe cambiar
	*/
	function crearObjeto($app){
		$inf = explode('.', $app);
		require_once("frontend/controller/".$inf[0]."Controller.php");
		$objeto = new $inf[0]();
		$objeto->$inf[1]($inf[2]);
	}
	function patterns($url){
		global $url_array;
		$url_array = explode('/', URL_short());
		if ($url_array[0] == '' and !$url_array[1]){
			$valor = "/";
		}else{
			$valor = $url_array[1];
		}
		if($url[$valor]){
			crearObjeto($url[$valor]);
		}else{
			if ($url['404']) {
				crearObjeto($url['404']);
			}else{
				echo "404";
			}
		}
	}
	/*Funcion para cambiar las etiquetas de configuracion
	por los valores de que se asigna en el arreglo de
	configuracion*/
	function conf($tem){
		global $conf_host;
		foreach ($conf_host as $key => $value){
			$tem = str_replace('{['.$key.']}',$value,$tem);
		}
		return $tem;
	}
	/*Funcion para cargar el diccionario de palabras y
	hacer el cambio por las claves en las paginas.*/
    function lang($tem){
    	$str_datos = file_get_contents("frontend/assets/languages/es_MX.json");
    	$lang = json_decode($str_datos,true);
		foreach($lang as $clave => $valor ){
			$tem = str_replace('['.$clave.']',$valor,$tem);
		}
		return conf($tem);
	}
	/*Funcion que recibe codigo .html y retorna
	un string del mismo listo para insertar y
	remplasar por su valor*/
	function loadPage($page){
		return file_get_contents($page);
	}
	/*Funcion que recive una pag con terminacion
	.html junto con un arreglo, donde se crea un
	bufer en el cual se ejecuta e interpreta el
	codigo que tiene interno de php ejecutando y
	inclullendo el arreglo.*/
	function dinamic($page,$arr = null){
		ob_start();
		require_once ($page);
		$sections = ob_get_clean();
		return $sections;
	}
	/*Funcion que imprime el valor que recibe*/
	function renderResponse($string){
		echo $string;
	}
	/*Funcion que redirigue a otra pagina del
	mismo sitio.*/
	function httpResponse($string){
		global $conf_host;
		header("Location: ".$conf_host['host'].$string);
	}
	/*Funcion que recibe un arreglo retornando un arreglo
	en formato json para poder trabajar con el desde otro
	sistema*/
	function jsonResponse($arr){
		header('Content-Type: text/txt; charset=ISO-8859-1');
		echo json_encode($arr);
		switch(json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - Sin errores';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Excedido tamaño máximo de la pila';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Desbordamiento de buffer o los modos no coinciden';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Encontrado carácter de control no esperado';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Error de sintaxis, JSON mal formado';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Caracteres UTF-8 malformados, posiblemente están mal codificados';
        break;
        default:
            echo ' - Error desconocido';
        break;
    }
	}
	function jsonPOST(){
		$dato = json_decode(file_get_contents("php://input"));
		foreach ($dato as $key => $value){$d[$key] = $value;}
		return $d;
	}
	/*Funcion que funciona para remplasar partes de las plantillas
	por los valores obtenidos de la ejecucion de otras apliaciones*/
	function remplas($array,$tem){
		foreach($array as $clave => $valor ){
			$tem = str_replace('{'.$clave.'}',$valor,$tem);
		}
		return lang($tem);
	}
	function hola(){
		return "hola :D";
	}
	/*Inclulle el archivo de configuracion del sistema*/
	require_once 'main/settings.php';
?>