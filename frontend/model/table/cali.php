<?php
	class cali{
		private $mysql;
		function __construct(){
			$this->mysql = new mysqli(host,user,pw,db);
			if ($mysql->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}
		public function getClass($sem){
			$query = $this->mysql->query("SELECT distinct id_cal, asig_cal, evaluar, nom_pes FROM cali
				INNER JOIN planes on ccar_pes = carr_cal AND gdo_pes = gdo_cal  AND casg_pes =asig_cal
				WHERE cic_cal='$sem' and cod_cal='$_SESSION[codigo]';");
			while ($reg=$query->fetch_array())
      			$data[] = $reg;
      		return $data;
		}
		public function getInfo($mat){
			$query = $this->mysql->query("SELECT carr_cal, gdo_cal, gpo_cal, asig_cal,cic_cal, tno_cal FROM cali 
				WHERE id_cal = '$mat' ");
			if ($reg=$query->fetch_array())
      			return $reg;
		}
		public function getGrabar($dato,$arr){
			$this->mysql->query("INSERT INTO evaluacion_a (carrera, grado, turno, grupo, materia,ciclo,a,b,c,d,e,f,com) values ('$dato[carr_cal]','$dato[gdo_cal]','$dato[tno_cal]','$dato[gpo_cal]','$dato[asig_cal]','$dato[cic_cal]','$arr[0]','$arr[1]','$arr[2]','$arr[3]','$arr[4]','$arr[5]','$arr[6]')");
			$this->mysql->query("UPDATE cali SET evaluar ='1' WHERE id_cal = '$_POST[materia]'");
		}
		public function cali_al(){
			$query = $this->mysql->query("SELECT cali FROM alumnos_datos WHERE codigo_a = '$_SESSION[codigo]';");
			if ($reg=$query->fetch_array())
      			return $reg;
		}
		function __destruct(){
			$this->mysql->close();
		}
	}
?>