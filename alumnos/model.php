<?php
	class general_Al extends datebase{
		function __construct(){parent::__construct();}
		public function clases($sem){
			$query = $this->consulta("SELECT distinct id_cal, asig_cal, evaluar, nom_pes FROM cali
				INNER JOIN planes on ccar_pes = carr_cal AND gdo_pes = gdo_cal  AND casg_pes =asig_cal
				WHERE cic_cal='$sem' and cod_cal='$_SESSION[codigo]';");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function calificaciones(){
			$query = $this->consulta("SELECT nom_pes, gdo_cal, gpo_cal,num_cal,num_cal2,nop_cal,evaluar, st_nex FROM cali 
				INNER JOIN planes on ccar_pes=carr_cal AND gdo_pes=gdo_cal AND casg_pes=asig_cal
				WHERE cod_cal='$_SESSION[codigo]' ");
			if($this->numero_de_filas($query) > 0){
				while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
			}else{	
				return '';
			}
		}
		public function cali_gen(){
			$query = $this->consulta("SELECT cali FROM alumnos_datos WHERE codigo_a = '$_SESSION[codigo]' ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function info($mat)
		{
			$query = $this->consulta("SELECT carr_cal, gdo_cal, gpo_cal, asig_cal,cic_cal FROM cali 
				WHERE id_cal = '$mat' ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function grabar($dato,$arr)
		{
			$this->consulta("INSERT INTO evaluacion_a (carrera, grado, grupo, materia,ciclo,a,b,c,d,e,f,com) values ('$dato[0]','$dato[1]','$dato[2]','$dato[3]','$dato[4]','$arr[0]','$arr[1]','$arr[2]','$arr[3]','$arr[4]','$arr[5]','$arr[6]')");
			$this->consulta("UPDATE cali SET evaluar ='1' WHERE id_cal = '$_POST[materia]'");
		}
		public function consul()
		{
			$query = $this->consulta("SELECT datos_c,em_codigo FROM alumnos_datos WHERE codigo_a = '$_SESSION[codigo]'");
			$sea= $this->fetch_array($query);
			if ($sea != '') {
				return $sea;
			}else{
				return '';
			}	
		}
		public function datos_al()
		{
			$query = $this->consulta("SELECT ccar_ubi,abr_car FROM ubicacion
				INNER JOIN carreras on ccar_car=ccar_ubi
				WHERE calu_ubi = '$_SESSION[codigo]' ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function catalogo($car)
		{
			$query = $this->consulta("SELECT em,count(*), name, domi FROM solicitantes
				INNER JOIN empresas on code = em
				WHERE carr = '$car' AND libre = '0'  GROUP BY em");
			while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
		}
		public function tli($cod)
		{
			$query = $this->consulta("SELECT * FROM empresas WHERE code = '$cod'");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function solici_lista($cod)
		{
			$query = $this->consulta("SELECT distinct * FROM solicitantes
				WHERE carr = '$_SESSION[carr]' AND libre = '0' AND em = '$cod'");
			while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
		}
		public function marcar($dato)
		{
			$this->consulta("UPDATE solicitantes SET libre = '1', codigo='$_SESSION[codigo]' WHERE id = '$dato';");
		}
		public function marcar2($dato)
		{
			$this->consulta("UPDATE alumnos_datos SET em_codigo = '$dato' WHERE codigo_a = '$_SESSION[codigo]';");
			$this->consulta("INSERT INTO citas (codigo_a) VALUES ('$_SESSION[codigo]')");
		}
		public function edit_perfil()
		{
			$this->consulta("UPDATE alumnos_datos SET domicilio_a='$_POST[domi]' ,colonia_a='$_POST[col]' ,cp_a='$_POST[cp]',municipio='$_POST[mun]',estado='$_POST[estado]',telp_a='$_POST[tel_a]',telc_a='$_POST[telc_a]',email_a='$_POST[email_a]',imss='$_POST[imss]',edad='$_POST[edad_a]',nacionalida='MEXICANA',vive='$_POST[amvive]',maneja='$_POST[optionsRadios]',estadocivil='$_POST[estacivil]',salud='$_POST[salud]',enfermedad='$_POST[cronica]',detalle_en='$_POST[enfermedad]',deporte='$_POST[sport]',name_p='$_POST[namep]',telp_p='$_POST[tel_p]',telc_p='$_POST[telc_p]',domicilio_p='$_POST[domi_p]',ofamiliar='$_POST[parentesco]',name_o='$_POST[nameo]',telp_o='$_POST[tel_o]',telc_o='$_POST[telc_o]',emergencia='$_POST[parentesco_e]',name_e='$_POST[name_e]',tel_c='$_POST[tel_e]', datos_c = '1' WHERE codigo_a = '$_SESSION[codigo]';");
		}
		public function cali()
		{
			$query = $this->consulta("SELECT cali FROM alumnos_datos WHERE codigo_a = '$_SESSION[codigo]'; ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function cita()
		{
			$query = $this->consulta("SELECT * FROM citas WHERE codigo_a = '$_SESSION[codigo]' ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function con()
		{
			$query = $this->consulta("SELECT em_codigo FROM alumnos_datos WHERE codigo_a = '$_SESSION[codigo]' ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
		public function em_info($co)
		{
			$query = $this->consulta("SELECT * FROM empresas WHERE code = '$co' ");
			$sea= $this->fetch_array($query);
				return $sea;
		}
	}
?>