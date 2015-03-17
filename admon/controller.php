<?php
	class admon {
		var $view;
		var $data;
		function __construct()
		{
			$this->data = new general_A();
			$this->view = new vista_A();	
		}

		/*****************************************
		**************Director********************
		******************************************/
		public function lista()
		{
			$GLOBALS = $this->data->maestros();
			$this->view->lista();
		}
		public function falta()
		{
			$GLOBALS = $this->data->faltas();
			$this->view->faltas();
		}

		/*********************************
		*************Madre Katy**********
		*********************************/

		public function lis_cali()
		{
			global $url_array;
			if ($url_array[3]) {
				if ($url_array[4]) {
					if ($url_array[6]) {
						if ($url_array[8]) {
							$alums = $this->data->alumnos($url_array);
							return render_to_response($this->view->gen_dinamic('lis_cali.html',$alums));
						}else{
							$mat = $this->data->materias($url_array);
							return render_to_response($this->view->gen_dinamic('mate.html',$mat));
						}
					}else{
						$grup = $this->data->grupos($url_array);
						return render_to_response($this->view->gen_dinamic('grup.html',$grup));
					}
				}else{
					$carr = $this->data->carreras($url_array[3]);
					return render_to_response($this->view->gen_dinamic('carr.html',$carr));
				}			
			}else{
				return render_to_response($this->view->gen_dinamic('calendarios.html'));
			}	
		}

		public function evaluar()
		{
			global $url_array;
			if ($_POST['opcion'] == 'si') {
				$fecha = date("Y-d-m");
				for ($i=0; $i < $_POST['cantidad'] ; $i++) { 
					$var = ['cod' => $_POST['cod'.$i],
						'or' => $_POST['or'.$i],
						'ex' => $_POST['ex'.$i],
					];
					$this->data->sec_save($var,$fecha,$url_array);
				}
				$this->data->marcar_pro($url_array);
				return HttpResponse('index.php/admon/eval_grups/');
			}
			if ($url_array[3]) {
				if ($url_array[4]) {
					if ($url_array[6]) {
						$lis = $this->data->alumno_lista($url_array);
						return render_to_response($this->view->gen_dinamic('alum_sec.html',$lis));
					}else{
						$mat = $this->data->mate($url_array);
						return render_to_response($this->view->gen_dinamic('mate_sec.html',$mat));
					}
				}else{
					$grup = $this->data->grupos_tecno($url_array);
					return render_to_response($this->view->gen_dinamic('grup.html',$grup));
				}
			}else{
				if ($_SESSION['grado'] == 1) {
					$grupos = $this->data->cod_todos();
				}else{
					$grupos = $this->data->carr_tecno();
				}
				return render_to_response($this->view->gen_dinamic('carr_sec.html',$grupos));
			}
		}

		/******************************
		*****Cordinacion Academica*****
		******************************/
		
		public function im_evaa()
		{
			if ($_POST['materia']){
				$evaluacion = $this->data->califi($_POST['materia']);
				$cali = array('a' => 0,
								'b'=>0,
								'c'=>0,
								'd'=>0,
								'e'=>0,
								'f'=>0,
								'i'=>0);
				foreach ($evaluacion as $key => $value) {
					$cali['i']++;
					$cali['a']+=$value['a'];
					$cali['b']+=$value['b'];
					$cali['c']+=$value['c'];
					$cali['d']+=$value['d'];
					$cali['e']+=$value['e'];
					$cali['f']+=$value['f'];

				}
				return render_to_response($this->view->gen_dinamic('form_pdf.html',$cali));
			}elseif ($_POST['codigo_m']) {
				$clases = $this->data->clases_p($_POST['codigo_m']);
				return render_to_response($this->view->gen_dinamic('asig_prof.html',$clases));
			}else{
				return render_to_response($this->view->gen_dinamic('evaluacion.html'));
			}
		}

		/******************************
		****Cordinacion de Carrera*****
		******************************/
		public function ap_em()
		{
			global $url_array;
			if ($url_array[4]) {
				if ($url_array[4]=="aceptar") {
					$this->data->guardar($url_array[3]);
				}
				$this->data->eliminar($url_array[3]);
				return HttpResponse('index.php/admon/ap_em/');
			}else{
				if ($url_array[3]) {
					$datos = $this->data->dat_em($url_array[3]);
					return render_to_response($this->view->gen_dinamic('ver_info.html',$datos));
				}else{
					$em = $this->data->prere();
					return render_to_response($this->view->gen_dinamic('lis_em.html',$em));
				}
			}
		}
		public function asig_data()
		{
			global $url_array;
			if ($_POST) {
				$em = $this->data->adato_uno($_POST['id']);
				$this->data->edi_empresa($_POST);
				$this->data->new_empre($_POST,$em);
				return HttpResponse('index.php/admon/asig_data/');
			}else{
				if ($url_array[3]) {
					return render_to_response($this->view->gen_dinamic('form-em.html'));
				}else{
					$em = $this->data->adato();
					return render_to_response($this->view->gen_dinamic('lista-em.html',$em));
				}
			}
		}
		public function citas()
		{
			global $url_array;
			$fecha = date("Y/m/d/H/i/s");
			if ($url_array[3]) {
				switch ($url_array[3]) {
					case 'new':
						echo $fecha;
						if ($fecha >= '2014/12/07/23/56/30') {
							echo "Listo";
						}
						break;
					case 'modify':
						echo "MOdifi";
						break;
					
					default:
						return render_to_response("Error");
						break;
				}
			}else{
				return render_to_response($this->view->gen_dinamic('citview.html'));
			}
			
		}
	}
?>