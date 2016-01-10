<?php
	require_once 'frontend/views/view.php';
	require_once 'frontend/model/admonModel.php';
	class admon{
		var $data;
		function __construct(){$this->data = new model_admon();}
		public function lis_maestos(){
			global $url_array;

			if ($url_array[2]) {
				//$mat = $this->data->materias($url_array[2]);
				//return renderResponse(viewIndex::admon('materias.html',$mat));
			} else {
				$mat = $this->data->datosMaestros();
				return renderResponse(viewTemplad::admon('listaMaestros.html',$mat));

			}

		}	
	}
?>