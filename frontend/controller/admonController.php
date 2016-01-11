<?php
	require_once 'frontend/views/view.php';
	require_once 'frontend/model/admonModel.php';
	class admon{
		var $data;
		function __construct(){$this->data = new model_admon();}
		public function lis_maestos($html){
			return renderResponse(viewTemplad::admon($html.'.html'));
		}
		public function datosMaestros(){
			$datos = $this->data->datosMaestros();
			$a = ["jaja"=>1,
					"pepe" => "juánñ"];
				//echo json_encode($datos,false,512);
			return jsonResponse($datos);
		}
	}
?>