<?php
	require_once 'frontend/views/view.php';
	require_once 'frontend/model/indexModel.php';
	class index{
		var $data;
		function __construct(){$this->data = new model_index();}
		public function inicio(){
			if ($_SESSION) {
				$str_datos = file_get_contents("frontend/assets/complementos/apps.json");
    			$app = json_decode($str_datos,true);
    			$_SESSION['apps'] = $app[$_SESSION['nivel']];
				return renderResponse(viewTemplad::page("principal.html"));
			}else{
				return renderResponse(viewTemplad::white("login.html"));
			}
			
		}
		public function log(){
			$datos = jsonPOST();
			$dat = $this->data->userData($datos['user']);
			if ($dat['nip'] == $datos['ps']) {
				$_SESSION = $dat;
				return jsonResponse(["estado" =>true]);
			}
			return jsonResponse(["estado" =>false]);
		}
		public function e404(){
			return renderResponse(viewTemplad::white("404.html"));
		}
		public function destroy(){
			session_destroy();
			return HttpResponse('index.php/');
		}
	}
?>