<?php
	$URLpatterns = [
		"/" => "index.inicio",
		"log" => "index.log",
		"destroy" => "index.destroy",
		"404" => "index.e404",
		"app_admin" => "index.app_admin",
		"lis_maestos" => "admon.lis_maestos.listaMaestros",
		"datosMaestros" => "admon.datosMaestros"
	];
	patterns($URLpatterns);
?>