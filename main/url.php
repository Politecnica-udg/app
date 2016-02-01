<?php
	$URLpatterns = [
		"/" => "index.inicio",
		"log" => "index.log",
		"destroy" => "index.destroy",
		"404" => "index.e404",
		"app_admin" => "index.app_admin",
		"lis_maestos" => "admon.pagHtml.listaMaestros",
		"datosMaestros" => "admon.datosMaestros",
		"asigProf" => "admon.pagHtml.maestroLis",
		"datosGrupos" => "admon.datosGrupos",
		"eval_grup" => "admon.pagHtml.maestroLis",
		"alum_lis" => "admon.pagHtml.alumnosLis",
		"datAl" => "admon.datAl",
		"saveCal" => "admon.saveCal",
		"saveFal" => "admon.saveFal",
		"grabarM" => "admon.grabarM",
		"pdf" => "admon.pdf_M"
	];
	patterns($URLpatterns);
?>