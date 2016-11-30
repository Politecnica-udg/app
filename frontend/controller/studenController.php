<?php
	require_once 'frontend/views/view.php';
	require_once 'frontend/model/studenModel.php';
	class studen{
		var $data;
		function __construct(){$this->data = new model_studen();}
		public function pagHtml($html){
			return renderResponse(viewTemplad::studen($html.'.html'));
		}
		public function materias_Al(){
			global $conf_poli;
			$mat = $this->data->clases($conf_poli['cal_prof']);
			return jsonResponse($mat);
		}
		public function preguntasSave(){
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
		}
		public function el_emp(){
			$dat = $this->data->inf_Al($_SESSION['codigo']);
			if ($dat['datos_c'] != 0) {
				$d = $this->data->inf_soli($_SESSION['codigo']);
				if ($d) {
					return HttpResponse('index.php/cita');
				}else{
					return HttpResponse('index.php/catalogo');
				}
			}else{
				return HttpResponse("index.php/info_em");
			}
		}
		public function saveInfo(){
			if ($this->data->saveInfo($_POST)) {
				return HttpResponse("index.php/el_emp");
			}
		}
		public function catalogo(){
			$info_al = $this->data->info_al($_SESSION['codigo']);
			$dat = $this->data->catalogo($info_al['abr_car']);
			$_SESSION['carr'] = $info_al['abr_car'];
			return renderResponse(viewTemplad::studen('catalogo.html',$dat));
		}
		public function ele_em(){
			global $url_array;
			$inf_e = $this->data->inf_em($url_array[2]);
			$inf_e['soli'] = $this->data->solici_lista($url_array[2]);
			$promedio = $this->data->cali_al();
							$fecha = date("Y/m/d/H/i/s");
							if ($fecha >= "2016/12/5/00/00/01" && $promedio[0] >= 97) {
								$_SESSION['elegir'] = TRUE;  
							}elseif ($fecha >= "2016/12/5/06/00/01" && $promedio[0] >= 94) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/5/12/00/01" && $promedio[0] >= 91) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/5/18/00/01" && $promedio[0] >= 88) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/6/00/00/01" && $promedio[0] >= 85) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/6/06/00/01" && $promedio[0] >= 82) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/6/12/00/01" && $promedio[0] >= 79) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/6/18/00/01" && $promedio[0] >= 76) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/7/00/00/01" && $promedio[0] >= 73) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/7/06/00/01" && $promedio[0] >= 70) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/7/12/00/01" && $promedio[0] >= 67) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/7/18/00/01" && $promedio[0] >= 64) {
								$_SESSION['elegir'] = TRUE;
							}elseif ($fecha >= "2016/12/8/00/00/01" && $promedio[0] >= 60) {
								$_SESSION['elegir'] = TRUE;
							}else{
								$_SESSION['elegir'] = FALSE;
							}
			return renderResponse(viewTemplad::studen('info_e.html',$inf_e));
		}
		public function save_inf(){
			global $url_array;
			$this->data->save_inf($url_array[2]);
			return HttpResponse("index.php/el_emp");
		}
		public function cita(){
			$dat = $this->data->cita($_SESSION['codigo']);
			if ($dat['presento'] == 0) {
				return renderResponse(viewTemplad::studen('info_cita.html',$dat));
			}else{
				print_r($dat);
			}	
		}
	}
?>