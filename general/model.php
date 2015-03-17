<?php
	class general extends datebase
	{
		function __construct()
		{
			parent::__construct();
		}
		public function datos()
		{
			$query = $this->consulta("SELECT * FROM user WHERE codigo = '$_POST[user]' ");
			$sea= $this->fetch_array($query);
			if (utf8_decode($_POST['ps']) == $sea['nip']) {
				return $sea;
			}else{
				return "";
			}
		}
		public function peditar($var)
		{
			$this->consulta("UPDATE user SET nip = '$var[nip]', email = '$var[email]' WHERE codigo = '$_SESSION[codigo]';");
		}
	}
?>