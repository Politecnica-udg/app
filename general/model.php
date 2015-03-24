<?php
	class general extends datebase{
		function __construct(){
			parent::__construct();
		}
		public function dato_user($user){
			$query = $this->consulta("SELECT * FROM user WHERE codigo = '$user'");
			$sea= $this->fetch_array($query);
				return $sea;
		}
	}
?>