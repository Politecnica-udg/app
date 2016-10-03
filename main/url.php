<?php
	$URLpatterns = [
		"/" 			=> "index.inicio",
		"log" 			=> "index.log",
		"destroy" 		=> "index.destroy",
		"404" 			=> "index.e404",
		"app_admin" 	=> "index.app_admin",
		"lis_maestos" 	=> "admon.pagHtml.listaMaestros",
		"datosMaestros" => "admon.datosMaestros",
		"asigProf" 		=> "admon.pagHtml.maestroLis",
		"datosGrupos" 	=> "admon.datosGrupos",
		"eval_grup" 	=> "admon.pagHtml.maestroLis",
		"alum_lis" 		=> "admon.pagHtml.alumnosLis",
		"datAl" 		=> "admon.datAl",
		"saveCal" 		=> "admon.saveCal",
		"saveFal" 		=> "admon.saveFal",
		"grabarM" 		=> "admon.grabarM",
		"pdf" 			=> "admon.pdf_M",
		"alum_e" 		=> "studen.pagHtml.alum_e",
		"materias_Al" 	=> "studen.materias_Al",
		"preguntas" 	=> "studen.pagHtml.preguntas",
		"preguntasSave" => "studen.preguntasSave",
		"editP"			=> "index.pagHtml.editP",
		"pwNew"			=> "index.pwNew",
		"autEM"			=> "admon.pagHtml.autEM",
		"saveFAM"		=> "admon.saveFAM"
	];
	patterns($URLpatterns);
?>