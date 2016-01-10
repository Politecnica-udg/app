<?php
	$URLpatterns = [
		"/" => "index.inicio",
		"destroy" => "index.destroy",
		"404" => "index.e404",
		"app_admin" => "index.app_admin",
		"ips" => "index.ips",
		"lis_maestos" => "admon.lis_maestos"
	];
	patterns($URLpatterns);
?>