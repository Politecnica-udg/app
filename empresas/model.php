<?php
	class general_E extends datebase
	{
		function __construct()
		{
			parent::__construct();
		}

		public function guardar_prem($var)
		{
			$this->consulta("INSERT INTO registo_em (name,rfc,domi,colo,cp,pais,estado,mun,email,tel,ex,fax,web,giro,actividad,antig,name_en,cargo,email_en) 
								values ('$var[name_empre]','$var[rfc]','$var[domicilio]','$var[colonia]','$var[CP]','$var[pais]','$var[estado]','$var[mun]','$var[email]','$var[tel]','$var[ext]','$var[fax]','$var[web]','$var[giro_em]','$var[actividad]','$var[antig]','$var[name_enc]','$var[cargo]','$var[email_en]')");
		}
		public function consulta1_ad()
		{
			$query = $this->consulta("SELECT * FROM acuerdos_em WHERE user = '$_SESSION[codigo]' ");
			$sea= $this->fetch_array($query);
			return $sea;
		}
		public function consultas()
		{
			$query = $this->consulta("SELECT QTA,QTI,QTME,QTP,TEI,TF,TMI,TPI,total FROM acuerdos_em WHERE user = '$_SESSION[codigo]' ");
			$sea= $this->fetch_array($query);
			return $sea;
		}
		public function agregar($em)
		{
			$this->consulta("UPDATE acuerdos_em SET acuerdo = '1' WHERE id = '$em'");
		}
		public function sum($carr,$em)
		{
			$this->consulta("UPDATE acuerdos_em SET $carr = $carr+1,total = total+1 WHERE id = '$em'");
		}
		public function agre($arr)
		{
			$this->consulta("INSERT INTO solicitantes(em, carr, act, apoyo) values ('$_SESSION[codigo]', '$arr[carre]', '$arr[act]','$arr[apoyo]')");
		}
		public function contar($carr)
		{
			$query = $this->consulta("SELECT count(*) FROM solicitantes
				WHERE carr = '$carr' AND libre = '0' AND em = '$_SESSION[codigo]'");
			$sea= $this->fetch_array($query);
			return $sea;
		}
		public function listar($carr)
		{
			$query = $this->consulta("SELECT * FROM solicitantes
				INNER JOIN alumnos_datos on codigo_a = codigo
				WHERE carr = '$carr' AND libre = '1' AND em = '$_SESSION[codigo]'");
			while ( $tsArray = $this->fetch_assoc($query) ) {
					$data[] = $tsArray;			
				}
				return $data;
		}
		function __destruct() {
			parent::__destruct();
		}
	}
?>