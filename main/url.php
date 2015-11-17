<?php
	switch ($objects["poli"]->url_p(URL_short())) {
		//App's generales
		case '/':{$objects["poli"]->log_in();}break;
		case 'distroy':{$objects["poli"]->distroy();}break;
		case 'app_admin':{$objects["poli"]->app_admin();}break;
		default:{$objects["poli"]->e404();}break;
		case 'ips':{$objects["poli"]->ips();}break;
		case 'ipsR':{$objects["poli"]->ipsR();}break;
		//App's de maestro
		case 'eval_grup':{$objects['maestro']->eval_grup();}break;
		case 'pdf':{$objects['maestro']->pdf_M();}break;
		//App's de alumno
		case 'cali':{$objects['alumno']->cali();}break;
		case 'alum_e':{$objects['alumno']->eval_A();}break;
		case 'preguntas':{$objects['alumno']->preguntas();}break;
		//administrativos
		case 'lis_maestos':{$objects['admon']->lisMaestros();}break;
		case 'lis_grupo':{$objects['admon']->lisGrupo();}break;
	}
?>