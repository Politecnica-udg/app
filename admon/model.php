<?php
	class general_A extends datebase
	{
		function __construct()
		{
			parent::__construct();
		}

		public function carreras($cal)
		{
			$query = $this->consulta("SELECT distinct carr_cal,nom_car FROM cali 
				INNER JOIN carreras on ccar_car=carr_cal
				WHERE cic_cal = '$cal';");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function grupos($arr)
		{
			$query = $this->consulta("SELECT distinct gdo_cal,tno_cal,gpo_cal FROM cali WHERE cic_cal = '$arr[3]' AND carr_cal='$arr[4]'");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function materias($arr)
		{
			$query = $this->consulta("SELECT distinct asig_cal,nom_pes FROM cali 
				INNER JOIN planes on ccar_pes = carr_cal AND gdo_pes = gdo_cal AND casg_pes = asig_cal
				WHERE cic_cal = '$arr[3]' AND carr_cal='$arr[4]' AND gdo_cal = '$arr[5]' AND gpo_cal = '$arr[6]'");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function alumnos($arr)
		{
			$query = $this->consulta("SELECT distinct cod_cal,nom_ubi,num_cal, nop_cal FROM cali 
				INNER JOIN ubicacion on calu_ubi = cod_cal
				WHERE cic_cal = '$arr[3]' AND carr_cal='$arr[4]' AND gdo_cal = '$arr[5]' AND gpo_cal = '$arr[6]' AND asig_cal = '$arr[7]' order by nom_ubi;");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function cod_todos()
		{
			$query = $this->consulta("SELECT distinct carrera FROM escolar");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function carr_tecno()
		{
			$query = $this->consulta("SELECT carrera FROM escolar WHERE codigo = '$_SESSION[codigo]'");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function grupos_tecno($arr)
		{
			$query = $this->consulta("SELECT distinct gdo_cal,tno_cal,gpo_cal FROM cali WHERE carr_cal='$arr[3]'");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function mate($arr)
		{
			$query = $this->consulta("SELECT nom_pes, casg_prof, sec FROM asig_prof
				INNER JOIN planes ON ccar_pes = ccar_prof AND gdo_pes = gdo_prof AND casg_pes = casg_prof
				WHERE ccar_prof='$arr[3]' AND gdo_prof = '$arr[4]' AND gpo_prof='$arr[5]' ");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function alumno_lista($arr)
		{
			$query = $this->consulta("SELECT distinct nom_ubi,cod_cal,num_cal,num_cal2 FROM cali
				INNER JOIN ubicacion on calu_ubi=cod_cal
				WHERE cic_cal='2014A' AND carr_cal='$arr[3]' AND gdo_cal='$arr[4]' AND gpo_cal= '$arr[5]' AND asig_cal='$arr[6]' order by nom_ubi ");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}

		public function sec_save($arr,$fecha,$url)
		{
			$this->consulta("UPDATE cali SET num_cal ='$arr[or]', num_cal2 ='$arr[ex]', fec_cal ='$fecha' WHERE cod_cal='$arr[cod]' and carr_cal = '$url[3]' and asig_cal = '$url[6]' and gdo_cal = '$url[4]' ");
		}
		public function marcar_pro($url)
		{
			$this->consulta("UPDATE asig_prof SET sec ='1' WHERE ccar_prof = '$url[3]' and casg_prof = '$url[6]' and gdo_prof = '$url[4]' ");
		}
		public function clases_p($cod)
		{
			$query = $this->consulta("SELECT id,ccar_prof,gdo_prof,tur_prof,gpo_prof,casg_prof,cal_prof,cod_prof,nom_pes FROM asig_prof
				INNER JOIN planes ON ccar_pes = ccar_prof AND gdo_pes = gdo_prof AND casg_pes = casg_prof
				WHERE cod_prof = '$cod' AND (cal_prof = '2013B' OR cal_prof = '2014A');");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function califi($materia)
		{
			$query = $this->consulta("SELECT ccar_prof,gdo_prof,gpo_prof,casg_prof FROM asig_prof WHERE id = '$materia';");
			$sea= $this->fetch_array($query);
			$query = $this->consulta("SELECT * FROM evaluacion_a WHERE carrera = '$sea[0]' AND grado = '$sea[1]' AND grupo = '$sea[2]' AND materia = '$sea[3]'");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
			
		}
		public function prere()
		{
			$query = $this->consulta("SELECT id, name, actividad FROM registo_em");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function dat_em($id)
		{
			$query = $this->consulta("SELECT * FROM registo_em WHERE id = '$id'");
			$sea = $this->fetch_array($query);
			return $sea;
		}
		public function guardar($id)
		{
			$query = $this->consulta("SELECT * FROM registo_em WHERE id = '$id'");
			$sea = $this->fetch_array($query);
			$this->consulta("INSERT INTO empresas (name,rfc,domi,colo,cp,pais,estado,mun,email,tel,ex,fax,web,giro,actividad,antig,name_en,cargo,email_en) 
								values ('$sea[name]','$sea[rfc]','$sea[domi]','$sea[colo]','$sea[cp]','$sea[pais]','$sea[estado]','$sea[mun]','$sea[email]','$sea[tel]','$sea[ex]','$sea[fax]','$sea[web]','$sea[giro]','$sea[actividad]','$sea[antig]','$sea[name_en]','$sea[cargo]','$sea[email_en]')");
		}
		public function eliminar($id)
		{
			$this->consulta("DELETE FROM registo_em where id='$id';");
		}
		public function adato()
		{
			$query = $this->consulta("SELECT id, name,email FROM empresas WHERE code = '0'");
			while ( $tsArray = $this->fetch_assoc($query) ) {
				$data[] = $tsArray;	
			}
			return $data;
		}
		public function adato_uno($id)
		{
			$query = $this->consulta("SELECT id, name,email FROM empresas WHERE id = '$id'");
			$sea = $this->fetch_array($query);
			return $sea;
		}
		public function edi_empresa($arr)
		{
			$this->consulta("UPDATE empresas SET code ='$arr[codigo]' WHERE id='$arr[id]' ");
		}
		public function new_empre($arr,$arr2)
		{
			$this->consulta("INSERT INTO user (codigo,nip,email,nivel,tipo,nombre,grado) VALUES ('$arr[codigo]','$arr[pw]','$arr2[email]','6','empresa','$arr2[name]','0')");
			$this->consulta("INSERT INTO acuerdos_em (user) VALUES ('$arr[codigo]')");
		}
		function __destruct() {
			parent::__destruct();
		}
	}
?>