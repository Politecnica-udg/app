<?php
	require_once 'frontend/views/view.php';
	require_once 'frontend/model/admonModel.php';
	class admon{
		var $data;
		function __construct(){$this->data = new model_admon();}
		public function pagHtml($html){
			return renderResponse(viewTemplad::admon($html.'.html'));
		}
		public function datosMaestros(){
			$datos = $this->data->datosMaestros();
			return jsonResponse($datos);
		}
		public function datosGrupos(){
			global $url_array;
			if ($url_array[2] != 'undefined') {
				$cod = $url_array[2];
			}else{
				$cod = $_SESSION['codigo'];
			}
			$datos = $this->data->datosGrupos($cod);
			return jsonResponse($datos);
		}
	}
?>