<?php
	require_once 'frontend/model/table/user.php';
	require_once 'frontend/model/table/ips_poli.php';
	class model_index{
		public function userData($user){
			$consu = new user();
			return $consu->queryAll(['codigo'=>$user]);
		}
		public function ip($dat){
			$consu = new ips_poli();
			return $consu->queryAll(['ip3_ip'=>$dat['ip3'], 'ip4_ip' => $dat['ip4']]);
		}
	}
?>