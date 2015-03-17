<?php
	switch ($objects["poli"]->url_p(URL_short())) {
		case '/':{$objects["poli"]->log_in();}break;
		case '/distroy/':{$objects["poli"]->distroy();}break;
		case '/denegado/':{$objects["poli"]->denegado();}break;
		case '/alumno/cali/':{$objects["alumnos"]->cali();}break;
		case '/alumno/alum_e/':{$objects["alumnos"]->eval_A('2014A');}break;
		case '/alumno/preguntas/':{$objects["alumnos"]->preguntas();}break;
		case '/admon/lis_calit/':{$objects["admon"]->lis_cali();}break;
		case '/admon/eval_grups/':{$objects["admon"]->evaluar();}break;
		case '/visitante/rempresa/':{$objects["empresas"]->registro();}break;
		case '/perfil/editar/':{$objects["poli"]->perfil();}break;
		case '/admon/im_evaa/':{$objects["admon"]->im_evaa();}break;
		case '/empresa/adiestramientos/':{$objects["empresas"]->adiestramientos();}break;
		case '/alumno/ele_em/':{$objects["alumnos"]->ele_em();}break;
		case '/admon/ap_em/':{$objects["admon"]->ap_em();}break;
		case '/admon/asig_data/':{$objects["admon"]->asig_data();}break;
		case '/perfil/editar/alumno/':{$objects["alumnos"]->perfil_ed();}break;
		case '/admon/cita/':{$objects["admon"]->citas();}break;
		//App en cosntruccion
		case '/maestro/eval_grup/':{echo "Evaluar a los alumnos";}break;
		case '/admon/lis_maestos/':{echo "Lista de maestros que faltan por evaluar Y el estado de los mismos";}break;
		case '/admon/lis_calit/':{echo "Lista de calificaciones de todos los grupos.";}break;
		case '/admon/eval_grups/':{echo "Evaluar a los grupos";}break;
		case '/empresa/btrabajo/':{echo "Bolsa de trabajo de la escuela politecnia de Guadalajara.";}break;
		case '/admon/catalt/':{echo "Catalogo para los adiestramientos de la escuela politecnia de guadalajara.";}break;
		case '/admon/aam/':{echo "Asignar a los alumnos a sus maestros facilitadores.";}break;
		case '/maestro/vae/':{echo "Ver informacion de los alumnos que le fueron asignados.";}break;
		case '/alumno/vbt/':{echo "Ver bolsa de trabajo de la escuela politecnia.";}break;
		default:{
			if (URL_short() == NULL) {
				$objects["poli"]->log_in();
			}else{
				$objects["poli"]->E_404();
			}
		}			
		break;
	}
?>