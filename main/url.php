<?php
	switch ($objects["poli"]->url_p(URL_short())) {
		//App's generales
		case '/':{$objects["poli"]->log_in();}break;
		case '/distroy/':{$objects["poli"]->distroy();}break;
		case '/app_admin/':{$objects["poli"]->app_admin();}break;
		default:{$objects["poli"]->e404();}break;
		//App's de maestro
		case '/maestro/eval_grup/':{$objects['maestro']->eval_grup();}break;
		case '/maestro/pdf/':{$objects['maestro']->pdf_M();}break;
		//App's de alumno
		case '/alumno/cali/':{$objects['alumno']->cali();}break;
		case '/alumno/alum_e/':{$objects['alumno']->eval_A();}break;
		case '/alumno/preguntas/':{$objects['alumno']->preguntas();}break;
	}
?>