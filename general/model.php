<?php
	class general extends datebase{
		function __construct(){
			parent::__construct();
		}
		public function dato_user($user){
			$query = $this->consulta("SELECT * FROM user WHERE codigo = '$user'");
			$sea = $this->fetch_array($query);
				return $sea;
		}
		public function ip($ip){
			$query = $this->consulta("SELECT * FROM ips_poli WHERE ip3_ip = '$ip[ip3]' AND ip4_ip = '$ip[ip4]';");
			$sea = $this->fetch_array($query);
				return $sea;
		}
		public function ipSave($dat){
			$this->consulta("INSERT INTO ips_poli (name_ip, mac_ip, sw_ip, puerto_ip, ip1_ip, ip2_ip, ip3_ip, ip4_ip)
										VALUES ('$dat[namePC]','$dat[macD]','$dat[swIp]','$dat[puertoIp]','148','202','$dat[ip3S]','$dat[ip4S]');");
		}
		public function ipEdit($dat){
			$this->consulta("UPDATE ips_poli SET name_ip = '$dat[namePC]', mac_ip = '$dat[macD]', sw_ip = '$dat[swIp]', puerto_ip = '$dat[puertoIp]'
										WHERE ip3_ip = '$dat[ip3S]' AND ip4_ip = '$dat[ip4S]'");
		}
	}
?>