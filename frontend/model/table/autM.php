<?php
	class autM{
		private $mysql;
		function __construct(){
			$this->mysql = new mysqli(host,user,pw,db);
			if ($mysql->connect_error) {
				die("Problemas con la conexion a la base de datos");
			}
		}
		public function getSaveFAM($a){
			$this->mysql->query("INSERT INTO autM (codM_autM,p1,p2,p3,p4,p5,p6,p7,p8,p9,p10,p11,p12,p13,p14,p15,p16,p17,p18,p19,p20,p21,p22,p23,p24,p25,p26,p27,p28,p29,p30,p31,p32,p33,p34,p35,p36,p37,p38,p39,p40,p41,p42,p43,p44)
								values ('$_SESSION[codigo]','$a[p1]','$a[p2]','$a[p3]','$a[p4]','$a[p5]','$a[p6]','$a[p7]','$a[p8]','$a[p9]','$a[p10]','$a[p11]','$a[p12]','$a[p13]','$a[p14]','$a[p15]','$a[p16]','$a[p17]','$a[p18]','$a[p19]','$a[p20]','$a[p21]','$a[p22]','$a[p23]','$a[p24]','$a[p25]','$a[p26]','$a[p27]','$a[p28]','$a[p29]','$a[p30]','$a[p31]','$a[p32]','$a[p33]','$a[p34]','$a[p35]','$a[p36]','$a[p37]','$a[p38]','$a[p39]','$a[p40]','$a[p41]','$a[p42]','$a[p43]','$a[p44]')");
			$this->mysql->query("UPDATE profesores SET evaluo ='1' WHERE cod_pro = '$_SESSION[codigo]'");
		}
		function __destruct(){
			$this->mysql->close();
		}
	}
?>