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
	}
?>