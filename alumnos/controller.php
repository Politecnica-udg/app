<?php
	class alumnos {
		var $data;
		function __construct(){$this->data = new general_Al();}
		public function eval_A(){
			global $conf_poli;
			$arr1 = $this->data->clases($conf_poli['cal_prof'][0]);
			$arr2 = $$this->data->clases($conf_poli['cal_prof'][1]);
			$mat = array_merge($arr1,$arr2);
			return render_to_response (vista_Al::gen_dinamic('lista.html',$mat));
		}
		public function cali()
		{
			$cali['gen'] = $this->data->cali_gen();
			$cali['mate'] = $this->data->calificaciones();
			return render_to_response (vista_Al::gen_dinamic('calificaciones.html',$cali));
		}
		public function preguntas(){
			if ($_POST['a']=='guardar') {
				$data = $this->data->info($_POST['materia']);
				$array[0] += $_POST['1-1'];
				$array[0] += $_POST['1-2'];
				$array[0] += $_POST['1-3'];
				$array[0] += $_POST['1-4'];
				$array[0] += $_POST['1-5'];
				$array[0] /=5;
				$array[1] += $_POST['2-1'];
				$array[1] += $_POST['2-2'];
				$array[1] += $_POST['2-3'];
				$array[1] += $_POST['2-4'];
				$array[1] /=4;
				$array[2] += $_POST['3-1'];
				$array[2] += $_POST['3-2'];
				$array[2] += $_POST['3-3'];
				$array[2] += $_POST['3-4'];
				$array[2] /=4;
				$array[3] += $_POST['4-1'];
				$array[3] += $_POST['4-2'];
				$array[3] += $_POST['4-3'];
				$array[3] /=3;
				$array[4] += $_POST['5-1'];
				$array[4] += $_POST['5-2'];
				$array[4] /=2;
				$array[5] += $_POST['6-1'];
				$array[5] += $_POST['6-2'];
				$array[5] /=2;
				$array[6] = $_POST['com'];
				$data = $this->data->grabar($data,$array);
				return HttpResponse('index.php/alum_e/');
			}else{
				return render_to_response(vista_Al::gen_dinamic('preguntas.html'));
			}
		}
		public function ele_em()
		{
			global $url_array;
			$conf = $this->data->consul();
			if ($conf['datos_c'] == 0) {
				return render_to_response($this->view->gen_dinamic('info_ex.html'));
			}else{
				if ($conf['em_codigo'] == 0) {
					if ($url_array[3]) {
						if ($url_array[4]) {
							$this->data->marcar($url_array[4]);
							$this->data->marcar2($url_array[3]);
							return HttpResponse('index.php/ele_em/');
						}else{
							$inf_em = $this->data->tli($url_array[3]);
							$inf_em['soli'] = $this->data->solici_lista($url_array[3]);
							$promedio = $this->data->cali();
							$fecha = date("Y/m/d/H/i/s");
							if ($fecha >= "2014/12/08/00/00/01" && $promedio[0] >= 94.99) {
								$_SESSION['elegir'] = TRUE;  
							}elseif ($fecha >= "2014/12/08/12/00/01" && $promedio[0] >= 90.99) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2014/12/09/00/00/01" && $promedio[0] >= 84.99) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2014/12/09/12/00/01" && $promedio[0] >= 80.99) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2014/12/10/00/00/01" && $promedio[0] >= 74.99) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2014/12/10/12/00/01" && $promedio[0] >= 70.99) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2014/12/11/00/00/01" && $promedio[0] >= 64.99) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2014/12/11/12/00/01" && $promedio[0] >= 60.00) {
								$_SESSION['elegir'] = TRUE;
							}else{
								$_SESSION['elegir'] = FALSE;
							}
							return render_to_response($this->view->gen_dinamic('inf_em.html',$inf_em));
						}
					}else{
						$datos = $this->data->datos_al();
						$oferta = $this->data->catalogo($datos['abr_car']);
						$_SESSION['carr'] = $datos['abr_car'];
						return render_to_response($this->view->gen_dinamic('catalogo.html',$oferta));
					}
				}else{
					$cons = $this->data->cita();
					if ($cons['presento'] == 1) {
						$empresa = $this->data->con();
						$info = $this->data->em_info($empresa['em_codigo']);
						return render_to_response($this->view->gen_dinamic('dato_empresa.html',$info));
					}else{
						return render_to_response($this->view->gen_dinamic('info_em.html',$cons));
					}
					
				}	
			}
		}
	}
?>
