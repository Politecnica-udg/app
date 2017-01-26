<?php
	class alumnos_datos{
		private $mysql;
		function __construct(){
			$this->mysql = new mysqli(host,user,pw,db);
			if ($mysql->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}
		public function inf_Al($cod){
			$query = $this->mysql->query("SELECT * FROM alumnos_datos WHERE codigo_a = '$cod' ");
			if ($reg=$query->fetch_array())
      			return $reg;
		}
		public function saveInfo($dat){
			$this->mysql->query("UPDATE alumnos_datos SET 
										domicilio_a	='$dat[domi]',
										colonia_a	='$dat[col]',
										cp_a 		='$dat[cp]',
										municipio	='$dat[mun]',
										estado 		='$dat[estado]',
										telp_a 		='$dat[tel_a]',
										telc_a 		='$dat[telc_a]',
										email_a 	='$dat[email_a]',
										imss 		='$dat[imss]',
										edad 		='$dat[edad_a]',
										nacionalida	='MEXICANA',
										vive 		='$dat[amvive]',
										maneja 		='$dat[optionsRadios]',
										estadocivil	='$dat[estacivil]',
										salud 		='$dat[salud]',
										enfermedad 	='$dat[cronica]',
										detalle_en	='$dat[enfermedad]',
										deporte		='$dat[sport]',
										name_p		='$dat[namep]',
										telp_p		='$dat[tel_p]',
										telc_p		='$dat[telc_p]',
										domicilio_p	='$dat[domi_p]',
										sexo 		='$dat[sexo]',
										ofamiliar	='$dat[parentesco]',
										name_o 		='$dat[nameo]',
										telp_o 		='$dat[tel_o]',
										telc_o 		='$dat[telc_o]',
										emergencia 	='$dat[parentesco_e]',
										name_e 		='$dat[name_e]',
										tel_c 		='$dat[tel_e]',
										datos_c 	= '1'
							WHERE codigo_a = '$_SESSION[codigo]';");
			return true;
		}
		public function sexo(){
			$query = $this->mysql->query("SELECT sexo FROM alumnos_datos WHERE codigo_a = '$_SESSION[codigo]' ");
			if ($reg=$query->fetch_array())
      			return $reg;
		}
		public function listaCartas(){
			$query = $this->mysql->query("SELECT codigo_a FROM alumnos_datos WHERE datos_c != 0 AND em_codigo != 0; ");
			while ($reg=$query->fetch_array()){
				if ($reg['codigo_a'] != "") {
					$data[] = $reg;
				}		
			}
      		return $data;
		}
		function __destruct(){
			$this->mysql->close();
		}
	}
?>